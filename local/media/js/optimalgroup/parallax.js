var Parallax = function(element, options) {
    this.$element = $(element);
    this.$body = $('body');
    this.options = $.extend(true, {}, $.fn.parallax.defaults, options);
    this.animate();
    
}
Parallax.prototype.animate = function() {
    if (this.$element.is('img')){
        this.translateImage();
    }
    else {    
        this.translateBgImage();
    }
}
Parallax.prototype.translateImage = function() {
    var scrollPos;
    var pagecoverHeight = this.$element.height();
    var opacityKeyFrame = pagecoverHeight * 50 / 100;
    var direction = 'translateY';
    scrollPos = $(window).scrollTop();
    this.$element.css({
        'transform': direction + '(' + scrollPos * this.options.speed.coverPhoto + 'px)'
    });
}
Parallax.prototype.translateBgImage = function() {
    var scrollPos = $(window).scrollTop();
    var pagecoverHeight = this.$element.height();
    var relativePos = this.$element.offset().top - scrollPos;
    if (relativePos > -pagecoverHeight && relativePos <= $(window).height()) {
        var displacePerc = 100 - ($(window).height() - relativePos) / ($(window).height() + pagecoverHeight) * 100;
        this.$element.css({
            'background-position': 'center ' + displacePerc + '%'
        });
    }
}
function Plugin(option) {
    return this.each(function() {
        var $this = $(this);
        var data = $this.data('pg.parallax');
        var options = typeof option == 'object' && option;
        if (!data)
            $this.data('pg.parallax', (data = new Parallax(this,options)));
        if (typeof option == 'string')
            data[option]();
    })
}
var old = $.fn.parallax
$.fn.parallax = Plugin
$.fn.parallax.Constructor = Parallax
$.fn.parallax.defaults = {
    speed: {
        coverPhoto: 0.9,
        content: 0.17
    }
}
$.fn.parallax.noConflict = function() {
    $.fn.parallax = old;
    return this;
}
$(window).on('load', function() {
    $('.js-parallax').each(function() {
        var $parallax = $(this)
        $parallax.parallax($parallax.data())
    })
});
$(window).on('scroll', function() {
    $('.js-parallax').parallax('animate');
});
