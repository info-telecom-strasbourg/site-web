// permet de faire en sorte que le carousel fasse exactement la taille de l'écran
// de l'utilisateur

var $item = $('.carousel-item');
var $wHeight = $(window).height();

$item.height($wHeight);
$item.addClass('full-screen');

$(window).on('resize', function() {
    $wHeight = $(window).height();
    $item.height($wHeight);
});