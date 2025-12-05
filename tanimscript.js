window.addEventListener("load", function () {
  var header = document.getElementById("main-header");
  if (!header) return;

  var sticky = header.offsetTop;
  

  function stickyNav() {
    if (window.pageYOffset > sticky) {
      header.classList.add("sticky");
    } else {
      header.classList.remove("sticky");
    }
  }

  window.addEventListener("scroll", stickyNav);
});


document.addEventListener("DOMContentLoaded", function () {
  var BALLS_CATEGORY_ID = "e6660920-cf7e-11f0-a24b-005056b707be";
  var RACKETS_CATEGORY_ID = "352883ba-cd3f-11f0-982a-005056b707be";
  var SPORTSWEAR_CATEGORY_ID = "e6660501-cf7e-11f0-a24b-005056b707be";

  var ballsContainer = document.getElementById("featured-balls-list");
  var racketsContainer = document.getElementById("featured-rackets-list");
  var sportswearContainer = document.getElementById("featured-sportswear-list");

  function loadCategory(categoryId, container, imageUrl) {
    if (!container || !categoryId) return;

    fetch("http://localhost:5000/api/products?category_id=" + categoryId)
      .then(function (res) {
        return res.json();
      })
      .then(function (products) {
        var firstFive = products.slice(0, 3);
        renderProducts(firstFive, container, imageUrl);
      })
      .catch(function (err) {
        console.error("Error loading products for category:", categoryId, err);
      });
  }

  function renderProducts(products, container, imageUrl) {
    container.innerHTML = "";

    products.forEach(function (product) {
      var card = document.createElement("div");
      card.classList.add("product-card");

      var priceHtml = "";
      if (product.base_price !== null && product.base_price !== undefined) {
        priceHtml =
          '<div class="product-price">£' +
          Number(product.base_price).toFixed(2) +
          "</div>";
      }

      card.innerHTML =
        '<img src="' +
        imageUrl +
        '" alt="' +
        product.name +
        '">' +
        '<div class="product-info">' +
        '<div class="product-name">' +
        product.name +
        "</div>" +
        '<div class="product-bottom">' +
        priceHtml +
        '<button onclick="window.location.href=\'product-details.html?id=' +
        product.product_id +
        '\'">' +
        "See Details" +
        "</button>" +
        "</div>" +
        "</div>";


      container.appendChild(card);
    });
  }

  loadCategory(BALLS_CATEGORY_ID, ballsContainer, "images/racket1.jpg");
  loadCategory(RACKETS_CATEGORY_ID, racketsContainer, "images/racket1.jpg");
  loadCategory(SPORTSWEAR_CATEGORY_ID, sportswearContainer, "images/racket1.jpg");


});
