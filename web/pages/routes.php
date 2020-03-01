<?php
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

$output = "";

foreach ($jsonDecoded as $obj) {
    $output .=  "<tr>
                    <td><a href='index.php?page=single'>$obj->name</a></td>
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

    <div class="row">
        <div class="col-1 flex-e">
            <button class="spec-btn active-spec-btn">Vis liste</button> <span class="no-line-height">Eller</span> <button class="spec-btn">Vis kort</button>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="col-1 text-center searchRoute">
            <h3>
                Find hjertestier nær dig
            </h3>
            <input type="text" placeholder="Søg på kommune"/>
            <input type="submit" value="Søg"/>
        </div>
    </div>

    <div class="row">
        <table class="searchRouteTable">
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
</main>