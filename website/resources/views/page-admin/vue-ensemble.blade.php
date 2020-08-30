@extends('layouts.layout')

@section('title', 'Admin')

@section('breadcrumb')

@endsection

@section('content')

<style>
    #content {
        padding-bottom: 0;
    }
    @media only screen and (max-width: 992px) {
        #content {
            padding-bottom: 150px;
        }
    }
</style>


<section class="dark-page" id="vue-ens">
	<!-- Navbar dark version -->
	<div class="bandeau-dark">
		<div class="dropdown">
			<a class="btn btn-secondary dropdown-toggle total" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
				{{ Auth::user()->name }}
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="#">Profil</a>
				<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
				document.getElementById('logout-form').submit();">
				Déconnexion
			</a>

			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</div>
	</div>

	<div class="dropdown">
		<button class="btn btn-secondary dropdown-toggle short" type="button" data-toggle="dropdown">
			<img class="profil-rounded" src="{{ asset('storage/' . Auth::user()->profil_picture) }}">
		</button>
		<div class="dropdown-menu dropdown-menu-right">
			<a class="dropdown-item" href="/users/{{ Auth::user()->id }}">Profil</a>
			<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
			document.getElementById('logout-form').submit();">
			Déconnexion
		</a>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			@csrf
		</form>
	</div>
</div>
</div>
<div class="nav flex-column nav-pills short" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
	<div class="navbar-dark-brand" href="/">
		<a href="/">
			<img src="/images/logo/logo-dark.png" width="90" height="100%" alt="Logo du site">
		</a>
	</div>
	<a class="nav-link active" href="#">VUE D'ENSEMBLE</a>
	<a class="nav-link" href="/page-admin/membres">MEMBRES</a>
	<a class="nav-link" href="/page-admin/actualites">ACTUALITÉS</a>
