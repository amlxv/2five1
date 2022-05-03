<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script defer src="{{ asset('js/app.js') }}"></script>
</head>

<body class="bg-gradient-kindsteel">

    @section('navbar')
        @include('layouts.navbar')
    @show

    <div class="container">
        @yield('content')
    </div>

</body>

@stack('scripts')

</html>
