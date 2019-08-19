OptimalGroup.cartAction = {
    cartUrl: OptimalGroup.AJAX_PATH + 'basket.action.php',
    basketContainer: '.js-BasketHeader',
    add:function(e){
		e.preventDefault();
		var _self = $(this),
            product = _self.closest('.product-to-basket'),
            productAjax = product.find('.product-item--basket'),
            productBtn = product.find('.product-item--action'),
            productImg = product.find('.product-to-basket--img img'),
            submitData = productAjax.data();
        submitData.action = "ADD2BASKET";
        if(product.length > 0){                
			OptimalGroup.cartAction.animation(productImg);
		}
		$.ajax({
			url: OptimalGroup.cartAction.cartUrl,
			dataType:"json",
			data:submitData,
			success: function(data){
                if (dataLayer){
                    OptimalGroup.dataLayer(submitData, 'add', 'addToCart', 'Adding a Product to a Shopping Cart');
                }
                if (productBtn){
                    productBtn.addClass('is-in_cart');
                    productBtn.find('.product-item--buy').text('+1');
                    currentInCart = parseInt(productBtn.find('.product-item--cart small').text());
                    productBtn.find('.product-item--cart small').text(currentInCart+1);
                }
				$(OptimalGroup.cartAction.basketContainer).html(data.basket);
			}
		});		
		
	},
    popUp:function(e){
		e.preventDefault();
        var _self = $(this),
            product = _self.closest('.product-to-basket'),
            productAjax = product.find('.product-item--basket'),
            productBtn = product.find('.product-item--action'),
            productImg = product.find('.product-to-basket--img img'),
            submitData = productAjax.data();
        submitData.action = "ADD2BASKET";
       
        $.ajax({
            url: OptimalGroup.cartAction.cartUrl,
            dataType:"json",
            data:submitData,
            success: function(data){
                if (dataLayer){
                    OptimalGroup.dataLayer(submitData, 'add', 'addToCart', 'Adding a Product to a Shopping Cart');
                }
                if (productImg){
                    $.fancybox({
                        wrapCSS: 'page',
                        type:'ajax',
                        href:OptimalGroup.AJAX_PATH + 'product.popup.php?image='+$(productImg).attr('src'),
                        padding : [15,25,15,25],
                        height:"auto",
                        minHeight:0,
                        maxWidth:"100%",
                        fitToView: false,
                        afterShow: function(current, previous) {
                            OptimalGroup.ajaxReloadFunction();
                        }
                    });
                }
                $(OptimalGroup.cartAction.basketContainer).html(data.basket);
            }
        });
        
    },
	update:function(e){
		e.preventDefault();
		var id = $(this).data('id'),
			action = $(this).data('action'),
			product = $(this).data('pid'),
            q = $(this).val();
            
		$.ajax({
			url:OptimalGroup.cartAction.cartUrl,
			dataType:"json",
			data:{
				q:q,
				action:action,
                pid:product,
				id:id,
			},
			success: function(data){
				$(OptimalGroup.cartAction.basketContainer).html(data.basket);
                setTimeout(function(){
                    $(OptimalGroup.cartAction.basketContainer).removeClass('show-cart'); 
                },300);
			}
		});		
		
	},
    quantity: function(e){
        e.preventDefault();  
        var container = $(this).closest('.js-itemQuantity'),
            input = container.find('input'),
            currentValue = parseInt(input.val()),
            type = $(this).data('type'),
            productBasket = $(this).closest('.product-item').find('.product-item--basket'),
            minInField = input.data('min'),
            min = 1;
            
        if (minInField || minInField == 0) min = minInField
        if (type == "more") currentValue++;
        else currentValue--;
        if (currentValue < min) currentValue = min;
        input.val(currentValue);
        productBasket.data('quantity',currentValue);
        input.trigger('change');
    },
	remove:function(e){
		e.preventDefault();
		var _self = $(this),
		    submitData = _self.data();            
		$.ajax({
			url:OptimalGroup.cartAction.cartUrl,
			dataType:"json",
			data:submitData,
			success: function(data){
				$(OptimalGroup.cartAction.basketContainer).html(data.basket);
			}
		});
		
	},
    quantityInput:function(e){
        console.log($(this).val());
    },
    animation:function(block){
		var	basket = $(this.basketContainer);
		if (basket.length) {
			var image = $(block),
				clone = image.clone();
                
			clone.css({'position':'absolute', 'z-index':8020});
			$('body').append(clone);
			var	easing = new BX.easing({
					duration : 1000,
					start : { height : image.height(), left : image.offset().left, top: image.offset().top, width: image.width(), opacity: 100},
					finish : { height : 0, width : 0, top: basket.offset().top, left: basket.offset().left, opacity: 20},
					transition : BX.easing.transitions.linear,
					step : function(state){
						clone.css("height", state.height);
						clone.css("width", state.width);
						clone.css("top", state.top);
						clone.css("left", state.left);
						clone.css("opacity", state.opacity/100);
					},
					complete : function() {
						clone.remove();
					}
				});
			easing.animate();
		}
	},
};
$(function(){
    $('body').on('click','.js-AddToCartPopUp', OptimalGroup.cartAction.popUp);
    $('body').on('click','.js-AddToCart', OptimalGroup.cartAction.add);
    $('body').on('click','.js-itemQuantity i', OptimalGroup.cartAction.quantity);
});