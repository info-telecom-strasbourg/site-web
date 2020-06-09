// permet de faire en sorte que le carousel fasse exactement la taille de l'écran
// de l'utilisateur

var $item = $('.carousel-item');
var $wHeight = $(window).height();

$item.height($wHeight);
$item.addClass('full-screen');

$('.carousel img').each(function() {
    var $src = $(this).attr('src');
    var $color = $(this).attr('data-color');
    $(this).parent().css({
        'background-image': 'url(' + $src + ')',
        'background-color': $color
    });
    $(this).remove();
});

$(window).on('resize', function() {
    $wHeight = $(window).height();
    $item.height($wHeight);
});