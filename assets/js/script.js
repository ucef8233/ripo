// // Can also be used with $(document).ready()
// $(window).on('load', function () {
//     $('.flexslider').flexslider({
//         animation: "slide"
//     });
// });


$('.carousel').carousel({
    interval: 2000,
    animation: "slide"
})
// Enable Carousel Indicators
$(".item").click(function(){
    $("#myCarousel").carousel(1);
  });


