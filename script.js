// Wait for the window to load
window.onload = function() {
    
    // Get the header
    var header = document.getElementById("main-header");
    
    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position
    // Remove "sticky" when you leave the scroll position
    function stickyNav() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }

    // Attach the function to the window's scroll event
    window.onscroll = function() {
        stickyNav();
    };
};

// script.js - live product filter (robust version)

// Find the search input in several ways (works even if you didn't add an id)
const searchInput =
  document.getElementById('searchInput') ||
  document.querySelector('.searchbar input[placeholder="Search Products"]') ||
  document.querySelector('.searchbar input');

if (!searchInput) {
  console.warn('Search input not found. Make sure there is an <input> inside .searchbar.');
} else {
  // container that holds product cards
  const productsContainer = document.getElementById('productsContainer') || document;

  // We'll capture the initial computed display style of the first card
  // so we can restore it when showing a card again.
  function getDefaultDisplay(card) {
    const style = window.getComputedStyle(card);
    // prefer 'flex' or 'grid' if that's what's used; fallback to 'block'
    return (style.display && style.display !== 'none') ? style.display : 'block';
  }

  // Filter function
  function filterProducts() {
    const q = searchInput.value.toLowerCase().trim();

    // Get current list of cards (so it works if cards are changed dynamically)
    const cards = productsContainer.querySelectorAll('.product-card');

    cards.forEach(card => {
      const nameEl = card.querySelector('.product-name');
      const name = nameEl ? nameEl.textContent.toLowerCase() : '';

      if (q === '' || name.includes(q)) {
        // show card (restore its natural display)
        if (!card._originalDisplay) card._originalDisplay = getDefaultDisplay(card);
        card.style.display = card._originalDisplay;
      } else {
        // hide card
        card.style.display = 'none';
      }
    });
  }

  // Use 'input' for immediate feedback as you type
  searchInput.addEventListener('input', filterProducts);

  // Optional: run once on page load to apply any initial query (if input prefilled)
  document.addEventListener('DOMContentLoaded', filterProducts);
}


