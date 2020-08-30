// Activate tooltip
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
});

/*** Parse the datas from the calendar
	 From "sun jan 03 2020" to "2020-01-03"
***/
function convertMonth(value) {
    var str = value.toString();
    var day = str.substring(8, 10);
    var monthName = str.substring(4, 7);
    var year = str.substring(11, 15);
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

    return [year, month, day];
}

function parseDate(dateTable, inputName, divSelect) {
    if (Array.isArray(dateTable))
        $.each(dateTable, function(index, value) {
            var datesComposed = convertMonth(value);
            $(divSelect).append('<input type="text" name="' + inputName + '[]" value="' + datesComposed[0] + '-' + datesComposed[1] + '-' + datesComposed[2] + '" hidden>');
        });
    else {
        var datesComposed = convertMonth(dateTable);
        $(divSelect).append('<input type="text" name="' + inputName + '" value="' + datesComposed[0] + '-' + datesComposed[1] + '-' + datesComposed[2] + '" hidden>');
    }
}

/*** Translate the calendars ***/
function translateCalendar(that) {
    var title = that.html();
    var month = title.substring(0, title.length - 5);
    var year = title.substring(title.length - 5, title.length);
    that.empty();
    switch (month) {
        case 'January':
            that.append('Janvier' + year);
            break;
        case 'February':
            that.append('Févrirer' + year);
            break;
        case 'March':
            that.append('Mars' + year);
            break;
        case 'April':
            that.append('Avril' + year);
            break;
        case 'May':
            that.append('Mai' + year);
            break;
        case 'June':
            that.append('Juin' + year);
            break;
        case 'July':
            that.append('Juillet' + year);
            break;
        case 'August':
            that.append('Août' + year);
            break;
        case 'September':
            that.append('Septembre' + year);
            break;
        case 'October':
            that.append('Octobre' + year);
            break;
        case 'November':
            that.append('Novembre' + year);
            break;
        case 'December':
            that.append('Decembre' + year);
            break;
        default:
            that.append(month + year);
    }
    $('thead.e-week-header').each(function() {
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
}

/*** Create variables to store the informations from the calendars ***/

var calendarPres = new ej.calendars.Calendar({
    isMultiSelection: true,
    values: []
});
calendarPres.appendTo('#cal-pres-dates');

var calendarDist = new ej.calendars.Calendar({
    isMultiSelection: true,
    values: []
});
calendarDist.appendTo('#cal-dist-dates');

var calendarComp = new ej.calendars.Calendar({
    isMultiSelection: true,
    values: []
});
calendarComp.appendTo('#cal-comp-dates');

/*** Translate the calendar after the user changed the month ***/
$('div.e-day.e-title').each(function() {
    translateCalendar($(this));
});

/*** Translate the calendar after the user changed the month ***/
$('div.e-control.e-calendar.e-lib.e-keyboard').each(function() {
    $(this).click(function() {
        $('div.e-day.e-title').each(function() {
            translateCalendar($(this));
        });
    });
});

/*** Just to delete a button on the calendar ***/
$('button.e-today').remove();

/*** Hide the title to select files visibility in create page
	If there is no file selected, it will remains hidden
***/
$('#choose-visibility').hide();

/* ##########################   Hide elements and button see more  ########################## */

/*** Hide the elements if there is more than 6***/
$(".element:gt(5)").addClass("hid").hide();
$(".comment-thread:gt(5)").addClass("hid").hide();
$(".comment-reply:gt(5)").addClass("hid").hide();

/*** If there is more than 6 elements, some are hidden.
 * This function will display 6 more elements ***/
function seeMore(element, btnToHide) {
    $("." + element + ".hid:lt(6)").fadeIn("slow").removeClass("hid");
    if ($("." + element + ".hid").length === 0) {
        $(btnToHide).remove();
    }
}

/**
 * Show more comments replies.
 * @param {*} element element to show
 * @param {*} btnToHide button to hide when all elements are shown
 */
function seeMoreComments(element, btnToHide) {
    $("." + element + ".hid:lt(6)").addClass("d-flex");
    $("." + element + ".hid:lt(6)").addClass("align-items-start");
    $("." + element + ".hid:lt(6)").fadeIn("slow").removeClass("hid");
    if ($("." + element + ".hid").length === 0) {
        $(btnToHide).remove();
    }
}

/* ##########################   Show / hide password on profil page ########################## */
$(".reveal").on('click', function() {
    var $pwd = $(".pwd");
    var $icon = $(".eye-icon");

    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
        $icon.removeClass('fa-eye');
        $icon.addClass('fa-eye-slash');
    } else {
        $pwd.attr('type', 'password');
        $icon.removeClass('fa-eye-slash');
        $icon.addClass('fa-eye');
    }
});

$(".reveal-confirm").on('click', function() {
    var $pwd = $(".pwd-confirm");
    var $icon = $(".eye-icon-confirm");

    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
        $icon.removeClass('fa-eye');
        $icon.addClass('fa-eye-slash');
    } else {
        $pwd.attr('type', 'password');
        $icon.removeClass('fa-eye-slash');
        $icon.addClass('fa-eye');
    }
});

