<script src="{{ asset('assets/js/libs.min.js') }}" > </script>
<script src="{{ asset('assets/js/app.min.js') }}" > </script>

<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3eIgwMkqQtZuM7iVJi2is6EoktemIZ8E&signed_in=true&libraries=places&callback=initMap" async defer>
</script>

<script>

var map;
var service;
var infowindow;
var latlng;
var geocoder;
var circle;
var layer;
var radius = 40000;
var tipoLocal = 'Autorizada';
//var tableid = '1aPLJfYAPlL3L2KVVC-FyZaspqnpv4MWK-dYpgbPS';
var tableid = '1dJbVTrkNi8lSqIYVy_AOSnAU0vtpTlTwoXRsV8rQ';


function initMap() {
  latlng = new google.maps.LatLng(-20.642921,-47.225273); //minha casa
  //console.log(JSON.stringify(latlng));
  map = new google.maps.Map(document.getElementById('map'), {
    center: latlng,
    zoom: 8
  });

  infowindow = new google.maps.InfoWindow();
  service = new google.maps.places.PlacesService(map);
  geocoder = new google.maps.Geocoder;

}
//obtem localização do usuario e centraliza mapa nela
if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
	    //se achou o local e o navegador suporta
	    var pos = { lat: position.coords.latitude, lng: position.coords.longitude };
	    var $whenSearch = $('#whenSearch');
	    //Atribui localização encontrada ao input de onde pesquisar
	    geocoder.geocode({'location': pos}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          if (results[1]) {
          	$whenSearch.val(results[1].formatted_address);
          } else {
            console.log('Local não encontrado!');
          }
        } else {
          console.log('Geocoder failed due to: ' + status);
        }
      });

	    //centraliza mapa na posição encontrada
	    map.setCenter(pos);

	  }, function() {
	    // se não encontrou a localização de nois
	    console.log('Geolocation não autorizado ou com problemas');
	  });
	} else {
	  // Browser doesn't support Geolocation
	  console.log('Navegador não suporta Geolocation');
	}


// Buscar todas as Assistências Na posição encontrada do user
function getEverythingAroundMe() {
	if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
	    //se achou o local e o navegador suporta
	    var pos = {
	      lat: position.coords.latitude,
	      lng: position.coords.longitude
	    };
	   	//pesquisa todos os locais em volta..
	   	markPlacesFromTables(pos);

	  }, function() {
	    // se não encontrou a localização de nois
	    console.log('Geolocation não altorizado ou com problemas');
	  });
	} else {
	  // Browser doesn't support Geolocation
	  console.log('Navegador não suporta Geolocation');
	}

}

//Busca tudo ao redor
$('#js-everythingAroundMe').on('click', function() {
	getEverythingAroundMe();
});

//Filtro
$('#js-filtrar').on('click', function() {

  var address = $('#whenSearch').val();
	//var meters = $('#kmSearch').val();
	//var meters = $('#typeAssist').val();
	  
  geocoder.geocode( { 'address': address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {
	  	var pos = JSON.stringify(results[0].geometry.location);
	  	pos = JSON.parse(pos);

	  	//pesquisa os locais em volta..
	   	markPlacesFromTables(pos, 'Autorizada', 50000);

	  } else {
	    console.log("Geocode was not successful for the following reason: " + status);
	  }
	
	});
});
	
	//marca e centraliza o usuario com a posição dada.
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
  }

  function markPlacesFromTables(myLocation, tipoLocal = 'Autorizada', kmSearch = 50000) {
  	tipoLocal = 'notebook'
    //camada  do fusion table
    layer = new google.maps.FusionTablesLayer({
	    query: {
	      select: '\'Location\'',
	      from: tableid,
	      where: 'typeProducts like \'' + tipoLocal + '\' and ST_INTERSECTS(Location, CIRCLE(LATLNG('
	      	+ myLocation.lat + ',' + myLocation.lng + '), ' + kmSearch + '))'
	    }
	  });
	  layer.setMap(map);

    var circle = new google.maps.Circle({
      strokeColor: '#0000ff',
      strokeOpacity: 0.4,
      strokeWeight: 1,
      fillColor: '#0000ff',
      fillOpacity: 0.07,
      map: map,
      center: myLocation,	
      radius: kmSearch,
    });

    //marcar posição do user.
    tagMe(myLocation);

  }

  //pesquisa pelo Places API
  function placeSearch(myLocation) {

    //abrangencia das pesquisas e tamanho do circulo
    var radius = 50000; 

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

  } //fim pesquisa pelo places api
</script>


