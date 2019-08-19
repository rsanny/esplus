$(function(){//DOM READEY
    OptimalGroup.init();
    Material.init();
    
    if (OptimalGroup.isMobile()){
        $('.js-MobilePopUp').fancybox({
            wrapCSS: 'page mobile-popup',
            padding : [16,10,25,10],
            height:"auto",
            fitToView: false,
            afterShow: function(current, previous) {
                OptimalGroup.ajaxReloadFunction();
            }
        });
        $('body').on('click','.js-FooterSection',function(){
            $(this).next('.footer-menu').slideToggle();
        });
        $('body').on('click','.js-MobileHref',function(e){
            e.preventDefault();
            var href = $(this).data('mobile-href');
            if (href)
                window.location = href;
        });
    }
    $('body').on('click','.js-AuthForm',function(e){
        e.preventDefault();
        $(this).closest('.header-auth').toggleClass('is-opened');
    });
    var AuthAnalytics = {
        yur: {
            ga:{
                category: "busin-service",
                action: "lk-biz"
            },
            ym:"lk-biz"
        },
        fiz: {
            ga:{
                category: "dom-service",
                action: "lk-fiz"
            },
            ym:"lk-fiz"
        }
    };
    $('body').on('submit','#authInline', function(e){
        var $form = $(this),
            yur_lico = $form.find('input[name="yur"]').val();
        if(!window.successAuth)
        {
            e.preventDefault();
            $('#authInline').find('input.form-control').removeClass('is-error');
            $('#authInline').find('.form-group-error').remove();

            var apiurl = $form.data('apiurl');
            var login = $form.find('input[name="login"]').val();
            var pass = $.md5($form.find('input[name="pass"]').val());

            if(yur_lico==1)
            {
                $form.attr('action',apiurl+'/_artifitial/default.aspx');
                apiurl += "/Services/ArtifitialAuth.asmx/Safe";
            }
            else
            {
                $form.attr('action',apiurl+'/Individual');
                apiurl += "/Services/Auth.asmx/Safe";
            }

            $.getScript(apiurl+"?part=&login='"+encodeURIComponent(login)+"'&password='"+encodeURIComponent(pass)+"'&format=json&callback=authCallbackInline");
        }
        else {
            if (yur_lico == 1){
                OptimalGroup.analytics.Submit(AuthAnalytics.yur);
            }
            else {
                OptimalGroup.analytics.Submit(AuthAnalytics.fiz);
            }
        }
    });

    $('body').on('submit','#authForm', function(e){
        var $form = $(this),
            user_type = $form.find('input[name="USER_TYPE"]').val();
        
        if(!window.successAuth)
        {
            $('#authForm').find('input.form-control').removeClass('is-error');
            $('#authForm').find('.form-group-error').remove();

            e.preventDefault();
            var apiurl = $form.data('apiurl');
            var login = $form.find('input[name="login"]').val();
            var pass = $.md5($form.find('input[name="pass"]').val());

            if(user_type=='yur')
            {
                $form.attr('action',apiurl+'/_artifitial/default.aspx');
                apiurl += "/Services/ArtifitialAuth.asmx/Safe";
                login = $form.find('input[name="login-yur"]').val();
            }
            else
            {
                $form.attr('action',apiurl+'/Individual');
                apiurl += "/Services/Auth.asmx/Safe";
            }

            $.getScript(apiurl+"?part=&login='"+encodeURIComponent(login)+"'&password='"+encodeURIComponent(pass)+"'&format=json&callback=authCallback");

        }
        else
        {
            if (user_type == "yur"){
                OptimalGroup.analytics.Submit(AuthAnalytics.yur);
            }
            else {
                OptimalGroup.analytics.Submit(AuthAnalytics.fiz);
            }
        }
    })
    $(document).on('click', function(e) {
        if (!e.target.closest('.header-auth')) {
            $('.header-auth').removeClass('is-opened'); 
        }
        if (!e.target.closest('.menu-container') && !e.target.closest('.main-menu li')) {
            $('.menu-container').closest('li').removeClass('is-selected'); 
        }
        if (!e.target.closest('.dropdown.by-click')) {
            $('.dropdown.by-click').closest('.dropdown').removeClass('is-opened');
        }
    });
    $('.fancybox').fancybox();
    $('.js-popUp').fancybox({
        wrapCSS: 'page',
        padding : [15,25,15,25],
        height:"auto",
        minHeight:0,
        fitToView: false,
        maxWidth: "100%",
        afterShow: function() {
            OptimalGroup.ajaxReloadFunction();
        }
    });
    $('.js-popUpData').fancybox({
        wrapCSS: 'page',
        type:'ajax',
        beforeLoad: function() {
            var data = $(this.element).data();
            if (!data.title)
                data.title = document.title || window.document.title;
            if (!data.url)
                data.url = window.location.pathname + window.location.search + window.location.hash;
            this.ajax.data = $.param(data);
        },
        padding : [15,25,15,25],
        height:"auto",
        minHeight:0,
        maxWidth:"100%",
        fitToView: false,
        afterShow: function(current, previous) {
            OptimalGroup.ajaxReloadFunction();
        }
    });
    if (typeof BX === "function") {
        BX.addCustomEvent('onAjaxSuccess', function() {
            OptimalGroup.ajaxReloadFunction();
        });
    }
    $('body').on('click','.dropdown.by-click .dropdown--label',function(e){
        if ($(".dropdown.by-click").hasClass("is-opened")){
            $(".dropdown.by-click").removeClass("is-opened")
        }
        $(this).closest('.dropdown.by-click').toggleClass('is-opened');
    });
    $('body').on('click','.js-Tabs a',function(e){
        e.preventDefault();
        var container = $(this).closest('.js-Tabs'),
            tragetContainer = container.data('container'),
            selected = container.find('a.is-selected'),
            bg = container.find('span');
        if (bg.length){
            bg.removeClass('is-selected-1 is-selected-0');
            bg.addClass('is-selected-'+$(this).index());
        }
        selected.removeClass('is-selected');
        $(this).addClass('is-selected');
        $(tragetContainer).hide();
        $($(this).attr('href')).show();
        $.fancybox.update()
    });
    
    
    $('body').on('click','.js-OneRadio label',function(){
        var value = $(this).data('value'),
            container = $(this).closest('.js-OneRadio'),
            input = container.find('input'),
            bg = container.find('span'),
            toggleClass = container.data('toggle-class'),
            index = $(this).index();
        input.val(value);
        container.find('.is-selected').removeClass('is-selected');
        bg.removeClass('is-selected-1 is-selected-0');
        bg.addClass('is-selected-'+index);
        $(this).addClass('is-selected');
        if (toggleClass){
            var TargetBlock = $(toggleClass);
            TargetBlock.removeClass('is-selected-1 is-selected-0');
            TargetBlock.addClass('is-selected-'+index);
        }
    });
    $('body').on('change','.js-SelecLink',function(){
        var href = $(this).find('option:selected').data('href');
        window.location = href;
    });
    $('body').on('click','.js-input-clear',function(e){
        e.preventDefault();
        $(this).prev('input').val("");
    });
    $('body').on('click','.js-PasswordText',function(e){
        e.preventDefault();
        var input = $(this).next('input'),
            type = input.attr('type'),
            newType,
            newClass;
        $(this).removeClass('fa-eye-slash fa-slash');
        if (type == "text"){
            newType = "password";
            newClass = "fa-eye-slash";
        } else {
            newType = "text";
            newClass = "fa-eye";
        }
        input.attr('type', newType);
        $(this).addClass(newClass);
    });
    
    $('body').on({
        'mouseenter':function(){
            var text = $(this).data('text'),
                target = $(this).data('target');
            if (target)
                text = $(target).html();
            $('body .page').append('<div class="tooltip">'+text+'</div>');
            var offsetLeft = $(this).offset().left+7,
                offsetTop = ($(this).offset().top-$('.tooltip').outerHeight())-13,
                toolWidth = $('.tooltip').outerWidth(),
                position = $(this).data('position');
            
            if (position == "middle"){
                offsetLeft = $(this).offset().left + ($(this).outerWidth()/2);
            }
            $('.tooltip').css({
                'left': offsetLeft,
                'top': offsetTop
            });
            
            if (toolWidth + offsetLeft > $(window).width()){
                var offsetRight = $(window).width() - ($(this).offset().left + 10);
                
                if (toolWidth + offsetRight > $(window).width()) {
                    offsetRight = 0;
                }
                $('.tooltip').css({
                    'left': 'auto',
                    'right': offsetRight
                }).addClass('right-view');
            }
        },
        'mouseleave':function(){$('.tooltip').remove();}
    },'.js-toolTip');
    $('body').on('click','.js-MobileMenuToggle, .page-overlay',function(e){
        e.preventDefault();
        $('.header-menu--mobile').toggle();
        $('.page-overlay').fadeToggle();
        $('.header-bottom').toggleClass('is-visible')
    });
    $('.js-matchHeight').matchHeight({ 
        byRow: true,
    });
    
    $('body').on('click','.js-switchSite a, .js-switchSiteLink',function(e){        
        var code = $(this).data('code'),
            btn = $(this),
            url = $(this).attr('href');
        if (code) {
            e.preventDefault();
            $.ajax({
                url: OptimalGroup.AJAX_PATH + 'site-set.php',
                data:{code:code},
                success: function(data){
                    btn.closest('.js-switchSite').find('.is-selected').removeClass('is-selected');
                    btn.addClass('is-selected');
                    if (url == "#")
                        window.location = "/";
                    else    
                        window.location = url;
                }
            });
        }
    });
    
    $('.js-CityIsMy').on('click',function(e){
        e.preventDefault();
        $.ajax({
            url:OptimalGroup.AJAX_PATH + 'branch-access.php',
            dataType:"json",
            data:{"change_location":"y"},
            success:function(data){
                if (data.result){
                    $('.is-current--city').fadeOut();
                    $('.fancybox-lock').removeClass('fancybox-lock');
                    if (data.result.URL)
                        window.location = data.result.URL;
                }
            }
        })
    });
    $('body').on('click change','.js-ChangeBranch',function(e){        
        var id = $(this).data('id'),
            method = "index";
        if ($(this).is("select")){
            id = $(this).find('option:selected').data('id');
            method = $(this).data('method');
            if ($('.cart').length){
                $('.cart').addClass('is-loading');
            }
        }
        if (id) {
            e.preventDefault();
            $.ajax({
                url: OptimalGroup.AJAX_PATH + 'branch-change.php',
                data:{id:id},
                success: function(data){
                    if (method == "reload")
                        window.location.reload();
                    else if (method == "go-to")
                        window.location = path;
                    else
                        window.location = "/";
                }
            });
        }
    });
    $('body').on('click','.faq-item .faq-item--name',function(e){
        e.preventDefault();
        var FaqItem = $(this).closest('.faq-item');
        FaqItem.toggleClass('is-opened');
        FaqItem.find('.faq-item--text').slideToggle();
    });
    $('body').on('change','.form-control-file input',function(){
        var container = $(this).closest('.form-control-file'),
            input = container.find('input').val(),
            pieces = input.split('\\'),
            filename = pieces[pieces.length-1];
        if (filename){
            container.find('i').text('Выберите файлы');
            container.find('a').addClass('is-visible');
            container.find('span').text(filename);
        }
    });
    $('body').on('click','.form-control-file a',function(e){
        e.preventDefault();
        var container = $(this).closest('.form-control-file');
        container.find('input').val("");
        container.find('i').text('Выберите файлы');
        container.find('span').text("");
        $(this).removeClass('is-visible');
    });
    $('body').on('click','.js-SlideToggle',function(e){
        e.preventDefault();
        var href = $(this).attr('href'),
            close = $(this).data('close');
        if (!href)
            href = $(this).data('href');
        if (close){
            $(close).slideUp();
        }
        $(href).slideToggle(function(){
            $(window).trigger('slideToggleEnd');
        });
        $(this).toggleClass('is-selected');
        
    });
    $('body').on('click','.js-MainMenu',function(e){
        e.preventDefault();
        var li = $(this).closest('li');
        if (!li.hasClass('is-selected'))
            $('.main-menu > li.is-selected').removeClass('is-selected');
            
        li.toggleClass('is-selected');
    });
    $(window).on('scroll',function(){
        if ($(this).scrollTop()> 100){
            $('.fixed-btn').addClass('bottom');
        }
        else {
            $('.fixed-btn').removeClass('bottom');
        }
    });
    $('body').on('click','.js-ScrollTo', function(e){
        e.preventDefault();
        var target = $(this).attr('href'),
            offsetTop = $(target).offset().top;
        $('body, html').animate({"scrollTop":offsetTop});
    });
    $('body').on('click','.js-ScrollToTab', function(e){
        e.preventDefault();
        var target = $(this).attr('href'),
            tab = $(this).data('tab'),
            offsetTop = $(target).offset().top;
        if (!tab)
            tab = target;
        $('.js-Tabs a[href="'+tab+'"]').trigger('click');        
        $('body, html').animate({"scrollTop":offsetTop});
    });
    
    if (window.location.hash){
        var Hash = window.location.hash;
        
        if ($(Hash).length){
            $('a[href="'+Hash+'"]').trigger('click');
        }
    }

    $("#question").submit(function(){ // пeрeхвaтывaeм всe при сoбытии oтпрaвки
        var city=$('input[name=city]:checked').val();
        var answer=$('input[name=answer]:checked').val();
        var error = false;
        if(city=="")
        {
            error = true;
        }
        if(answer=="")
        {
            error = true;
        }
        if (!error) { // eсли oшибки нeт
            $.ajax({ // инициaлизируeм ajax зaпрoс
                type: 'POST', // oтпрaвляeм в POST фoрмaтe, мoжнo GET
                url: '/heating.php', // путь дo oбрaбoтчикa, у нaс oн лeжит в тoй жe пaпкe
                dataType: 'json', // oтвeт ждeм в json фoрмaтe
                data: {
                    city:city,
                    answer:answer,
                }, // дaнныe для oтпрaвки
                beforeSend: function(data) { // сoбытиe дo oтпрaвки
                    $(".btn-orange").attr('disabled', 'disabled'); // нaпримeр, oтключим кнoпку, чтoбы нe жaли пo 100 рaз
                    $(".btn-orange").text("Отправка...")
                },
                success: function(data){ // сoбытиe пoслe удaчнoгo oбрaщeния к сeрвeру и пoлучeния oтвeтa
                    // eсли всe прoшлo oк
                        //alert(data); // пишeм чтo всe oк
                        $("#question").hide();
                        $(".succ_voice>b").text(data);
                        $(".color-orange").hide();
                        $(".color-orange+p").hide();
                },
                error: function (xhr, ajaxOptions, thrownError) { // в случae нeудaчнoгo зaвeршeния зaпрoсa к сeрвeру
                    alert(xhr.status); // пoкaжeм oтвeт сeрвeрa
                    alert(thrownError); // и тeкст oшибки
                },
            });
        }
        return false; // вырубaeм стaндaртную oтпрaвку фoрмы
    });

    $(".header-search").hover(function(){
        $(".header-search--form").show()
    },
    function()
    {
        $(".header-search--form").hide()
    });


});

