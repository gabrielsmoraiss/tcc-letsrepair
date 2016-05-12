var common = {
  responsive: true,
  order: []
};

var configs = {
  "en-US" : {
    language: {
      "sEmptyTable": "No records found",
      "sInfo": "Showing from _START_ to _END_ of _TOTAL_ records",
      "sInfoEmpty": "Showing from 0 to 0 of 0 records",
      "sInfoFiltered": "(Filtered of _MAX_ records)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "Show _MENU_ results",
      "sLoadingRecords": "Loading...",
      "sProcessing": "Processing...",
      "sZeroRecords": "No records found",
      "sSearch": "Search: ",
      "oPaginate": {
        "sNext": "Next",
        "sPrevious": "Previous",
        "sFirst": "First",
        "sLast": "Last"
      },
      "oAria": {
        "sSortAscending": ": Sort columns ascending",
        "sSortDescending": ": Sort columns descending"
      }
    }
  },
  "pt-BR": {
    language: {
      "sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "Mostrar _MENU_ resultados",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar: ",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  }
};



module.exports = function(locale) {
  return $.extend(common, configs[locale] || configs['en-US']);
}