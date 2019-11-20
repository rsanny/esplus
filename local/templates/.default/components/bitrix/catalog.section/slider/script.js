$(document).ready(function () {
    $('.product-slider').slick({
        nav:true,
        infinite: true,
        slidesToShow:4,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow:3,
                },
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow:2,
                },
            },
            {
                breakpoint: 766,
                settings: "unslick",
            }
        ]
    })
    .on('afterChange', function(event, slick, direction){
        OptimalGroup.LoadHiddenImg();
    });
});