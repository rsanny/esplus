$(function(){
    var setAutoPlaySpeed = function() {
        var subdomain = window.location.host.split('.')[1] ? window.location.host.split('.')[0] : false;
        var isCustom = (subdomain && subdomain.indexOf('samara') > -1 && $(".ink-reaction[data-code='home'].is-selected").length);
        return (isCustom) ? 8000 : 4000;
    };
    $('.index-slider').slick({
        autoplay: true,
        autoplaySpeed: setAutoPlaySpeed(),
        nav:true,
        dots:false
    });
});