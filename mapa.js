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