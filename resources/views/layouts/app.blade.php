<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <link rel="icon" href="{{ asset('favicon.ico') }}"> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Selection Committee') }}</title> --}}
    <title>@yield('pageTitle')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts and Icons -->
    {{-- <link rel="stylesheet" href="{{ asset('css/materialdesignicons.min.css') }}" /> --}}

    <link rel="stylesheet" href="{{ asset('css/icon.css') }}" />

    <link rel="icon" href="{{url('storage/img/title.png')}}">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
        crossorigin="anonymous">

</head>
<body class="bg-secondary">

    <main>
        @yield('content')
    </main>
    
    @stack('scripts')

</body>
</html>
