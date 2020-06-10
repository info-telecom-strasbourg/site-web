// permet de faire en sorte que le carousel fasse exactement la taille de l'écran
// de l'utilisateur

var $item = $('#carouselExampleIndicators .carousel-item');
var $wHeight = $(window).height();

$item.height($wHeight);
$item.addClass('full-screen');

$(window).on('resize', function() {
    $wHeight = $(window).height();
    $item.height($wHeight);
});

$('#recipeCarousel').carousel({
    interval: 10000
})

$('#nos-projets .carousel .carousel-item').each(function() {
    var minPerSlide = 3;
    var next = $(this).next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i = 0; i < minPerSlide; i++) {
        next = next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }

        next.children(':first-child').clone().appendTo($(this));
    }
});