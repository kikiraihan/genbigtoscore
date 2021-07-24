<x-slot name="header">
    @include('layouts.navigation',['warna'=>'bg-white'])
</x-slot>

<x-slot name="footer">
    @include('layouts.navigationbawah')
</x-slot>


<x-slot name="scripthalaman">
    
</x-slot>

<x-slot name="stylehalaman">
    
</x-slot>





<div>
    {{-- The whole world belongs to you. --}}

    
    <!-- welcome tron -->
    {{-- style="background-image: url('{{asset("assets_kiki/vector/CreditCard_TwoColor.svg")}}');background-size: 14rem;" --}}
    <div class="grid grid-cols-4 p-4 justify-between items-center bg-gradient-to-b from-blue-200 to-gray-50 bg-no-repeat bg-bottom space-y-2">
            
            <div class="flex flex-col col-span-3">
                <span class=" f-roboto text-xs">
                    Selamat Datang,
                </span>
                <span class="text-2xl f-opensans font-black text-gray-700 ">
                    {{$userlogin->nama}}
                </span>
                <div class="p-0 m-0">
                    <span class="f-roboto text-xs bg-white rounded-l px-1 py-0.5 text-gray-400 shadow-sm">
                        {{$userlogin->anggota->namaBadan}}
                    </span>
                    <span class="f-robotomon text-xs bg-gray-400 rounded-r px-1 py-0.5 text-gray-100 shadow-sm">
                        {{$userlogin->anggota->namaUnitSingkat}} 
                    </span>
                </div>
            </div>

            <div>
                <img src="{{Auth::user()->avatar}}" class="object-cover w-20 h-20 shadow rounded-full border-2 border-blue-100 ring-2 ring-blue-400">
            </div>
            
        
    </div>


    <!-- info bar -->
    <div class="container mx-auto p-3 bg-gradient-to-b from-gray-50 to-gray-100 ">
        
        <div class="grid grid-cols-2 grid-rows-3 gap-2">
            
            <div>
                <div class="grid grid-cols-2 p-3 mx-auto bg-blue-400 rounded-xl shadow-md items-center gap-2">
                    <div>
                        <span class="material-icons text-6xl text-white">emoji_events</span>
                        <!-- <img class="w-24" src="public/vector/Completed_task _Outline.svg"> -->
                    </div>
                    <div class="text-3xl text-right self-end font-medium text-gray-200 f-nunito diagonal-fractions">
                        2/4
                    </div>
                    <p class="text-right flex-1 text-gray-100 col-span-2">Pekerjaan selesai!</p>
                </div>
            </div>

            <div class="row-span-2 select-none">
                <div class="p-2 mx-auto bg-white rounded-lg shadow-md items-center">
                    <x-kiki.sublabel class="uppercase text-sm justify-between flex items-center">
                        <span>Kepengurusan</span>
                        <span class="material-icons ">
                            military_tech
                            {{-- group --}}
                        </span>
                    </x-kiki.sublabel>
                    <x-kiki.molecul.data-dash :label="'Badan'">
                        {{$userlogin->anggota->namaBadan}}
                    </x-kiki.molecul.data-dash>
                    <x-kiki.molecul.data-dash :label="'Unit'">
                        {{$userlogin->anggota->namaUnit}}
                    </x-kiki.molecul.data-dash>
                    <x-kiki.molecul.data-dash :label="'Jabatan'">
                        {{$userlogin->anggota->Kepengurusan->jabatan}}
                    </x-kiki.molecul.data-dash>
                    {{-- <x-kiki.molecul.data-dash :label="'Periode'">
                        {{$userlogin->anggota->Kepengurusan->periode}}
                    </x-kiki.molecul.data-dash> --}}
                    <x-kiki.molecul.data-dash :label="'Status Beasiswa'">
                        @if ($userlogin->anggota->menerima_beasiswa)
                            <x-kiki.badge class="bg-green-200 text-gray-500">
                                Penerima
                            </x-kiki.badge>
                        @else
                            <x-kiki.badge class="bg-gray-200 text-gray-500">
                                Tidak menerima
                            </x-kiki.badge>
                        @endif
                    </x-kiki.molecul.data-dash>
                    
                    <x-kiki.molecul.data-dash :label="'Status Keanggotaan'">
                        @if ($userlogin->anggota->kepengurusan->tanggal_demisioner==NULL)
                            <x-kiki.badge class="bg-green-200 text-gray-500">
                                Pengurus Aktif
                            </x-kiki.badge>
                        @else
                            <x-kiki.badge class="bg-gray-200 text-gray-500">
                                Demisioner pada tanggal {{$userlogin->anggota->kepengurusan->tanggal_demisioner->format('Y m d')}}
                            </x-kiki.badge>
                        @endif
                    </x-kiki.molecul.data-dash>
                    <x-kiki.molecul.data-dash :label="'Angkatan GenBI'">
                        {{$userlogin->anggota->awalmasukgenbi}}
                    </x-kiki.molecul.data-dash>
                </div>
            </div>

            
            

            <div class="">
                coba
            </div>

            
            
        </div>

    </div>
</div>
