$(function(){
    $('body').on('change','.js-SearchStock',function(){
        var search = $(this).val();
        Contacts.search(search);
    });
    $('body').on('click','.js-setPrimaryStore',function(e){
        e.preventDefault();
        var _self = $(this),
            id = _self.data('id');
        $.ajax({
            url:OptimalGroup.AJAX_PATH+'store-session.php',
            data:{
                CODE:"PRIMARY_STORE",
                VALUE:id
            },
            success:function(data){
                console.log(data);
                
            }
        })
    });
});
Contacts.currentPoints = {};
Contacts.search = function(request){
    if (request){
        var arIds = $.parseJSON(request);
        this.collection.each(function (item, i) {
            if ($.inArray(item.properties.get('id'), arIds) != -1){
                Contacts.currentPoints = item.geometry.getBounds();
            }
        });
        this.myMap.panTo(this.currentPoints, {zoom: 10});
        
        $('.stock-tr').hide();
        for (var i in arIds){
            var tr = arIds[i];
            $('#stock-'+tr).show();
        }
    }
    else {
        $('.stock-tr').show();
        this.myMap
                .setBounds(this.myMap.geoObjects.getBounds());
    }
};