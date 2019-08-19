$(function(){
    $('.partners-slider').slick({
        nav:true,
        infinite: true,
        slidesToShow:4,
        responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow:3,
            }
        },{
            
            breakpoint: 768,
            settings: {
                slidesToShow:2,
            }
        },{
            
            breakpoint: 575,
            settings: {
                slidesToShow:1,
            }
        }
        ]
    })
    .on('afterChange', function(event, slick, direction){
        OptimalGroup.LoadHiddenImg();
    });
});