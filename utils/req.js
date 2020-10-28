//PAGE: home
$('.delete-button').click(function(e) {

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

$('.pencil-icon').click(function(e) {
    let clientId = $(e.target).attr('data-id');
    window.location.href = `/pages/edit.php?id=${clientId}`
});

$('.address-icon').click(function(e) {
    let clientId = $(e.target).attr('data-id');
    window.location.href = `/pages/addresses.php?id=${clientId}`
});


// PAGE: edit.php
$('.submit-button').click(function(e) {
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
    console.log('teste');
    let clientId = $(e.target).attr('data-id');

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
                url: 'api/remove.php',
                async: true,
                data: {'id': clientId},
                success: function(response){
                    Swal.fire({

                        title: 'Sucesso!',
                        text: `O endereço foi deletado.`,
                        icon: 'success',
                        confirmButtonColor: '#2BBBAB',
                    }).then(() => {
                        window.location.reload();
                    })
                }
            });
        }
    });
});