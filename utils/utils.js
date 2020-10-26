$(document).ready(function(){
  $(".cpf").mask("999.999.999-99");
  $(".rg").mask("99.999.999-9");
  $(".cel").mask('99999-9999');

  $(".birth").each(function(index) {
    $(this).text(moment($(this).text()).format('D/MM/yyyy'));
  });

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

});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems);
});
