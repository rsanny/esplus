$(function(){
	OptimalGroup.tariffCalc();
	
	var $power_consumption = $("#power_consumption").ionRangeSlider({
		hide_min_max: true,
		keyboard: true,
		min: 0,
		max: 100,
		from: 50,
		to: 70,
		type: 'double',
		step: 1,
        onStart: function (data) {
            $(data.slider).append('<div class="irs-right-bar"/>');
            $('.irs-right-bar').css('left',data.to+"%");
        },
        onChange: function (data) {
            $('.irs-right-bar').css('left',data.to+"%");
        },
	});
	
	$power_consumption.on("change", function(){
		var $this = $(this),
		peak = parseInt($this.data("from")),
		halfPeak = parseInt($this.data("to"))-peak,
		nightPeak = 100-halfPeak-peak;
		monthlyConsumption = $('.monthly-consumption-js').val();
		
		$('#tariff-peak').val(peak);
		$('#tariff-half-peak').val(halfPeak);
		$('#tariff-night-peak').val(nightPeak);
		
		$('.peak-js span').text(peak);
		$('.half-load-peak-js span').text(halfPeak);
		$('.peak-night-js span').text(nightPeak);
		
		$('.tariff-peak-outgo-js').text(Math.round(monthlyConsumption*peak/100));
		$('.tariff-half-peak-outgo-js').text(Math.round(monthlyConsumption*halfPeak/100));
		$('.tariff-night-peak-outgo-js').text(Math.round(monthlyConsumption*nightPeak/100));
		
		OptimalGroup.tariffCalc();
	});
	
	$('body').on('change', '.monthly-consumption-js', function(){
		var monthlyConsumption = parseFloat($('.monthly-consumption-js').val()),
            errorText = $('<div class="form-group-error">Введите число</div>');
        
        if (isNaN(monthlyConsumption)) {
            monthlyConsumption = 0;
            $(this).addClass('is-error');
            if (!$(this).next(".form-group-error").length)
                errorText.insertAfter($(this));
        }
        else {
            $(this).removeClass('is-error'); 
            $(this).next(".form-group-error").remove();
        }
		$('.tariff-peak-outgo-js').text(Math.round(monthlyConsumption*$('#tariff-peak').val()/100));
		$('.tariff-half-peak-outgo-js').text(Math.round(monthlyConsumption*$('#tariff-half-peak').val()/100));
		$('.tariff-night-peak-outgo-js').text(Math.round(monthlyConsumption*$('#tariff-night-peak').val()/100));
		
		OptimalGroup.tariffCalc();
	})
	
	$('body').on('click', '.plate-type-js', function(){
        var submitData = {
            plate_type: $(this).val(), 
            sec_id: $('#tariff-branch-id').val(), 
            tariff_peak: $('#tariff-peak').val(), 
            tariff_half_peak: $('#tariff-half-peak').val(), 
            tariff_night_peak: $('#tariff-night-peak').val(), 
            monthly_consumption: $('.monthly-consumption-js').val()
        };
		$.ajax({
			url: OptimalGroup.AJAX_PATH+'tariff-config.php',
			data: submitData,
			cache: false,
			type: 'POST',
			success: function(data){
                console.log(data);
				$('.tariff-details').html(data);				
				OptimalGroup.tariffCalc();
			}
		});			
	});
});
OptimalGroup.tariffCalc = function (){
    var outgo,
        kw,
        sum,
        total = {
            column_1: 0,
            column_2: 0,
            column_3: 0
        },
        tariffs = {
            max: 0,
            min: 0,
            columnMax: 0,
            columnMin: 0,
        };
    $('.tariff-tr').each(function(i){
        outgo = $(this).find('.tariff-outgo-js').text();
        outgo = outgo.replace(",",".");
        kw = $(this).find('.tariff-kw').text();
        kw = kw.replace(",",".");
        sum = parseFloat(outgo)*parseFloat(kw);
        $(this).find('.tariff-sum-js').text(Math.round(sum));
    });

    $('.table-tarrif-one .tariff-tr').each(function(i){
        total.column_1 = total.column_1 + parseInt($(this).find('.tariff-sum-js').text());
    });
    $('.table-tarrif-two .tariff-tr').each(function(i){
        total.column_2 = total.column_2 + parseInt($(this).find('.tariff-sum-js').text());	
    });
    $('.table-tarrif-three .tariff-tr').each(function(i){
        total.column_3 = total.column_3 + parseInt($(this).find('.tariff-sum-js').text());
    });
    for (var i in total){
        var t = total[i];
        if (tariffs.max < t){
            tariffs.max = t;
            tariffs.columnMax = i;
        }
        if (tariffs.min > t || tariffs.min == 0){
            tariffs.min = t;
            tariffs.columnMin = i;
        }
    }
    $('.tariffs-column').removeClass('is-selected');
    $('.'+tariffs.columnMin).addClass('is-selected');
    $('.one-tariff-account-js span').text(OptimalGroup.number_format(total.column_1,0,'', ''));
    $('.two-tariff-account-js span').text(OptimalGroup.number_format(total.column_2,0,'', ''));
    $('.three-tariff-account-js span').text(OptimalGroup.number_format(total.column_3,0,'', ''));
}
