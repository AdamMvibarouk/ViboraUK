document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const productId = params.get("id");

    if (!productId) {
        console.error("No product ID found in URL");
        return;
    }

    // Fetch single product
    fetch(`http://localhost:5000/api/products/${productId}`)
        .then(res => res.json())
        .then(product => renderProduct(product))
        .catch(err => console.error("Error loading product:", err));
});


function renderProduct(product) {
    // Page elements
    const titleEl = document.querySelector(".product-title");
    const imgEl = document.querySelector(".product-image img");
    const descEl = document.querySelector(".product-description");
    const priceEl = document.querySelector(".price");
    const brandEl = document.querySelector(".product-info");

    // Update content
    titleEl.textContent = product.name;
    descEl.textContent = product.description || "No description available.";
    priceEl.textContent = `£${Number(product.base_price).toFixed(2)}`;

    imgEl.src = "images/racket1.jpg";   // Replace when you have real images

    // Brand + stock info
    brandEl.innerHTML = `
        <li><strong>Brand:</strong> ${product.brand || "Unknown"}</li>
        <li><strong>Availability:</strong> ${product.stock > 0 ? "In Stock" : "Out of Stock"}</li>
    `;
}
