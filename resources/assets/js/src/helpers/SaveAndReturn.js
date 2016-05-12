/**
 * função para botão submit com tag [data-back=true] Botão salvar e continuar adicionando ...
 */
 exports.init = function() {
  var $forms = $('form');
  var $buttons = $forms.find('button[data-back=true]');

  if ($buttons.length) {
    $buttons.on('click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      var $button = $(event.currentTarget);
      var $form = $button.closest('form');

      $form.append('<input type="hidden" value="1" name="back">');
      $form.submit();
    });
  }
}
