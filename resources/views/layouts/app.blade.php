<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tasks') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/select2.css') }}">
    {{--    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/style.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tempusdominus-bootstrap-4.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
<div id="app">

    @include('layouts.nav')
    <main class="py-4">
        @yield('content')
    </main>
</div>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/fontawesome.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.js') }}"></script>
<script src="{{ asset('js/tempusdominus-bootstrap-4.js') }}"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
@stack('js')
</body>
</html>
