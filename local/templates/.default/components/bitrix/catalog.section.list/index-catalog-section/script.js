$(function(){
    $('.shop-section--carousel').slick({
        nav:true,
        infinite: true,
        slidesToShow:5,
        margin:15,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow:4,
                },
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow:3,
                },
            },
            {
                breakpoint: 766,
                settings: {
                    slidesToShow:2,
                },
            },
            {
                breakpoint: 576,
                settings: "unslick"             
            }
        ]
    });
});