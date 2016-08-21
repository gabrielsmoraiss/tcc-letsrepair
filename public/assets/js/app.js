(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){

//var findParticipant = require('./events/findParticipant.js');
var StartApplication = require('./events/StartApplication.js');
require('./events/openModal.js');
require('./events/deleteConfirmation.js');

//findParticipant.init();
StartApplication();
$(document).on('needs-application-restart', function(e) {
  StartApplication();
});

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -33.866, lng: 151.196},
    zoom: 15
  });
  var infowindow = new google.maps.InfoWindow();
  var service = new google.maps.places.PlacesService(map);

  service.getDetails({
    placeId: 'ChIJN1t_tDeuEmsRUsoyG83frY4'
  }, function(place, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
      });
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(place.name);
        infowindow.open(map, this);
        console.log(place);
      });
    }
  });
}




},{"./events/StartApplication.js":2,"./events/deleteConfirmation.js":3,"./events/openModal.js":4}],2:[function(require,module,exports){
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
}

$.extend($.fn.dataTable.defaults, dataTablesConfig($('meta[name=locale]').prop('content')));

module.exports = StartApplication;


},{"../functions/makeDataTableOnEach.js":5,"../functions/makeSelectizeOnEach.js":6,"../helpers/dataTablesConfig.js":7}],3:[function(require,module,exports){
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

},{}],6:[function(require,module,exports){
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
        console.log('Selectize added on: #' + el.id);
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

},{}],7:[function(require,module,exports){
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
