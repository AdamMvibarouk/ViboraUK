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
