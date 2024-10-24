var navigationButton = document.getElementById("navigation");
var menuIcon = document.getElementById("materialMenu");
var closeIcon = document.getElementById("materialClose");
var accordionItems = document.querySelectorAll('.accordionItem');

// *Navigation Button
function navButton() {
    if (navigationButton.className === "navigation") {
        navigationButton.className += " responsive";
    } else {
        navigationButton.className = "navigation";
    }

    if (menuIcon.style.display === "none") {
        menuIcon.style.display = "block";
        closeIcon.style.display = "none";
    } else {
        menuIcon.style.display = "none";
        closeIcon.style.display = "block";
    }
}

// *Help Accordion

var accordions = document.querySelectorAll('.accordionItem');

    accordions.forEach(function(accordion) {
        var header = accordion.querySelector('.accordionHeader');
        var content = accordion.querySelector('.accordionContent');
        var icon = header.querySelector('.accordionIcon');

    header.addEventListener('click', function() {
        var isOpen = content.style.display === 'block';

      // Close all accordions
    accordions.forEach(function(item) {
        item.querySelector('.accordionContent').style.display = 'none';
        item.querySelector('.accordionIcon').textContent = 'add';
    });

      // If this accordion was not open, open it
    if (!isOpen) {
        content.style.display = 'block';
        icon.textContent = 'remove'; // Change to minus when open
    } else {
        icon.textContent = 'add'; // Reset to plus when closed
    }
    });
});

// Toggle Search Bar visibility
function toggleSearch() {
    const searchBar = document.getElementById('searchBar');
    if (searchBar.style.display === 'flex') {
        searchBar.style.display = 'none';
    } else {
        searchBar.style.display = 'flex';
    }
}

// Redirect to 404page.html when search is submitted
function submitSearch() {
    const searchInput = document.getElementById('searchInput').value;
    if (searchInput.trim() !== "") {
        window.location.href = '404page.html';
    }
}

// // Navigation Button for Mobile (Toggling Menu)
// function navButton() {
//     const menuIcon = document.getElementById('materialMenu');
//     const closeIcon = document.getElementById('materialClose');
//     const navigation = document.getElementById('navigation');

//     if (menuIcon.style.display === "none") {
//         menuIcon.style.display = "block";
//         closeIcon.style.display = "none";
//     } else {
//         menuIcon.style.display = "none";
//         closeIcon.style.display = "block";
//     }

//     // Logic to show/hide the actual menu goes here
// }
