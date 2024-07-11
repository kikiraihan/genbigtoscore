<nav id="header" class="fixed w-full z-50 top-0">

    <div id="progress" class="h-1 z-20 top-0" style="background:linear-gradient(to right, #5789cf var(--scroll), transparent 0);"></div>

    <div class="w-full md:max-w-4xl mx-auto flex flex-wrap items-center justify-between mt-0 py-2">

        <div class="pl-4">
            <a href="{{ route('landing.home') }}">
                <img src="{{ asset('assets_kiki/genbi_logo_horizontal_full_rata.svg') }}" class="transform w-32 hover:shadow-md  rounded-xl px-1 py-0.5">
            </a>
        </div>

        <div class="block lg:hidden pr-4">
            <button id="nav-toggle" class="bg-gradient-to-r from-orange-300 to-amber-300 flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-green-500 appearance-none focus:outline-none">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>

        <div class="w-full flex-grow  lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-100 md:bg-transparent z-20" id="nav-content">
            <ul class="list-reset lg:flex justify-end flex-1 items-center">
                @foreach ([
                    ['route' => 'landing.home', 'title' => 'Beranda'],
                    ['route' => 'landing.schedule', 'title' => 'Aktivitas'],
                    ['route' => 'landing.statistik', 'title' => 'Statistik'],
                    ['route'=>'landing.timeline','title'=>'Kepengurusan'],
                    // ['route' => 'landing.intro', 'title' => 'Tentang'],
                    // ['route' => 'landing.form-pengurus-baru', 'title' => 'Form A'],
                    ['route' => 'login', 'title' => 'Login'],
                ] as $item)
                <li class="mr-3">
                    <a class="inline-block py-2 px-4 no-underline @if(request()->routeIs($item['route'])) text-gray-900 font-bold @else text-gray-600 hover:text-gray-900 hover:text-underline @endif " href="{{ route($item['route']) }}">{{$item['title']}}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
