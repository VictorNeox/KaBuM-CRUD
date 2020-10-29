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

$('.trash-icon').click(function(e) {

    let addressId = $(e.target).attr('data-id');

    let data = {
        clientId,
        addressId
    };

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

            $("#cep").val(response.zipcode);
            $("#street").val(response.street);
            $("#number").val(response.number);
            $("#neighbourhood").val(response.neighbourhood);
            $("#city").val(response.city);
            $("#uf").val(response.uf);
            $("#complement").val(response.complement);
            $(function() {
                M.updateTextFields();
            });

            $(".address-submit-btn").attr("data-id", addressId);
            
        }
    })
});


function addInfoModalMasks() {
    $("#modal-content").find('.cpf').mask("999.999.999-99");
    $("#modal-content").find('.rg').mask("99.999.999-9");
    $("#modal-content").find('.cel').mask('99999-9999');
    $("#modal-content").find('.birth').each(function(index) {
        $(this).text(moment($(this).text()).format('D/MM/yyyy'));
    });
}

$(".info-client").click(function(e) {
    let clientId = $(e.target).attr('data-id');

    let data = {
        clientId,
    };

    console.log(data);

    $.ajax({
        type: 'GET',
        url: '/api/client_info.php',
        async: true,
        data,
        dataType: "json",
        success: function(response) {

            console.log(response);
            $("#modal-content").find('.name').text(response.name);
            $("#modal-content").find('.cpf').text(response.cpf);
            $("#modal-content").find('.rg').text(response.rg);
            $("#modal-content").find('.birth').text(response.birth);
            $("#modal-content").find('.email').text(response.email);
            $("#modal-content").find('.cel1').text(response.telephone1);
            $("#modal-content").find('.cel2').text(response.telephone2);
            
            addInfoModalMasks();

            if(response.zipcode != null) {
                $("#modal-content").find('.street').text(response.street + ", ");
                $("#modal-content").find('.number').text(response.number);
                $("#modal-content").find('.neighbourhood').text(response.neighbourhood + " - ");
                $("#modal-content").find('.cep').text(response.zipcode);
                $("#modal-content").find('.complement').text(response.complement);
            }
            
        },
        error: function(response) {
            console.log(response);
        }
    });
});


$(".main-address").click(function(e) {
    e.preventDefault();

    let addressId = $(e.target).attr('data-id');

    let data = {
        clientId,
        addressId
    };

    console.log(clientId, addressId);

    Swal.fire({
        title: 'Tem certeza?',
        text: `Você está prestes a modificar seu endereço principal.`,
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
                url: '/api/address_main_update.php',
                async: true,
                data,
                success: function(response){
                    Swal.fire({
                        title: 'Sucesso!',
                        text: `O endereço principal foi alterado.`,
                        icon: 'success',
                        confirmButtonColor: '#2BBBAB',
                    }).then(() => {
                        window.location.reload(true);
                    });
                },
                error: function(response) {
                    alert(response);
                }
            });
        }
    });
});