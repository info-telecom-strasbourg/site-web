$(document).ready(function() {
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
        if (!$("body").hasClass("xl")) {
            if ($(document).scrollTop() == 0) {
                $('.navbar-collapse').css('background-color', 'rgba(0, 0, 0, 0.7)');
            }
        }
    })

    var $item = $('#carouselExampleIndicators .carousel-item'); // get carousel item
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


$(document).ready(function() {
    $('.js-scrollTo').on('click', function() { // Au clic sur un élément
        var page = $(this).attr('href'); // Page cible
        var speed = 750; // Durée de l'animation (en ms)
        $('html, body').animate({ scrollTop: $(page).offset().top }, speed); // Go
        return false;
    });
});