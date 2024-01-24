<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
</x-slot>


{{-- @include('livewire.landing.about.nav-side') --}}


<div class="container w-full md:max-w-4xl mx-auto pt-20 px-4"> {{-- xl:pt-0 --}}

    <h2 class="w-full my-2 text-4xl font-black leading-tight text-gray-800">
        Timeline sejarah 
    </h2>
    <div>
        Dokumentasi perjanalan pergantian pengurus dari masa ke masa
    </div>
    {{-- <div>
        <h1 class="text-3xl"></h1>
    </div> --}}


    <ol class="relative border-l border-gray-300 dark:border-gray-700 mt-12">

        {{-- 2022-2023 --}}
        <li class="mb-10 ml-4">
            <div class="absolute w-3 h-3 bg-gray-300 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
            </div>
            <time class="mb-1 text-sm font-normal leading-none text-gray-600 dark:text-gray-500">Kepengurusan
                2022-2023</time>

            <div class="mt-2">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white inline">Pembina : </h3>
                <span class="inline-flex space-x-2">
                    <div class="text-sm text-gray-500 pl-2">Mas Hilmy Munis </div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Mba Anisa Kurniarahman </div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Mba Siti Murtafi'ah Mooduto </div>
                </span>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-600">
                </p>
            </div>

            <div class="flex space-x-8 mt-2 divide-x-2 my-3 md:items-center items-start">
                <div class="flex items-center space-x-4">
                    <img class="w-10 h-10 rounded-full" src="{{$foto['komang']}}">
                    <div class="space-y-1 font-medium">
                        <div>Ketua Umum</div>
                        <div class="text-sm text-gray-500">Muh Zamharir malongi</div>
                    </div>
                </div>

                <div class="flex items-center md:space-x-4 px-4">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="{{$foto['aco']}}">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="{{$foto['minarti']}}">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="{{$foto['apik']}}">
                    <div class="space-y-1 font-medium">
                        <div>Ketua Komisariat (UNG | IAIN | UG)</div>
                        <span class="block md:flex md:space-x-2">
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">Moh. Abror Maaruf </div>
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">Indrianto J. Hasan </div>
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">Ulfadiyanti Udju </div>
                        </span>
                    </div>
                </div>
            </div>

            

            <div id="animation-carousel" class="relative" data-carousel="static">

                <div class="overflow-hidden relative rounded-lg h-96 bg-gray-500 shadow-xl">
                    @foreach ([
                        'asset_landing/2022-2023/w23-3.jpg',
                        'asset_landing/2022-2023/w23-1.jpg ',
                        'asset_landing/2022-2023/ung23.jpg ',
                        'asset_landing/2022-2023/iain23.jpeg ',
                        'asset_landing/2022-2023/ug23.jpeg ',
                        'asset_landing/2022-2023/w23-2.jpg ',
                    ] as $item)
                        <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                            data-carousel-item="active">
                            <img src="{{ asset($item) }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                        </div>
                    @endforeach

                </div>

                <!-- Slider indicators -->
                <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                    @foreach ([0,1,2,3,4,5] as $item)
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="{{$item}}"></button>
                    @endforeach
                </div>

                <button type="button"
                    class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-prev="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        <span class="hidden">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-next="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="hidden">Next</span>
                    </span>
                </button>
            </div>
        </li>

        {{-- 2021-2022 --}}
        <li class="mb-10 ml-4">
            <div class="absolute w-3 h-3 bg-gray-300 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
            </div>
            <time class="mb-1 text-sm font-normal leading-none text-gray-600 dark:text-gray-500">Kepengurusan
                2021-2022</time>

            <div class="mt-2">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white inline">Pembina : </h3>
                <span class="inline-flex space-x-2">
                    <div class="text-sm text-gray-500 pl-2">Mas Abdullah Ulil Albab </div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Mas Hilmy Munis </div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Mba Siti Murtafi'ah Mooduto </div>
                </span>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-600">
                </p>
            </div>

            <div class="flex space-x-8 mt-2 divide-x-2 my-3 md:items-center items-start">
                <div class="flex items-center space-x-4">
                    <img class="w-10 h-10 rounded-full" src="{{$foto['komang']}}">
                    <div class="space-y-1 font-medium">
                        <div>Ketua Umum</div>
                        <div class="text-sm text-gray-500">Komang Darma Widia</div>
                    </div>
                </div>

                <div class="flex items-center md:space-x-4 px-4">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="{{$foto['aco']}}">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="{{$foto['minarti']}}">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="{{$foto['apik']}}">
                    <div class="space-y-1 font-medium">
                        <div>Ketua Komisariat (UNG | IAIN | UG)</div>
                        <span class="block md:flex md:space-x-2">
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">Alviansyah S. Malawe </div>
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">Minarti Mansombo </div>
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">Arafik Pakaya </div>
                        </span>
                    </div>
                </div>
            </div>

            

            <div id="animation-carousel" class="relative" data-carousel="static">

                <div class="overflow-hidden relative rounded-lg h-96 bg-gray-500 shadow-xl">

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="active">
                        <img src="{{ asset('asset_landing/2021-2022/20212022.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2021-2022/ung.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2021-2022/iain.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2021-2022/ug.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                    {{-- <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2021-2022/DSCF2127.JPG') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div> --}}

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2021-2022/DSCF25288.JPG') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                </div>

                <!-- Slider indicators -->
                <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                    @foreach ([0,1,2,3,4] as $item)
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="{{$item}}"></button>
                    @endforeach
                </div>

                <button type="button"
                    class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-prev="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        <span class="hidden">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-next="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="hidden">Next</span>
                    </span>
                </button>
            </div>


        </li>

        {{-- 2020-2021 --}}
        <li class="mb-10 ml-4">
            <div class="absolute w-3 h-3 bg-gray-300 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
            </div>
            <time class="mb-1 text-sm font-normal leading-none text-gray-600 dark:text-gray-500">Kepengurusan
                2020-2021</time>

            <div class="mt-2">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white inline">Pembina : </h3>
                <span class="inline-flex space-x-2">
                    <div class="text-sm text-gray-500 pl-2">Mas Arief Setyowidodo </div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Mas Abdullah Ulil Albab </div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Mba Siti Murtafi'ah Mooduto </div>
                </span>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-600">
                </p>
            </div>

            <div class="flex space-x-8 mt-2 divide-x-2 my-3 md:items-center items-start">
                <div class="flex items-center space-x-4">
                    <img class="w-10 h-10 rounded-full"
                        src="{{$foto['kiki']}}"
                        alt="">
                    <div class="space-y-1 font-medium">
                        <div>Ketua Umum</div>
                        <div class="text-sm text-gray-500">Moh Zulkifli Katili</div>
                    </div>
                </div>

                <div class="flex items-center md:space-x-4 px-4">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="{{$foto['naswa']}}">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="{{$foto['tasya']}}">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="{{$foto['roly']}}">
                    <div class="space-y-1 font-medium">
                        <div>Ketua Komisariat (UNG | IAIN | UG)</div>
                        <span class="block md:flex md:space-x-2">
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">Naswa Adilia Alamri </div>
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">Tasya Dwias Amanda </div>
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">Rolly R. Basti </div>
                        </span>
                    </div>
                </div>
            </div>

            

            <div id="animation-carousel" class="relative" data-carousel="static">

                <div class="overflow-hidden relative rounded-lg h-96 bg-gray-500 shadow-xl">

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="active">
                        <img src="{{ asset('asset_landing/2020-2021/wilayah.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90 "
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2020-2021/ung.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90 translate-x-0 z-20"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2020-2021/iain.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div> 

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2020-2021/ug.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2020-2021/progenbi.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                    
                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2020-2021/pelantikan.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                </div>

                <!-- Slider indicators -->
                <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                    @foreach ([0,1,2,3,4,5] as $item)
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="{{$item}}"></button>
                    @endforeach
                </div>

                <button type="button"
                    class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-prev="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        <span class="hidden">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-next="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="hidden">Next</span>
                    </span>
                </button>
            </div>


        </li>

        {{-- 2018-2020 --}}
        <li class="mb-10 ml-4">
            <div class="absolute w-3 h-3 bg-gray-300 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
            </div>
            <time class="mb-1 text-sm font-normal leading-none text-gray-600 dark:text-gray-500">Kepengurusan
                2018-2020</time>

            <div class="mt-2">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white inline">Pembina : </h3>
                <span class="inline-flex space-x-2">
                    <div class="text-sm text-gray-500 pl-2">Pak One Yusril Fikar</div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Bang Rahmi Mabruri</div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Mas Arief Setyowidodo  </div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Mba Siti Murtafi'ah Mooduto </div>
                </span>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-600">
                </p>
            </div>

            <div class="flex space-x-8 mt-2 divide-x-2 my-3 md:items-center items-start">
                <div class="flex items-center space-x-4">
                    <img class="w-10 h-10 rounded-full"
                        src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                        alt="">
                    <div class="space-y-1 font-medium">
                        <div>Ketua Umum</div>
                        <div class="text-sm text-gray-500">Vebriansyah Mohi</div>
                    </div>
                </div>

                <div class="flex items-center md:space-x-4 px-4">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="">
                    <img class="hidden md:inline w-10 h-10 rounded-full" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="">
                    <div class="space-y-1 font-medium">
                        <div>Ketua Komisariat (UNG | IAIN | UG)</div>
                        <span class="block md:flex md:space-x-2">
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">Arya S. Puasa </div>
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">Maulidin R. Pratama </div>
                            <div class="text-sm text-gray-500 md:border-l-2 md:pl-2">(Demisioner) </div>
                        </span>
                    </div>
                </div>
            </div>

            

            <div id="animation-carousel" class="relative" data-carousel="static">

                <div class="overflow-hidden relative rounded-lg h-96 bg-gray-500 shadow-xl">

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="active">
                        <img src="{{ asset('asset_landing/2018-2020/struktur.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                    {{-- <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2018-2020/pembina.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div> --}}

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2018-2020/IMG_7079.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2018-2020/IMG-20210204-WA0007_3.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                </div>

                <!-- Slider indicators -->
                <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                    @foreach ([0,1,2] as $item)
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="{{$item}}"></button>
                    @endforeach
                </div>

                <button type="button"
                    class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-prev="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        <span class="hidden">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-next="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="hidden">Next</span>
                    </span>
                </button>
            </div>


        </li>

        {{-- 2014-2018 --}}
        <li class="mb-10 ml-4">
            <div class="absolute w-3 h-3 bg-gray-300 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
            </div>
            <time class="mb-1 text-sm font-normal leading-none text-gray-600 dark:text-gray-500">Kepengurusan
                2014-2018</time>

            <div class="mt-2">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white inline">Pembina : </h3>
                <span class="inline-flex space-x-2">
                    <div class="text-sm text-gray-500 pl-2">Pak Unggul Priyatna</div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Mas Imam</div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Mas Iksan Wahyudi</div>
                    <div class="text-sm text-gray-500 border-l-2 pl-2">Bang Rahmi Mabruri</div>
                </span>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-600">
                </p>
            </div>

            <div class="flex space-x-8 mt-2 divide-x-2 my-3 md:items-center items-start">
                <div class="flex items-center space-x-4">
                    <img class="w-10 h-10 rounded-full"
                        src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                        alt="">
                    <div class="space-y-1 font-medium">
                        <div>Ketua Umum</div>
                        <div class="text-sm text-gray-500">Bayu Eka Saputra Katili</div>
                    </div>
                </div>

            </div>

            

            {{-- <div id="animation-carousel" class="relative" data-carousel="static">

                <div class="overflow-hidden relative rounded-lg h-96 bg-gray-500 shadow-xl">

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="active">
                        <img src="{{ asset('asset_landing/2018-2020/01Struktur.png') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform brightness-90"
                        data-carousel-item="">
                        <img src="{{ asset('asset_landing/2018-2020/pembina.png') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                    </div>

                </div>

                <!-- Slider indicators -->
                <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                </div>

                <button type="button"
                    class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-prev="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        <span class="hidden">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-next="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="hidden">Next</span>
                    </span>
                </button>
            </div> --}}


        </li>

    </ol>

    <div class="mb-96"></div>

</div>
