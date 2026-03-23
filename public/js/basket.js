document.addEventListener("DOMContentLoaded", () => {
const basketItemsContainer = document.getElementById("basket-items");
const basketTotalEl = document.getElementById("basket-total");
const basketSubtotalEl = document.getElementById("basket-subtotal");
const basketDiscountEl = document.getElementById("basket-discount");
const basketDeliveryEl = document.getElementById("basket-delivery");
const promoInput = document.getElementById("promo-code");
const promoBtn = document.getElementById("apply-promo-btn");
const promoMessage = document.getElementById("promo-message");

if (!basketItemsContainer || !basketTotalEl) return;

let activePromo = "";
const DELIVERY_FEE = 4.99;

function getPromoCode() {
return (promoInput?.value || "").trim().toUpperCase();
}

function calculateTotals(items) {
let subtotal = 0;

items.forEach((item) => {
subtotal += Number(item.price) * Number(item.quantity);
});

let discount = 0;
if (activePromo === "VIBORA10") {
discount = subtotal * 0.10;
}

const delivery = subtotal >= 50 || subtotal === 0 ? 0 : DELIVERY_FEE;
const total = subtotal - discount + delivery;

return {
subtotal,
discount,
delivery,
total
};
}

function renderTotals(items) {
const totals = calculateTotals(items);

if (basketSubtotalEl) {
basketSubtotalEl.textContent = `£${totals.subtotal.toFixed(2)}`;
}

if (basketDiscountEl) {
basketDiscountEl.textContent = `-£${totals.discount.toFixed(2)}`;
}

if (basketDeliveryEl) {
basketDeliveryEl.textContent = `£${totals.delivery.toFixed(2)}`;
}

basketTotalEl.textContent = `£${totals.total.toFixed(2)}`;
}

async function loadBasket() {
try {
const res = await fetch("/cart/items", {
method: "GET",
headers: {
"Accept": "application/json"
},
credentials: "same-origin"
});

if (!res.ok) {
throw new Error(`HTTP ${res.status}`);
}

const data = await res.json();

if (!data.success) {
throw new Error(data.message || "Basket load failed");
}

const items = data.items || [];

if (items.length === 0) {
basketItemsContainer.innerHTML = `
<tr>
<td colspan="4">Your basket is empty.</td>
</tr>
`;
renderTotals([]);
return;
}

let rows = "";

items.forEach((item) => {
const lineTotal = Number(item.price) * Number(item.quantity);

rows += `
<tr>
<td>${item.name}</td>
<td>${item.quantity}</td>
<td>£${lineTotal.toFixed(2)}</td>
<td>
<button type="button" class="remove-item-btn" data-product-id="${item.product_id}">
Remove
</button>
</td>
</tr>
`;
});

basketItemsContainer.innerHTML = rows;
renderTotals(items);

document.querySelectorAll(".remove-item-btn").forEach((button) => {
button.addEventListener("click", async () => {
const productId = button.getAttribute("data-product-id");

try {
const removeRes = await fetch("/cart/remove", {
method: "POST",
headers: {
"Content-Type": "application/json",
"Accept": "application/json",
"X-CSRF-TOKEN": document
.querySelector('meta[name="csrf-token"]')
?.getAttribute("content")
},
credentials: "same-origin",
body: JSON.stringify({
product_id: productId
})
});

if (!removeRes.ok) {
throw new Error(`HTTP ${removeRes.status}`);
}

const removeData = await removeRes.json();

if (!removeData.success) {
throw new Error(removeData.message || "Remove failed");
}

loadBasket();
} catch (err) {
console.error("Remove basket item error:", err);
alert("There was a problem removing the item.");
}
});
});
} catch (err) {
console.error("Error loading basket:", err);
basketItemsContainer.innerHTML = `
<tr>
<td colspan="4">Error loading basket.</td>
</tr>
`;
renderTotals([]);
}
}

if (promoBtn) {
promoBtn.addEventListener("click", () => {
const code = getPromoCode();

if (code === "VIBORA10") {
activePromo = code;
if (promoMessage) {
promoMessage.textContent = "Promo code applied.";
}
} else {
activePromo = "";
if (promoMessage) {
promoMessage.textContent = code ? "Invalid promo code." : "";
}
}

loadBasket();
});
}

loadBasket();
});
