/* Scroll */

// function when user scrolls
$(document).on('scroll', function(e) {
    var rgba = $(document).scrollTop() / 500;

    // change the color of the navbar 
    // (from transparent to blue) when scrolling down
    $('.fixed-top').css('background-color', 'rgba(92, 111, 163,' + rgba + ')');

    // if the user scrolls the black filter is removed from the collapse navbar
    $('.navbar-collapse').css('background-color', 'transparent');

    // if the user scrolls to the top, 
    // a black filter is added to the collapse navbar
    if ($(window).width() < 1188) {
        if ($(document).scrollTop() == 0) {
            $('.navbar-collapse').css('background-color', 'rgba(0, 0, 0, 0.7)');
        }
    }
})

// Remove hide button that is used to center links 
// in the navbar when the navbar is collapsed
if ($(window).width() < 1188) {
    $(".hidden").remove();
}

/* Resize */

var $item = $('.carousel-item'); // get carousel item
var $wHeight = $(window).height(); // get window height

$item.height($wHeight); // set height of carousel item to window height

// on resize of the window
$(window).on('resize', function() {
    $wHeight = $(window).height(); // get window height
    $item.height($wHeight); // set height of carousel item to window height

    // Remove hide button that is used to center links 
    // in the navbar when the navbar is collapsed
    if ($(window).width() < 1188) {
        $(".hidden").remove();
        $('.navbar-collapse').css('background-color', 'rgba(0, 0, 0, 0.7)');
    } else {
        // Remove hide button that is used to center links 
        // in the navbar when the navbar is collapsed to be sure that we don't
        // add it two times, then add it

        $(".hidden").remove(); // remove it 
        $(".not-shown").html("<li class='nav-item hidden'><a href='#'' class='btn btn-rounded btn-primary connexion' type='button'>CONNEXION</a></li>"); // add it

        $('.navbar-collapse').css('background-color', 'transparent');
    }
});