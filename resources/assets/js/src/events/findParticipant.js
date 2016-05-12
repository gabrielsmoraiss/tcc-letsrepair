var laroute = require('../../laroute.js');

exports.init = function() {
  var $participant = $('#add-participante-modal')
  if ($participant.length) {
    var $participant = $('#idUsuarioParticipante');
    $participant.selectize({
      plugins: ['remove_button'],
      valueField: 'id',
      labelField: 'nome',
      searchField: ['nome', 'cidade'],
      placeholder: 'Digite o nome ou cidade...',
      options: [],
      create: false,
      load: function(query, callback) {
        if (!query.length) return callback();
        var url = laroute.route('usuarios.index', {
          query: query
        });
        $.get(url, function(data) {
          callback(data);
        });
      }
    });

    //Atribuir text da option selecionada ao input NomeCracha
    $participant.on('change', function() {
      $('#nomeCracha').attr('value', $(this).text());
    });
  }
}
