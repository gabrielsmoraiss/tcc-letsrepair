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
