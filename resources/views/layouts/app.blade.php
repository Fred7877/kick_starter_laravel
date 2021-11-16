<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            background-image: url('{{ asset('storage/images/numerique.jpeg') }}');
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        .center {
            margin-top:45vh;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
<div id="app" >
    <main class="center">
        @yield('content')
    </main>
</div>
</body>
</html>
