$(document).ready(function() {

    
    $("#cep").blur(function() {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep != "") {
            var validatecep = /^[0-9]{8}$/;

            if(validatecep.test(cep)) {

                $("#street").val("..");
                $("#neighbourhood").val("...");
                $("#city").val("...");
                $("#uf").val("...");
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(data) {
                    if (!("erro" in data)) {
                        console.log(data);
                        $("#street").val(data.logradouro);
                        $("#neighbourhood").val(data.bairro);
                        $("#city").val(data.localidade);
                        $("#uf").val(data.uf);
                        $(function() {
                            M.updateTextFields();
                        });
                    }
                    else {
                        cleanForm();
                        alert("CEP não encontrado.");
                    }
                });
            } 
            else {
                cleanForm();
                alert("Formato de CEP inválido.");
            }
        }
        else {
            cleanForm();
        }
    });
});