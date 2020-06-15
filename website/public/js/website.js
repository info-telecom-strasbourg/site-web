$(document).ready(function() {

    // color navbar when loading page
    if (window.location.pathname == '/') {
        var rgba = $(document).scrollTop() / 500;
        $('.fixed-top').css('background-color', 'rgba(92, 111, 163,' + rgba + ')');
    }
    else {
        $('.fixed-top').css('background-color', 'rgb(92, 111, 163)');
    }

    /* Scroll */

    // function when user scrolls
    $(document).on('scroll', function(e) {
        if (window.location.pathname != '/')
            return;
        var rgba = $(document).scrollTop() / 500;

        // change the color of the navbar 
        // (from transparent to blue) when scrolling down
        $('.fixed-top').css('background-color', 'rgba(92, 111, 163,' + rgba + ')');

        // if the user scrolls the black filter is removed from the collapse navbar
        $('.navbar-collapse').css('background-color', 'transparent');

        // if the user scrolls to the top, 
        // a black filter is added to the collapse navbar
        if (!$("body").hasClass("xl")) {
            if ($(document).scrollTop() == 0) {
                $('.navbar-collapse').css('background-color', 'rgba(0, 0, 0, 0.7)');
            }
        }
    });

    var $item = $('.carousel-item'); // get carousel item
    var $wHeight = $(window).height(); // get window height

    $item.height($wHeight); // set height of carousel item to window height


    // Remove hide button that is used to center links 
    // in the navbar when the navbar is collapsed
    if (!$("body").hasClass("xl")) {
        $(".hidden").remove();
    }

    // Update on window resize
    $(window).resize(function() {

        $(".hidden").remove(); // remove it
        if ($("body").hasClass("xl")) {
            // Remove hide button that is used to center links 
            // in the navbar when the navbar is collapsed to be sure that we don't
            // add it two times, then add it

            $(".not-shown").html("<li class='nav-item hidden'><a href='#'' class='btn btn-rounded btn-primary connexion' type='button'>CONNEXION</a></li>"); // add it
            $('.navbar-collapse').css('background-color', 'transparent');
        } else {
            $('.navbar-collapse').css('background-color', 'rgba(0, 0, 0, 0.7)');
        }
    });
});