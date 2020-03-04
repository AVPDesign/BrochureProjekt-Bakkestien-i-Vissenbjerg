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
    // Search route map
    var searchMapOptions = {
        zoom: 6,
        center: new google.maps.LatLng(56.157788, 11.057739),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    // Init map
    function initMap() {
        searchRouteMap = new google.maps.Map(document.getElementById('searchRouteMap'), searchMapOptions);
        addMarkers();
    }

    google.maps.event.addDomListener(window, 'load', initMap);

    // Make markers
    var markers = [
        {id: 1, name: 'Bakkestien', zip: 'Assens', length: '3,5', lat: 55.391140, lng: 10.116250},
        {id: 2, name: 'Møllegårdsskovstien', zip: 'Assens', length: '4,5', lat: 55.270630, lng: 9.900540},
        {id: 3, name: 'Dallund Sø', zip: 'Søndersø', length: '5,5', lat: 55.487289, lng: 10.246400},
        {id: 4, name: 'Pipstorn Skov', zip: 'Faaborg', length: '3,0', lat: 55.093891, lng: 10.264750}
    ];

    function addMarkers() {
        for (var i = 0; i < markers.length; i++) {

            var latLng = new google.maps.LatLng(markers[i].lat, markers[i].lng);

            markers[i] = new google.maps.Marker({
                id: markers[i].id,
                position: latLng,
                map: searchRouteMap,
                name: markers[i].name
            });

            var infowindow = new google.maps.InfoWindow({
                content: markers[i].name
            });

            google.maps.event.addListener(markers[i], 'click', function () {
                window.location.href = "index.php?page=single";
            });
        }
    }
</script>