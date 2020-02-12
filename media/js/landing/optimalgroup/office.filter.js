$(function(){
    $('.js-autocomplete').autocomplete({
        serviceUrl:OptimalGroup.AJAX_PATH + "office-list.php",
        params: {
            method: 'city'
        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'Не найдено городов',
        onHide:function(){
            $(this).removeClass('is-visible--autocomplete');        
        },
        onSearchComplete:function(){
            $(this).addClass('is-visible--autocomplete');
        },
        onSelect: function (suggestion) {
        }
    });
    $('body').on('change','.js-OfficeFilter input[type="radio"],.js-OfficeFilter input[type="checkbox"]',function(){
        $(this).closest('.js-OfficeFilter').trigger('submit');
    });
});