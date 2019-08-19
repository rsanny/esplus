$(function(){
    $('body').on('click','.js-ShowEsplusForm',function(e){
        e.preventDefault();
        $('#lk-auth-esplus').slideDown();
        $('#bx-auth').slideUp();
        $(this).remove();
    });
    $('body').on('submit','#AuthESplusForm', function(e){
        e.preventDefault();
        var form = $(this);
        
        $('#lk-auth-esplus').find('.bg-message').remove();
        
        $.ajax({
            url: OptimalGroup.AJAX_PATH + 'auth.php',
            dataType: 'json',
            data: form.serialize(),
            success: function(data){
                if(!!data.ERROR)
                {
                    $('#lk-auth-esplus').prepend('<div class="bg-danger bg-message mb-20">'+data.ERROR_MESSAGE+'</div>');
                }
                else
                {
                    location.reload();
                }
            }
        });
    });
});