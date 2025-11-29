const express = require("express");
const { db } = require("../db");

const router = express.Router();

// GET /api/products
router.get("/", async (req, res) => {
  try {
    const categoryId = req.query.category_id;

    let sql = "SELECT * FROM products";
    let params = [];

    if (categoryId) {
      sql += " WHERE category_id = ?";
      params.push(categoryId);
    }

    const [rows] = await db.query(sql, params);
    res.json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// get product by ID
router.get("/:id", async (req, res) => {
  try {
    const [rows] = await db.query("SELECT * FROM products WHERE id = ?", [
      req.params.id,
    ]);

    if (!rows.length) {
      return res.status(404).json({ error: "Not found" });
    }

    res.json(rows[0]);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

module.exports = router;
