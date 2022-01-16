<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv=”Refresh” content=”0;URL=https://www.namawebsite.com”/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- PWA MANIFEST --}}
    {{-- <link rel="manifest" href="/manifest.json"> --}}
    <link rel="apple-touch-icon" href="assets_kiki/icon_app/icon-192x192.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="white"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Hello World">
    <meta name="msapplication-TileImage" content="assets_kiki/icon_app/icon-192x192.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    {{-- PWA end --}}




    {{-- kikiassets --}}
    @include('layouts.kikiassets')


    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    



    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script> --}}

    {{-- Untuk Blured Background SweetAlert --}}
    <style>
        body.swal2-shown > [aria-hidden="true"] {
            transition: 0.1s filter;
            filter: blur(2px);
        }
    </style>

    {{$stylehalaman}}

</head>

<body class="bg-gray-100 f-opensans font-sans antialiased">
    <!-- loader halaman -->
    <div id="loading-image" class="pembungkus-loader min-h-screen fixed w-full z-30 flex flex-col space-y-3 justify-center items-center bg-gray-100 opacity-80">
        <div class="loader bg-white p-5 rounded-full flex space-x-3">
            <div class="w-5 h-5 bg-blue-400 rounded-full animate-bounce"></div>
            <div class="w-5 h-5 bg-red-400 rounded-full animate-bounce"></div>
            <div class="w-5 h-5 bg-gray-300 rounded-full animate-bounce"></div>
        </div>
        <span class="animate-pulse">Loading.. </span>
    </div>
    <!-- loader halaman -->



    {{-- nav atas --}}
    {{ $header }}


    {{ $slot }}


    {{ $footer }}
    {{-- nav bawah --}}


    
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script>
    $(function () {
        // $('#navbarSupportedContent a[href~="' + location.href + '"]').parents('li').addClass('active');
        $('#navbarMobile a[href~="' + location.href + '"]').css("color", "#3B82F6"); //#E5E5E5
        $('#tabTask a[href~="' + location.href + '"]').addClass('border-b-2 border-blue-400 text-blue-500'); //#E5E5E5
    });
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script src="sweetalert2.all.min.js"></script> --}}
{{$scripthalaman}}



{{-- PWA SERVICES WORKERS --}}
{{-- @include('layouts.scriptPWA') --}}
{{-- PWA HOMESCREEN --}}
{{-- @include('layouts.scriptAddToHomeScreen') --}}




<!-- loader halaman -->
<script>
    // const pemb = document.querySelector('.pembungkus-loader');
    // window.onload = function(event) {
    //   pemb.remove();
    // };


    $(function () {
        // page is loaded, it is safe to hide loading animation
        $('#loading-image').hide();

        $(window).on('beforeunload', function () {
            // user has triggered a navigation, show the loading animation
            $('#loading-image').show();
        });
    });
</script>
<!-- loader halaman -->


</html>
