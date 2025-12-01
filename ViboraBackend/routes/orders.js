// routes/orders.js
const express = require("express");
const db = require("../db");
const verifyToken = require("../middleware/authMiddleware");

const router = express.Router();

/**
 * GET /api/orders
 * Returns all past orders for the logged-in user.
 */
router.get("/", verifyToken, async (req, res) => {
  try {
    const userId = req.user.id; // users.user_id from JWT

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
        oi.variant_id     AS variantId,
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
        variant_id: row.variantId,
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

module.exports = router;
