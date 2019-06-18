<!DOCTYPE html>
<html>
<head>
    <title>Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
        /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        var map;
        function initMap() {
            var lat = parseFloat(<?php echo $lat; ?>);
            var lng = parseFloat(<?php echo $lng; ?>);
            var center = {lat: lat, lng: lng}
            
            map = new google.maps.Map(document.getElementById('map'), {
                center: center,
                zoom: 16,
                mapTypeId: 'terrain'
            });

            var marker = new google.maps.Marker({position: center, map: map});
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpQ8hEdEXHlKDn9yCw3nDUs1j0HhijuV4&callback=initMap" async defer></script>
</body>
</html>