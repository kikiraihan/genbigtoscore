<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
</x-slot>



@include('livewire.landing.about.nav-side')
    

<div class="container w-full md:max-w-4xl mx-auto pt-20 xl:pt-0">

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
