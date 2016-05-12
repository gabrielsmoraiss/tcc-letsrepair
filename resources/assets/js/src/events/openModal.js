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
