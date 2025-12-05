const express = require("express");
const db = require("../db");
const verifyToken = require("../middleware/authMiddleware");

const router = express.Router();

router.use(verifyToken);

router.get("/", async (req, res) => {
  const userId = req.user.id;

  try {
    const [cartRows] = await db.query(
      "SELECT cart_id FROM carts WHERE user_id = ? ORDER BY created_at DESC LIMIT 1",
      [userId]
    );

    if (!cartRows.length) {
      return res.json({ cartId: null, items: [] });
    }

    const cartId = cartRows[0].cart_id;

    const [items] = await db.query(
      `
      SELECT 
        ci.cart_item_id,
        ci.quantity,
        ci.unit_price,
        ci.line_total,
        p.product_id,
        p.name
      FROM cart_items ci
      JOIN products p ON ci.product_id = p.product_id
      WHERE ci.cart_id = ?
      `,
      [cartId]
    );

    res.json({ cartId, items });
  } catch (err) {
    console.error("Error loading cart:", err);
    res.status(500).json({ error: "Server error while loading cart" });
  }
});

router.post("/add", async (req, res) => {
  const userId = req.user.id;
  const { productId, quantity } = req.body;

  if (!productId || !quantity) {
    return res
      .status(400)
      .json({ error: "productId and quantity are required" });
  }

  const qtyToAdd = Number(quantity);

  try {
    let cartId;

    const [existingCart] = await db.query(
      "SELECT cart_id FROM carts WHERE user_id = ? ORDER BY created_at DESC LIMIT 1",
      [userId]
    );

    if (existingCart.length) {
      cartId = existingCart[0].cart_id;
    } else {
      const [uuidRows] = await db.query("SELECT UUID() AS id");
      cartId = uuidRows[0].id;

      await db.query(
        "INSERT INTO carts (cart_id, user_id) VALUES (?, ?)",
        [cartId, userId]
      );
    }

    const [productRows] = await db.query(
      "SELECT base_price FROM products WHERE product_id = ?",
      [productId]
    );

    if (!productRows.length) {
      return res.status(400).json({ error: "Invalid productId" });
    }

    const unitPrice = Number(productRows[0].base_price);

    const [existingItem] = await db.query(
      `
      SELECT cart_item_id, quantity 
      FROM cart_items 
      WHERE cart_id = ? AND product_id = ?
      `,
      [cartId, productId]
    );

    if (existingItem.length) {
      const currentQty = Number(existingItem[0].quantity);
      const newQty = currentQty + qtyToAdd;
      const newLineTotal = unitPrice * newQty;

      await db.query(
        `
        UPDATE cart_items
        SET quantity = ?, line_total = ?
        WHERE cart_item_id = ?
        `,
        [newQty, newLineTotal, existingItem[0].cart_item_id]
      );

      return res.json({
        message: "Cart item updated",
        cartId,
        cart_item_id: existingItem[0].cart_item_id,
        quantity: newQty,
      });
    }

    const [uuidItemRows] = await db.query("SELECT UUID() AS id");
    const cartItemId = uuidItemRows[0].id;
    const lineTotal = unitPrice * qtyToAdd;

    await db.query(
      `
      INSERT INTO cart_items 
        (cart_item_id, cart_id, product_id, quantity, unit_price, line_total)
      VALUES (?, ?, ?, ?, ?, ?)
      `,
      [cartItemId, cartId, productId, qtyToAdd, unitPrice, lineTotal]
    );

    res.json({
      message: "Added to cart",
      cartId,
      cart_item_id: cartItemId,
      quantity: qtyToAdd,
    });
  } catch (err) {
    console.error("Error adding to cart:", err);
    res.status(500).json({ error: "Server error while adding to cart" });
  }
});

router.patch("/update/:cartItemId", async (req, res) => {
  const { quantity } = req.body;
  const cartItemId = req.params.cartItemId;

  if (!quantity || quantity < 1) {
    return res.status(400).json({ error: "Quantity must be >= 1" });
  }

  try {
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
    res.status(500).json({ error: "Server error while updating cart item" });
  }
});

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
    res.status(500).json({ error: "Server error while removing cart item" });
  }
});

module.exports = router;
