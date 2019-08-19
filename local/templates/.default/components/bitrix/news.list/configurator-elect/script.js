$(function(){
    OptimalGroup.ElectService.init(ElectItems);
    $('body').on('click','.js-SwitchCounter a', OptimalGroup.ElectService.changeCounter);
    $('body').on('click','.counters-calc .js-OneRadio label', OptimalGroup.ElectService.Radio);
    $('body').on('click','.js-ElectBuy',function(e){
        e.preventDefault();
        var product = $(this).data('product'),
            phase = OptimalGroup.ElectService.Settings.phase,
            tariff = OptimalGroup.ElectService.Settings.tariff,
            data = ElectItems[phase][tariff][product];
        data.action = "ADD2BASKET";
        data.type = "ELECT";
        console.log(data);
        $.ajax({
			url: OptimalGroup.AJAX_PATH+'basket.action.multi.php',
			dataType:"json",
			data:data,
			success: function(data){
                console.log(data);
				$('.js-BasketHeader').html(data.basket);
                //window.location = "/cart/";
			}
		});	
    });
});
OptimalGroup.ElectService = {
    Settings:{
        phase:1,
        tariff:1
    },
    Radio:function(e){
        e.preventDefault();
        $('.counters-calc .js-OneRadio input').each(function(){
            var val = $(this).val(),
                name = $(this).attr('name');
            OptimalGroup.ElectService.Settings[name] = val;
        });
        OptimalGroup.ElectService.init(ElectItems);
    },
    makeCounterSlect: function(item){
        $('.js-SwitchCounter').empty();
        var html = "",
            selected = " is-selected";
        for (var i in item){
            var counter = item[i],
                avaiable = " is-avaiable",
                avaiableText = "Наличие:";
            if (counter.COUNTER_AMOUT == 0) {
                avaiable = "";
                avaiableText = "Нет в наличии";
            }
                
            html += '<a href="#" data-product="'+counter.ID+'" class="flex flex-vertical inline-product'+ selected +'">';
            html += '<span class="inline-product--img loading-bg"><img src="'+counter.IMAGE_SRC+'" alt=""></span>';
            html += '<span class="inline-product--name"><b>'+counter.COUNTER_NAME+'</b>';
                html += '<span class="product-item--availability'+avaiable+'">';
                html += '<i class="fa fa-check-circle-o"></i>'+avaiableText;
                if (counter.COUNTER_AMOUT){
                    for (var i = 1; i<=5; i++){
                        var selected = '';
                        if (i<=counter.COUNTER_AMOUT)
                            selected = ' class="is-selected"';
                        html += '<b'+selected+'></b>';
                    }
                }
                html += '</span>'; //Counter amout
            html += '</span>'; //COUNTER NAME
            html += '<span class="inline-product--price color-orange">'+OptimalGroup.number_format(counter.PRICE.NEW,0,' ','')+' руб.</span>';
            
            html += '</a>';
            selected = "";
        }
        $('.js-SwitchCounter').append(html);
    },
    changeCounter: function(e){
        e.preventDefault();
        var product = $(this).data('product'),
            dropdown = $(this).closest('.js-SwitchCounter'),
            phase = OptimalGroup.ElectService.Settings.phase,
            tariff = OptimalGroup.ElectService.Settings.tariff,
            counter = ElectItems[phase][tariff][product];
        dropdown.find('.is-selected').removeClass('is-selected');
        $.fancybox.close();
        $(this).addClass('is-selected');
        OptimalGroup.ElectService.setCurrentCounter(counter);
    },
    setCurrentCounter: function(current){
        var subTitle = "";
        if (current.TARIFF == 1) subTitle += "1-тарифный";
        else if (current.TARIFF == 2) subTitle += "Многотарифный";
        if (current.PHASES == 1) subTitle += " / 1-фазный";
        else if (current.PHASES == 2) subTitle += " / Трехфазный";
        $('.counters-calc--item__img img').attr('src',current.IMAGE_SRC);
        $('.counters-calc--item__name b').text(current.COUNTER_NAME);
        $('.counters-calc--item__name span').text(subTitle);
        $('.counters-calc--discount span').text(OptimalGroup.number_format(current.PRICE.OLD,0,' ','') + " р.");
        $('.counters-calc--price').text(OptimalGroup.number_format(current.PRICE.NEW,0,' ','') + " р.");
        $('.js-ElectBuy').data('product',current.ID);
    },
    init: function(items){
        var phase = this.Settings.phase,
            tariff = this.Settings.tariff,
            counters = items[phase][tariff],
            Sorted = BX.util.objectSort(counters,"COUNTER_AMOUT", "desc"),
            firstItem;
        for (var i in counters) {
            firstItem = counters[i];
            break;
        }
        this.makeCounterSlect(Sorted);
        this.setCurrentCounter(firstItem);
    }
}