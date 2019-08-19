$(function(){    
    $('body').on('click','.js-CatalogView a',function(e){
        e.preventDefault();
        var _self = $(this),
            view = _self.data('view');
        $.ajax({
            url:OptimalGroup.AJAX_PATH+'store-session.php',
            data:{
                CODE:"CATALOG_VIEW",
                VALUE:view
            },
            success:function(data){
                $('.catalog-items')
                    .removeClass('catalog-view--table catalog-view--list catalog-view--grid')
                    .addClass('catalog-view--'+view);
                $('.js-CatalogView a.is-selected').removeClass('is-selected');
                _self.addClass('is-selected');
            }
        })
    });
});