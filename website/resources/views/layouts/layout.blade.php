<!-- Layout of the website -->

<!DOCTYPE html>
<html lang="fr" local="fr">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175182089-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-175182089-1');
    </script>

    <!-- Parameters -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/x-icon">

    <link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <!-- Font awesome icons -->
    <link href="{{ URL::asset('lib/fontawesome/css/all.css') }}" rel="stylesheet">

    <!-- CSS -->
    <!-- ####################################"" -->
    <link href="//cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-calendars/styles/material.css" rel="stylesheet">
    <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js" type="text/javascript"></script>
    <!-- ####################################"" -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/fonts.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>


    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src='https://cdn.rawgit.com/JacobLett/IfBreakpoint/e9fcd4fd/if-b4-breakpoint.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <title>@yield('title')</title>

</head>

<body>
    <!-- Navbar -->
    {{-- If the route is not page-admin we display the navbar --}}
    @if (!Request::is('page-admin') && !Request::is('login') && !Request::is('password/*'))
    @include('partials.navbar')
    @endif

    @if (Request::is('page-admin'))
    <style>
        body {
            background-color: #131722;
        }

        .page-footer {
            background-color: #20242e;
        }
    </style>
    @endif

    {{-- If the route is not welcome we change the navbar background color --}}
    @if (!Request::is('/'))
    <style>
        .navbar {
            background-color: rgb(92, 111, 163);
        }
    </style>
    @endif

    <div class="page">

        <!-- Main content -->
        <div id="content">
            <!-- Breadcrumbs -->
            @if (!Request::is('/') && !Request::is('page-admin') && !Request::is('login') && !Request::is('password/*'))
            <div class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </div>
            @endif

            <div class="main-content">
                @yield('content')
            </div>

        </div>

        <!-- Footer -->
        @if (!Request::is('login') && !Request::is('password/*'))
        @include('partials.footer')
        @endif
    </div>
    <script src="{{ asset('js/website.js') }}"></script>
</body>

</html>