$('.delete-button').click(function(e) {

    let clientId = $(e.target).attr('data-id');
    let action = $(e.target).hasClass('active') ? 'inativar' : 'ativar';
    let msg = action == 'inativar' ? 'inativado' : 'ativado'

    Swal.fire({
        title: 'Tem certeza?',
        text: `Você está prestes à ${action} o ID ${clientId}!`,
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
                data: {'id': $(e.target).attr('data-id')},
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

$('.submit-button').click(function(e) {
    e.preventDefault();

    let data = $('#form').serializeArray();
    data.push({name: 'id', value: clientId});

    Swal.fire({
        title: 'Tem certeza?',
        text: `Você está prestes à modificar o ID ${clientId}!`,
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