var authCallback = function(data){
    var $form = $('#authForm'),
        user_type = $form.find('input[name="USER_TYPE"]').val(),
        apiurl = $form.data('apiurl'),
        login = $form.find('input[name="login"]').val();
    if(user_type=='yur')
    {
        login = $form.find('input[name="login-yur"]').val();
    }
    if(data.d == "true")
    {
        window.successAuth = true;
        $form.submit();
    }
    else
    {
        var errMsg = 'Неверный логин или пароль';
        switch(data.d)
        {
            case 'registration_light':
                setTimeout(function(){
                    window.location.href = apiurl+'/RegistrationLight?PersonalAccount='+login;
                },300);
                return false;
                break;

            case 'not_confirmed':
                errMsg = 'Вы не подтвердили регистрацию!';
                break;

            case 'is_blocked':
                errMsg = 'Абонент не обслуживается. Учетная запись заблокирована!';
                break;

            case 'ip_bloked':
                errMsg = 'Слишком много запросов с Вашего IP - попробуйте зайти позже';
                break;

            case 'db_inaccessible':
                errMsg = 'Сервис временно недоступен! Попробуйте зайти позже';
                break;
        }
        
        $form.find('input.form-control').addClass('is-error');
        $form.find('input[name="pass"]').after('<div class="form-group-error">'+errMsg+'</div>');
    }
}
var authCallbackInline = function(data){
    if(data.d == "true")
    {
        window.successAuth = true;
        $('#authInline').submit();
    }
    else
    {
        var errMsg = 'Неверный логин или пароль';
        switch(data.d)
        {
            case 'registration_light':
                setTimeout(function(){
                    window.location.href = $('#authInline').data('apiurl')+'/RegistrationLight?PersonalAccount='+$('#authInline').find('input[name="login"]').val();
                },300);
                return false;
                break;

            case 'not_confirmed':
                errMsg = 'Вы не подтвердили регистрацию!';
                break;

            case 'is_blocked':
                errMsg = 'Абонент не обслуживается. Учетная запись заблокирована!';
                break;

            case 'ip_bloked':
                errMsg = 'Слишком много запросов с Вашего IP - попробуйте зайти позже';
                break;

            case 'db_inaccessible':
                errMsg = 'Сервис временно недоступен! Попробуйте зайти позже';
                break;
        }

        $('#authInline').find('input.form-control').addClass('is-error');
        $('#authInline').find('input[name="pass"]').after('<div class="form-group-error">'+errMsg+'</div>');
    }
}