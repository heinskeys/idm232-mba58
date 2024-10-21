var navigationButton = document.getElementById("navigation");
var menuIcon = document.getElementById("materialMenu");
var closeIcon = document.getElementById("materialClose");

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
