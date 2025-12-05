document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("productsContainer");
  const searchInput = document.getElementById("searchInput");
  const searchBtn = document.getElementById("searchBtn");
  const CATEGORY_ID = "e6660af2-cf7e-11f0-a24b-005056b707be";
  if (!container) return;

  function renderProducts(products) {
    container.innerHTML = "";
    if (!products.length) {
      container.innerHTML = "<p>No bags found.</p>";
      return;
    }
    products.forEach((product) => {
      const card = document.createElement("div");
      card.classList.add("product-card");
      const imageUrl = "images/bag1.jpg";
      const priceHtml =
        product.base_price !== null && product.base_price !== undefined
          ? <div class="product-price">£${Number(product.base_price).toFixed(2)}</div>
          : "";
      card.innerHTML = `
        <img src="${imageUrl}" alt="${product.name}">
        <div class="product-info">
          <div class="product-name">${product.name}</div>
          <div class="product-bottom">
            ${priceHtml}
            <button onclick="window.location.href='product-details.html?id=${product.product_id}'">See Details</button>
          </div>
        </div>`;
      container.appendChild(card);
    });
  }

  function loadProducts(term = "") {
    fetch(http://localhost:5000/api/products?category_id=${CATEGORY_ID})
      .then((res) => res.json())
      .then((products) => {
        const filtered = term
          ? products.filter((p) => p.name.toLowerCase().includes(term.toLowerCase()))
          : products;
        renderProducts(filtered);
      })
      .catch(() => {
        container.innerHTML = "<p>Error loading bags.</p>";
      });
  }

  if (searchBtn && searchInput) {
    searchBtn.addEventListener("click", () => loadProducts(searchInput.value.trim()));
  }

  loadProducts();
});