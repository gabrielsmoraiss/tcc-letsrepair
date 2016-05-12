
//var findParticipant = require('./events/findParticipant.js');
var StartApplication = require('./events/StartApplication.js');
require('./events/openModal.js');
require('./events/deleteConfirmation.js');

//findParticipant.init();

StartApplication();
$(document).on('needs-application-restart', function(e) {
  StartApplication();
});



