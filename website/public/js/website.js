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
$("input#voir-plus").click(function(e) {
	e.preventDefault();
	$("div#proj-card.hid:lt(8)").fadeIn("slow").removeClass("hid");
	if ($(".hid").length === 0)
	{
		$("div#line-btn-vp").remove();
	}
});

$("div#cours-liste:gt(7)").addClass("hid").hide();

$("input#voir-plus").click(function(e) {
	e.preventDefault();
	$("div#cours-liste.hid:lt(8)").fadeIn("slow").removeClass("hid");
	if ($(".hid").length === 0)
	{
		$("div#line-btn-vp").remove();
	}
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

var calendarComp = new ej.calendars.Calendar({
        isMultiSelection: true,
		values:[]
    });
calendarComp.appendTo('#cal-comp-dates');

// Traduction des jours dans les calendriers

// Traduction des mois

$('div.e-day.e-title').each(function () {
	var title = $(this).html();
	var month = title.substring(0, title.length - 5);
	var year = title.substring(title.length - 5, title.length);
	$(this).empty();
	switch (month) {
		case 'January':
			$(this).append('Janvier' + year);
			break;
		case 'February':
			$(this).append('Févrirer' + year);
			break;
		case 'March':
			$(this).append('Mars' + year);
			break;
		case 'April':
			$(this).append('Avril' + year);
			break;
		case 'May':
			$(this).append('Mai' + year);
			break;
		case 'June':
			$(this).append('Juin' + year);
			break;
		case 'July':
			$(this).append('Juillet' + year);
			break;
		case 'August':
			$(this).append('Août' + year);
			break;
		case 'September':
			$(this).append('Septembre' + year);
			break;
		case 'October':
			$(this).append('Octobre' + year);
			break;
		case 'November':
			$(this).append('Novembre' + year);
			break;
		case 'December':
			$(this).append('Decembre' + year);
	}
	$('thead.e-week-header').each(function () {
		$(this).empty();
		$(this).append('<tr>');
		$(this).append('<th>Di</th>');
		$(this).append('<th>Lu</th>');
		$(this).append('<th>Ma</th>');
		$(this).append('<th>Me</th>');
		$(this).append('<th>Je</th>');
		$(this).append('<th>Ve</th>');
		$(this).append('<th>Sa</th>');
		$(this).append('</tr>');
	});
});

$('div.e-control.e-calendar.e-lib.e-keyboard').each(function () {
	$(this).click(function () {
		$('div.e-day.e-title').each(function () {
			var title = $(this).html();
			var month = title.substring(0, title.length - 5);
			var year = title.substring(title.length - 5, title.length);
			$(this).empty();
			switch (month) {
				case 'January':
					$(this).append('Janvier' + year);
					break;
				case 'February':
					$(this).append('Févrirer' + year);
					break;
				case 'March':
					$(this).append('Mars' + year);
					break;
				case 'April':
					$(this).append('Avril' + year);
					break;
				case 'May':
					$(this).append('Mai' + year);
					break;
				case 'June':
					$(this).append('Juin' + year);
					break;
				case 'July':
					$(this).append('Juillet' + year);
					break;
				case 'August':
					$(this).append('Août' + year);
					break;
				case 'September':
					$(this).append('Septembre' + year);
					break;
				case 'October':
					$(this).append('Octobre' + year);
					break;
				case 'November':
					$(this).append('Novembre' + year);
					break;
				case 'December':
					$(this).append('Decembre' + year);
					break;
				default:
					$(this).append(month + year);
			}
			$('thead.e-week-header').each(function () {
				$(this).empty();
				$(this).append('<tr>');
				$(this).append('<th>Di</th>');
				$(this).append('<th>Lu</th>');
				$(this).append('<th>Ma</th>');
				$(this).append('<th>Me</th>');
				$(this).append('<th>Je</th>');
				$(this).append('<th>Ve</th>');
				$(this).append('<th>Sa</th>');
				$(this).append('</tr>');
			});
		});
	});
});



$('button.e-today').remove();


function parseDate (dateTable, inputName) {
	$.each(dateTable, function ( index, value ) {
		var str = value.toString();
		var day = str.substring(8,10);
		var monthName = str.substring(4,7);
		var year = str.substring(11,15);
		var month;
		switch (monthName) {
			case 'Jan':
				month = '01';
				break;
			case 'Feb':
				month = '02';
				break;
			case 'Mar':
				month = '03';
				break;
			case 'Apr':
				month = '04';
				break;
			case 'May':
				month = '05';
				break;
			case 'Jun':
				month = '06';
				break;
			case 'Jul':
				month = '07';
				break;
			case 'Aug':
				month = '08';
				break;
			case 'Sep':
				month = '09';
				break;
			case 'Oct':
				month = '10';
				break;
			case 'Nov':
				month = '11';
				break;
			case 'Dec':
				month = '12';
		}
		$('div#dates-crt-crs').append('<input type="text" name="' + inputName + '[]" value="'+ year + '-' + month + '-' + day + '" hidden>')
	});
}

$('#submit-btn-crt-crs').click(function() {
	parseDate(calendarDist.values, 'dates_dist');
	parseDate(calendarPres.values, 'dates_pres');
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

//["image1", "image2"]
