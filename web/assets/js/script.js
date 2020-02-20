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
};

// Toggle mobile nav
var toggle = false;

//function toggleMobileNav() {
var toggleMobileNav = debounce(function(){
    var mobileNavMenuPath = document.getElementById("mobileNavMenuPath");
    var mobileNavOverlay = document.getElementById("mobileNavOverlay");
    var mobileNavLinks = document.getElementById("mobileNavLinks");

    if (toggle == false) {
        mobileNavOverlay.style.display = "block";

        setTimeout(function () {
            mobileNavOverlay.style.width = "100%";
        }, 1);

        mobileNavMenuPath.setAttribute("d", "M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z");
        mobileNavLinks.style.display = "block";
        toggle = true;
    } else {
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
var map;
var kmlSrc = 'https://sti.webnation.dk/bakkestien.kml';

function initMap() {
    map = new google.maps.Map(document.getElementById('map'));

    var kmlLayer = new google.maps.KmlLayer(kmlSrc, {
        suppressInfoWindows: true,
        preserveViewport: false,
        map: map
    });
}
;