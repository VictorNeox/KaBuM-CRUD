$('.delete-button').click(function(e) {
    $.ajax({
        type: 'POST',
        data: {'id': $(e.target).attr('data-id')},
        success: function(response){
            document.location.reload();
        }
    });
});
