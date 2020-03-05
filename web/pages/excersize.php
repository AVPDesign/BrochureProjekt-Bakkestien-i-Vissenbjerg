<main>
    <!-- MAP -->
    <div class="row">
        <div class="col-1">
            <div id="excMap"></div>
        </div>
    </div>


    <div class="row excersizeSpecs">
        <h1>Bakkestien</h1>
        <div class="col-1">
            3 km tilbage (ca. 12 min.)
        </div>
        <div class="col-1 redBox">
            Afbryd rute
        </div>
    </div>
</main>
<script>
    //Maps
    var excMap;
    var kmlSrc = 'http://sti.webnation.dk/bakkestien.kml';

    (function initMap() {

        // Excersize map
        excMap = new google.maps.Map(document.getElementById('excMap'));

        var kmlLayer = new google.maps.KmlLayer(kmlSrc, {
            suppressInfoWindows: true,
            preserveViewport: false,
            map: excMap
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
                    map: excMap,
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
                    excMap.setCenter(newPosition);
                    excMap.setZoom(16);
                    marker.setPosition(newPosition);
                }, 2500);

                // Set marker infoWindow content
                marker.addListener('click', function () {
                    infoWindow.open(excMap, marker);
                });

            }, function () {
                handleLocationError(true, infoWindow, excMap.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, excMap.getCenter());
        }
    })();
</script>
<!--