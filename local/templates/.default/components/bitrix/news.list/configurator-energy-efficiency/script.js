$(function(){
    OptimalGroup.Led.calculator();
	$('body').on('change', '#ee-lamp-quantity, #ee-lamp-hours, #ee-lamp-cost, #ee-lamp-item', function(){
		var empty = true;
		if($('#ee-lamp-item').val() == '') empty = false;
		if($('#ee-lamp-quantity').val() == '') empty = false;
		if($('#ee-lamp-hours').val() == '') empty = false;
		if($('#ee-lamp-cost').val() == '') empty = false;		
		if(empty){
			OptimalGroup.Led.calculator();
		}else{
			$('.lamp-efficiency, .led-efficiency, .lamp-spending, .led-spending, .energy-economy, .cost-economy').html('');
		}
	});
});
OptimalGroup.Led = {
    calculator: function(){
        var selectedOption = $('.ee-lamp-select').find('option:selected'),
            selectedName = selectedOption.text(),
            selectedLed = selectedOption.data('led-name');
            
        $('#ee-lamp-power').text(selectedOption.data('lamp-power'));
        $('#ee-led-power').text(selectedOption.data('led-power'));
        $('#ee-lamp-luminous').text(selectedOption.data('lamp-luminous'));
        $('#ee-led-luminous').text(selectedOption.data('led-luminous'));	
        $('.lamp-name').text(selectedName);
        $('.led-name').text(selectedLed);
        
        var result = {},
            lamp_quantity = $('#ee-lamp-quantity').val(),
            lamp_hours = $('#ee-lamp-hours').val(), 
            lamp_cost = $('#ee-lamp-cost').val(),  
            lamp_power = parseInt($('#ee-lamp-power').text()), 
            led_power = parseInt($('#ee-led-power').text()),
            lamp_luminous = parseInt($('#ee-lamp-luminous').text()),
            led_luminous = parseInt($('#ee-led-luminous').text()),
            lampEfficiency = lamp_power*1.25/1000*365*lamp_quantity*lamp_hours,
            ledEfficiency = led_power*1.2/1000*365*lamp_quantity*lamp_hours,
            lampSpending = lampEfficiency*lamp_cost,
            ledSpending = ledEfficiency*lamp_cost,
            costEconomy = lampSpending - ledSpending,
            energyEconomy = lampEfficiency - ledEfficiency;
            
        result = {
            'lamp-efficiency': Math.round(lampEfficiency),
            'led-efficiency': Math.round(ledEfficiency),
            'lamp-spending': Math.round(lampSpending),
            'led-spending': Math.round(ledSpending),
            'energy-economy': Math.round(energyEconomy),
            'cost-economy': Math.round(costEconomy)
        }
        $.each(result, function(i, item){
           $('.energy-efficiency-block .'+i).html(OptimalGroup.number_format(item, "0", " ", ""));
        });
        return result;
            
    }    
}
function validate(inp) {
	inp.value = inp.value.replace(/[^\d,.]*/g, '')
						 .replace(/([.])[.]+/g, '$1')
						 .replace(/^[^\d]*(\d{0,2}([.]\d{0,2})?).*$/g, '$1');
}