<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>GenBI Gorontalo</title>
    <meta name="author" content="name" />
    <meta name="description" content="description here" />
    <meta name="keywords" content="keywords,here" />
    

    <!-- Google Icon -->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" /> --}}
    <!--Replace with your tailwind.css once created-->

    {{-- PWA MANIFEST --}}
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="assets_kiki/icon_app/icon-192x192.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="white" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Hello World">
    <meta name="msapplication-TileImage" content="assets_kiki/icon_app/icon-192x192.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    {{-- PWA end --}}

	<style>
		@import url("https://rsms.me/inter/inter.css");
		html {
		  font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI",
			Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif,
			"Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol",
			"Noto Color Emoji";
		}
	  </style>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{$stylehalaman}}

</head>


<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    @include('layouts.landing.nav')

    {{-- <div class="container w-full md:max-w-4xl mx-auto pt-20">
    </div> --}}
    <!--Container-->
    {{$slot}}
    <!--/container-->

    
    <div class="bg-white flex justify-center text-xs text-gray-400 space-x-4 p-2 f-roboto">
        <span class="font-bold">Scoring System</span>
        <span class="material-icons self-center" style="font-size: 6px;">
            fiber_manual_record
        </span>
        <span class="hidden lg:inline">Generasi Baru Indonesia Gorontalo</span>
        <span class="lg:hidden inline">GenBI GTO</span>
        <span class="material-icons self-center" style="font-size: 6px;">
            fiber_manual_record
        </span>
        <span>Coded <a href="https://linktr.ee/kikiraihann" class="hover:text-blue-300 font-bold">©Katili.dev</a></span>
    </div>

    {{-- font awesome --}}
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    
    <script>
        /* Progress bar */
        //Source: https://alligator.io/js/progress-bar-javascript-css-variables/
        var h = document.documentElement,
            b = document.body,
            st = 'scrollTop',
            sh = 'scrollHeight',
            progress = document.querySelector('#progress'),
            scroll;
        var scrollpos = window.scrollY;
        var header = document.getElementById("header");
        var navcontent = document.getElementById("nav-content");

        document.addEventListener('scroll', function () {

            /*Refresh scroll % width*/
            scroll = (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
            progress.style.setProperty('--scroll', scroll + '%');

            /*Apply classes for slide in bar*/
            scrollpos = window.scrollY;

            if (scrollpos > 10) {
                header.classList.add("bg-white");
                header.classList.add("shadow");
                navcontent.classList.remove("bg-gray-100");
                navcontent.classList.add("bg-white");
            } else {
                header.classList.remove("bg-white");
                header.classList.remove("shadow");
                navcontent.classList.remove("bg-white");
                navcontent.classList.add("bg-gray-100");

            }

        });


        //Javascript to toggle the menu
        document.getElementById('nav-toggle').onclick = function () {
            document.getElementById("nav-content").classList.toggle("hidden");
        }

    </script>

    {{$scripthalaman}}

</body>

</html>
