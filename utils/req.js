$('.delete-button').click(function(e) {

    let clientId = $(e.target).attr('data-id');
    let action = $(e.target).hasClass('active') ? 'inativar' : 'ativar';
    let result = confirm(`Tem certeza que deseja ${action} o ID ${clientId}?`);

    if(result) {
        $.ajax({
            type: 'POST',
            url: 'api/remove.php',
            async: true,
            data: {'id': $(e.target).attr('data-id')},
            success: function(response){
                /*let currentClass = !$(e.target).hasClass('active') ? 'active' : 'inactive';
                let newClass = $(e.target).hasClass('active') ? 'inactive' : 'active';
                $(e.target).toggleClass(currentClass, newClass);*/
                window.location.reload();
            }
        });
    }
});

$('.pencil-icon').click(function(e) {

    let clientId = $(e.target).attr('data-id');
    let result = confirm(`Tem certeza que deseja editar o ID ${clientId}`);

    if(result) {
        window.location.href = `/pages/edit.php?id=${clientId}`
    }
});

$('.submit-button').click(function(e) {
    e.preventDefault();

    let data = $('#form').serializeArray();
    data.push({name: 'id', value: clientId});

    $.ajax({
        type: 'POST',
        url: '../api/edit.php',
        async: true,
        data,
        success: function(response) {
            window.location.href = '/index.php'
        }
    })
    
});