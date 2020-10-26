$('.delete-button').click(function(e) {

    let result = confirm(`Tem certeza que deseja deletar/recuperar o ID ${$(e.target).attr('data-id')}?`);

    if(result) {
        $.ajax({
            type: 'POST',
            url: 'api/remove.php',
            async: true,
            data: {'id': $(e.target).attr('data-id')},
            success: function(response){
                let currentClass = !$(e.target).hasClass('active') ? 'active' : 'inactive';
                let newClass = $(e.target).hasClass('active') ? 'inactive' : 'active';
                $(e.target).toggleClass(currentClass, newClass);
    
                /*
                    Caso queira que a página dê reload adicionar
                    window.location.reload();
                */
            }
        });
    }

});