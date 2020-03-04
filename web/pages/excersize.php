<main>
    <!-- MAP -->
    <div class="row">
        <div class="col-1">
            <div id="routeMap"></div>
        </div>
    </div>


    <div class="row">
        <a href="index.php?page=excersize" class="col-1 greenBox">
            <span>Start rute</span>
        </a>
    </div>



    <div class="row">
        <div class="col-1">Start- & slutsted er på P-pladsen ved terrariet.</div>
    </div>
</main>
<script>
    //Maps
    var routeMap, searchRouteMap;
    var kmlSrc = 'http://sti.webnation.dk/bakkestien.kml';

    (function initMap() {

        // Single-route map
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
    })();
</script>