/* ##########################   Show search bar on profil page  ########################## */
/**
 * Shows the search bar
 * @param {string} id id of the search input to show
 */
function showSearchBar(id) {
    if ($('#' + id).hasClass('disabled')) {
        $('#' + id).addClass('show');
        $('#' + id).removeClass('disabled');
    } else {
        $('#' + id).removeClass('show');
        $('#' + id).addClass('disabled');
    }
}

/*** Enable tooltips ***/
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
});

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
    });

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
        var $item = $('#carousel-actualite .carousel-item'); // get carousel item
        var $wHeight = $(window).height(); // get window height

        $item.height($wHeight); // set height of carousel item to window height
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
     * by adding a class
     */
    $(document).mouseup(function(e) {
        var link = $("#navbarDropdownMenuLink");

        // Remove the class
        if (link.has(e.target).length === 0 && $('#poles').hasClass("show")) {
            $('#poles').removeClass('dropdown-click');
        } else if (link.is(e.target)) { // Add the class
            $('#poles').addClass('dropdown-click');
        }
    });

    /* ##########################   Reset Projets filter   ########################## */
    /*
     * If reset value in select menu is selected the below code changes the
     * text of the reset option and submit filter form.
     */

    /*** Reset pole filter ***/
    $('#pole').change(function() {
        // get the selected option
        var pole = $("#pole option:selected");

        // if the option has the name reset, change the text
        if (pole.is('[name="reset"]')) {
            $('#pole option[name="reset"]').text('Pôle');
            $('.filter-options').submit();
        }
    });

    /*** Reset membre filter ***/
    $('#membre').change(function() {
        // get the selected option
        var membre = $("#membre option:selected");

        // if the option has the name reset, change the text
        if (membre.is('[name="reset"]')) {
            $('#membre option[name="reset"]').text('Membre');
            $('.filter-options').submit();
        }
    });

    /*** Reset partner filter ***/
    $('#partner').change(function() {
        // get the selected option
        var partner = $("#partner option:selected");

        // if the option has the name reset, change the text
        if (partner.is('[name="reset"]')) {
            $('#partner option[name="reset"]').text('Collaborateur');
            $('.filter-options').submit();
        }
    });

    /*** Reset trie filter ***/
    $('#trie').change(function() {
        // get the selected option
        var trie = $("#trie option:selected");

        // if the option has the name reset, change the text
        if (trie.is('[name="reset"]')) {
            $('#trie option[name="reset"]').text('Trié par');
            $('.filter-options').submit();
        }
    });

    /*** Remove the files selected if you refresh the page ***/
    $('input[type="file"]#link_support').val('');
    $('input[type="file"]#link_support_mod').val('');


    /*** Create checkbox for each file to choose wich one will be private  ***/
    $('input[type="file"]#link_support').change(function(e) {
        if (e.target.files.length === 0)
            $('#choose-visibility').hide();
        else
            $('#choose-visibility').fadeIn("slow");

        $('div#choose-visibility').empty();
        $(e.target.files).each(function() {
            $('div#choose-visibility').append('<div>\
				<input type="checkbox" id="' + this.name + '" name="visibility[' + this.name + ']" >\
				<label for="' + this.name + '">' + this.name + '</label>\
			</div>');
        });
    });

    /*** Add the select list to choose the visibility for the new file ***/
    $('input[type="file"]#link_support_mod').change(function(e) {
        if (e.target.files.length === 0)
            $('div.to-hide').hide();
        else
            $('div.to-hide').fadeIn("slow");

        $('div#new-files').remove();

        $(e.target.files).each(function() {
            $('div#choose-new-statut').append('<div id="new-files" class="row justify-content-start">\
				<div class="col-auto">' + this.name + '</div>\
				<div class="col-auto">\
					<div class="form-group">\
						<select class="form-control form-control-sm" name="visibility_new[]">\
							<option value="0">Public</option>\
							<option value="1" selected>Privé</option>\
						</select>\
					</div>\
				</div>\
				</div>');
        });
    });

    /*** Convert the dates given by the calendar in date for the database ***/
    $('button#submit-btn-crt-crs').click(function() {
        parseDate(calendarDist.values, 'dates_dist', 'div#dates-select');
        parseDate(calendarPres.values, 'dates_pres', 'div#dates-select');
    });

    /* ########## Compétitions ##########*/

    /*** Prevent the user to put more than 3 images for a compétition ***/
    $('button#create-cpt.compet').click(function(e) {
        var fileUpload = $('input#images');
        var cover = $('input#cover');
        var problem = false;
        if (parseInt(fileUpload.get(0).files.length) > 3) {
            e.preventDefault();
            $('input#images').val('');
            alert("3 images maximums");
            problem = true;
        }

        if (calendarComp.values.length === 0) {
            e.preventDefault();
            alert("Il faut au moins une date pour la compétition");
            problem = true;
        }
        if (!problem) {
            parseDate(calendarComp.values, 'dates_comp', 'div#dates-select');
        }
    });


    /*** Create the calendars ***/
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