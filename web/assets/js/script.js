//Function debouncing
function debounce(func, wait, immediate) {
    var timeout;
    return function () {
        var context = this,
                args = arguments;
        var later = function () {
            timeout = null;
            if (!immediate)
                func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow)
            func.apply(context, args);
    };
}


/* Remove preload class from body */
function loaded() {
    document.body.classList.remove("preload");
}

// Toggle mobile search input
var toggleMobileSearch = false;

var toggleSearch = debounce(function () {
    var fullLogo = document.getElementById("fullLogo");
    var halfLogo = document.getElementById("halfLogo");

    var mobileSearch = document.getElementById('mobileSearch');
    var mobileSearchInput = document.getElementById('mobileSearchInput');
    var mobileSearchSubmit = document.getElementById('mobileSearchSubmit');
    var mobileSearchPath = document.getElementById('mobileSearchPath');

    if (toggleMobileSearch == false) {
        mobileSearch.style.display = "flex";

        setTimeout(function () {
            fullLogo.style.display = "none";
            halfLogo.style.display = "block";

            mobileSearch.style.opacity = "1";
            mobileSearch.style.width = "165px";

            mobileSearchInput.style.opacity = "1";
            mobileSearchInput.style.width = "77%";

            mobileSearchSubmit.style.opacity = "1";
            mobileSearchSubmit.style.width = "23%";

            mobileSearchPath.setAttribute("d", "M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z");
        }, 75);

        clearTimeout();

        toggleMobileSearch = true;
    } else {


        mobileSearch.style.opacity = "0";
        mobileSearch.style.width = "0";

        mobileSearchInput.style.opacity = "0";
        mobileSearchInput.style.width = "0";

        mobileSearchSubmit.style.opacity = "0";
        mobileSearchSubmit.style.width = "0";

        mobileSearchPath.setAttribute("d", "M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z");

        setTimeout(function () {
            fullLogo.style.display = "block";
            halfLogo.style.display = "none";
            mobileSearch.style.display = "none";
        }, 350);

        clearTimeout();

        toggleMobileSearch = false;
    }
}, 250);

// Toggle mobile nav
var toggle = false;

//function toggleMobileNav() {
var toggleMobileNav = debounce(function () {
    var mobileNavMenuPath = document.getElementById("mobileNavMenuPath");
    var mobileNavOverlay = document.getElementById("mobileNavOverlay");
    var mobileNavLinks = document.getElementById("mobileNavLinks");

    if (toggle == false) {
        document.body.style.overflowY = "hidden";
        mobileNavOverlay.style.display = "block";

        setTimeout(function () {
            mobileNavOverlay.style.width = "100%";
        }, 1);

        mobileNavMenuPath.setAttribute("d", "M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z");
        mobileNavLinks.style.display = "block";
        toggle = true;
    } else {
        document.body.style.overflowY = "scroll";
        mobileNavOverlay.style.width = "0";

        setTimeout(function () {
            mobileNavOverlay.style.display = "none";
        }, 350);

        mobileNavMenuPath.setAttribute("d", "M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z");
        mobileNavLinks.style.display = "none";
        toggle = false;
    }
}, 250);


// Toggle fixed header
var header = document.getElementById("header");

// Get the offset position of the navbar
var top = header.OffsetTop;
var scrollPos = (document.body.getBoundingClientRect()).top;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function fixHeader() {
    if (window.pageYOffset > scrollPos) {
        header.classList.add("fixed");
    } else {
        header.classList.remove("fixed");
    }
}

// Detect scroll direction
scrollPos = (document.body.getBoundingClientRect()).top;

window.addEventListener('scroll', function () {
    // detects new state and compares it with the new one
    if ((document.body.getBoundingClientRect()).top > scrollPos) {
        // Up
        header.style.top = "0";
    } else {
        // Down
        header.style.top = "-75px";
    }
    // saves the new position for iteration.
    scrollPos = (document.body.getBoundingClientRect()).top;
});

// When the user scrolls the page, execute myFunction
window.addEventListener('scroll', fixHeader);


// !!!! Find routes page
// Show list or map
var listBtn = document.getElementById('showList');
var mapBtn = document.getElementById('showMap');

var routesList = document.getElementById('searchRouteTable');
var routesMap = document.getElementById('searchRouteMap');

function showRoutes(style) {
    if (style === 1) {
        routesList.style.display = "inline-table";
        listBtn.classList.add("active-spec-btn");

        routesMap.style.display = "none";
        mapBtn.classList.remove("active-spec-btn");

    } else {
        routesMap.style.display = "block";
        mapBtn.classList.add("active-spec-btn");

        routesList.style.display = "none";
        listBtn.classList.remove("active-spec-btn");
    }
}

// Search route table row link to route on <tr> click
function toSingleRoute() {
    location.href = "index.php?page=single";
}