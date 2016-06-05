<script src="{{ asset('assets/js/libs.min.js') }}" > </script>
<script src="{{ asset('assets/js/app.min.js') }}" > </script>

<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3eIgwMkqQtZuM7iVJi2is6EoktemIZ8E&signed_in=true&libraries=places&callback=initMap" async defer>
</script>

<script>

var pos;
var map;
var service;
var infowindow;
var latlng;
var geocoder;
function initMap() {
  var latlng = new google.maps.LatLng(-20.642921,-47.225273); //minha casa

  map = new google.maps.Map(document.getElementById('map'), {
    center: latlng,
    zoom: 14
  });

  var layer = new google.maps.FusionTablesLayer({
    query: {
      select: '\'Location\'',
      from: '1BT8PWnY-JBSphaDJ2cTW8W6702xoDXEkS4_C0DC1'
    }
  });
  layer.setMap(map);

  infowindow = new google.maps.InfoWindow();
  service = new google.maps.places.PlacesService(map);

  //var infoWindow = new google.maps.InfoWindow({map: map});
  service = new google.maps.places.PlacesService(map);
  geocoder = new google.maps.Geocoder;

}
  //Filtro
  
$('#js-filtrar').on('click', function() {
  var address = $('#myLocation').val();
  geocoder.geocode( { 'address': address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {

	    tagMe(results[0].geometry.location);
	  } else {
	    console.log("Geocode was not successful for the following reason: " + status);
	  }
	});
});


  // Obter minha localização
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      //se achou o local e o navegador suporta
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      
      geocoder.geocode({'location': pos}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          if (results[1]) {

           console.log(results[1].formatted_address);
          } else {
            window.alert('No results found');
          }
        } else {
          window.alert('Geocoder failed due to: ' + status);
        }
      });
      

      tagMe(pos);

    }, function() {
      // se não encontrou a localização de nois
      console.log('Geolocation não altorizado ou com problemas');
    });
  } else {
    // Browser doesn't support Geolocation
    console.log('Navegador não suporta Geolocation');
  }

  function tagMe(myLocation) {

    map.setCenter(myLocation);

    var image = 'https://cdn4.iconfinder.com/data/icons/map1/502/Untitled-11-48.png';
    var markerMyLocation = new google.maps.Marker({
        map: map,
        position: myLocation,
        title: 'Minha Localização',
        icon: image,
    });

    google.maps.event.addListener(markerMyLocation, 'click', function() {
      infowindow.setContent('Minha Localização');
      console.log(this);
      infowindow.open(map, this);
    });

    placeSearch(myLocation);
    
  }

  function placeSearch(myLocation) {

    //abrangencia das pesquisas e tamanho do circulo
    var radius = 10000; 

    var scopeCircle = new google.maps.Circle({
      strokeColor: '#0000ff',
      strokeOpacity: 0.4,
      strokeWeight: 1,
      fillColor: '#0000ff',
      fillOpacity: 0.07,
      map: map,
      center: myLocation,
      radius: radius,
    });

    var options = {
    //bounds: map.getBounds(),
      keyword: 'Assistência Técnica',
      location: myLocation,
      radius: radius,
      types: ['establishment', 'electronics_store'],
  };
    //service.nearbySearch(options, callback); // locais proximos
    service.radarSearch(options, callback);
  }

  function callback(results, status) {
    if (status !== google.maps.places.PlacesServiceStatus.OK) {
      console.error(status);
      return;
    }
    for (var i = 0, result; result = results[i]; i++) {
      addMarker(result);
    }
  }

  function addMarker(place) {
  var marker = new google.maps.Marker({
    map: map,
    position: place.geometry.location,
    icon: {
      url: 'https://cdn2.iconfinder.com/data/icons/snipicons/500/map-marker-48.png',
      scaledSize: new google.maps.Size(25, 25)
    }
  });

  google.maps.event.addListener(marker, 'click', function() {
    service.getDetails(place, function(result, status) {
      if (status !== google.maps.places.PlacesServiceStatus.OK) {
        console.error(status);
        return;
      }
      console.log(result.types);
      var tipos = result.types;
      infowindow.setContent('Nome: ' + result.name + ' Tipo: ' + tipos.join(" , "));
      infowindow.open(map, marker);
      console.log(result);
    });
  });
}

</script>


