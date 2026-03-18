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
  loadCategory(RACKETS_CATEGORY_ID, racketsContainer, "database/images/products/rackets/BABOLAT X LAMBORGHINI BL002 SCANDAL GREEN.jpg");
  loadCategory(SPORTSWEAR_CATEGORY_ID, sportswearContainer, "images/racket1.jpg");

});

document.addEventListener("DOMContentLoaded", function () {

  var popup = document.getElementById("newsletter-popup");
  if (!popup) return;

  var form = document.getElementById("newsletter-form");
  var success = document.getElementById("newsletter-success");

  if (!localStorage.getItem("newsletter")) {
    setTimeout(function () {
      popup.classList.add("active");
    }, 1500);
  }

  document.getElementById("newsletter-close").onclick = closePopup;
  document.getElementById("newsletter-overlay").onclick = closePopup;

  function closePopup() {
    localStorage.setItem("newsletter", "done");
    popup.classList.remove("active");
  }

  if (form) {
    form.onsubmit = function (e) {
      e.preventDefault();
      localStorage.setItem("newsletter", "done");
      form.style.display = "none";
      success.style.display = "block";
    };
  }

});

document.addEventListener("DOMContentLoaded", function () {

  var popup = document.getElementById("cookie-popup");
  if (!popup) return;

  if (!localStorage.getItem("cookie")) {
    popup.classList.add("active");
  }

  document.getElementById("cookie-accept").onclick = closeCookie;
  document.getElementById("cookie-reject").onclick = closeCookie;

  function closeCookie() {
    localStorage.setItem("cookie", "done");
    popup.classList.remove("active");
  }

});

document.addEventListener("DOMContentLoaded", function () {

  var form = document.getElementById("review-form");
  var list = document.getElementById("reviews-list");

  if (!form || !list) return;

  function getReviews() {
    var savedReviews = localStorage.getItem("reviews");
    return savedReviews ? JSON.parse(savedReviews) : [];
  }

  function saveReviews(reviews) {
    localStorage.setItem("reviews", JSON.stringify(reviews));
  }

  function renderReviews() {
    var reviews = getReviews();
    list.innerHTML = "";

    reviews.forEach(function (review, index) {
      var card = document.createElement("div");
      card.classList.add("review-card");

      var fullStars = Number(review.rating);
      var emptyStars = 5 - fullStars;
      var stars = "⭐️".repeat(fullStars) + "☆".repeat(emptyStars);

      card.innerHTML =
      "<h4>" + review.name + "</h4>" +
      '<div class="review-stars">' + stars + "</div>" +
      "<p>" + review.message + "</p>" +
      '<button class="delete-review" data-index="' + index + '">Delete</button>';

      list.appendChild(card);
    });

    var deleteButtons = document.querySelectorAll(".delete-review");

    deleteButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        var index = this.getAttribute("data-index");
        var reviews = getReviews();

        // BACKEND

        reviews.splice(index, 1);
        saveReviews(reviews);
        renderReviews();
      });
    });
  }

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    var name = document.getElementById("review-name").value;
    var rating = document.getElementById("review-rating").value;
    var message = document.getElementById("review-message").value;

    var reviews = getReviews();

    // BACKEND

    reviews.push({
      name: name,
      rating: rating,
      message: message
    });

    saveReviews(reviews);
    renderReviews();
    form.reset();
  });

  renderReviews();

});

document.addEventListener("DOMContentLoaded", function () {

  var homepageReviews = document.getElementById("homepage-reviews-list");

  if (!homepageReviews) return;

  var savedReviews = localStorage.getItem("reviews");
  var reviews = savedReviews ? JSON.parse(savedReviews) : [];

  homepageReviews.innerHTML = "";

  reviews.slice(0,3).forEach(function (review) {

    var card = document.createElement("div");
    card.classList.add("review-card");

    var fullStars = Number(review.rating);
    var emptyStars = 5 - fullStars;
    var stars = "⭐️".repeat(fullStars) + "☆".repeat(emptyStars);

    card.innerHTML =
      "<h4>" + review.name + "</h4>" +
      '<div class="review-stars">' + stars + "</div>" +
      "<p>" + review.message + "</p>";

    homepageReviews.appendChild(card);

  });

});