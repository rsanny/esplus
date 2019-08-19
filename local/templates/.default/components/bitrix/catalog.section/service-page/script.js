$(function(){
    if ($('.service-total').length){
        OptimalGroup.FixServiceTotal;
        $(window).on('scroll', OptimalGroup.FixServiceTotal);
        $('.services-page').on('resize', OptimalGroup.FixServiceTotal);
        $(window).bind('slideToggleEnd', OptimalGroup.FixServiceTotal);
    }
    if($('.js-ScrolToHere').length){
        var OffestTop = $('.js-ScrolToHere').offset().top-20;
        $('body,html').animate({scrollTop:OffestTop})
    }
    $('body').on('change','.js-ServiceInput', OptimalGroup.Service.Section);
    $('body').on('click','.js-ServiceBuy',function(e){
        e.preventDefault();
        var location = $(this).data('location'),
            data = {};
        
        data.service = OptimalGroup.Service.InBasket;
        data.action = "ADD2BASKET";
        data.type = "SERVICE";
        
        $.ajax({
			url: OptimalGroup.AJAX_PATH+'basket.action.service.php',
			dataType:"json",
			data:data,
			success: function(data){
				$('.js-BasketHeader').html(data.basket);
                if (location)
                    window.location = location;
			}
		});	
    });
});
OptimalGroup.Service = {
    InBasket: {},
    Format: function(price){
        if (price == 0)
            return "";
        else
            return OptimalGroup.number_format(price,0,' ','.')+" руб.";
    },
    SectionItem: '.js-SectionItem',
    SectionItemPrice: '.js-SectionPrice',
    Section:function(){
        var BasketPrice = 0;
        $('.js-SectionItem').each(function(){
            var total = 0,
                SectionPrice = $(this).find(OptimalGroup.Service.SectionItemPrice);
            $(this).find('.js-ServiceInput').each(function(){
                var quantity = parseInt($(this).val()),
                    id = $(this).data('id'),
                    price = $(this).data('price');
                if (quantity > 0){
                    var moutnPrice = quantity * price;
                    $(this).data('quantity', quantity);
                    $(this).closest('.item__content--service').find('.service-input--price').text(OptimalGroup.Service.Format(moutnPrice));
                    total += moutnPrice;
                    OptimalGroup.Service.InBasket[id] = $(this).data();
                }
                else {
                    $(this).closest('.item__content--service').find('.service-input--price').text(" ");
                    $(this).val(0);
                    $(this).data('quantity',0);
                    delete OptimalGroup.Service.InBasket[id];
                }
            });
            SectionPrice.data('price', total);
            SectionPrice.text(OptimalGroup.Service.Format(total));
            BasketPrice += SectionPrice.data('price');
        });
        $('.js-ServiceTotal').data('price',BasketPrice);
        $('.js-ServiceTotal').html(OptimalGroup.Service.Format(BasketPrice));
        
        if (BasketPrice > 0)
            $('.service-total').removeClass("none");
        else 
            $('.service-total').addClass("none");            
        
    },
}
OptimalGroup.FixServiceTotal = function(e){
    var Container = $('.services-page'),
        ConteinerTop = Container.offset().top,
        ConteinerBottom = Container.outerHeight() + ConteinerTop,
        ServiceTotal = $('.service-total'),
        ServiceTotalHeight = ServiceTotal.outerHeight(),
        window = $(this),
        windowScrollTop = window.scrollTop(),
        windowScrollBottom = windowScrollTop + window.height();
    if (windowScrollTop <= ConteinerTop || ConteinerBottom > windowScrollBottom){
        var top = windowScrollBottom - ConteinerTop - ServiceTotalHeight;
        if (top < 0 ) top = 0;
        if (top > Container.outerHeight()-ServiceTotalHeight) top = Container.outerHeight()-ServiceTotalHeight;
    }
    else {
        top = Container.outerHeight()-ServiceTotalHeight
    }
    $('.service-total').css('top', top);
};