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

    $("#edit-cep").blur(function() {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep != "") {
            var validatecep = /^[0-9]{8}$/;

            if(validatecep.test(cep)) {

                $("#edit-street").val("..");
                $("#edit-neighbourhood").val("...");
                $("#edit-city").val("...");
                $("#edit-uf").val("...");
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(data) {
                    if (!("erro" in data)) {
                        console.log(data);
                        $("#edit-street").val(data.logradouro);
                        $("#edit-neighbourhood").val(data.bairro);
                        $("#edit-city").val(data.localidade);
                        $("#edit-uf").val(data.uf);
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