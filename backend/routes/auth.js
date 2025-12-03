const express = require("express");
const bcrypt = require("bcrypt");
const jwt = require("jsonwebtoken");
const db = require("../db");
const verifyToken = require("../middleware/authMiddleware");
const router = express.Router();

/**
 * POST /api/auth/register
 * Body: { first_name, last_name, email, password, phone? }
 */
router.post("/register", async (req, res) => {
  try {
    const { first_name, last_name, email, password, phone } = req.body;

    if (!first_name || !last_name || !email || !password) {
      return res
        .status(400)
        .json({ message: "First name, last name, email and password are required" });
    }

    // checks if email already exists
    const [exists] = await db.query(
      "SELECT user_id FROM users WHERE email = ?",
      [email]
    );
    if (exists.length > 0) {
      return res.status(400).json({ message: "Email is already registered" });
    }

    const hashedPassword = await bcrypt.hash(password, 10);

    await db.query(
      `
      INSERT INTO users (email, password_hash, first_name, last_name, phone)
      VALUES (?, ?, ?, ?, ?)
      `,
      [email, hashedPassword, first_name, last_name, phone || null]
    );

    res.status(201).json({ message: "User registered successfully" });
  } catch (err) {
    console.error("Register error:", err);
    res.status(500).json({ message: "Server error while registering user" });
  }
});

/**
 * POST /api/auth/login
 * Body: { email, password }
 */
router.post("/login", async (req, res) => {
  try {
    const { email, password } = req.body;

    if (!email || !password) {
      return res.status(400).json({ message: "Email and password are required" });
    }

    const [users] = await db.query(
      "SELECT user_id, email, password_hash, first_name, last_name, phone FROM users WHERE email = ?",
      [email]
    );

    if (users.length === 0) {
      return res.status(401).json({ message: "Invalid email or password" });
    }

    const user = users[0];

    const valid = await bcrypt.compare(password, user.password_hash);
    if (!valid) {
      return res.status(401).json({ message: "Invalid email or password" });
    }

    const token = jwt.sign(
      { id: user.user_id, email: user.email },
      process.env.JWT_SECRET,
      { expiresIn: "1h" }
    );

    res.json({
      message: "Login successful",
      token,
      user: {
        user_id: user.user_id,
        first_name: user.first_name,
        last_name: user.last_name,
        email: user.email,
        phone: user.phone,
      },
    });
  } catch (err) {
    console.error("Login error:", err);
    res.status(500).json({ message: "Server error while logging in" });
  }
});

/**
 * GET /api/auth/profile
 * Header: Authorisation: Bearer <token>
 */
router.get("/profile", verifyToken, async (req, res) => {
  try {
    const [rows] = await db.query(
      `
      SELECT user_id, first_name, last_name, email, phone, created_at
      FROM users
      WHERE user_id = ?
      `,
      [req.user.id]
    );

    if (rows.length === 0) {
      return res.status(404).json({ message: "User not found" });
    }

    res.json({ user: rows[0] });
  } catch (err) {
    console.error("Profile error:", err);
    res.status(500).json({ message: "Server error while fetching profile" });
  }
});

module.exports = router;
