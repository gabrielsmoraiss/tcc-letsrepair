<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', '')">
    <meta name="keywords" content="@yield('keywords' , '')">
    <meta name="author" content="Gabriel Silva de Morais">
    <meta name="ROBOTS" content="INDEX,FOLLOW">
    <title>Let's Repair | @yield('title', 'Lets Repair')</title>
    @include('layouts.css')

</head>

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

  infowindow = new google.maps.InfoWindow();
  service = new google.maps.places.PlacesService(map);

  //var infoWindow = new google.maps.InfoWindow({map: map});
  service = new google.maps.places.PlacesService(map);
  geocoder = new google.maps.Geocoder;

}

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
    //console.log(myLocation);

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
    var radius = 2000; 

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
   // keyword: 'store'
      location: myLocation,
      radius: radius,
      types: ['establishment', 'food'],
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
<body>
{{--dd(!Request::is('index'))--}}
@if($current_user)
    @include('layouts.navbar')
@endif
{{--dd('nou')--}}
@yield('content')

@include('layouts.js')
</body>

</html>