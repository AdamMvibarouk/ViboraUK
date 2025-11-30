const express = require("express");
const { db } = require("../db");

const router = express.Router();

// POST /api/orders/checkout
// handles checkout, first-order discount, totals
router.post("/checkout", async (req, res) => {
  const { userId } = req.body;

  if (!userId) {
    return res.status(400).json({ error: "userId is required" });
  }

  try {
    // get user's most recent cart
    const [cartRows] = await db.query(
      "SELECT * FROM carts WHERE user_id = ? ORDER BY created_at DESC LIMIT 1",
      [userId]
    );

    if (!cartRows.length) {
      return res.status(400).json({ error: "no cart found for user" });
    }

    const cart = cartRows[0];
    const cartId = cart.cart_id;

    // get all cart items
    const [items] = await db.query(
      "SELECT * FROM cart_items WHERE cart_id = ?",
      [cartId]
    );

    if (!items.length) {
      return res.status(400).json({ error: "cart is empty" });
    }

    // calculate subtotal
    let subtotal = 0;
    items.forEach((item) => {
      const lineTotal =
        item.line_total ?? Number(item.unit_price) * Number(item.quantity);
      subtotal += Number(lineTotal);
    });

    // check if user is new (first order)
    const [pastOrders] = await db.query(
      "SELECT order_id FROM orders WHERE user_id = ? LIMIT 1",
      [userId]
    );

    const isNewCustomer = pastOrders.length === 0;
    const discountRate = isNewCustomer ? 0.1 : 0;
    const discountTotal = subtotal * discountRate;

    // totals
    const taxableBase = subtotal - discountTotal;
    const taxTotal = taxableBase * 0.2; // 20% vat
    const shippingTotal = 0.0; // placeholder
    const grandTotal = taxableBase + taxTotal + shippingTotal;

    // create order uuid
    const [uuidRows] = await db.query("SELECT UUID() AS id");
    const orderId = uuidRows[0].id;
    const orderNumber = `ORD-${Date.now()}`;

    // insert into orders
    await db.query(
      `INSERT INTO orders 
        (order_id, user_id, order_number, status,
         subtotal, discount_total, tax_total, shipping_total, grand_total)
       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`,
      [
        orderId,
        userId,
        orderNumber,
        "paid",
        subtotal,
        discountTotal,
        taxTotal,
        shippingTotal,
        grandTotal,
      ]
    );

    // insert each item into order_items
    for (const item of items) {
      const [uuidItemRows] = await db.query("SELECT UUID() AS id");
      const orderItemId = uuidItemRows[0].id;

      const unitPrice = Number(item.unit_price);
      const qty = Number(item.quantity);
      const lineTotal = unitPrice * qty;

      await db.query(
        `INSERT INTO order_items
          (order_item_id, order_id, variant_id, quantity, unit_price, line_total)
         VALUES (?, ?, ?, ?, ?, ?)`,
        [orderItemId, orderId, item.product_id, qty, unitPrice, lineTotal]
      );
    }

    // clear cart
    await db.query("DELETE FROM cart_items WHERE cart_id = ?", [cartId]);

    res.json({
      message: "order completed",
      orderId,
      orderNumber,
      subtotal,
      discountApplied: isNewCustomer,
      discountTotal,
      taxTotal,
      grandTotal,
    });
  } catch (err) {
    console.error("checkout error:", err);
    res.status(500).json({ error: err.message });
  }
});

// GET /api/orders/history/:userId
// returns list of all orders for a user
router.get("/history/:userId", async (req, res) => {
  const { userId } = req.params;

  try {
    const [rows] = await db.query(
      `SELECT order_id, order_number, status, subtotal, discount_total, 
              tax_total, grand_total, placed_at
       FROM orders
       WHERE user_id = ?
       ORDER BY placed_at DESC`,
      [userId]
    );

    res.json(rows);
  } catch (err) {
    console.error("history error:", err);
    res.status(500).json({ error: err.message });
  }
});

module.exports = router;
