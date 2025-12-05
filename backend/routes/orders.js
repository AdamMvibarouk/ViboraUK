const express = require("express");
const db = require("../db");
const verifyToken = require("../middleware/authMiddleware");

const router = express.Router();

router.get("/", verifyToken, async (req, res) => {
  try {
    const userId = req.user.id;

    const [rows] = await db.query(
      `
      SELECT
        o.order_id        AS orderId,
        o.order_number    AS orderNumber,
        o.status          AS status,
        o.subtotal        AS subtotal,
        o.discount_total  AS discountTotal,
        o.tax_total       AS taxTotal,
        o.shipping_total  AS shippingTotal,
        o.grand_total     AS grandTotal,
        o.placed_at       AS placedAt,

        oi.order_item_id  AS orderItemId,
        oi.variant_id     AS productId,
        oi.quantity       AS quantity,
        oi.unit_price     AS unitPrice,
        oi.line_total     AS lineTotal
      FROM orders o
      JOIN order_items oi ON o.order_id = oi.order_id
      WHERE o.user_id = ?
      ORDER BY o.placed_at DESC, o.order_id DESC
      `,
      [userId]
    );

    const ordersById = {};

    for (const row of rows) {
      if (!ordersById[row.orderId]) {
        ordersById[row.orderId] = {
          order_id: row.orderId,
          order_number: row.orderNumber,
          status: row.status,
          subtotal: row.subtotal,
          discount_total: row.discountTotal,
          tax_total: row.taxTotal,
          shipping_total: row.shippingTotal,
          grand_total: row.grandTotal,
          placed_at: row.placedAt,
          items: [],
        };
      }

      ordersById[row.orderId].items.push({
        order_item_id: row.orderItemId,
        product_id: row.productId,
        quantity: row.quantity,
        unit_price: row.unitPrice,
        line_total: row.lineTotal,
      });
    }

    const orders = Object.values(ordersById);
    res.json({ orders });
  } catch (err) {
    console.error("Error fetching past orders:", err);
    res
      .status(500)
      .json({ message: "Server error while fetching past orders" });
  }
});

router.post("/checkout", verifyToken, async (req, res) => {
  const userId = req.user.id;

  try {
    const [cartRows] = await db.query(
      "SELECT * FROM carts WHERE user_id = ? ORDER BY created_at DESC LIMIT 1",
      [userId]
    );

    if (!cartRows.length) {
      return res.status(400).json({ error: "No basket found for this user" });
    }

    const cart = cartRows[0];
    const cartId = cart.cart_id;

    const [items] = await db.query(
      `
      SELECT cart_item_id, product_id, quantity, unit_price, line_total
      FROM cart_items
      WHERE cart_id = ?
      `,
      [cartId]
    );

    if (!items.length) {
      return res.status(400).json({ error: "Your basket is empty" });
    }

    let subtotal = 0;
    items.forEach((item) => {
      const lineTotal =
        item.line_total ?? Number(item.unit_price) * Number(item.quantity);
      subtotal += Number(lineTotal);
    });

    const [pastOrders] = await db.query(
      "SELECT order_id FROM orders WHERE user_id = ? LIMIT 1",
      [userId]
    );

    const isNewCustomer = pastOrders.length === 0;
    const discountRate = isNewCustomer ? 0.1 : 0;
    const discountTotal = subtotal * discountRate;

    const taxableBase = subtotal - discountTotal;
    const taxTotal = taxableBase * 0.2;
    const shippingTotal = 0.0;
    const grandTotal = taxableBase + taxTotal + shippingTotal;

    const [uuidRows] = await db.query("SELECT UUID() AS id");
    const orderId = uuidRows[0].id;
    const orderNumber = `ORD-${Date.now()}`;

    await db.query(
      `
      INSERT INTO orders 
        (order_id, user_id, order_number, status,
        subtotal, discount_total, tax_total, shipping_total, grand_total)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
      `,
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

    for (const item of items) {
      const [uuidItemRows] = await db.query("SELECT UUID() AS id");
      const orderItemId = uuidItemRows[0].id;

      const unitPrice = Number(item.unit_price);
      const qty = Number(item.quantity);
      const lineTotal = unitPrice * qty;

      const variantId = item.product_id;

      await db.query(
        `
        INSERT INTO order_items
          (order_item_id, order_id, variant_id, quantity, unit_price, line_total)
        VALUES (?, ?, ?, ?, ?, ?)
        `,
        [orderItemId, orderId, variantId, qty, unitPrice, lineTotal]
      );
    }

    await db.query("DELETE FROM cart_items WHERE cart_id = ?", [cartId]);

    res.json({
      message: "Your order has been processed. You will receive a confirmation email shortly.",
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
    res.status(500).json({ error: "Server error while processing your order" });
  }
});

module.exports = router;
