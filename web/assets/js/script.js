// Display mobile nav
var toggle = false;

function toggleMobileNav() {
    var mobileNavMenuPath = document.getElementById("mobileNavMenuPath");
    var mobileNavOverlay = document.getElementById("mobileNavOverlay");

    var closeMobileNav = document.getElementById("closeMobileNav");
    var showMobileNav = document.getElementById("showMobileNav");

    if (toggle == false) {
        mobileNavOverlay.style.width = "100%";

//        mobileNavMenuPath.setAttribute("d", "M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z");
        mobileNavMenuPath.style.d = "path('M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z')";

        toggle = true;
    } else {
        mobileNavOverlay.style.width = "0";

//        mobileNavMenuPath.setAttribute("d", "M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z");
        mobileNavMenuPath.style.d = "path('M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z')";


        toggle = false;
    }
}

// 156,4 - 110,6