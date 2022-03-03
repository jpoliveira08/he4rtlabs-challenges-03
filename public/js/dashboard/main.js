function divInteraction() {
    verticalNav = document.querySelector("#mySideNav");
    verticalNav.offsetWidth === 0 ? verticalNav.style.width = "200px" : verticalNav.style.width = "0px";
}