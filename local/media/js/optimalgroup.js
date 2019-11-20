var OptimalGroup = {
    AJAX_PATH: '/local/include/ajax/',
    INCLUDE_PATH: '/local/include/',
    MEDIA_PATH: '/local/media/',
    isMobile: function(){
        return /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    },
    ajaxReloadFunction: function(){
        $('.js-InputMask[data-type="email"]').inputmask({
            clearMaskOnLostFocus: true,
            showMaskOnHover: false,
        });

        $('.js-InputMask:not([data-type="email"])').each(function () {
            var options = $(this).attr('data-inputmask');
            //options = options.replace(/'/g, '"');
            //options = JSON.parse("{" + options + "}");

            var mask = new IMask($(this)[0], {
                mask: "+{7} 000 000 00 00",
                lazy: false,
                placeholderChar: options && options.placeholder ? options.placeholder : 'X'
            });

        });

        $('.js-select select').chosen({"width":"100%", disable_search: true});
        $('body').on('ready keyup', '.like-input', OptimalGroup.textAdjust);
    },
    dataLayer: function(data, method, event, action){
        var ecommerce = {
            "currencyCode": "RUB"
        };
        ecommerce[method] = {                    
            "products": [
                {
                    "id": data.id,
                    "name" : data.name,
                    "price": data.price,
                    "brand": data.brand,
                    "category": data.category,
                    "quantity": data.quantity
                }
            ]            
                
        };
        dataLayer.push({
            "event": event,
            "ecommerce": ecommerce,
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': action,
        });
    },
    textAdjust: function (o) {
        var e = this;
        e.style.height = "50px";
        setTimeout(function() {
            e.style.height = (e.scrollHeight)+"px";
        }, 1);
    },
    alert: function(text,type){
        var AlertParams = {
            wrapCSS: 'page',
            padding : [40,47,40,47],
            height:"auto",
            minHeight:60
        };
        if (type){
            AlertParams.type = type;
        }
        text = "<div class=\"z5 text-center\" style=\"margin:0\">"+text+"</div>";
        AlertParams.modal = true;
        AlertParams.afterShow = function(){
            setTimeout(function(){
                $.fancybox.close();
            },1000);
        };
        $.fancybox(text, AlertParams);
    },
    hideImgBeforeLoad:function(){
        $('.fadeImg').css({'opacity':0});
        this.LoadHiddenImg();
    },
    LoadHiddenImg:function(){
        $('.fadeImg').imagesLoaded().progress( function( instance, image ) {
            if (image.isLoaded){
                $(image.img).animate({'opacity':1})
            }
            else {
                console.log('image is broken for ' + image.img.src)
            }
        });
    },
    fixHeaderBitrix:function(){
        if ($('#panel').html()!=""){
            $('header').css('top',parseInt($('#panel').height()));
            $(window).on('scroll', function(){
                $top = parseInt($('#panel').height());
                if ($(window).scrollTop() > 0 && $(window).scrollTop() < $top){
                    $('header').css('top',$top-$(window).scrollTop());
                }
                else if ($(window).scrollTop() >= $top){
                    $('header').css('top',0);
                }
                else {
                    $('header').css('top',$top);
                }
            });
        }
    },
    formBtnLoad: function(){
        $('body').on('click','[data-action="btn-ajax-load"]', function(e){
            $(this).addClass('is-loading');
        });
    },
    init:function(){
        $.fancybox.defaults.tpl = $.extend($.fancybox.defaults.tpl, {
            error: '<p class="fancybox-error">Запрашиваемая страница недоступна.<br/>Пожалуйста, повторите попытку.</p>',
            closeBtn: '<a title="Закрыть" class="fancybox-item fancybox-close" href="javascript:;"></a>',
            next: '<a title="Следующий" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
            prev: '<a title="Предыдущий" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
        });
        if (this.MobileMenu)
            this.MobileMenu.init();
            
        if (this.analytics)
            this.analytics.init();
        
        this.ajaxReloadFunction();
        this.hideImgBeforeLoad();
        this.formBtnLoad();
        $('html').removeClass("no-js");
    
    /*/init*/
    }
}