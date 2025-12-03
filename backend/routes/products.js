const express = require("express");
const db = require("../db");

const router = express.Router();

// GET /api/products
// optional ?category_id=1
router.get("/", async (req, res) => {
  try {
    const categoryId = req.query.category_id;

    let sql =
      "SELECT product_id, category_id, name, slug, base_price FROM products";
    const params = [];

    if (categoryId) {
      sql += " WHERE category_id = ?";
      params.push(categoryId);
    }

    const [rows] = await db.query(sql, params);
    res.json(rows);
  } catch (err) {
    console.error("PRODUCT QUERY ERROR:", err);
    res.status(500).json({ error: err.message });
  }
});

// GET /api/products/:id
router.get("/:id", async (req, res) => {
  try {
    const [rows] = await db.query(
      "SELECT product_id, category_id, name, slug, base_price FROM products WHERE product_id = ?",
      [req.params.id]
    );

    if (rows.length === 0) {
      return res.status(404).json({ error: "Product not found" });
    }

    res.json(rows[0]);
  } catch (err) {
    console.error("PRODUCT DETAIL ERROR:", err);
    res.status(500).json({ error: err.message });
  }
});

module.exports = router;
