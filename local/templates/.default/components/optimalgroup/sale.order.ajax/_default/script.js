$(function(){
    $('body').on('click','.js-ChangeStore',function(e){
        e.preventDefault();
        var address = $(this).text(),
            id = $(this).data('id');
        $('#BUYER_STORE').val(id);
        $('#BUYER_STORE_ADDRESS span').text(address);
        $.fancybox.close();
        OptimalGroup.saleOrderAjax.submit("refresh");
    });
    $('body').on('submit','#bx-ajax-order',function(e){
        e.preventDefault();
        OptimalGroup.saleOrderAjax.submit("save");
    });
    $('body').on('change','.js-itemQuantity input',function(){        
		var _self = $(this),
		    submitData = _self.data();
        submitData.q = $(this).val();
        
        $.ajax({
			url: OptimalGroup.cartAction.cartUrl,
			dataType:"json",
			data:submitData,
			success: function(data){
                OptimalGroup.saleOrderAjax.init("refresh");
			}
		});
    });
    $('body').on('click','.js-RemoveFromCart', OptimalGroup.saleOrderAjax.removeFromCart);
    if (BX('bx-ajax-order'))
        OptimalGroup.saleOrderAjax.init("refresh");
});

OptimalGroup.saleOrderAjax = {
    init:function(action){
        this.submit(action);
    },
    submit: function(action){
        var postData = this.getData(),
            result = {};
        $('.cart-page').addClass('is-loading');
        if (action == "refresh"){
            postData['action'] = "refreshOrderAjax";
        }
        /*else if (postData.order.RULE_FOR_PAY != "Y" || postData.order.RULE_FOR_DATA != "Y"){
            if (postData.order.RULE_FOR_PAY != "Y")
                $('input[name="RULE_FOR_PAY"]').closest('.for-rules').addClass('is-error');
            else    
                $('input[name="RULE_FOR_PAY"]').closest('.for-rules').removeClass('is-error');
            if (postData.order.RULE_FOR_DATA != "Y") 
                $('input[name="RULE_FOR_DATA"]').closest('.for-rules').addClass('is-error');
            else    
                $('input[name="RULE_FOR_DATA"]').closest('.for-rules').removeClass('is-error');
              
            $('.cart-page').removeClass('is-loading');
            postData = "";
        }*/
        else if (action == "save"){
            if (!postData.order.BUYER_STORE && action == "save"){
                OptimalGroup.saleOrderAjax.showErrors({"string":"Необходимо выбрать пункт самовывоза"});
                postData = "";
                $('.cart-page').removeClass('is-loading');
                return false;
            } else {
                postData = $('#bx-ajax-order').serializeArray();
                postData['action'] = "saveOrderAjax";
            }
        }
        $.ajax({
            method: 'POST',
            dataType: 'json',
            data:postData,
            success:function(result){
                console.log(result);
                if (result.redirect && result.redirect.length) {
                    document.location.href = result.redirect;
                }
                if (result.order.ERROR){
                    OptimalGroup.saleOrderAjax.showErrors(result.order.ERROR);
                }
                if (action == "save"){
                    OptimalGroup.saleOrderAjax.SaveOrder(result);
                }
                if (action == "refresh"){
                    OptimalGroup.cartTemplate.init(result.order);
                }
                $('.cart-page').removeClass('is-loading');
            },
            error:function(error){
                console.log(error)
            }


        });
    },
    SaveOrder:function(result){
        if (result.order && result.order.ID){
            if (result.order.REDIRECT_URL)
                document.location.href = result.order.REDIRECT_URL;
        }
    },
    showErrors: function(errors){
        for (k in errors)
        {
            if (!errors.hasOwnProperty(k))
                continue;

            blockErrors = errors[k];
            PropertyErrors = "";
            switch (k.toUpperCase())
            {
                case 'PROPERTY':
                    if (BX.type.isArray(blockErrors)) { 
                        for (var key in blockErrors){
                            PropertyErrors += "Поле "+ blockErrors[key] +"<br>";
                        }
				        //blockErrors = blockErrors.join('<br />');
                    }
                break;
                case 'STRING':
                    for (var key in blockErrors){
                        PropertyErrors += blockErrors[key] +"<br>";
                    }
				break;
            }
            $('.order-errors').html(PropertyErrors).slideDown();
            var top = $('.order-errors').offset().top;
            $('body,html').animate({scrollTop:top});
        }
    },
    getData: function(){
        var data = {
            order: this.getAllFormData(),
            sessid: BX.bitrix_sessid(),
            via_ajax: 'Y',
        };
        return data;
    },
    getAllFormData: function(){
        var form = BX('bx-ajax-order'),
            prepared = BX.ajax.prepareForm(form),
            i;
        
        for (i in prepared.data)
            if (prepared.data.hasOwnProperty(i) && i == '')
                delete prepared.data[i];

        return !!prepared && prepared.data ? prepared.data : {};
    },
    
    
	removeFromCart:function(e){
		e.preventDefault();
		var _self = $(this),
		    submitData = _self.data(),
            items = OptimalGroup.saleOrderAjax.items;
        for (var i in items){
            item = items[i];
            if (item.ID == submitData.id){
                if (dataLayer){
                    OptimalGroup.dataLayer({
                        "id": item.ID,
                        "name" : item.NAME,
                        "price": item.SUM_NUM,
                        "brand": "",
                        "category": item.SECTION,
                        "quantity": 1                        
                    }, 'remove', 'removeFromCart', 'Removing a Product from a Shopping Cart');
                }       
            }
        }
		$.ajax({
			url:OptimalGroup.cartAction.cartUrl,
			dataType:"json",
			data:submitData,
			success: function(data){
				$(OptimalGroup.cartAction.basketContainer).html(data.basket);
                OptimalGroup.saleOrderAjax.init("refresh");
			}
		});
		
	},
};