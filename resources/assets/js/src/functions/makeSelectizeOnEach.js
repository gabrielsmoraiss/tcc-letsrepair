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
