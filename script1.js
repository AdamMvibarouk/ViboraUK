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

const searchInput =
  document.getElementById('searchInput') ||
  document.querySelector('.searchbar input[placeholder="Search Products"]') ||
  document.querySelector('.searchbar input');

if (!searchInput) {
  console.warn('Search input not found. Make sure there is an <input> inside .searchbar.');
} else {
  const productsContainer = document.getElementById('productsContainer') || document;
  function getDefaultDisplay(card) {
    const style = window.getComputedStyle(card);
    return (style.display && style.display !== 'none') ? style.display : 'block';
  }

  function filterProducts() {
    const q = searchInput.value.toLowerCase().trim();
    const cards = productsContainer.querySelectorAll('.product-card');

    cards.forEach(card => {
      const nameEl = card.querySelector('.product-name');
      const name = nameEl ? nameEl.textContent.toLowerCase() : '';

      if (q === '' || name.includes(q)) {
        if (!card._originalDisplay) card._originalDisplay = getDefaultDisplay(card);
        card.style.display = card._originalDisplay;
      } else {
        card.style.display = 'none';
      }
    });
  }

  searchInput.addEventListener('input', filterProducts);

  document.addEventListener('DOMContentLoaded', filterProducts);
}
