$(document).on('scroll', function(e) {
    if ($(window).width() > 992) {
        var rgba = $(document).scrollTop() / 500;
        $('.navbar').css('background-color', 'rgba(92, 111, 163,' + rgba + ')');
    }
})