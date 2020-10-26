$(document).ready(function(){
  $(".cpf").mask("999.999.999-99");
  $(".rg").mask("99.999.999-9");
  $(".cel").mask('99999-9999');

  $(".birth").each(function(index) {
    $(this).text(moment($(this).text()).format('D/MM/yyyy'));
  });
});
