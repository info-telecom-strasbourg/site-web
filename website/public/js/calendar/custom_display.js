// Edit your ics sources here
ics_sources = [
    { url: '/ITS.ics', title: 'ITS', event_properties: { color: 'DeepPink' } }
]



////////////////////////////////////////////////////////////////////////////
//
// Here be dragons!
//
////////////////////////////////////////////////////////////////////////////

function data_req(url, callback) {
    req = new XMLHttpRequest()
    req.addEventListener('load', callback)
    req.open('GET', url)
    req.send()
}

function add_recur_events() {
    if (sources_to_load_cnt < 1) {
        $('#calendar').fullCalendar('addEventSource', expand_recur_events)
    } else {
        setTimeout(add_recur_events, 30)
    }
}


function load_ics(ics, cpt) {
    data_req(ics.url, function () {
        $('#calendar').fullCalendar('addEventSource', fc_events(this.response, ics.event_properties))
        sources_to_load_cnt -= 1;
    })
    // Meddling with the HTML to add everything related to our ics feeds dynamically
    // hidden ics feeds
    document.getElementById("ics-feeds").insertAdjacentHTML('beforeend', "<span hidden id='ics-url" + cpt + "'>" + ics.url + "</span>");

    // calendar legend
    document.getElementById("legend-feeds").insertAdjacentHTML('beforeend', "    <div class='calendar-feed'>" +
        "<span class='fc-event-dot' style='background-color: " + ics.event_properties['color'] + "'></span>" +
        "<span> " + ics.title + " <button id='copyLink" + cpt + "'>" +
        "<img src='./img/clipboard.svg' alt='copy to clipboard' title='copy to clipboard' width='15px' style='padding-top: 3px;'/></button></span></div>");

    // copy button for ics feeds
    document.querySelector("#copyLink" + cpt).addEventListener("click", function () { copy("ics-url" + cpt); });
}


$(document).ready(function () {

    // display events
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek,listMonth'
        },
        defaultView: 'month',
        firstDay: '1',
        locale: 'fr',
        lang: 'fr',

        // customize the button names,
        // otherwise they'd all just say "list"
        views: {
            listWeek: { buttonText: 'Liste hebdo' },
            listMonth: { buttonText: 'Liste mensuelle' }
        },
        navLinks: true,
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        eventRender: function (event, element, view) {
            if (view.name == "listMonth" || view.name == "listWeek") {
                element.find('.fc-list-item-title').append('<div style="margin-top:5px;"></div><span style="font-size: 0.9em">' + (event.description || '---') + '</span>' + ((event.loc) ? ('<span style="margin-top:5px;display: block"><b>Lieu: </b>' + event.loc + '</span>') : ' ') + '</div>');
            } else {
                element.qtip({
                    content: {
                        text: '<small>' + ((event.start.format("d") != event.end.format("d")) ? (event.start.format("MMM Do")
                            + (((event.end.subtract(1, "seconds")).format("d") == event.start.format("d")) ? ' ' : ' - '
                                + (event.end.subtract(1, "seconds")).format("MMM Do"))) : (event.start.format("HH:mm")
                                    + ' - ' + event.end.format("HH:mm"))) + '</small><br/>' +
                            '<b>' + event.title + '</b>' +
                            ((event.description) ? ('<br/>' + event.description) : ' ') +
                            ((event.loc) ? ('<br/><b>Lieu: </b>' + event.loc) : ' ')
                    },
                    style: {
                        classes: 'qtip-bootstrap qtip-rounded qtip-shadown qtip-light',
                    },
                    position: {
                        my: 'top left',
                        at: 'bottom center',
                    }
                });
            }
        }
    })
    sources_to_load_cnt = ics_sources.length
    var cpt = 0;
    for (ics of ics_sources) {
        cpt += 1;
        load_ics(ics, cpt)
    }
    add_recur_events()
})

