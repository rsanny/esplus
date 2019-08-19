OptimalGroup.cartTemplate = {  
    discount: {},
    init:function(order){
        this.create.delivery(order);
        this.create.cart(order);
        this.create.totals(order);
        this.create.pay(order);
        OptimalGroup.saleOrderAjax.items = order.BASKET_ITEMS;
    },
    class: {
        cart: $('.basket_list'),
        delivery: $('.delivery-list'),
        pay: $('.pay-list'),
        totalCart: $('.cart-total'),
        totalOrder: $('.order-total'),
        totalDelivery: $('.delivery-total'),
        orderTotal: $('.cart-order--total'),
        ordetTotalTable: $('.cart-order--total__table')        
    },
    create:{
        delivery:function(order){
            var currentStore = order.BUYER_STORE,
                result = order.DELIVERY,
                html = "";
            if (order.STORE_LIST.length != 0 && order.STORE_LIST){
                if (!order.ALL_IN_STOCK){
                    html += '<div class="color-orange">К сожалению, данный заказ сейчас невозможно скомплектовать ни в одном из отделений филиала (нет в наличии всех товаров в одном отделении).<br>Вы можете изменить состав заказа или продолжить оформление заказа (в таком случае Вам перезвонит консультант для уточнения сроков и возможности реализации заказа).</div>';
                }
                for (var i in result){
                    var data = result[i];
                        data.BUYER_STORE = "";
                        data.ALL_IN_STOCK = order.ALL_IN_STOCK;
                        
                    if (data.CHECKED == "Y")
                        data.ceck = " checked";
                    if (order.STORE_LIST){
                        data.CURRENT = order.STORE_LIST[order.BUYER_STORE];
                        if (order.STORE_PRODUCT_ID.length)
                            data.BASKET_ITEMS = order.STORE_PRODUCT_ID.join(',');
                        else
                            data.BASKET_ITEMS = "all";
                    }
                    html += OptimalGroup.cartTemplate.templates.delivery(data);
                }
            }
            
            OptimalGroup.cartTemplate.class.delivery.html(html);
            setTimeout(function(){
                $('.cart-group--delivery').slideDown();
            },300);
        },
        pay:function(order){
            var result = order.PAY_SYSTEM,
                html = "";
            for (var i in result){
                var data = result[i];
                if (data.CHECKED == "Y")
                    data.ceck = " checked";
                html += OptimalGroup.cartTemplate.templates.pay(data);
            }
            OptimalGroup.cartTemplate.class.pay.html(html);
            setTimeout(function(){
                $('.cart-group--pay').slideDown();
            },500);
        },
        totals:function(order){
            var delivery = order.TOTAL.DELIVERY_PRICE;
            if (OptimalGroup.cartTemplate.discount){
                discount = 0;
                for (var i in OptimalGroup.cartTemplate.discount){
                    price = OptimalGroup.cartTemplate.discount[i];
                    discount += price;
                }
                if (discount){
                    dicountSign = "С учётом общей скидки в "+BX.util.number_format(Math.ceil(discount),0,'',' ')+" руб.";
                    OptimalGroup.cartTemplate.class.totalCart.find('span').html(dicountSign);
                }
                else {
                    OptimalGroup.cartTemplate.class.totalCart.find('span').empty()
                }
            }
            OptimalGroup.cartTemplate.class.totalCart.find('div').html(order.TOTAL.ORDER_PRICE_FORMATED)
            OptimalGroup.cartTemplate.class.totalCart.slideDown();
            OptimalGroup.cartTemplate.class.totalOrder.html(order.TOTAL.PRICE_WITHOUT_DISCOUNT);
            OptimalGroup.cartTemplate.class.totalDelivery.html(delivery?order.TOTAL.DELIVERY_PRICE_FORMATED:'самовывоз');
            setTimeout(function(){
                if (order.STORE_LIST.length != 0 && order.STORE_LIST && order.BUYER_STORE){
                    OptimalGroup.cartTemplate.class.orderTotal.slideDown();
                    OptimalGroup.cartTemplate.class.ordetTotalTable.removeClass('hidden');
                }
                else {
                    OptimalGroup.cartTemplate.class.ordetTotalTable.addClass('hidden');
                    OptimalGroup.cartTemplate.class.orderTotal.slideDown();
                    //$('#BUYER_STORE').val(0);//
                }
            },800);
        },
        cart:function(order){
            var result = order.BASKET_ITEMS,
                html = "";
            OptimalGroup.cartTemplate.discount = {};
            for (var i in result){
                var data = result[i];
                html += OptimalGroup.cartTemplate.templates.cart(data, order.BASKET_IDS);
            }
            OptimalGroup.cartTemplate.class.cart.html(html).slideDown();
        },
    },
    templates:{
        pay:function(data){
            return '<li> \
                <div class="radio"> \
                    <label> \
                        <input type="radio" value="'+data.ID+'" name="PAY_SYSTEM_ID"'+data.ceck+'> \
                        <i></i> \
                        <span>'+data.NAME+'</span>\
                    </label>\
                </div>\
            </li>';
        },
        delivery:function(data){
            var li = '<li>';
                li += '<div class="radio">\
                    <label>\
                        <input type="radio" name="DELIVERY_ID" value="'+data.ID+'"'+data.ceck+'>\
                        <i></i>\
                        <span>'+data.NAME+'</span>\
                    </label>\
                </div>';
                
            if (!data.ALL_IN_STOCK){
                data.BASKET_ITEMS = "all";
            }
            if (data.BASKET_ITEMS && data.CURRENT && data.CURRENT.CONTACTS){
                var address = data.CURRENT.CONTACTS.ADDRESS,
                    id = data.CURRENT.ID;
                li +='<div class="radio-text"> \
                    <p id="BUYER_STORE_ADDRESS">Офис - <span>'+address+'</span></p>\
                    <div><a href="#"  data-fancybox-type="ajax" data-fancybox-href="'+OptimalGroup.AJAX_PATH+'store-address.php?products='+data.BASKET_ITEMS+'&current='+id+'" class="btn btn-grey-light btn-exsmall js-popUp">Выбрать другой пункт самовывоза <i class="fa fa-angle-right"></i></a></div>\
                </div>';
            }
            else if(data.BASKET_ITEMS) {
                li +='<div class="radio-text"> \
                    <div><a href="#"  data-fancybox-type="ajax" data-fancybox-href="'+OptimalGroup.AJAX_PATH+'store-address.php?products='+data.BASKET_ITEMS+'" class="btn btn-orange btn-exsmall js-popUp">Выбрать пункт самовывоза <i class="fa fa-angle-right"></i></a></div>\
                </div>';
            }
                li += '</li>';
            return li;
        },
        cart:function(data, products){
            var imgSrc,
                discountPrice = "",
                id = products[data.SERVICE],
                url = data.DETAIL_PAGE_URL;
            if (!url) url = "";
            if (data.PROPS.PICTURE) {
                imgSrc = data.PICTURE;
            }
            if (data.PROPS.TYPE){
                if (data.PROPS.TYPE.VALUE == "SERVICE"){
                    if (!imgSrc)
                        imgSrc = OptimalGroup.MEDIA_PATH + "icons/icon-service-no-photo.jpg";

                    //serviceDiscount = Math.ceil(data.PRICE*.08);
//                    if (serviceDiscount){
//                        OptimalGroup.cartTemplate.discount[data.ID] = serviceDiscount*data.QUANTITY;
//                        discountPrice = 'Скидка: '+ serviceDiscount + ' руб.';
//                    }
                }
            }
            if (!imgSrc)
                imgSrc = OptimalGroup.MEDIA_PATH + "images/no_image.jpg";
            if (data.PROPS.PRICE_OLD){
                oldPriceDiscount = Math.ceil(data.PROPS.PRICE_OLD.VALUE-data.PRICE);
                OptimalGroup.cartTemplate.discount[data.ID] = oldPriceDiscount*data.QUANTITY;
                discountPrice = 'Скидка: '+ oldPriceDiscount + ' руб.';
            }
            var item = '<div class="cart-item">\
                <a href="'+url+'" class="cart-item--img loading-bg"><img src="'+imgSrc+'" alt="'+data.NAME+'" class="img-responsive"></a>\
                <a href="'+url+'" class="cart-item--name">'+data.NAME+'</a>\
                <div class="cart-item--quantity">\
                    <div class="form-control--container js-itemQuantity">\
                       <div class="form-control--quantity">\
                            <i data-type="more">+</i>\
                            <i data-type="less">-</i>\
                        </div>\
                        <input type="text" value="'+data.QUANTITY+'" data-action="update" data-id="'+data.ID+'" data-pid="'+data.PRODUCT_ID+'" class="form-control">\
                    </div>\
                    <div class="form-control--quantity__piece">'+data.MEASURE_TEXT+'</div>\
                </div>\
                <div class="cart-item--price"><div>'+data.PRICE_FORMATED+'</div>'+discountPrice+'</div>\
                <a href="#" data-id="'+data.ID+'" data-action="remove"';
            if (id)
                item += ' data-service="'+id+'"';
            
                item +='class="cart-item--remove js-RemoveFromCart"></a>\
                </div>';
            return item;
        }
    },
};