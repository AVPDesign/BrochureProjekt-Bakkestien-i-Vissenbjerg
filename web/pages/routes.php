<?php

$output = "";

$json = '[{
              "id": "1",
              "name": "Bakkestien",
              "zip": "Assens",
              "length": "3,5"
            },
            {
                "id": "2",
                "name": "Møllegårdsskovstien",
                "zip": "Assens",
                "length": "4,5"
            },
            {
                "id": "3",
                "name": "Dallund Sø",
                "zip": "Søndersø",
                "length": "5,5"
            },
            {
                "id": "4",
                "name": "Pipstorn Skov",
                "zip": "Faaborg",
                "length": "3,0"
            }]';

$jsonDecoded = json_decode($json);

foreach ($jsonDecoded as $obj) {
    $output .= "<tr onclick='toSingleRoute()'>
                    <td>$obj->name</td>
                    <td>$obj->zip</td>
                    <td>$obj->length km</td>
                 </tr>";
}
?>
<main>
    <div class="row">
        <div class="col-1">
            <h1>Find din hjertesti</h1>
        </div>
    </div>


    <!-- Search kommune -->
    <div class="row no-gutters">
        <div class="col-1 text-center searchRoute">
            <h3>
                Find hjertestier nær dig
            </h3>
            <input type="text" placeholder="Indtast kommune"/>
            <input type="submit" value="Søg"/>
        </div>
    </div>


    <!-- Choose between list or map -->
    <div class="row">
        <div class="col-1 flex-e">
            <button class="spec-btn active-spec-btn" id="showList" onclick="showRoutes(1)">Vis liste</button> <span class="no-line-height">Eller</span> <button onclick="showRoutes(2)" class="spec-btn" id="showMap">Vis kort</button>
        </div>
    </div>


    <!-- Routes list -->
    <div class="row" style="overflow-x:auto;">
        <table class="searchRouteTable" id="searchRouteTable">
            <thead>
                <tr>
                    <th>Navn:</th>
                    <th>Kommune:</th>
                    <th>Længde:</th>
                </tr>
            </thead>

            <tbody>
                <?php echo $output; ?>
            </tbody>
        </table>
    </div>

    <!-- Routes map -->
    <div class="row">
        <div class="col-1">
            <div id="searchRouteMap"></div>
        </div>
    </div>
</main>

<script>
    //Maps
    var routeMap;
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