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

// Hide the project if there is too much project to display (keep 8 projects)
$("div#proj-card:gt(7)").addClass("hid").hide();


//display more if the user click on the button
$("div#voir-plus").click(function(e) {
	e.preventDefault();
	$("div#proj-card.hid:lt(8)").fadeIn("slow").removeClass("hid");
});

//Download multiple files
$("#download-sup").click(function(e) {
	e.preventDefault();
	$("input[type=checkbox]#file-select:checked").each(function () {
		// alert("/supports/"+ $(this).attr("name"));
		window.open("/supports/"+ $(this).attr("name"), "_blank", null);
	});
});

$('input[type="file"]#link_support').val('');

//Create checkbox for each file
$('input[type="file"]#link_support').change(function(e) {
	$('div#choose-visibility').empty();
	$(e.target.files).each(function () {
		$('div#choose-visibility').append('<div>');
		$('div#choose-visibility').append('<input type="checkbox" id="' + this.name + '" name="visibility[' + this.name +']" >');
		$('div#choose-visibility').append('<label for="' + this.name + '">' + this.name + '</label>');
		$('div#choose-visibility').append('</div>');
	});
});
