$("#address-form").validate({
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
    submitHandler: function(form) {
        let data = $("#address-form").serializeArray();
        data.push({name: 'clientId', value: clientId});
        
        $.ajax({
            type: 'POST',
            url: '/api/address_add.php',
            async: true,
            data,
            success: function(response) {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Endereço inserido.',
                    icon: 'success',
                    confirmButtonColor: '#2BBBAB',
                }).then(() => {
                    window.location.reload();
                })
            }
        })
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
});