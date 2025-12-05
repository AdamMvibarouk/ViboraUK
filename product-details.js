product-details.js

document.addEventListener("DOMContentLoaded", async () => {
const params = new URLSearchParams(window.location.search);
const productId = params.get("id");
if (!productId) return;

const titleEl = document.querySelector(".product-title");
const descEl = document.querySelector(".product-description");
const priceEl = document.querySelector(".price");
const addBtn = document.querySelector(".add-cart-btn");

try {
const res = await fetch(http://localhost:5000/api/products/${productId});
const data = await res.json();

if (!res.ok) {
alert(data.error || "Error loading product");
return;
}

if (titleEl) titleEl.textContent = data.name || "Product";
if (priceEl && data.base_price != null) {
priceEl.textContent = £${Number(data.base_price).toFixed(2)};
}
if (descEl) {
descEl.textContent = data.description || "No description available.";
}
} catch (err) {
console.error("Error loading product:", err);
alert("Server error while loading product");
}

if (addBtn) {
addBtn.addEventListener("click", async () => {
const token = localStorage.getItem("token");
if (!token) {
alert("Please log in to add items to your basket.");
return;
}

try {
const res = await fetch("http://localhost:5000/api/cart/add", {
method: "POST",
headers: {
"Content-Type": "application/json",
Authorization: Bearer ${token},
},
body: JSON.stringify({ productId, quantity: 1 }),
});

const data = await res.json();

if (!res.ok) {
alert(data.error || "Server error while adding to basket");
return;
}

alert("Item added to basket.");
} catch (err) {
console.error("Error adding to basket:", err);
alert("Server error while adding to basket");
}
});
}
});

