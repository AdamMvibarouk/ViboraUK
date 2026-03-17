ddocument.addEventListener("DOMContentLoaded", async () => {
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
      "database/images/products/rackets/Babolat-Air-Vertuo-Padel-Racket-2025.png",
    "Short Sleeve Training Top Womens Red":
      "database/images/products/tshirts/Short Sleeve Training Top Womens Red.jpg",
    "Short Sleeve Training Top Mens Red":
      "database/images/products/tshirts/Short Sleeve Training Top Mens Red.jpg",
    "Short Sleeve Training Top Mens Navy":
      "database/images/products/tshirts/Short Sleeve Training Top Mens Navy.jpg",
    "Short Sleeve Training Top Womens Navy":
      "database/images/products/tshirts/Short Sleeve Training Top Womens Navy.jpg",
      "Short Sleeve Training Top Mens Black":
        "database/images/products/tshirts/Short Sleeve Training Top Mens Black.jpg",
      "Short Sleeve Training Top Mens White":
        "database/images/products/tshirts/Short Sleeve Training Top Mens White.jpg",
      "T-Shirt Bullpadel Paquito 25I White":
        "database/images/products/tshirts/T-SHIRT BULLPADEL PAQUITO 25I WHITE.jpg",
      "T-Shirt Bullpadel Chingotto 25I Stone":
        "database/images/products/tshirts/T-SHIRT BULLPADEL PAQUITO 25I WHITE.jpg",
      "T-Shirt Bullpadel Di Nenno 25I Hybiscus":
        "database/images/products/tshirts/T-SHIRT BULLPADEL PAQUITO 25I WHITE.jpg",
      "T-Shirt Bullpadel Tello 25I Blue Green":
        "database/images/products/tshirts/T-SHIRT BULLPADEL PAQUITO 25I WHITE.jpg",
      "T-Shirt Bullpadel Batea Woman":
        "database/images/products/tshirts/T-SHIRT BULLPADEL BATEA WOMAN.jpg",
      "T-Shirt Bullpadel Gemma 25V Woman":
        "database/images/products/tshirts/t-shirt-bullpadel-gemma-25v-water-green.jpg",
      "T-Shirt Nox Pro 2025":
        "database/images/products/tshirts/T-SHIRT NOX PRO 2025.jpg",
        "T-Shirt Lacoste TH5195":
          "database/images/products/tshirts/T-SHIRT LACOSTE TH5195.jpg",
      "Padel Core Carry Case":
      "database/images/products/bags/Padel Core Carry Case.JPG",
    "Bullpadel BPP26013 Hack Bag":
      "database/images/products/bags/Bullpadel BPP26013 Hack Bag.jpg",
    "Bullpadel BPP26021 Pearl Bag":
      "database/images/products/bags/Bullpadel BPP26021 Pearl Bag.jpg",
    "Bullpadel BPP25022 Xplo Red Bag":
      "database/images/products/bags/Bullpadel BPP25022 Xplo Red Bag.jpg",
    "Bullpadel BPP25015 Tour Bag":
      "database/images/products/bags/Bullpadel BPP25015 Tour Bag.jpg",
    "Varlion Summum Lime Green Bag":
      "database/images/products/bags/lime-green-varlion-summum-padel-bag-3338933439.jpg",
    "Bullpadel BPP26013 Hack Racket Bag Grey-Green":
      "database/images/products/bags/PALETERO BULLPADEL BPP26013 HACK GRIS VERDOSO.jpg",
    "Babolat Court Padel X3 Balls Canister":
      "database/images/products/balls/BABOLAT COURT PADEL X3 BALLS CANISTER.jpg",
    "Wilson Premier Padel Balls Canister":
      "database/images/products/balls/WILSON PREMIER PADEL BALLS CANISTER.jpg",
    "3-Ball Can Nox Nerbo":
      "database/images/products/balls/3-BALL CAN NOX NERBO.jpg",
    "Bullpadel Premium Pro Boat":
      "database/images/products/balls/BULLPADEL PREMIUM PRO BOAT.jpg",
    "Bullpadel Train Ball Jar 465464":
      "database/images/products/balls/BULLPADEL TRAIN BALL JAR 465464.jpg",
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


