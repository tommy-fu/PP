// document.addEventListener("DOMContentLoaded", function() {

function openNavbar() {

    //Conditional functions depending on viewport
    if (window.innerWidth < 996) {
        var element = document.getElementById('navbar-menu2');
    }
    else {
        var element = document.getElementById('navbar-menu');
    }

    if (element.style.display === "none") {
        element.style.display = "block";
    } else {
        element.style.display = "none";
    }

}
