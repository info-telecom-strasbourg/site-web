$(document).on('scroll', function(e) {
    var rgba = $(document).scrollTop() / 500;
    $('.fixed-top').css('background-color', 'rgba(92, 111, 163,' + rgba + ')');

})