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
