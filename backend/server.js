// server.js

const express = require("express");
const cors = require("cors");
require("dotenv").config();

const productsRoute = require("./routes/products");
const cartRoute = require("./routes/cart");
const ordersRoute = require("./routes/orders");
const usersRoute = require("./routes/users");

const app = express();

app.use(cors());
app.use(express.json());

// API routes

app.use("/api/products", productsRoute);
app.use("/api/cart", cartRoute);
app.use("/api/orders", ordersRoute);
app.use("/api/users", usersRoute);

const PORT = process.env.PORT || 5000;

app.listen(PORT, () => {
  console.log(`Backend running on port ${PORT}`);
});
