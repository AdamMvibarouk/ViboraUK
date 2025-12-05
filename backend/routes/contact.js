const express = require("express");
const crypto = require("crypto");
const db = require("../db");

const router = express.Router();

router.post("/submit", async (req, res) => {
  const { email, message } = req.body;

  if (!email || !message) {
    return res.status(400).json({ message: "Email and message are required" });
  }

  try {
    const enquiry_id = crypto.randomUUID();

    await db.query(
      "INSERT INTO enquiries (enquiry_id, email, message) VALUES (?, ?, ?)",
      [enquiry_id, email, message]
    );

    res.json({ message: "Enquiry submitted successfully!" });
  } catch (err) {
    console.error("Contact form error:", err);
    res.status(500).json({ message: "Server error while submitting enquiry" });
  }
});

module.exports = router;
