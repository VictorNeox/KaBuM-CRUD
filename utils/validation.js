let addressFormOptions = {
    rules: {
        cep: {
            required: true,
            minlength: 8,
            maxlength: 8,
        },
        street: {
            required: true,
        },
        number: {
            required: true,
        },
        neighbourhood: {
            required: true,
        },
        city: {
            required: true,
        },
        uf: {
            required: true,
            minlength: 2,
            maxlength: 2,
        },
    },
    messages: {
        cep: {
            required: "Digite seu CEP",
        },
        street: {
            required: "Digite sua rua",
        },
        number: {
            required: "Digite seu numero",
        },
        neighbourhood: {
            required: "Digite seu bairro",
        },
        city: {
            required: "Digite sua cidade",
        },
        uf: {
            required: "Digite seu estado",
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
}

$("#address-form").validate({
    rules: addressFormOptions.rules,
    messages: addressFormOptions.messages,
    submitHandler: function(form) {
        let data = $("#address-form").serializeArray();
        let editBtnCheck = $('.address-submit-btn').attr('data-id') ? true : false;
        
        data.push({name: 'clientId', value: clientId}); 
        if(editBtnCheck) {
            data.push({name: 'addressId', value: $('.address-submit-btn').attr('data-id')});
        }

        $.ajax({
            type: 'POST',
            url: editBtnCheck ? '/api/address_edit.php' : '/api/address_add.php',
            async: true,
            data,
            success: function(response) {
                console.log(response);
                Swal.fire({
                    title: 'Sucesso!',
                    text: `Endereço ${editBtnCheck ? 'modificado' : 'inserido'}.`,
                    icon: 'success',
                    confirmButtonColor: '#2BBBAB',
                }).then(() => {
                    window.location.reload(true);
                })
            }
        })
    },
    errorElement : addressFormOptions.errorElement,
    errorPlacement: addressFormOptions.errorPlacement
});