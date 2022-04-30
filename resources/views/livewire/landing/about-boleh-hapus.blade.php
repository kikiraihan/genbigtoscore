<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
</x-slot>


<div class="container w-full flex flex-wrap mx-auto px-2 pt-8 lg:pt-16 mt-16">
    <div class="w-full lg:w-1/5 lg:px-6 text-xl text-gray-800 leading-normal">
        <p class="text-base font-bold py-2 lg:pb-6 text-gray-700">Pages</p>
        <div class="block lg:hidden sticky inset-0">
            <button id="menu-toggle"
                class="flex w-full justify-end px-3 py-3 bg-white lg:bg-transparent border rounded border-gray-600 hover:border-purple-500 appearance-none focus:outline-none">
                <svg class="fill-current h-3 float-right" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </button>
        </div>
        <div class="w-full sticky inset-0 hidden h-64 lg:h-auto overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 border border-gray-400 lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-20"
            style="top:5em;" id="menu-content">
            <ul class="list-reset">
                <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                    <a href="#"
                        class="block pl-4 align-middle text-gray-700 no-underline hover:text-purple-500 border-l-4 border-transparent lg:border-purple-500 lg:hover:border-purple-500">
                        <span class="pb-1 md:pb-0 text-sm text-gray-900 font-bold">Home</span>
                    </a>
                </li>
                <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                    <a href="#"
                        class="block pl-4 align-middle text-gray-700 no-underline hover:text-purple-500 border-l-4 border-transparent lg:hover:border-gray-400">
                        <span class="pb-1 md:pb-0 text-sm">Tasks</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="w-full lg:w-4/5  lg:mt-0 text-gray-900 leading-normal">
        <!--Title-->
        {{-- <div class="font-sans">
          <span class="text-base text-purple-500 font-bold">&laquo;</span> <a href="#" class="text-base md:text-sm text-purple-500 font-bold no-underline hover:underline">Back Link</a>
          <h1 class="font-sans break-normal text-gray-900 pt-6 pb-2 text-xl">Help page title</h1>
          <hr class="border-b border-gray-400">
       </div> --}}
        <!--Post Content-->
        <div class="container w-full md:max-w-2xl mx-auto">

            <section class="bg-gray-100 border-b py-8">
                <iframe class="w-full" height="415" src="https://www.youtube.com/embed/JLN7Z0l2QrQ"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </section>



            <section class="w-full px-4 md:px-6 text-xl text-gray-800 leading-normal text-justify border-b "
                style="font-family:Georgia,serif;">

                <!--Title-->
                <div class="font-sans">
                    <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3xl md:text-4xl">
                        Kenalan 🙌
                    </h1>
                    {{-- <p class="text-sm md:text-base font-normal text-gray-600">Published 19 February 2019</p> --}}
                </div>

                <!--Lead Para-->
                <p class="py-6">
                    <a class="text-sky-700 " href="https://www.generasibaruindonesia.com/main"> Generasi Baru Indonesia
                        (GenBI)
                    </a>
                    merupakan komunitas yang terdiri dari mahasiswa/i penerima beasiswa Bank Indonesia yang berada di
                    bawah
                    naungan
                    Bank Indonesia. GenBI memiliki tingkatan struktur kepengurusan wilayah dan komisariat kampus, yang
                    tersebar
                    di
                    berbagai wilayah di indonesia.
                </p>

                <p class="py-6">
                    GenBI Gorontalo sendiri merupakan struktur kepengurusan pada tingkatan wilayah, yang dinaungi oleh
                    Kantor
                    Perwakilan Bank Indonesia Provinsi Gorontalo. Mahasiswa GenBI Gorontalo berasal dari 3 Kampus yang
                    bermitra,
                    yaitu Universitas Negeri Gorontalo, Institut Agama Islam Negeri Sultan Amai Gorontalo, dan
                    Universitas
                    Gorontalo.
                </p>
            </section>


            <section class="bg-gray-100 border-b py-8">
                <iframe class="w-full" height="415" src="https://www.youtube.com/embed/ZhkGCOS73ZM"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </section>


        </div>
        <!--/ Post Content-->
        <div class="mb-24"></div>
    </div>
</div>
