document.addEventListener("DOMContentLoaded", async () => {
  const params = new URLSearchParams(window.location.search);
  const productId = params.get("id");
  if (!productId) return;

  const titleEl = document.querySelector(".product-title");
  const descEl = document.querySelector(".product-description");
  const priceEl = document.querySelector(".price");
  const addBtn = document.querySelector(".add-cart-btn");
  const imageEl = document.querySelector(".product-image img");
  const brandEl = document.querySelector(".product-brand");
  const stockEl = document.querySelector(".product-stock");

  // If your API does not return the image path, use this mapping
  const productImages = {
    "Babolat X Lamborghini BL002 Scandal Green":
      "database/images/products/rackets/BABOLAT X LAMBORGHINI BL002 SCANDAL GREEN.jpg",
    "ViboraUK Venom Pro Padel Racket":
      "database/images/products/rackets/Arlo Padel Racket.jpg",
    "ViboraUK Strike Control Padel Racket":
      "database/images/products/rackets/Pro X Padel Racket.jpg",
    "Babolat Air Vertuo Padel Racket 2025":
      "database/images/products/rackets/Babolat-Air-Vertuo-Padel-Racket-2025.png",
    "Mirage 25 Padel Racket":
      "database/images/products/rackets/Mirage-Front-2655789586.jpg",
    "Panna 25 Padel Racket":
      "database/images/products/rackets/Panna TF Padel Racket.jpg",
    "Pro X 25 Padel Racket":
      "database/images/products/rackets/pro-x-25-padel-racket.jpeg",
    "Arlo 25 Padel Racket":
      "database/images/products/rackets/Arlo Padel Racket.jpg",
    "Bullpadel Vertex 04 25":
      "database/images/products/rackets/RACKET BULLPADEL VERTEX 04 25.jpg",
    "Bullpadel Vertex 04 MX 24":
      "database/images/products/rackets/RACKET BULLPADEL VERTEX 04 MX 24.jpg",
    "Bullpadel Pearl 25":
      "database/images/products/rackets/bullpadel-vertex-jr-25.jpeg",
    "Bullpadel Vertex JR 25":
    "database/images/products/rackets/bullpadel-vertex-jr-25.jpeg",
    "Nox AT10 Genius 18K Alum 2026":
      "database/images/products/rackets/nox-at10-genius-18k-alum-2026.jpeg",
    "Nox X-One Casual Series 23":
      "database/images/products/rackets/nox-x-one-casual-series-23.jpeg",
    "Head Evo Extreme 2025":
      "database/images/products/rackets/head-evo-extreme-2025.jpeg",
    "Head Speed Motion 2025":
      "database/images/products/rackets/HEAD EVO EXTREME 2025.jpg",
    "Babolat Air Origin":
      "database/images/products/rackets/Babolat-Air-Vertuo-Padel-Racket-2025.png"
  };

const sportswearImages = {
    "Short Sleeve Training Top Womens Red":
      "database/images/products/tshirts/Short Sleeve Training Top Womens Red.jpg"
  };

  try {
    const res = await fetch(`http://localhost:5000/api/products/${productId}`);
    const data = await res.json();

    if (!res.ok) {
      alert(data.error || "Error loading product");
      return;
    }

    if (titleEl) titleEl.textContent = data.name || "Product";
    if (priceEl && data.base_price != null) {
      priceEl.textContent = `£${Number(data.base_price).toFixed(2)}`;
    }
    if (descEl) {
      descEl.textContent = data.description || "No description available.";
    }
    if (brandEl) brandEl.textContent = data.brand || "Brand not available";
    if (stockEl) stockEl.textContent = data.stock || "Stock not available";

    // Set the product image source
    if (imageEl) {
      if (data.image) {
        imageEl.src = data.image;
      } else if (productImages[data.name]) {
        imageEl.src = productImages[data.name];
      } else {
        console.error("No image found for product:", data.name);
      }
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
            Authorization: `Bearer ${token}`,
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


