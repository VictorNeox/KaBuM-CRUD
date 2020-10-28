$(document).ready(function(){
  
  
  // MASKS
  $(".cpf").mask("999.999.999-99");
  $(".rg").mask("99.999.999-9");
  $(".cel").mask('99999-9999');

  $(".birth").each(function(index) {
    $(this).text(moment($(this).text()).format('D/MM/yyyy'));
  });

  //Filter
  $("#filter").change(function() {
    
    let filter = $("#filter");
    let input = $("#search");
    
    console.log(filter.val())

    if(filter.val() === 'cpf' || filter.val() === 'rg') {
      input.attr('minlength', '5');
    } else {
      input.attr('minlength', '3');
    }

  });

  // TOOLTIP
  tippy('.pencil-icon', {
    content: "Editar",
  });

  tippy('.active', {
    content: 'Inativar',
  });

  tippy('.inactive', {
    content: 'Ativar',
  });

  tippy('.address-icon', {
    content: 'Endereços',
  });

});

function cleanForm() {
  // Limpa valores do formulário de cep.
  $("#street").val("");
  $("#neighbourhood").val("");
  $("#city").val("");
  $("#uf").val("");
}

// SELECT BOX
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems);
});

// DATEPICKER
let months = [ 
  'Janeiro', 
  'Fevereiro', 
  'Marco', 
  'Abril', 
  'Maio', 
  'Junho', 
  'Julho', 
  'Agosto', 
  'Setembro', 
  'Outubro', 
  'Novembro', 
  'Dezembro' 
];

let weekdays = [ 
  'Domingo', 
  'Segunda-Feira', 
  'Terca-Feira', 
  'Quarta-Feira', 
  'Quinta-Feira', 
  'Sexta-Feira', 
  'Sabado' 
];

let date = new Date();

let options = {
  i18n: {
      months,
      monthsShort: [ 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez' ],
      weekdays,
      weekdaysShort: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
      weekdaysLetter: [ 'D', 'S', 'T', 'Q', 'Q', 'S', 'S' ],
  },
  selectMonths: true,
  selectYears: true,
  clear: false,
  format: 'yyyy-mm-dd',
  today: "today",
  close: "X",
  closeOnSelect: true
}

document.addEventListener('DOMContentLoaded', function() {
  let elems = document.querySelectorAll('.datepicker');
  let instances = M.Datepicker.init(elems, options);
});


// MODAL
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.modal');
  var instances = M.Modal.init(elems, {
    onCloseStart: () => {
      $("#cep").val('');
      $("#number").val('');
      $("#complement").val('');
      cleanForm();
      $(function() {
        M.updateTextFields();
      });
    },
    onCloseEnd: () => {
      $(".address-submit-btn").removeAttr('data-id');
    }
  });
});