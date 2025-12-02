fetch("/api/products")
  .then(res => res.json())
  .then(products => {
    const container = document.getElementById("productsContainer");

    products.forEach(product => {
      const card = document.createElement("div");
      card.classList.add("product-card");

      // TEMP image until DB has a real one
      const imageUrl = `images/racket1.jpg`;

      card.innerHTML = `
        <img src="${imageUrl}" alt="${product.name}">
        <div class="product-info">
            <div class="product-name">${product.name}</div>
            <div class="product-bottom">
                <div class="product-price">£${product.base_price.toFixed(2)}</div>
                <button onclick="window.location.href='/product.html?id=${product.product_id}'">
                  See Details
                </button>
            </div>
        </div>
      `;

      container.appendChild(card);
    });
  })
  .catch(err => console.error("Error loading products:", err));
