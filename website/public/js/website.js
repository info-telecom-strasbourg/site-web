$(document).ready(function() {
    // color navbar when loading page
    if (window.location.pathname == '/') {
        var rgba = $(document).scrollTop() / 500;
        // Adjust the background color of the navbar when the navbar is collapsed
        $('.fixed-top').css('background-color', 'rgba(92, 111, 163,' + rgba + ')');
        if ($(document).scrollTop() != 0) {
            $('.navbar-collapse').css('background-color', 'transparent');
        }
    } else {
        // Adjust the background color of the navbar when the navbar is collapsed
        $('.fixed-top').css('background-color', 'rgb(92, 111, 163)');
        if (!$("body").hasClass("xl")) {
            $('.navbar-collapse').css('background-color', 'transparent');
        }
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
    })

    var $item = $('#carousel-actualite .carousel-item'); // get carousel item
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
            // Adjust the background color of the navbar when the navbar is collapsed
            $('.navbar-collapse').css('background-color', 'rgba(0, 0, 0, 0.7)');
            if ((window.location.pathname != '/') || ($(document).scrollTop() != 0)) {
                $('.navbar-collapse').css('background-color', 'transparent');
            }
        }
    });

    // The amount of time to delay between automatically cycling an item.
    $('#recipeCarousel').carousel({
        interval: 10000
    })

    // Allows to correctly animate the multiple carousel (for projects)
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

    //Allows to progressively descend the page to move to the contact section
    if (window.location.pathname == '/') {
        $('.js-scrollTo').on('click', function() {
            var page = $('.js-scrollTo').attr('href');
            var anchor = page.substring(1, page.length);
            var speed = 750;
            $('html, body').animate({ scrollTop: $(anchor).offset().top }, speed);
            return false;
        });
    }

     /* Add background color to nav-item Pôles if the dropdown is expanded
        by adding a class
      */
    $(document).mouseup(function(e){
        var link = $("#navbarDropdownMenuLink");

        // Remove the class 
        if(link.has(e.target).length === 0 && $('#poles').hasClass("show")){
            $('#poles').removeClass('dropdown-click');
        }
        else if (link.is(e.target)) {   // Add the class 
            $('#poles').addClass('dropdown-click');
        }
    });
});