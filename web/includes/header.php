<?php
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = '';
}
?>
<html lang="da">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bakkestien Vissenbjerg - Hjerteforeningen</title>

        <!-- material design icons -->
        <link rel="stylesheet" href="//cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">


        <!-- google maps -->
        <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1k5SC29hxlgaYFAVTeKx9yS7iPNUjUTI&callback=initMap"></script>-->
        <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>

        <!-- custom -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <!-- font awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" async defer></script>
        <script src="assets/js/script.js" defer></script>
    </head>

    <body onload="loaded()" class="preload">
        <header id="header">
            <div class="wrapper">
                <div class="logo">
                    <a href="index.php">
                        <img src="assets/img/logo1.svg" alt="logo"/>
                    </a>
                </div>

                <nav>
                    <!-- desktop nav -->
                    <div id="desktopNav">
                        <a href="index.php" class="<?php
                        if ($page === "" || $page === "home") {
                            echo 'activeDesktop';
                        } else {
                            echo '';
                        }
                        ?>">Forside</a>
                        
                        <a href="index.php?page=routes" class="<?php
                        if ($page === "routes") {
                            echo 'activeDesktop';
                        } else {
                            echo '';
                        }
                        ?>">Hjertestier</a>
                        
                        <a href="index.php?page=about" class="<?php
                        if ($page === "about") {
                            echo 'activeDesktop';
                        } else {
                            echo '';
                        }
                        ?>">Om os</a>
                        
                        <a href="index.php?page=contact" class="<?php
                           if ($page === "contact") {
                               echo 'activeDesktop';
                           } else {
                               echo '';
                           }
                        ?>">Kontakt</a>
                    </div>

                    <!-- mobile nav -->
                    <div class="flex" id="mobileNavContainer">
                        <!-- search -->
                        <div class="flex m-r">
                            <svg style="width:2em;" viewBox="0 0 24 24" onclick="toggleSearch()">
                            <path id="mobileSearchPath" fill="#C8102E" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                            </svg>

                            <div id="mobileSearch">
                                <input type="text" placeholder="Søg" id="mobileSearchInput">
                                <button type="submit" id="mobileSearchSubmit">
                                    <svg style="width:2em;" viewBox="0 0 24 24">
                                    <path fill="#C8102E" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- nav -->
                        <svg id="mobileNav" style="width:2.2em;" viewBox="0 0 24 24" onclick="toggleMobileNav()">
                        <path fill="#C8102E" id="mobileNavMenuPath" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z"/>
                        </svg>
                    </div>
                </nav>
            </div><!-- wrapper -->
        </header>

        <!-- mobile nav -->
        <div id="mobileNavOverlay">
            <ul id="mobileNavLinks">
                <li><a href="index.php">Forside</a></li>
                <li><a href="index.php?page=routes">Hjertestier</a></li>
                <li><a href="index.php?page=about">Om os</a></li>
                <li><a href="index.php?page=contact">Kontakt</a></li>
            </ul>

            <div id="mobileNavFooter">
                <img src="assets/img/hjerteforeningenLogo1.svg" alt="logo"/>
            </div>
        </div>