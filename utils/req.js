//PAGE: home
$('.delete-client').click(function(e) {

    let clientId = $(e.target).attr('data-id');
    let action = $(e.target).hasClass('active') ? 'inativar' : 'ativar';
    let msg = action == 'inativar' ? 'inativado' : 'ativado'
    
    Swal.fire({
        title: 'Tem certeza?',
        text: `Você está prestes a ${action} o ID ${clientId}!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2BBBAB',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: 'api/remove.php',
                async: true,
                data: {'id': clientId},
                success: function(response){
                    Swal.fire({

                        title: 'Sucesso!',
                        text: `O ID ${clientId} foi ${msg}.`,
                        icon: 'success',
                        confirmButtonColor: '#2BBBAB',
                    }).then(() => {
                        window.location.reload();
                    })
                }
            });
        }
    })
});

$('.edit-client').click(function(e) {
    let clientId = $(e.target).attr('data-id');
    window.location.href = `/pages/edit.php?id=${clientId}`
});

$('.address-client').click(function(e) {
    let clientId = $(e.target).attr('data-id');
    window.location.href = `/pages/addresses.php?id=${clientId}`
});


// PAGE: edit.php
$('.edit-submit').click(function(e) {
    e.preventDefault();

    let data = $('#form').serializeArray();
    data.push({name: 'id', value: clientId});

    Swal.fire({
        title: 'Tem certeza?',
        text: `Você está prestes a modificar o ID ${clientId}!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2BBBAB',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/api/edit.php',
                async: true,
                data,
                success: function(response){
                    Swal.fire({
                        title: 'Sucesso!',
                        text: `O ID ${clientId} foi modificado.`,
                        icon: 'success',
                        confirmButtonColor: '#2BBBAB',
                    }).then(() => {
                        window.location.href = '/index.php'
                    })
                }
            });
        }
    })
});

// PAGE: address
/*$(".address-submit-button").click(function(e) {
    e.preventDefault();

    let data = $("#address-form").serializeArray();
    data.push({name: 'clientId', value: clientId});
    
    $.ajax({
        type: 'POST',
        url: '/api/address_add.php',
        async: true,
        data,
        success: function(response) {

            alert(response);
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
});*/

$('.trash-icon').click(function(e) {

    let addressId = $(e.target).attr('data-id');

    let data = {
        clientId,
        addressId
    };

    console.log(data);

    Swal.fire({
        title: 'Tem certeza?',
        text: `Você está prestes a deletar o endereço selecionado!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2BBBAB',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/api/address_remove.php',
                async: true,
                data,
                success: function(response){
                    Swal.fire({

                        title: 'Sucesso!',
                        text: `O endereço foi deletado.`,
                        icon: 'success',
                        confirmButtonColor: '#2BBBAB',
                    }).then(() => {
                        window.location.reload();
                    });
                },
            });
        }
    });
});

$(".address-edit").click(function(e) {
    let addressId = $(e.target).attr('data-id');

    let data = {
        clientId,
        addressId
    };

    $.ajax({
        type: 'GET',
        url: '/api/address_edit.php',
        async: true,
        data,
        dataType: "json",
        success: function(response) {

            console.log(response);

            $("#address-edit-form").find("#cep").val(response.zipcode);
            $("#address-edit-form").find("#street").val(response.street);
            $("#address-edit-form").find("#number").val(response.number);
            $("#address-edit-form").find("#neighbourhood").val(response.neighbourhood);
            $("#address-edit-form").find("#city").val(response.city);
            $("#address-edit-form").find("#uf").val(response.uf);
            $("#address-edit-form").find("#complement").val(response.complement);
            $(function() {
                M.updateTextFields();
            });
        }
    })
});