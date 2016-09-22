(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
//functions
var Mapa = require('./functions/Mapa.js');

//Events
var StartApplication = require('./events/StartApplication.js');
require('./events/openModal.js');
require('./events/deleteConfirmation.js');

$.material.init();

Mapa.init();

StartApplication();
$(document).on('needs-application-restart', function(e) {
  StartApplication();
});

},{"./events/StartApplication.js":2,"./events/deleteConfirmation.js":3,"./events/openModal.js":4,"./functions/Mapa.js":5}],2:[function(require,module,exports){
//helpers
var dataTablesConfig = require('../helpers/dataTablesConfig.js');

//functions
var makeSelectizeOnEach = require('../functions/makeSelectizeOnEach.js');
var makeDataTableOnEach = require('../functions/makeDataTableOnEach.js');

//events

function StartApplication() {
  makeSelectizeOnEach();
  makeDataTableOnEach();

  	//Função para deletar assistencia após aprovala e inseri-la no fusion tables
	$('[data-aprove-delete]').one("click", function(e) {
		var target = e.target;
	  	//e.preventDefault();
	  	//e.stopPropagation();
	  	var form = $(target).closest('form');

		var url = $(target).data('aprove-delete');
		
	  	$.ajax({
	      	url: url,
	      	data: form.serialize(),
	      	method: "DELETE",
	      	success: function(data) {
	      		console.log('foi');
	      	}
    	});

	});

 	$('#hoursStart').timepicki();
 	$('#hoursEnd').timepicki();
}

$.extend($.fn.dataTable.defaults, dataTablesConfig($('meta[name=locale]').prop('content')));

module.exports = StartApplication;


},{"../functions/makeDataTableOnEach.js":6,"../functions/makeSelectizeOnEach.js":7,"../helpers/dataTablesConfig.js":8}],3:[function(require,module,exports){
//funcção para exibir modal de deletar
$(document).on("click", "button[data-id]", function(e) {
  e.preventDefault();
  e.stopPropagation();
  var $button = $(e.target);
  $button = $button[0].localName === 'button' ? $button : $button.closest('button[data-id]');

  var submitForm = function() {

    var form = 'form[data-id=' + $button.data('id') + ']';
    var $form = $button.closest(form);
    $form.submit();
  };

  $('#modal-delete')
    .find('.btn-delete')
    .one("click", submitForm);

  $('#modal-delete').modal('show');
});

},{}],4:[function(require,module,exports){
//função para abrir modal
$(document).on("click", "a[data-modal-open]", function(e) {
  var target = e.target;
  var button = target.tagName.toLowerCase() == 'a' ? $(target) : $(target).closest('a');

  e.preventDefault();
  e.stopPropagation();

  $(button.data('target') + ' .modal-dialog').load(button.data('href'), function() {
    $(button.data('target')).modal('show');
    $(document).trigger('needs-application-restart');
  });

});

},{}],5:[function(require,module,exports){
exports.init = function() {
  
//var map;
//var infowindow;
//var latlng;
//var geocoder;
//var circle;
//var layer;
//var rendererOptions;
//var directionsDisplay;
//var directionsService;
//var markerMyLocation;
var tableId = '1aPLJfYAPlL3L2KVVC-FyZaspqnpv4MWK-dYpgbPS';


window.initMap = function() {
  latlng = new google.maps.LatLng(-20.642921,-47.225273); //minha casa
  //console.log(JSON.stringify(latlng));
  map = new google.maps.Map(document.getElementById('map'), {
    center: latlng,
    zoom: 9
  });
  
  //directionsDisplay.setMap(map);

}
//obtem localização do usuario e centraliza mapa nela
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      //se achou o local e o navegador suporta
      var pos = { lat: position.coords.latitude, lng: position.coords.longitude };
      var $address = $('#address');
      //Atribui localização encontrada ao input de onde pesquisar
      geocoder = new google.maps.Geocoder;
      geocoder.geocode({'location': pos}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          if (results[1]) {
            $address.val(results[1].formatted_address);
            //console.log(results[1], results[1].address_components);
            getEverythingAroundMe();
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

      //limpa tudo os trem antes de marcar os locais
      clearMap();

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

var $form = $("#form-busca");
$form.submit(function(e) {
  e.preventDefault();

  var address = $('#address').val();
  var radius = $('#radius').val() * 1000;
  var category = $('#category').val();
  var typeProduct = $('#typeProduct').val();
  var brandsAttended = $('#brandsAttended').val();
  geocoder = new google.maps.Geocoder;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      var pos = JSON.stringify(results[0].geometry.location);
      pos = JSON.parse(pos);

      clearMap();
      //pesquisa os locais em volta..
      markPlacesFromTables(pos, category, typeProduct, brandsAttended, parseInt(radius));

    } else {
      console.log("Geocode was not successful for the following reason: " + status);
    }
  
  });
});

//limpa todos os trem do mapa
function clearMap() {
  if(typeof circle != "undefined") { 
    circle.setMap(null);
  }
  console.log(typeof layer);
  if(typeof layer != "undefined") { 
    layer.setMap(null);
  }
  if(typeof markerMyLocation != "undefined") {  
    markerMyLocation.setMap(null);
  }

  if(typeof directionsDisplay != "undefined") {
    directionsDisplay.setMap(null);
  }
}

  //marca e centraliza o usuario com a posição dada.
  function tagMe(myLocation) {

    map.setCenter(myLocation);
    map.setZoom(11);
    //fazer if para descobrir melhor zoom dependendo da area de cobertura

    var image = 'https://cdn4.iconfinder.com/data/icons/map1/502/Untitled-11-48.png';
    markerMyLocation = new google.maps.Marker({
        map: map,
        position: myLocation,
        title: 'Minha Localização',
        icon: image,
    });

    google.maps.event.addListener(markerMyLocation, 'click', function() {
      infowindow = new google.maps.InfoWindow();
      infowindow.setContent('Minha Localização');
      console.log(this);
      infowindow.open(map, this);
    });  
  }

  function markPlacesFromTables(
      myLocation,
      category = null,
      typeProduct = null,
      brandsAttended = null,
      radius = 50000
    )
  {
    var searchCategory = category ? 'category like \'' + category + '\' and ' : '';
    var searchTypeProduct = typeProduct ? 'typeProduct like \'%' + typeProduct + '%\' and ' : '';
    var searchBrandsAttended = brandsAttended ? 'brandsAttended like \'%' + brandsAttended + '%\' and ' : '';
    //console.log(searchCategory, searchTypeProduct, searchBrandsAttended);

    //Cria o circulo azul mostrando a abrangencia da pesquisa
    circle = new google.maps.Circle({
      strokeColor: '#0000ff',
      strokeOpacity: 0.4,
      strokeWeight: 1,
      fillColor: '#0000ff',
      fillOpacity: 0.07,
      map: map,
      center: myLocation, 
      radius: radius
    });

    //camada  do fusion table
    layer = new google.maps.FusionTablesLayer({
      query: {
        select: '\'Location\'',
        from: tableId,
        where:
          searchCategory +
          searchTypeProduct +
          searchBrandsAttended +
          ' ST_INTERSECTS(Location, CIRCLE(LATLNG('+
            myLocation.lat + ',' + myLocation.lng + '), ' + radius +
          '))'          
      },
      styles: [{
          where: 'category like \'AUTORIZADA\'',
          markerOptions: {
            iconName: "ylw_stars",
            zIndex:100
          }
        }, {
          where: 'category like \'ESPECIALIZADA\'',
          markerOptions: {
            iconName: "wht_blank",
            zIndex:99
          }
        }
      ],
      //suppressInfoWindows: true,
      map: map
    });

    google.maps.event.addListener(circle, 'mouseover', function(e) {
      circle.setVisible(false);
    });

    google.maps.event.addListener(map, 'mouseout', function(e) {

      circle.setVisible(true);
      //circle.setMap(map);
    });

    google.maps.event.addListener(layer, 'click', function(e) {

      var end = e.row['Location'].value;

      // Change the content of the InfoWindow
      e.infoWindowHtml = "<strong>Nome: </strong>" + e.row['name'].value + "<br>";
      e.infoWindowHtml += "<strong>Endereço: </strong>" + e.row['Location'].value + "<br>";
      e.infoWindowHtml += "<strong>Telefone: </strong>" + e.row['fone'].value + "<br>";
      //e.infoWindowHtml += "Horario de funcionamento:" + e.row['BusinessHoursDate'].value + "<br>";

      e.infoWindowHtml += '<a onclick="calcRoute( &apos;'
        + end
        + '&apos;)" id="makeRoute" class="btn btn-success btn-sm" title="Traçar rota">Como chegar</a>';

     /*
      e.infoWindowHtml = e.row['Store Name'].value + "<br>";
      // If the delivery == yes, add content to the window
      if (e.row['delivery'].value == 'yes') {
        e.infoWindowHtml += "Delivers!";
      }*/
    });
      
    //marcar posição do user.
    tagMe(myLocation);

  }

  window.calcRoute = function(end) {
    rendererOptions = {
      //draggable: true
    };
    directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
    directionsService = new google.maps.DirectionsService();

    directionsDisplay.setMap(map);
    var enderecoPartida = markerMyLocation.getPosition();
    //var enderecoPartida = $('#address').val();
    var enderecoChegada = end;

    var request = {
      origin: enderecoPartida,
      destination: enderecoChegada,
      travelMode: google.maps.TravelMode.DRIVING,
      provideRouteAlternatives: true // ativar rotas alternativas
    };

    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      }
    });
  }
