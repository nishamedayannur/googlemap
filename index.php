<html>
    <head>
        
        <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    </head>
    <body>
        <div>
            <input type="text" id="address">
            <button id="submit">Submit</button>
        </div>
        <label>Google Map</label>
        <!-- <div id="map"></div> -->
        <div style="padding:10px">
			<div id="map"></div>
		</div>
        <label>OpenStreetMap</label>
        <div id="mapOSM" style="width: 100vw; height: 100vh;"></div>

        
    </body>
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3aYY63LgX1gDoOBLxLt0XV1m9wYR_UkY"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3aYY63LgX1gDoOBLxLt0XV1m9wYR_UkY&callback=initMap" async defer></script>

    <script>
        $(document).ready(function(){
            function handleData(result){
                result = JSON.parse(result);

                lat = parseFloat(result.results[0].geometry.location.lat);
                lng = parseFloat(result.results[0].geometry.location.lng);
                loadmap(lat, lng);
                
                loadOSM(lat, lng);
                
            }

            function loadOSM(lat, lng)
            {
                console.log('done');
                var map;
                var mapLat = lat;
                var mapLng = lng;
                var mapDefaultZoom = 15;

                map = new ol.Map({
                    target: "mapOSM",
                    layers: [
                        new ol.layer.Tile({
                            source: new ol.source.OSM({
                                url: "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png"
                            })
                        })
                    ],
                    view: new ol.View({
                        center: ol.proj.fromLonLat([mapLng, mapLat]),
                        zoom: mapDefaultZoom
                    })
                });
            }

            function loadmap(lat, lng){
                
                
                var myLatlng = new google.maps.LatLng(lat,lng);
                var myOptions = {
                    zoom: 4,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                map = new google.maps.Map(document.getElementById("map"), myOptions);
                var marker = new google.maps.Marker({
                    position: myLatlng, 
                    map: map,
                title:"Fast marker"
                });

                /*var map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: lat,
                        lng: lng
                    },
                    zoom: 13,
                    mapTypeId: 'roadmap'
                });*/
            }

            $("#submit").click(function(){
                address = $("#address").val();
                $.ajax({
                    url: "input.php",
                    data: {address : address},
                    type: "POST",
                    success: handleData 
                });
            });
        });
    </script>
</html>
