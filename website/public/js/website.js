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

//////

$(document).ready(function() {
    $('#datepicker').datepicker({
        startDate: new Date(),
        multidate: true,
        format: "dd/mm/yyyy",
        daysOfWeekHighlighted: "5,6",
        datesDisabled: ['31/08/2017'],
        language: 'en'
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
        $(this).find('.input-group-addon .count').text(' ' + e.dates.length);
    });
});


////////////////////////////////////////////////////////////////

/* ########## Pour les calendriers ##########*/
var calendarPres = new ej.calendars.Calendar({
        isMultiSelection: true,
		values:[]
    });
calendarPres.appendTo('#cal-pres-dates');

var calendarDist = new ej.calendars.Calendar({
        isMultiSelection: true,
		values:[]
    });
calendarDist.appendTo('#cal-dist-dates');

var calendarDist = new ej.calendars.Calendar({
        isMultiSelection: true,
		values:[]
    });
calendarDist.appendTo('#cal-comp-dates');

$('#submit-btn').click(function() {

});

$('button.e-today').remove();

/* TODO: Parser les dates */

// A enlever à la fin 
$('#submit-btn').click(function() {
	alert("OK");
	alert(calendarDist.values.join("////"));
	alert(calendarPres.values.join("////"));
});


/* ########## Compétitions ##########*/

//Max 3 Images
$("button.compet").click(function(e){
    var $fileUpload = $("input#images");
    if (parseInt($fileUpload.get(0).files.length)>3){
		e.preventDefault();
		$("input#images").val('');
		alert("3 images maximums !!");
    }
});

// TODO: vérifier si une date à été mises