</div>
    <div class="container">
        <div class="nav flex-column nav-pills total" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <div class="navbar-dark-brand" href="/">
                <a href="/">
                    <img src="/images/logo/logo-dark.png" width="90" height="90" alt="Logo du site">
                </a>
            </div>
            <a class="nav-link active" href="#">VUE D'ENSEMBLE</a>
            <a class="nav-link" href="/page-admin/membres">MEMBRES</a>
            <a class="nav-link" href="/page-admin/actualites">ACTUALITÉS</a>
        </div>
        <div class="tab-content" id="v-pills-tabContent" style="padding-bottom: 300px">
            <div class="tab-pane fade show active" id="v-pills-ens" role="tabpanel" aria-labelledby="v-pills-ens-tab">
                <h1 class="title lg text-center"> Vue d'ensemble </h1>
                <hr class="line-under-title" style="margin-bottom: 100px;">
                <!-- Show statistics -->
                <div id="widgets_container">
                    <div class="widget" id="views-container">
                        <h2>Pages vues</h2>
                        <div class="widget-content" id="views"></div>
                    </div>
                    <div class="widget" id="viewsBySession-container">
                        <h2>Pages vues par session</h2>
                        <div class="widget-content" id="viewsBySession"></div>
                    </div>
                    <div class="widget" id="visitors-container">
                        <h2>Utilisateurs</h2>
                        <div class="widget-content" id="visitors"></div>
                    </div>
                    <div class="widget" id="views-container">
                        <h2>Nouveaux utilisateurs</h2>
                        <div class="widget-content" id="newUsers"></div>
                    </div>
                    <div class="widget" id="sessions-container">
                        <h2>Sessions</h2>
                        <div class="widget-content" id="sessions"></div>
                    </div>
                    <div class="widget" id="bounceRate-container">
                        <h2>Taux de rebond</h2>
                        <div class="widget-content" id="bounceRate"></div>
                    </div>
                    <div class="widget" id="durationSession-container">
                        <h2>Durée moyenne par session</h2>
                        <div class="widget-content" id="durationSession"></div>
                    </div>
                    <div class="widget" id="durationPage-container">
                        <h2>Durée moyenne par page</h2>
                        <div class="widget-content" id="durationPage"></div>
                    </div>
                    <div class="widget" id="numberMembers-container">
                        <h2>Nombre de membres</h2>
                        <p>{{ $nbUsers }}</p>
                    </div>
                    <div class="widget" id="numberProjects-container">
                        <h2>Nombre de projets</h2>
                        <p>{{ $nbProjets }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Google Analytics -->
<?php
// Autoloader integration
require_once __DIR__ . '/../../../vendor/autoload.php';

$analytics = initializeAnalytics();
$profile = getFirstProfileId($analytics);

// Initialization and authentication function
function initializeAnalytics()
{
    // Json file path
    $KEY_FILE_LOCATION = __DIR__ . '/../../../site-web-its-7c23329334b3.json';

    // Creation and configuration of the new client
    $client = new Google_Client();
    $client->setApplicationName("Hello Analytics Reporting");
    $client->setAuthConfig($KEY_FILE_LOCATION);
    $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
    $analytics = new Google_Service_Analytics($client);
    return $analytics;
}

// Get the Google Analytics profile
function getFirstProfileId($analytics)
{
    // Get the accounts list
    $accounts = $analytics->management_accounts->listManagementAccounts();

    if (count($accounts->getItems()) > 0) {
        $items = $accounts->getItems();
        $firstAccountId = $items[0]->getId();

        // Get the properties list
        $properties = $analytics->management_webproperties
            ->listManagementWebproperties($firstAccountId);

        if (count($properties->getItems()) > 0) {
            $items = $properties->getItems();
            $firstPropertyId = $items[0]->getId();

            // Get the profiles list
            $profiles = $analytics->management_profiles
                ->listManagementProfiles($firstAccountId, $firstPropertyId);

            if (count($profiles->getItems()) > 0) {
                $items = $profiles->getItems();

                // Return the first profile id
                return $items[0]->getId();
            } else {
                throw new Exception('No views (profiles) found for this user.');
            }
        } else {
            throw new Exception('No properties found for this user.');
        }
    } else {
        throw new Exception('No accounts found for this user.');
    }
}
// Get views, users and sessions
$results = getChartresults($analytics, $profile, 'ga:pageviews,ga:users,ga:sessions,ga:pageviewsPerSession, ga:avgSessionDuration, ga:avgTimeOnPage, ga:bounceRate, ga:newUsers');

// Get data during a period
function getChartresults($analytics, $profileId, $metric)
{
    return $analytics->data_ga->get(
        'ga:' . $profileId,
        '30daysAgo',
        'today',
        $metric,
        array(
            'dimensions' => 'ga:Date'
        )
    );
}

// Create a json array readable by javascript
function buildChartArrayViews($results)
{
    if (count($results->getRows()) > 0) {
        $rows = $results->getRows(); // Count the lines
        $array = [["Date", "Pages Vues"]]; // Array initialization
        foreach ($rows as $date) { // For each date
            $datejour = substr($date[0], -2, 2) . "/" . substr($date[0], -4, 2); // Date formatting
            array_push($array, [$datejour, (int)$date[1]]); // Add the date and data on the array
        }
        $js_array = json_encode($array); // Encode in json
        return $js_array; // Return the json array
    } else {
        return "Pas de résultat.\n";
    }
}

// Create a json array readable by javascript
function buildChartArrayVisitors($results)
{
    if (count($results->getRows()) > 0) {
        $rows = $results->getRows(); // Count the lines
        $array = [["Date", "Utilisateurss"]]; // Array initialization
        foreach ($rows as $date) { // For each date
            $datejour = substr($date[0], -2, 2) . "/" . substr($date[0], -4, 2); // Date formatting
            array_push($array, [$datejour, (int)$date[2]]); // Add the date and data on the array
        }
        $js_array = json_encode($array); // Encode in json
        return $js_array; // Return the json array
    } else {
        return "Pas de résultat.\n";
    }
}

// Create a json array readable by javascript
function buildChartArraySessions($results)
{
    if (count($results->getRows()) > 0) {
        $rows = $results->getRows(); // Count the lines
        $array = [["Date", "Sessions"]]; // Array initialization
        foreach ($rows as $date) { // For each date
            $datejour = substr($date[0], -2, 2) . "/" . substr($date[0], -4, 2); // Date formatting
            array_push($array, [$datejour, (int)$date[3]]); // Add the date and data on the array
        }
        $js_array = json_encode($array); // Encode in json
        return $js_array; // Return the json array
    } else {
        return "Pas de résultat.\n";
    }
}

// Create a json array readable by javascript
function buildChartArrayViewsBySession($results)
{
    if (count($results->getRows()) > 0) {
        $rows = $results->getRows(); // Count the lines
        $array = [["Date", "Pages vues par session"]]; // Array initialization
        foreach ($rows as $date) { // For each date
            $datejour = substr($date[0], -2, 2) . "/" . substr($date[0], -4, 2); // Date formatting
            array_push($array, [$datejour, (int)$date[4]]); // Add the date and data on the array
        }
        $js_array = json_encode($array); // Encode in json
        return $js_array; // Return the json array
    } else {
        return "Pas de résultat.\n";
    }
}

// Create a json array readable by javascript
function buildChartArrayDurationSession($results)
{
    if (count($results->getRows()) > 0) {
        $rows = $results->getRows(); // Count the lines
        $array = [["Date", "Durée moyenne par session"]]; // Array initialization
        foreach ($rows as $date) { // For each date
            $datejour = substr($date[0], -2, 2) . "/" . substr($date[0], -4, 2); // Date formatting
            array_push($array, [$datejour, (int)$date[5]]); // Add the date and data on the array
        }
        $js_array = json_encode($array); // Encode in json
        return $js_array; // Return the json array
    } else {
        return "Pas de résultat.\n";
    }
}

// Create a json array readable by javascript
function buildChartArrayDurationPage($results)
{
    if (count($results->getRows()) > 0) {
        $rows = $results->getRows(); // Count the lines
        $array = [["Date", "Durée moyenne par page"]]; // Array initialization
        foreach ($rows as $date) { // For each date
            $datejour = substr($date[0], -2, 2) . "/" . substr($date[0], -4, 2); // Date formatting
            array_push($array, [$datejour, (int)$date[6]]); // Add the date and data on the array
        }
        $js_array = json_encode($array); // Encode in json
        return $js_array; // Return the json array
    } else {
        return "Pas de résultat.\n";
    }
}

// Create a json array readable by javascript
function buildChartArrayBounceRate($results)
{
    if (count($results->getRows()) > 0) {
        $rows = $results->getRows(); // Count the lines
        $array = [["Date", "Taux de rebond"]]; // Array initialization
        foreach ($rows as $date) { // For each date
            $datejour = substr($date[0], -2, 2) . "/" . substr($date[0], -4, 2); // Date formatting
            array_push($array, [$datejour, (int)$date[7]]); // Add the date and data on the array
        }
        $js_array = json_encode($array); // Encode in json
        return $js_array; // Return the json array
    } else {
        return "Pas de résultat.\n";
    }
}

// Create a json array readable by javascript
function buildChartArrayNewUsers($results)
{
    if (count($results->getRows()) > 0) {
        $rows = $results->getRows(); // Count the lines
        $array = [["Date", "Nouveaux utilisateurs"]]; // Array initialization
        foreach ($rows as $date) { // For each date
            $datejour = substr($date[0], -2, 2) . "/" . substr($date[0], -4, 2); // Date formatting
            array_push($array, [$datejour, (int)$date[8]]); // Add the date and data on the array
        }
        $js_array = json_encode($array); // Encode in json
        return $js_array; // Return the json array
    } else {
        return "Pas de résultat.\n";
    }
}

?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Charts options
    let options = {
        series: {
            0: {
                color: '#5962f3'
            }
        },
        hAxis: {
            textStyle: {
                color: 'white',
                fontSize: 10,
                fontName: 'Nunito'
            }
        },
        vAxes: {
            0: {
                gridlines: {
                    color: 'grey'
                },
                textStyle: {
                    color: 'white',
                    fontSize: 10,
                    fontName: 'Nunito'
                }
            }
        },
        legend: 'none',
        backgroundColor: 'transparent'
    };

    google.charts.setOnLoadCallback(drawChartViews);

    function drawChartViews() {
        let data = google.visualization.arrayToDataTable(<?= buildChartArrayViews($results); ?>);
        // Indicates where the chart has to be "injected"
        let chart = new google.visualization.LineChart(document.getElementById('views'));
        // Draw the chart
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChartVisitors);

    function drawChartVisitors() {
        let data = google.visualization.arrayToDataTable(<?= buildChartArrayVisitors($results); ?>);
        // Indicates where the chart has to be "injected"
        let chart = new google.visualization.LineChart(document.getElementById('visitors'));
        // Draw the chart
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChartSessions);

    function drawChartSessions() {
        let data = google.visualization.arrayToDataTable(<?= buildChartArraySessions($results); ?>);
        // Indicates where the chart has to be "injected"
        let chart = new google.visualization.LineChart(document.getElementById('sessions'));
        // Draw the chart
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChartViewsBySession);

    function drawChartViewsBySession() {
        let data = google.visualization.arrayToDataTable(<?= buildChartArrayViewsBySession($results); ?>);
        // Indicates where the chart has to be "injected"
        let chart = new google.visualization.LineChart(document.getElementById('viewsBySession'));
        // Draw the chart
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChartDurationSession);

    function drawChartDurationSession() {
        let data = google.visualization.arrayToDataTable(<?= buildChartArrayDurationSession($results); ?>);
        // Indicates where the chart has to be "injected"
        let chart = new google.visualization.LineChart(document.getElementById('durationSession'));
        // Draw the chart
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChartDurationPage);

    function drawChartDurationPage() {
        let data = google.visualization.arrayToDataTable(<?= buildChartArrayDurationPage($results); ?>);
        // Indicates where the chart has to be "injected"
        let chart = new google.visualization.LineChart(document.getElementById('durationPage'));
        // Draw the chart
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChartBounceRate);

    function drawChartBounceRate() {
        let data = google.visualization.arrayToDataTable(<?= buildChartArrayBounceRate($results); ?>);
        // Indicates where the chart has to be "injected"
        let chart = new google.visualization.LineChart(document.getElementById('bounceRate'));
        // Draw the chart
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChartNewUsers);

    function drawChartNewUsers() {
        let data = google.visualization.arrayToDataTable(<?= buildChartArrayNewUsers($results); ?>);
        // Indicates where the chart has to be "injected"
        let chart = new google.visualization.LineChart(document.getElementById('newUsers'));
        // Draw the chart
        chart.draw(data, options);
    }

    // Create trigger to resizeEnd event
    $(window).resize(function() {
        if (this.resizeTO) clearTimeout(this.resizeTO);
        this.resizeTO = setTimeout(function() {
            $(this).trigger('resizeEnd');
        }, 500);
    });

    // Redraw graph when window resize is completed
    $(window).on('resizeEnd', function() {
        drawChartNewUsers();
        drawChartBounceRate();
        drawChartDurationPage();
        drawChartDurationSession();
        drawChartViewsBySession();
        drawChartSessions();
        drawChartVisitors();
        drawChartViews();
    });
</script>
@endsection