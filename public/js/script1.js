if (!window.viboraScriptLoaded) {
window.viboraScriptLoaded = true;

document.addEventListener("DOMContentLoaded", () => {
const searchInput = document.getElementById("searchInput");
const searchBtn = document.getElementById("searchBtn");
const priceSelect = document.getElementById("price");
const sortBySelect = document.getElementById("sortBy");
const brandSelect =
document.getElementById("brand") ||
document.getElementById("brands") ||
document.getElementById("ballsbrands") ||
document.getElementById("sportswearbrands") ||
document.getElementById("shoesbrands") ||
document.getElementById("bagsbrands");
const productContainer = document.getElementById("productsContainer");

if (!productContainer) return;

function getCards() {
return Array.from(productContainer.querySelectorAll(".product-card"));
}

function matchesPrice(price, selectedPrice) {
if (!selectedPrice || selectedPrice === "all") return true;
if (selectedPrice === "under50") return price < 50;
if (selectedPrice === "50to75") return price >= 50 && price <= 75;
if (selectedPrice === "75to100") return price > 75 && price <= 100;
if (selectedPrice === "100to150") return price > 100 && price <= 150;
if (selectedPrice === "over150") return price > 150;
return true;
}

function filterProducts() {
const searchValue = (searchInput?.value || "").trim().toLowerCase();
const priceValue = priceSelect?.value || "all";
const brandValue = (brandSelect?.value || "all").toLowerCase();

getCards().forEach((card) => {
const name = (card.dataset.name || "").toLowerCase();
const slug = (card.dataset.slug || "").toLowerCase();
const description = (card.dataset.description || "").toLowerCase();
const brand = (card.dataset.brand || "").toLowerCase();
const price = parseFloat(card.dataset.price || "0");

const matchesSearch =
!searchValue ||
name.includes(searchValue) ||
slug.includes(searchValue) ||
description.includes(searchValue);

const matchesPriceRange = matchesPrice(price, priceValue);
const matchesBrand =
brandValue === "all" || brand === brandValue;

card.style.display =
matchesSearch && matchesPriceRange && matchesBrand ? "" : "none";
});
}

function sortProducts() {
if (!sortBySelect || !productContainer) return;

const sortValue = sortBySelect.value;
const cards = getCards();

cards.sort((a, b) => {
const nameA = (a.dataset.name || "").toLowerCase();
const nameB = (b.dataset.name || "").toLowerCase();
const priceA = parseFloat(a.dataset.price || "0");
const priceB = parseFloat(b.dataset.price || "0");

switch (sortValue) {
case "name-asc":
return nameA.localeCompare(nameB);
case "name-desc":
return nameB.localeCompare(nameA);
case "price-asc":
return priceA - priceB;
case "price-desc":
return priceB - priceA;
default:
return 0;
}
});

cards.forEach(card => productContainer.appendChild(card));
}

if (searchBtn) searchBtn.addEventListener("click", filterProducts);
if (searchInput) searchInput.addEventListener("input", filterProducts);
if (priceSelect) priceSelect.addEventListener("change", () => {
filterProducts();
sortProducts();
});
if (brandSelect) brandSelect.addEventListener("change", filterProducts);
if (sortBySelect) sortBySelect.addEventListener("change", sortProducts);

document.querySelectorAll(".add-to-basket-btn").forEach((button) => {
if (button.dataset.boundBasket === "true") return;
button.dataset.boundBasket = "true";

button.addEventListener("click", async () => {
const productId = button.getAttribute("data-product-id");
const productName = button.getAttribute("data-product-name");
const productPrice = button.getAttribute("data-product-price");

try {
const res = await fetch("/cart/add", {
method: "POST",
headers: {
"Content-Type": "application/json",
"X-CSRF-TOKEN": document
.querySelector('meta[name="csrf-token"]')
?.getAttribute("content"),
"Accept": "application/json"
},
credentials: "same-origin",
body: JSON.stringify({
product_id: productId,
name: productName,
price: Number(productPrice),
quantity: 1
})
});

const data = await res.json();

if (!res.ok || !data.success) {
alert(data.message || "Failed to add item to basket.");
return;
}

alert(productName + " added to basket.");
} catch (err) {
console.error("Add to basket error:", err);
alert("There was a problem adding this item to the basket.");
}
});
});

document.querySelectorAll(".add-to-wishlist-btn").forEach((button) => {
if (button.dataset.boundWishlist === "true") return;
button.dataset.boundWishlist = "true";

button.addEventListener("click", async () => {
const payload = {
product_id: button.getAttribute("data-product-id"),
name: button.getAttribute("data-product-name"),
price: button.getAttribute("data-product-price"),
image: button.getAttribute("data-product-image"),
slug: button.getAttribute("data-product-slug")
};

try {
const res = await fetch("/wishlist/add", {
method: "POST",
headers: {
"Content-Type": "application/json",
"X-CSRF-TOKEN": document
.querySelector('meta[name="csrf-token"]')
?.getAttribute("content"),
"Accept": "application/json"
},
credentials: "same-origin",
body: JSON.stringify(payload)
});

const data = await res.json();

if (!res.ok || !data.success) {
alert(data.message || "Failed to add to wishlist.");
return;
}

alert(data.message || "Added to wishlist.");
} catch (err) {
console.error("Wishlist error:", err);
alert("There was a problem adding this item to the wishlist.");
}
});
});
});
}