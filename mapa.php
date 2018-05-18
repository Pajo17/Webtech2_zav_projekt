
<script>
function initMap() {
        var uluru = {lat: 48.8819572, lng: 19.8405443};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: uluru
        });
        // var marker = new google.maps.Marker({
        //   position: uluru,
        //   map: map
        // });
        var geocoder = new google.maps.Geocoder(); //pouzivam Geocoder, aby som vedel z adresy vytvorit suradnice
        //map.data.loadGeoJson("skuska.json");
        geocodeAddress(geocoder, map);



    <?php
    session_start();
    if(isset($_SESSION['email'])){
    $resoult = checkAktiveRoad();
        if(!(empty($resoult))){
            $resoult = getActiveRoute();

        while($row = $resoult->fetch_assoc()){
            echo "
                            var directionsDisplay;
                    var directionsService = new google.maps.DirectionsService();
                     directionsDisplay = new google.maps.DirectionsRenderer({
                        polylineOptions: {
                          strokeColor: \"red\"
                        }
                      });
                    directionsDisplay.setMap(map);
        
                   var start = new google.maps.LatLng(".$row['Start_lan'].", ".$row['Start_lng'].");
                    var end = new google.maps.LatLng(".$row['End_lan'].", ".$row['End_lng'].");
                    calcRoute(directionsDisplay,directionsService,start,end);
                    
        ";

        }

    }
    }


        //zakreslenie verejnych ciest
    $resoult = getPublicRoute();
    while($row = $resoult->fetch_assoc()){
        echo "
                            var directionsDisplay;
                    var directionsService = new google.maps.DirectionsService();
                    directionsDisplay = new google.maps.DirectionsRenderer();
                    directionsDisplay.setMap(map);
        
                   var start = new google.maps.LatLng(".$row['Start_lan'].", ".$row['Start_lng'].");
                    var end = new google.maps.LatLng(".$row['End_lan'].", ".$row['End_lng'].");
                    calcRoute(directionsDisplay,directionsService,start,end);
                    
        ";

    }


    if(isset($_SESSION['email'])){
        if ($_SESSION['administrator'] == 1) {
            $resoult = getPrivateRoute(1);
        } else {
            $resoult = getPrivateRoute(0);
        }
        //zakreslenie privatnych ciest
        while ($row = $resoult->fetch_assoc()) {
            echo "
                            var directionsDisplay;
                    var directionsService = new google.maps.DirectionsService();
                     directionsDisplay = new google.maps.DirectionsRenderer()
                    directionsDisplay.setMap(map);

                   var start = new google.maps.LatLng(" . $row['Start_lan'] . ", " . $row['Start_lng'] . ");
                    var end = new google.maps.LatLng(" . $row['End_lan'] . ", " . $row['End_lng'] . ");
                    calcRoute(directionsDisplay,directionsService,start,end);
                    
        ";
        }
    }

    ?>

      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = "Bratislava, Slovensko";
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location,
              title: "JA SOM"
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }

function calcRoute(directionsDisplay,directionsService,start,end) {
   /* var start = new google.maps.LatLng(48.8819572, 19.8405443);
    var end = new google.maps.LatLng(48.8819572, 20.8405443);*/
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            directionsDisplay.setMap(map);
        } else {
            alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
        }
    });
}
</script>