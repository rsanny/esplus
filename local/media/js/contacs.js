var Contacts = {
    myMap:"",
    geolocation: ymaps.geolocation,
    collection: "",
    closestPoint: "",
    BallonTemplate:{
        Contacts: function(placemark){
            var html = '<div class="map-item">';
                html += '<div class="contacts-item--address"><i class="fa fa-map-marker"></i>'+placemark.CONTENT.ADDRESS+'</div>';
                html +=	'<div class="contacts-item--phone"><i class="fa fa-phone"></i>'+placemark.CONTENT.PHONE+'</div>';
                if (placemark.CONTENT.FAX){
                    html +=	'<div class="contacts-item--phone"><i class="fa fa-fax"></i>'+placemark.CONTENT.FAX+'</div>';
                }
                //html +=	'<div class="contacts-item--person">'+placemark.CONTENT.PERSON+'</div>';
                html +=	'<div class="contacts-item--time"><i class="fa fa-clock-o"></i>'+placemark.CONTENT.TIME+'</div>';
                html +=	'<div class="contacts-item--text">'+placemark.CONTENT.TEXT+'</div>';
                html +=	'<div class="contacts-item--action">';
                    //html +=	'<a href="#" data-fancybox-href="'+OptimalGroup.AJAX_PATH+'form/callback.php"" class="btn btn-grey w-170 js-popUpData">Обратная связь</a>';
                    html +=	'<a href="#" data-fancybox-type="iframe" data-fancybox-href="'+OptimalGroup.AJAX_PATH+'print-contact.php?id='+placemark.ID+'" class="btn btn-transparent-border w-280 js-popUp"><i class="fa fa-print btn-fa"></i>Распечатать карту проезда</a>';
                html +=	'</div>';
                html +="</div>";
            return html;
        },
        Product: function(placemark){
            var html = '<div class="map-item">';
                html += '<div class="contacts-item--address"><i class="fa fa-map-marker"></i>'+placemark.CONTENT.ADDRESS+'</div>';
                html +=	'<div class="contacts-item--phone"><i class="fa fa-phone"></i>'+placemark.CONTENT.PHONE+'</div>';
                html +=	'<div class="contacts-item--time"><i class="fa fa-clock-o"></i>'+placemark.CONTENT.TIME+'</div>';
                html +=	'<div class="contacts-item--text">'+placemark.CONTENT.TEXT+'</div>';
               html +=	'<div class="contacts-item--text">'+placemark.CONTENT.IN_STOCK+'</div>';
                html +=	'<div class="contacts-item--action">';
                    html +=	'<a href="#price-scroll" class="btn btn-small btn-grey w-130 js-AddToCartPopUp js-setPrimaryStore" data-id="'+placemark.STOCK+'">Выбрать</a>';
                html +=	'</div>';
            html +="</div>";
            return html;
        },
        Cart:function(placemark){
            var html = '<div class="map-item">';
                html += '<div class="contacts-item--address"><i class="fa fa-map-marker"></i>'+placemark.CONTENT.ADDRESS+'</div>';
                html +=	'<div class="contacts-item--phone"><i class="fa fa-phone"></i>'+placemark.CONTENT.PHONE+'</div>';
                html +=	'<div class="contacts-item--time"><i class="fa fa-clock-o"></i>'+placemark.CONTENT.TIME+'</div>';
                html +=	'<div class="contacts-item--text">'+placemark.CONTENT.TEXT+'</div>';
               html +=	'<div class="contacts-item--text">'+placemark.CONTENT.IN_STOCK+'</div>';
                html +=	'<div class="contacts-item--action">';
                    html +=	'<a href="#" data-id="'+placemark.ID+'" class="btn btn-small btn-grey w-130 js-ChangeStore">Выбрать</a>';
                html +=	'</div>';
            html +="</div>";
            return html;
        
        }
    },
    CreatCollection:function(){
        Contacts.collection = new ymaps.GeoObjectCollection(null, {
            balloonShadow: false,
            balloonLayout: MyBalloonLayout,
            balloonContentLayout: MyBalloonContentLayout,
            balloonPanelMaxMapArea: 0,

        });
    },
    createPlaceMark: function(item){
        var imgHref = '/local/media/images/map-icon.png';
        if (item.COLOR){
            imgHref = '/local/media/images/map-icon--'+item.COLOR+'.png';
        }
        var placemark = new ymaps.Placemark(item.CENTER, {
            id: item.ID,
            balloonContent: Contacts.balloonHtml(item)
        }, {
            iconLayout: 'default#image',
            iconImageHref: imgHref,
            iconImageSize: [34, 40],
            iconImageOffset: [-17, -40],
            hideIconOnBalloonOpen:true,
        });
        Contacts.collection.add(placemark);
    },
    balloonHtml: function(placemark){
        var template;
        if (placemark.TEMPLATE == "product")
            template = this.BallonTemplate.Product(placemark);
        else if (placemark.TEMPLATE == "cart")
            template = this.BallonTemplate.Cart(placemark);
        else 
            template = this.BallonTemplate.Contacts(placemark);
        return template;
    },
    creatLayoutClass: function(){
        MyBalloonLayout = ymaps.templateLayoutFactory.createClass(
            '<div class="yaPopUp-container">' +
                '<a class="yaPopUp-close" href="#"></a>' +
                    '$[[options.contentLayout observeSize minWidth=580 maxWidth=600 maxHeight=auto]]' +
            '</div>', {
            build: function () {
                this.constructor.superclass.build.call(this);
                this._$element = $('.yaPopUp-container', this.getParentElement());
                this.applyElementOffset();
                this._$element.find('.yaPopUp-close')
                    .on('click', $.proxy(this.onCloseClick, this));
            },
            clear: function () {
                this._$element.find('.yaPopUp-close')
                    .off('click');
                this.constructor.superclass.clear.call(this);
            },
            onSublayoutSizeChange: function () {
                MyBalloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);
                if(!this._isElement(this._$element)) {
                    return;
                }
                this.applyElementOffset();
                this.events.fire('shapechange');
            },
            applyElementOffset: function () {
                this._$element.css({
                    left: -58,
                    bottom: 18
                });
            },
            onCloseClick: function (e) {
                e.preventDefault();
                this.events.fire('userclose');
            },
            getShape: function () {
                var position = this._$element.position();
                return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                    [position.left, position.top], [
                        position.left + this._$element[0].offsetWidth,
                        position.top + this._$element[0].offsetHeight
                    ]
                ]));
            },
            _isElement: function (element) {
                return element && element[0] && element.find('.arrow')[0];
            }
        }),
        MyBalloonContentLayout = ymaps.templateLayoutFactory.createClass('$[properties.balloonContent]');
    },
    refreshMap:function(){
       if (ContactsPlaceMarksList.length > 1){            
            Contacts.myMap
                .setBounds(Contacts.myMap.geoObjects.getBounds());
        }
        else {
            Contacts.myMap.panTo(Contacts.myMap.geoObjects.getBounds(), {zoom: 10});
        }
    },
    findClosest:function(){
        //https://tech.yandex.ru/maps/jsbox/2.1/geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    var coords = [position.coords.latitude, position.coords.longitude];            
                    Contacts.closestPoint = Contacts.Geo.getClosestTo(coords);
                    Contacts.refreshMap();
                },
                function(error){
                    console.log(error);
                }
            );
        }
    },
    openOnMap:function(){
        $('body').on('click','.js-OpenOnMap',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.js-Tabs a[href="#tab-map"]').trigger('click');
            Contacts.collection.each(function (item) {
                if (item.properties.get('id') == id){
                    setTimeout(function() {
                        Contacts.myMap
                            .setBounds(item.geometry.getBounds());
                        Contacts.myMap.setZoom(14, {duration: 200});
                        item.balloon.open();
                    },210);
                }
            });
        });
    },
    inTab:function(){    
        $('body').on('click','.js-Tabs a',function(e){
            Contacts.myMap.events.add('sizechange', function(){
                Contacts.refreshMap();
            });
        });
    },
    init: function(){
        Contacts.myMap = new ymaps.Map('map', {
            center: [55.76, 37.64],
            zoom: 14,
            behaviors: ['default', 'scrollZoom']
        });
        Contacts.myMap.behaviors.disable('scrollZoom');
        Contacts.myMap.controls.remove('searchControl');
        Contacts.creatLayoutClass();
        Contacts.CreatCollection();
        Contacts.inTab();
        for (var i = 0, l = ContactsPlaceMarksList.length; i < l; i++) {
            Contacts.createPlaceMark(ContactsPlaceMarksList[i]);
        } 
        Contacts.myMap
            .geoObjects.add(Contacts.collection);
        
        Contacts.Geo = ymaps
            .geoQuery(Contacts.collection)         
            .then(Contacts.findClosest);
        Contacts.refreshMap();
        Contacts.openOnMap();
    }
}

ymaps.ready(Contacts.init);
