<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air4casts Online Login</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">

    <!-- Additional CSS files -->
    <link href="{{ asset('css/a4cnew.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/a4clinks.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/tablestylegreyhover550.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/tablestylegreyhoversmallnohead.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/tashmeetloginform.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/a4csytle_new.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet" type="text/css" />

    <!-- External Styles -->
    <link href="https://subnews.air4casts.com/style/a4clinks.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900|Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet" />

    <!-- Menu CSS -->
    <link href="{{ asset('includes/FlexiMenus2/CSSMenu_ClientMenu2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('includes/FlexiMenus2/CSSMenu_AirportsMenuSimple.css') }}" rel="stylesheet" type="text/css" />

    <!-- DW Infographics CSS -->
    <link href="{{ asset('includes/DWInfographics/DWInfographics49.css') }}" rel="stylesheet">
    <link href="{{ asset('includes/DWInfographics/DWInfographics50.css') }}" rel="stylesheet">
    <link href="{{ asset('includes/DWInfographics/DWInfographics51.css') }}" rel="stylesheet">
    <link href="{{ asset('includes/DWInfographics/DWInfographics52.css') }}" rel="stylesheet">
    <link href="{{ asset('includes/DWInfographics/font-awesome-4.2.0/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/extendjQuery.js') }}"></script>
    <script src="{{ asset('js/FlexiMenus2/fleximenus2.js') }}"></script>
    <script src="{{ asset('includes/DWInfographics/extendDWInfographics.js') }}"></script>
    <script src="{{ asset('includes/DWInfographics/DWInfographics.js') }}"></script>



    @yield('styles')
</head>

<body class="oneColFixCtr">
    <div id="app">
        @yield('content')
    </div>

    @yield('footer')
    @yield('scripts')
</body>

</html>
