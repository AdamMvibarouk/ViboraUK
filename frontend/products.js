// frontend/products.js

document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("productsContainer");
  const searchInput = document.getElementById("searchInput");
  const searchBtn = document.getElementById("searchBtn");

  // Rackets category ID
  const RACKETS_CATEGORY_ID = "352883ba-cd3f-11f0-982a-005056b707be";

  if (!container) {
    console.error("productsContainer element not found");
    return;
  }

  // load ONLY racket products from backend
  function loadProducts() {
    fetch(`http://localhost:5000/api/products?category_id=${RACKETS_CATEGORY_ID}`)
      .then((res) => res.json())
      .then((products) => renderProducts(products))
      .catch((err) => console.error("Error loading products:", err));
  }

  // rendering products
  function renderProducts(products) {
    container.innerHTML = "";

    products.forEach((product) => {
      const card = document.createElement("div");
      card.classList.add("product-card");

      const imageUrl = "images/racket1.jpg";

      let priceHtml = "";
      if (product.base_price !== null && product.base_price !== undefined) {
        priceHtml = `<div class="product-price">£${Number(product.base_price).toFixed(2)}</div>`;
      }

      card.innerHTML = `
        <img src="${imageUrl}" alt="${product.name}">
        <div class="product-info">
          <div class="product-name">${product.name}</div>
          <div class="product-bottom">
            ${priceHtml}
            <button onclick="window.location.href='product.html?id=${product.product_id}'">
              See Details
            </button>
          </div>
        </div>
      `;

      container.appendChild(card);
    });
  }

  // search within racket products
  if (searchBtn && searchInput) {
    searchBtn.addEventListener("click", () => {
      const term = searchInput.value.toLowerCase().trim();

      fetch(`http://localhost:5000/api/products?category_id=${RACKETS_CATEGORY_ID}`)
        .then((res) => res.json())
        .then((products) =>
          renderProducts(
            products.filter((p) => p.name.toLowerCase().includes(term))
          )
        )
        .catch((err) => console.error("Error loading products:", err));
    });
  }

  loadProducts();
});