/*
  //pesquisa pelo Places API
  function placeSearch(myLocation) {
    service = new google.maps.places.PlacesService(map);
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
      radius: radius
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
          service = new google.maps.places.PlacesService(map);
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
*/

}

},{}],6:[function(require,module,exports){
function makeDataTableOnEach() {
  var dataTableSelector = $('.data-table');
  if (dataTableSelector.length) {
    dataTableSelector.each(function(n, el) {
      var options = {};
      if (!el.classList.contains('dataTable')) {
        if (el.dataset.checkboxTable == 'true') {
          options = {
            columnDefs: [{
              "targets": 0,
              "orderable": false
            }],
          };
        }
        //console.log('DataTables added on: #' + el.id);
        $(el).DataTable(options);
      }
    });
  }
}
module.exports = makeDataTableOnEach;

},{}],7:[function(require,module,exports){
function makeSelectizeOnEach() {
  var selectizeSelector = $('[data-selectize]');
  var options = {
    maxItems: 1,
    plugins: ['remove_button', 'restore_on_backspace'],
    persist: false,
  };
  if (selectizeSelector.length) {
    selectizeSelector.each(function(n, el) {

      if (!el.selectize) {
        if(el.multiple) {
          options.maxItems = 99;

          Object.assign(options, {
            delimiter: ',,',
            create: function(input) {
              return {
                value: input,
                text: input
              }
            }
          });

        }
        $(el).selectize(options);
      }
    });
  }
}

module.exports = makeSelectizeOnEach;

},{}],8:[function(require,module,exports){
var common = {
  responsive: true,
  order: []
};

var configs = {
  "en-US" : {
    language: {
      "sEmptyTable": "No records found",
      "sInfo": "Showing from _START_ to _END_ of _TOTAL_ records",
      "sInfoEmpty": "Showing from 0 to 0 of 0 records",
      "sInfoFiltered": "(Filtered of _MAX_ records)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "Show _MENU_ results",
      "sLoadingRecords": "Loading...",
      "sProcessing": "Processing...",
      "sZeroRecords": "No records found",
      "sSearch": "Search: ",
      "oPaginate": {
        "sNext": "Next",
        "sPrevious": "Previous",
        "sFirst": "First",
        "sLast": "Last"
      },
      "oAria": {
        "sSortAscending": ": Sort columns ascending",
        "sSortDescending": ": Sort columns descending"
      }
    }
  },
  "pt-BR": {
    language: {
      "sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "Mostrar _MENU_ resultados",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar: ",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  }
};



module.exports = function(locale) {
  return $.extend(common, configs[locale] || configs['en-US']);
}
},{}]},{},[1]);
