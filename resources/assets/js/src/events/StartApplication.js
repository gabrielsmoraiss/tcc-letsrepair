//helpers
var dataTablesConfig = require('../helpers/dataTablesConfig.js');

//functions
var makeSelectizeOnEach = require('../functions/makeSelectizeOnEach.js');
var makeDataTableOnEach = require('../functions/makeDataTableOnEach.js');

//events

function StartApplication() {
  makeSelectizeOnEach();
  makeDataTableOnEach();

}

$.extend($.fn.dataTable.defaults, dataTablesConfig($('meta[name=locale]').prop('content')));

module.exports = StartApplication;

