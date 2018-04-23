<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Map View</title>
</head>
<body>
    <div class="map" id="map" style="with:100%;height:475px;">

    </div>

    <script>
        function initMap(){
            var location={lat:<?php echo $lat;?>,lng:<?php echo $long;?>};
            var map=new google.maps.Map(document.getElementById('map'),{
                zoom:10,
                center:location
            });

            var marker=new google.maps.Marker({
                position:location,
                map:map
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0DP6gEmIIru_-dsZqTAJgkjBZTV1XDFQ&callback=initMap"></script>
</body>
</html>