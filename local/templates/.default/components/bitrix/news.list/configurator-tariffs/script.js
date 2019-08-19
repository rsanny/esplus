$(function(){
    $('.js-ScrollRadio').on('click','a',function(e){
        e.preventDefault();
        var block = $(this).attr('href'),
            value = $(this).data('value');
        $('html,body').animate({
            scrollTop: $(block).offset().top
        });
        $('#radio-tariff label[data-value="'+value+'"]').trigger('click');
    });
});