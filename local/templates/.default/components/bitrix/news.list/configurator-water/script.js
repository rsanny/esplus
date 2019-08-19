$(function(){
    $('body').on('click','.js-SwitchCounter a',function(e){
        e.preventDefault();
        var VisibleTab = $(this).closest('.water-tab'),
            BtnIndex = $(this).index(),
            SelectedBtn = VisibleTab.find('.js-SwitchCounter').find('a:eq('+BtnIndex+')');
        SelectedBtn.each(function(){
            OptimalGroup.WaterCounter($(this));
        });
        
    });
    $('body').on('click','.js-WaterBuy',function(e){
        e.preventDefault();
        var product = $(this).data('product'),
            data = WaterItems[product];
            data.CounterAmout = $(this).closest(".water-product").find('input[name="COUNTER_AMOUT"]').val();
            data.CounterColdAmout = $(this).closest(".water-product").find('input[name="COUNTER_COLD_AMOUT"]').val();
        data.action = "ADD2BASKET";
        data.type = "WATER";
        $.ajax({
			url: OptimalGroup.AJAX_PATH+'basket.action.multi.php',
			dataType:"json",
			data:data,
			success: function(data){
				$('.js-BasketHeader').html(data.basket);
                window.location = "/cart/";
			}
		});	
    });
    $('body').on('change','.js-WaterSumm .js-itemQuantity input',function(){
        var container = $(this).closest('.js-WaterSumm'),
            summ = parseInt(container.data('summ')),
            inputs = container.find('.js-itemQuantity input'),
            total = 0,
            val = parseInt($(this).val());
        if (val < 0 || isNaN(val)) {
            $(this).val("0");
            val = parseInt($(this).val());
        }
        inputs.each(function(){
            total += parseInt($(this).val());
        });
        if (val > summ) {
            inputs.val(0);
            $(this).val(summ);
        }
        else {
            second = summ - val;
            inputs.val(second);
            $(this).val(val);
        }
    });
});
OptimalGroup.WaterCounter = function(self){
    var product = self.data('product'),
        dropdown = self.closest('.dropdown'),
        container = self.closest('.water-product'),
        orderBtn = container.find(".js-WaterBuy"),
        data = WaterItems[product];
    dropdown.find('.is-selected').removeClass('is-selected');
    dropdown.removeClass('is-opened');
    self.addClass('is-selected');
    container.find('.product-item--name').text(data.NAME);
    container.find('.product-item--img img').attr('src',data.IMAGE);
    //container.find('.product-item--price div').text(OptimalGroup.number_format(data.PRICE.OLD,0,' ','') +" руб.");
    container.find('.product-item--price span').text(OptimalGroup.number_format(data.PRICE.NEW,0,' ','') +" руб.");
    orderBtn.data('product',product);
    console.log(product);
}