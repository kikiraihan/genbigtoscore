<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
            .font-family-karla { font-family: karla; }
            .bg-sidebar { background: #3d68ff; }
            .cta-btn { color: #3d68ff; }
            .upgrade-btn { background: #1947ee; }
            .upgrade-btn:hover { background: #0038fd; }
            .active-nav-link { background: #1947ee; }
            .nav-item:hover { background: #1947ee; }
            .account-link:hover { background: #3d68ff; }
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-gray-100 font-family-karla flex">

        {{-- @include('layouts.aside') --}}
        <x-forlayout.aside />
        
    
        <div class="w-full flex flex-col h-screen overflow-y-hidden">
            
            {{-- @include('layouts.header')
            @include('layouts.mobileheadernav') --}}
            <x-forlayout.header />
            <x-forlayout.mobileheadernav />
        
            <div class="w-full overflow-x-hidden border-t flex flex-col">
                <main class="w-full flex-grow p-6">
                    {{$slot}}
                </main>
        
                <footer class="w-full bg-white text-right p-4">
                    Built by <a target="_blank" href="https://davidgrzyb.com" class="underline">David Grzyb</a>.
                </footer>
            </div>
            
        </div>
    
        {{-- @include('layouts.script') --}}
        <x-forlayout.script />

    </body>

    
</html>



