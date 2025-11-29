const express = require("express");
const { db } = require("../db");

const router = express.Router();

/**
 * GET /api/cart/:userId
 * returns the latest cart for a user and its items.
 */
router.get("/:userId", async (req, res) => {
  const userId = req.params.userId;

  try {
    // get latest cart for this user
    const [cartRows] = await db.query(
      "SELECT * FROM carts WHERE user_id = ? ORDER BY created_at DESC LIMIT 1",
      [userId]
    );

    if (!cartRows.length) {
      return res.json({ cartId: null, items: [] });
    }

    const cart = cartRows[0];
    const cartId = cart.cart_id;

    const [items] = await db.query(
      `SELECT 
          ci.cart_item_id,
          ci.quantity,
          ci.unit_price,
          ci.line_total,
          p.product_id,
          p.name
       FROM cart_items ci
       JOIN products p ON ci.product_id = p.product_id
       WHERE ci.cart_id = ?`,
      [cartId]
    );

    res.json({ cartId, items });
  } catch (err) {
    console.error("Error loading cart:", err);
    res.status(500).json({ error: err.message });
  }
});

/**
 * POST /api/cart/add
 *
 * Body: { userId, productId, quantity }
 * finds latest cart for user or creates a new one (UUID).
 * adds a line into cart_items.
 */
router.post("/add", async (req, res) => {
  const { userId, productId, quantity } = req.body;

  if (!userId || !productId || !quantity) {
    return res
      .status(400)
      .json({ error: "userId, productId and quantity are required" });
  }

  try {
    //get or create cart_id for this user
    let cartId;

    const [existing] = await db.query(
      "SELECT cart_id FROM carts WHERE user_id = ? ORDER BY created_at DESC LIMIT 1",
      [userId]
    );

    if (existing.length) {
      cartId = existing[0].cart_id;
    } else {
      // create a UUID for the new cart
      const [uuidRows] = await db.query("SELECT UUID() AS id");
      cartId = uuidRows[0].id;

      await db.query("INSERT INTO carts (cart_id, user_id) VALUES (?, ?)", [
        cartId,
        userId,
      ]);
    }

    //get unit price from products table
    const [productRows] = await db.query(
      "SELECT base_price FROM products WHERE product_id = ?",
      [productId]
    );

    if (!productRows.length) {
      return res.status(400).json({ error: "Invalid productId" });
    }

    const unitPrice = Number(productRows[0].base_price);
    const qty = Number(quantity);
    const lineTotal = unitPrice * qty;

    //insert cart item
    await db.query(
      `INSERT INTO cart_items 
         (cart_item_id, cart_id, product_id, quantity, unit_price, line_total)
       VALUES (UUID(), ?, ?, ?, ?, ?)`,
      [cartId, productId, qty, unitPrice, lineTotal]
    );

    res.json({ message: "Added to cart", cartId });
  } catch (err) {
    console.error("Error adding to cart:", err);
    res.status(500).json({ error: err.message });
  }
});

/**
 * PATCH /api/cart/update/:cartItemId
 * Body: { quantity }
 * updates the quantity and line_total) for a cart item.
 */
router.patch("/update/:cartItemId", async (req, res) => {
  const { quantity } = req.body;
  const cartItemId = req.params.cartItemId;

  if (!quantity || quantity < 1) {
    return res.status(400).json({ error: "Quantity must be >= 1" });
  }

  try {
    // get current unit_price and product_id for this cart item
    const [rows] = await db.query(
      "SELECT unit_price FROM cart_items WHERE cart_item_id = ?",
      [cartItemId]
    );

    if (!rows.length) {
      return res.status(404).json({ error: "Cart item not found" });
    }

    const unitPrice = Number(rows[0].unit_price);
    const qty = Number(quantity);
    const lineTotal = unitPrice * qty;

    const [result] = await db.query(
      "UPDATE cart_items SET quantity = ?, line_total = ? WHERE cart_item_id = ?",
      [qty, lineTotal, cartItemId]
    );

    if (result.affectedRows === 0) {
      return res.status(404).json({ error: "Cart item not found" });
    }

    res.json({ message: "Quantity updated" });
  } catch (err) {
    console.error("Error updating cart item:", err);
    res.status(500).json({ error: err.message });
  }
});

/**
 * DELETE /api/cart/remove/:cartItemId
 * removes an item from the cart.
 */
router.delete("/remove/:cartItemId", async (req, res) => {
  const cartItemId = req.params.cartItemId;

  try {
    const [result] = await db.query(
      "DELETE FROM cart_items WHERE cart_item_id = ?",
      [cartItemId]
    );

    if (result.affectedRows === 0) {
      return res.status(404).json({ error: "Cart item not found" });
    }

    res.json({ message: "Item removed from cart" });
  } catch (err) {
    console.error("Error removing cart item:", err);
    res.status(500).json({ error: err.message });
  }
});

module.exports = router;
