<footer class="bg-white border-t border-gray-400 shadow">
    <div class="container mx-auto py-8">

        <div class="w-full mx-auto md:flex block space-x-4 max-w-5xl">
            
            <div class="w-full md:w-2/4 mb-7 md:mb-0 px-5 md:px-0">
                <h3 class="font-bold text-gray-900">
                    Tentang
                </h3>
                <p class="text-justify">
                    <a class="text-sky-700 " href="https://www.generasibaruindonesia.com/main"> Generasi Baru Indonesia (GenBI) </a> merupakan komunitas yang terdiri dari mahasiswa/i penerima beasiswa Bank Indonesia yang berada di bawah naungan Bank Indonesia, yang tersebar diseluruh wilayah Indonesia.
                    GenBI Gorontalo adalah salah satu struktur kepengurusan GenBI di tingkat wilayah.
                </p>
            </div>

            <div class="flex w-full md:w-1/4 mb-7 md:mb-0">
                <div class="px-8">
                    <h3 class="font-bold text-gray-900">
                        Instagram
                    </h3>
                    <ul class="list-reset items-center text-sm pt-3">
                        @foreach ([
                            ['link'=>'https://www.instagram.com/genbi_gto', 'icon'=>'fab fa-instagram', 'title'=>'@genbi_gto','warna'=>'purple'],
                            ['link'=>'https://www.instagram.com/genbi.ung', 'icon'=>'fab fa-instagram', 'title'=>'@genbi.ung','warna'=>'purple'],
                            ['link'=>'https://www.instagram.com/genbi_komsat_iainsag', 'icon'=>'fab fa-instagram', 'title'=>'@genbi_komsat_iainsag','warna'=>'purple'],
                            ['link'=>'https://www.instagram.com/genbi.ug', 'icon'=>'fab fa-instagram', 'title'=>'@genbi.ug','warna'=>'purple'],
                        ] as $item)
                            <li class="text-{{$item['warna']}}-900 text-gray-600 items-center flex space-x-2">
                                <i class="{{$item['icon']}} text-lg"></i>
                                <a class="no-underline hover:text-underline py-1" href="{{$item['link']}}">
                                    {{$item['title']}}
                                </a>
                            </li>
                            
                        @endforeach
                </div>
            </div>

            <div class="flex w-full md:w-1/4 mb-7 md:mb-0">
                <div class="px-8">
                    <h3 class="font-bold text-gray-900">Media sosial lainnya</h3>
                    <ul class="list-reset items-center text-sm pt-3">
                        @foreach ([
                            ['link'=>'https://www.youtube.com/channel/UCmbg73Fa670EzYn3amz2UBw', 'icon'=>'fab fa-youtube', 'title'=>'GenBI Gorontalo','warna'=>'red'],
                            ['link'=>'https://www.facebook.com/genbi.gorontalo.1', 'icon'=>'fab fa-facebook-square', 'title'=>'GenBI Gorontalo','warna'=>'sky'],
                            ['link'=>'https://www.tiktok.com/@genbi_gorontalo', 'icon'=>'fab fa-tiktok', 'title'=>'@genbi_gorontalo','warna'=>'gray'],
                        ] as $item)
                            <li class="text-{{$item['warna']}}-900 text-gray-600 items-center flex space-x-2">
                                <i class="{{$item['icon']}} text-lg"></i>
                                <a class="no-underline hover:text-underline py-1" href="{{$item['link']}}">
                                    {{$item['title']}}
                                </a>
                            </li>
                            
                        @endforeach
                </div>
            </div>
        </div>



    </div>
</footer>