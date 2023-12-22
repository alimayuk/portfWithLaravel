<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Mayuk Desing')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/frontFooter.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/frontNavbar.css') }}">
    @yield('css')
</head>

<body>
    <div class="customCursorDot"></div>
    <div class="customCursorOurline"></div>
    @include('layouts.frontLayout.navbar')
    

    @yield('content')


    @include('layouts.frontLayout.footer')


    <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/customFade.js') }}"></script>
    <script src="{{ asset('assets/js/customCursor.js') }}"></script>
    @include('sweetalert::alert')
  
</body>

</html>
