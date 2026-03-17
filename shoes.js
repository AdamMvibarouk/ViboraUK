document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("productsContainer");
  const searchInput = document.getElementById("searchInput");
  const searchBtn = document.getElementById("searchBtn");

  const brandSelect = document.getElementById("racketbrands");
  const priceSelect = document.getElementById("price");
  const materialSelect = document.getElementById("material");

  const CATEGORY_ID = "e6660a4e-cf7e-11f0-a24b-005056b707be";

  const shoesImages = {
    "Bullpadel Neuron Vibram 25V Clay":
      "database/images/products/shoes/TRAINERS BULLPADEL NEURON VIBRAM 25V CLAY.jpg",
    "Bullpadel Hybrid Fly 25I Steel Blue":
      "database/images/products/shoes/trainers-bullpadel-hybrid-fly-25i-steel-blue-154344606.jpg",
    "Bullpadel Vertex Vibram 25V Yellow":
      "database/images/products/shoes/trainers-bullpadel-vertex-vibram-25v-yellow-1522073331.jpg",
    "Bullpadel Premier P1 White":
      "database/images/products/shoes/trainers-bullpadel-premier-p1-white-687461239.jpg",
    "Babolat Jet Mach 3 All Court Blue/Orange Men 30523629":
      "database/images/products/shoes/BABOLAT JET MACH 3 ALL COURT BLUE ORANGE MEN.jpg",
    "K-Swiss Hypercourt Supreme 2 White 09071102":
      "database/images/products/shoes/KSWISS HYPERCOURT SUPREME 2 WHITE 09071102.jpg",
    "Joma Master 1000 Men 25 Clay Fluorescent Yellow TM100S2599CC":
      "database/images/products/shoes/joma-master-1000-men-2509-yellow-2025-padel-shoes-975772017.jpg",
    "Bullpadel Trainers Buker JR 25I White":
      "",
    "Wilson Rush Pro 4.5 White/Blue":
      "database/images/products/shoes/WILSON RUSH PRO 4.5 WHITE BLUE.jpg"
  };

  if (!container) return;

  let allProducts = [];

  function renderProducts(products) {
    container.innerHTML = "";

    if (!products || products.length === 0) {
      container.innerHTML = "<p>No shoes found.</p>";
      return;
    }

    products.forEach((product) => {
      const card = document.createElement("div");
      card.classList.add("product-card");

      const name = product.name || "Shoes";
      const brand = (product.brand || "").toString();
      const material = (product.material || "").toString();
      const priceValue =
        product.base_price !== null && product.base_price !== undefined
          ? Number(product.base_price)
          : null;

      const imageUrl = shoesImages[name] || product.image_url || "images/shoe1.jpg";

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
    const materialFilter = materialSelect ? materialSelect.value : "all";

    const filtered = allProducts.filter((p) => {
      const name = (p.name || "").toLowerCase();
      const brand = (p.brand || "").toLowerCase();
      const material = (p.material || "").toLowerCase();

      const matchesSearch =
        !term || name.includes(term) || brand.includes(term);

      const matchesBrand =
        !brandFilter || brandFilter === "all" || brand === brandFilter;

      const matchesMaterial =
        !materialFilter || materialFilter === "all" || material === materialFilter;

      const matchesPrice = priceMatches(p.base_price, priceFilter);

      return (
        matchesSearch &&
        matchesBrand &&
        matchesMaterial &&
        matchesPrice
      );
    });

    renderProducts(filtered);
  }

  function loadProducts() {
    container.innerHTML = "<p>Loading shoes...</p>";

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
        container.innerHTML = "<p>Error loading shoes.</p>";
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
  if (materialSelect) materialSelect.addEventListener("change", applyFilters);

  loadProducts();
});
