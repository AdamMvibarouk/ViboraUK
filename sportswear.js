document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("productsContainer");
  const searchInput = document.getElementById("searchInput");
  const searchBtn = document.getElementById("searchBtn");

  const brandSelect = document.getElementById("racketbrands");
  const priceSelect = document.getElementById("price");
  const levelSelect = document.getElementById("level");
  const materialSelect = document.getElementById("material");

  const CATEGORY_ID = "e6660501-cf7e-11f0-a24b-005056b707be";

  if (!container) return;

  let allProducts = [];

  function renderProducts(products) {
    container.innerHTML = "";

    if (!products || products.length === 0) {
      container.innerHTML = "<p>No sportswear found.</p>";
      return;
    }

    products.forEach((product) => {
      const card = document.createElement("div");
      card.classList.add("product-card");

      const name = product.name || "Sportswear item";
      const brand = (product.brand || "").toString();
      const level = (product.level || "").toString();
      const material = (product.material || "").toString();
      const priceValue =
        product.base_price !== null && product.base_price !== undefined
          ? Number(product.base_price)
          : null;

      const imageUrl = product.image_url || "images/sportswear1.jpg";

      const priceHtml =
        priceValue !== null && !Number.isNaN(priceValue)
          ? `<div class="product-price">£${priceValue.toFixed(2)}</div>`
          : `<div class="product-price">Price on request</div>`;

      card.innerHTML = `
        <img src="${imageUrl}" alt="${name}">
        <div class="product-info">
          <div class="product-name">${name}</div>
          <div class="product-meta">
            ${brand ? `<span class="product-brand">${brand}</span>` : ""}
            ${level ? `<span class="product-level">${level}</span>` : ""}
            ${material ? `<span class="product-material">${material}</span>` : ""}
          </div>
          <div class="product-bottom">
            ${priceHtml}
            <button class="product-details-btn"
              data-product-id="${product.product_id}">
              See Details
            </button>
          </div>
        </div>
      `;

      container.appendChild(card);
    });

    container.querySelectorAll(".product-details-btn").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        const id = e.currentTarget.getAttribute("data-product-id");
        if (id) {
          window.location.href = `product-details.html?id=${encodeURIComponent(
            id
          )}`;
        }
      });
    });
  }

  function priceMatches(price, filter) {
    if (!price && price !== 0) return filter === "all";
    const p = Number(price);

    switch (filter) {
      case "under50":
        return p < 50;
      case "50to75":
        return p >= 50 && p <= 75;
      case "75to100":
        return p > 75 && p <= 100;
      case "100to150":
        return p > 100 && p <= 150;
      case "over150":
        return p > 150;
      default:
        return true;
    }
  }

  function applyFilters() {
    const term = searchInput ? searchInput.value.trim().toLowerCase() : "";
    const brandFilter = brandSelect ? brandSelect.value : "all";
    const priceFilter = priceSelect ? priceSelect.value : "all";
    const levelFilter = levelSelect ? levelSelect.value : "all";
    const materialFilter = materialSelect ? materialSelect.value : "all";

    const filtered = allProducts.filter((p) => {
      const name = (p.name || "").toLowerCase();
      const brand = (p.brand || "").toLowerCase();
      const level = (p.level || "").toLowerCase();
      const material = (p.material || "").toLowerCase();

      const matchesSearch =
        !term || name.includes(term) || brand.includes(term);

      const matchesBrand =
        !brandFilter || brandFilter === "all" || brand === brandFilter;

      const matchesLevel =
        !levelFilter || levelFilter === "all" || level === levelFilter;

      const matchesMaterial =
        !materialFilter || materialFilter === "all" || material === materialFilter;

      const matchesPrice = priceMatches(p.base_price, priceFilter);

      return (
        matchesSearch &&
        matchesBrand &&
        matchesLevel &&
        matchesMaterial &&
        matchesPrice
      );
    });

    renderProducts(filtered);
  }

  function loadProducts() {
    container.innerHTML = "<p>Loading sportswear...</p>";

    fetch(
      `http://localhost:5000/api/products?category_id=${encodeURIComponent(
        CATEGORY_ID
      )}`
    )
      .then((res) => {
        if (!res.ok) throw new Error("Network error");
        return res.json();
      })
      .then((products) => {
        allProducts = Array.isArray(products) ? products : [];
        applyFilters();
      })
      .catch(() => {
        container.innerHTML = "<p>Error loading sportswear.</p>";
      });
  }

  if (searchBtn && searchInput) {
    searchBtn.addEventListener("click", applyFilters);
    searchInput.addEventListener("keyup", (e) => {
      if (e.key === "Enter") applyFilters();
    });
    searchInput.addEventListener("input", applyFilters);
  }

  if (brandSelect) brandSelect.addEventListener("change", applyFilters);
  if (priceSelect) priceSelect.addEventListener("change", applyFilters);
  if (levelSelect) levelSelect.addEventListener("change", applyFilters);
  if (materialSelect) materialSelect.addEventListener("change", applyFilters);

  loadProducts();
});
