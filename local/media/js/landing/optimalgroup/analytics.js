OptimalGroup.analytics  = {
    init: function(){
        $('body').on('click', '[data-ga], [data-ym]', 
            function(e){/*EVENT SUBMIT DATA*/
                var data = $(this).data();
                OptimalGroup.analytics.Submit(data);
            }
        ); 
    },
    Submit: function(data){
        if (data.ym && window.yaCounterCode){
            var yam = eval(window.yaCounterCode);
            yam.reachGoal(data.ym);
        }
        /*if (data.ga && window.gaCounterCode && typeof ga == "function"){
            ga('send', 'event', data.ga.category, data.ga.action);
        }*/
        if (typeof dataLayer !== 'undefined' && window.gaCounterCode){
            console.log(typeof dataLayer !== 'undefined');
            dataLayer.push({'event': data.ga.action});
        }
    }
}