<x-slot name="stylehalaman">
    @livewireStyles
    <style>
        /* Browser mockup code
            * Contribute: https://gist.github.com/jarthod/8719db9fef8deb937f4f
            * Live example: https://updown.io
        */

        .browser-mockup {
            border-top: 2em solid rgba(230, 230, 230, 0.7);
            position: relative;
            /* height: 60vh; */
        }

        .browser-mockup:before {
            display: block;
            position: absolute;
            content: "";
            top: -1.25em;
            left: 1em;
            width: 0.5em;
            height: 0.5em;
            border-radius: 50%;
            background-color: #f44;
            box-shadow: 0 0 0 2px #f44, 1.5em 0 0 2px #9b3, 3em 0 0 2px #fb5;
        }

        .browser-mockup>* {
            display: block;
        }

    </style>
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    {{-- @include('layouts.scriptsweetalert') --}}
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
</x-slot>






<div class="container w-full md:max-w-4xl mx-auto pt-20">

    <section class="bg-gray-100 border-b py-8">
        <div class="text-center px-3 lg:px-0">
            <h1 class="my-4 text-2xl md:text-3xl lg:text-5xl font-black leading-tight">
                Hi <span class="text-blue-900">Sobat Rupiah!</span>👋
            </h1>
            <p class="leading-normal text-gray-800 text-base md:text-xl lg:text-2xl mb-8">
                GenBI Gorontalo! Mowali' olo!
            </p>
        </div>

        <!-- This is an example component -->
        <div class="max-w-2xl mx-auto px-4 md:px-0">

            <div id="default-carousel" class="relative" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="overflow-hidden relative shadow-lg h-56 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
                        <img src="{{ asset('asset_landing/2021-2022/DSCF25288.JPG') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('asset_landing/2021-2022/DSCF2127.JPG') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('asset_landing/2020-2021/progenbi.JPG') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>
                    <!-- Item 4 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('asset_landing/2020-2021/pelantikan.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>
                    <!-- Item 5 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('asset_landing/2018-2020/IMG-20210204-WA0007_3.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>
                </div>
                <!-- Slider indicators -->
                <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
                </div>
                <!-- Slider controls -->
                <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        <span class="hidden">Previous</span>
                    </span>
                </button>
                <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="hidden">Next</span>
                    </span>
                </button>
            </div>
        </div>

    </section>

    <section class="bg-gray-100 border-b py-8">
        <h2 class="w-full my-2 text-4xl font-black leading-tight text-center text-gray-800">
            Aktivitas
        </h2>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-gradient-to-r from-cyan-500 to-blue-500 w-64 opacity-25 my-0 py-0 rounded-t">
            </div>
        </div>
        

        <div class="items-center w-full mx-auto content-end px-12 mb-14 ">
            <div class="browser-mockup flex-1 bg-white rounded shadow-xl md:col-span-2">
                @include('layouts.landing.layar-absen',['isiTabel'=>$absensi,'sekarang'=>$sekarang])
            </div>
            {{-- <div class="browser-mockup flex flex-1 p-6 md:px-0 md:p-12 bg-white rounded shadow-xl">
        </div> --}}
        </div>

        <div class="items-center w-full content-end grid grid-flow-col gap-4 px-12">
            <div class="p-4 max-w-md bg-white rounded-lg border shadow-xl sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                        Keaktifan <span class="text-xs text-gray-400">3 Teratas</span>
                    </h5>
                    <span class="text-sm font-medium text-green-600">
                        <i class="fas fa-arrow-up"></i>
                    </span>
               </div>
               <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        
                        @foreach (['','',''] as $item)
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="https://digimosque-admin.test/fav.jpeg" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Neil Sims
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $320
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
               </div>
            </div>
            <div class="p-4 max-w-md bg-white rounded-lg border shadow-xl sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                        Keaktifan <span class="text-xs text-gray-400">3 Terbawah</span>
                    </h5>
                    <span class="text-sm font-medium text-red-600">
                        {{-- <span>3 Terbawah</span> --}}
                        <i class="fas fa-arrow-down"></i>
                    </span>
               </div>
               <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        
                        @foreach (['','',''] as $item)
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="https://digimosque-admin.test/fav.jpeg" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Neil Sims
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $320
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
               </div>
            </div>
        </div>


    </section>

    <section class="bg-gray-100 border-b py-8">
        <div class="container max-w-5xl mx-auto m-8">
            <h2 class="w-full my-2 text-4xl font-black leading-tight text-center text-gray-800">
                Tugas Kami
            </h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto bg-gradient-to-r from-cyan-500 to-blue-500 w-64 opacity-25 my-0 py-0 rounded-t">
                </div>
            </div>

            <div class="flex flex-wrap flex-col-reverse sm:flex-row">
                <div class="w-full sm:w-1/2 p-6 mt-6">
                    <img src="{{ asset('assets_kiki/vector/SuperMan_TwoColor.svg') }}" alt="">
                </div>
                <div class="w-full sm:w-1/2 p-6 mt-6">
                    <div class="align-middle">
                        <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                            Front Liners
                        </h3>
                        <p class="text-gray-600 mb-8 ">
                            Mengkomunikasikan kelembagaan dan berbagai kebijakan BI kepada sesama mahasiswa & masyarakat
                            umum.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap">
                <div class="w-5/6 sm:w-1/2 p-6">
                    <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                        Change Agents
                    </h3>
                    <p class="text-gray-600 mb-8 ">
                        Menjadi role model dikalangan pelajar, mahasiswa & masyarakat.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 p-6">
                    <img src="{{ asset('assets_kiki/vector/Startup_TwoColor.svg') }}" alt="">
                </div>
            </div>

            <div class="flex flex-wrap flex-col-reverse sm:flex-row">
                <div class="w-full sm:w-1/2 p-6 mt-6">
                    <img src="{{ asset('assets_kiki/vector/Winners_TwoColor.svg') }}" alt="">
                </div>
                <div class="w-full sm:w-1/2 p-6 mt-6">
                    <div class="align-middle">
                        <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                            Future Leaders
                        </h3>
                        <p class="text-gray-600 mb-8 ">
                            Menjadi pemimpin muda di berbagai bidang & tingkatan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    



</div>
