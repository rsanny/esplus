$(function(){
    $('.js-hideContactsList').on('click',function(e){
        e.preventDefault();
        var currentText = $(this).find('span').text();
        $(this)
            .find('i')
            .toggleClass('fa-angle-up')
            .toggleClass('fa-angle-down');
        if (currentText == "Скрыть")
            $(this).find('span').text("Показать");
        else
            $(this).find('span').text("Скрыть");
            
        $('.contacts-list').slideToggle();
    });
    $('.ajax-load-iblock-but a').on('click', function(e){
        var page = $(this).data('page'),
            self = $(this),
            $total = $(this).data('total'),
            $block = '.contacts-list',
            $but = $(this).closest('.ajax-load-iblock-but');
		$(this).data('page', page+1);
		if (page <= $total){
			$.ajax({
				type: "POST",
				cache: false,
				dataType: "html",
				url: "/offices/contacts-list.php",
				data: {PAGEN_1: page, loadMore: true}, 
				success: function (data) {
					$($block).append(data);
					if(page == $total) {
						$but.hide();
					}
				} // success
			}); // ajax
		}
		else {$but.hide();}
		e.preventDefault();
	});
});