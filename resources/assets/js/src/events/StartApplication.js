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

