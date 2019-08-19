$(function(){
    $('body').on('click','.js-ServiceText',function(e){
        e.preventDefault();
        $(this).toggleClass('is-selected');
        $('#service-text-1').toggleClass('is-selected');
    });
});