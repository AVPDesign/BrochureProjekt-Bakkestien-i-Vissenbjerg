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
    var mobileSearch = document.getElementById('mobileSearch');
    var mobileSearchInput = document.getElementById('mobileSearchInput');
    var mobileSearchSubmit = document.getElementById('mobileSearchSubmit');
    var mobileSearchPath = document.getElementById('mobileSearchPath');

    if (toggleMobileSearch == false) {
        mobileSearch.style.display = "flex";

        setTimeout(function () {
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



//Bakkestien map
var routeMap;
var kmlSrc = 'http://sti.webnation.dk/bakkestien.kml';

function initMap() {
    routeMap = new google.maps.Map(document.getElementById('routeMap'));

    var kmlLayer = new google.maps.KmlLayer(kmlSrc, {
        suppressInfoWindows: true,
        preserveViewport: false,
        map: routeMap
    });

    var infoWindow = new google.maps.InfoWindow;

    // Try HTML5 Geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {

            // Get user current position
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            var marker = new google.maps.Marker({
                position: pos,
                map: routeMap,
                title: 'Din placering'
            });

            var infoWindow = new google.maps.InfoWindow({
                content: 'Din placering'
            });

            // Update user position every 5 seconds
            setInterval(function () {
                var newPosition = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                marker.setPosition(newPosition);
            }, 5000);

            // Set marker infoWindow content
            marker.addListener('click', function () {
                infoWindow.open(routeMap, marker);
            });

        }, function () {
            handleLocationError(true, infoWindow, routeMap.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, routeMap.getCenter());
    }
}



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