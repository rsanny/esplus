var Material = {
    getLuma: function (color) {
        var rgba = color.substring(4, color.length - 1).split(',');
        var r = rgba[0];
        var g = rgba[1];
        var b = rgba[2];
        var luma = 0.2126 * r + 0.7152 * g + 0.0722 * b;
        return luma;
    },
    getBackground: function (item) {
        var color = item.css("background-color");
        var alpha = parseFloat(color.split(',')[3], 10);
        if ((isNaN(alpha) || alpha > 0.8) && color !== 'transparent') {
            return color;
        }
        if (item.is("body")) {
            return false;
        } else {
            return this.getBackground(item.parent());
        }
    },
    init: function () {
        var self = this;
        $(document).on('click', '.ink-reaction, .btn', function (e) {
            var bound = $(this).get(0).getBoundingClientRect();
            var x = e.clientX - bound.left;
            var y = e.clientY - bound.top;
            var color = self.getBackground($(this));
            var inverse = (self.getLuma(color) > 183) ? ' inverse' : '';
            var ink = $('<div class="ink' + inverse + '"></div>');
            var btnOffset = $(this).offset();
            var xPos = e.pageX - btnOffset.left;
            var yPos = e.pageY - btnOffset.top;
            ink.css({
                top: yPos,
                left: xPos
            }).appendTo($(this));
            window.setTimeout(function () {
                ink.remove();
            }, 1500);
        });
    }
}
