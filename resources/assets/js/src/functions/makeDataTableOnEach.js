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
