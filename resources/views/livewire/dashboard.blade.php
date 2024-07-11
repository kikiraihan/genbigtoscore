<x-slot name="header">
    @include('layouts.navigation',['warna'=>'bg-white'])
</x-slot>

<x-slot name="footer">
    @include('layouts.navigationbawah')
</x-slot>

<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>





<div>
    {{-- The whole world belongs to you. --}}


    <!-- welcome tron -->
    {{-- style="background-image: url('{{asset("assets_kiki/vector/CreditCard_TwoColor.svg")}}');background-size:
    14rem;" --}}
    <div
        class="grid grid-cols-4 p-4 justify-between items-center bg-gradient-to-b from-blue-200 to-gray-50 bg-no-repeat bg-bottom space-y-2">

        <div class="flex flex-col col-span-3">
            <span class=" f-roboto text-xs">
                Selamat Datang,
            </span>
            <span class="text-2xl f-opensans font-black text-gray-700 ">
                {{$userlogin->nama}}
            </span>
            <div class="p-0 m-0">
                <span class="f-roboto text-xs bg-white rounded-l px-1 py-0.5 text-gray-400 shadow-sm">
                    {{$anggota->namaBadan}}
                </span>
                <span class="f-robotomon text-xs bg-gray-400 rounded-r px-1 py-0.5 text-gray-100 shadow-sm">
                    {{$anggota->namaUnitSingkat}}
                </span>
            </div>
        </div>

        <div>
            <img src="{{Auth::user()->avatar}}"
                class="object-cover w-20 h-20 shadow rounded-full border-2 border-blue-100 ring-2 ring-blue-400">
        </div>


    </div>


    <!-- info bar -->
    <div class="container mx-auto p-3 bg-gradient-to-b from-gray-50 to-gray-100 ">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

            {{-- grid1 --}}


            {{-- grid2 --}}
            <div class="select-none">
                <div class="p-2 mx-auto bg-white rounded-lg shadow-md items-center">
                    <x-kiki.sublabel class="uppercase text-sm justify-between flex items-center">
                        <span>Kepengurusan</span>
                        <span class="material-icons ">
                            military_tech
                            {{-- group --}}
                        </span>
                    </x-kiki.sublabel>

                    <div class="md:grid-cols-2 md:grid space-y-1">
                        <x-kiki.molecul.data-dash :label="'Badan'">
                            {{$anggota->namaBadan}}
                        </x-kiki.molecul.data-dash>
                        <x-kiki.molecul.data-dash :label="'Unit'">
                            {{$anggota->namaUnit}}
                        </x-kiki.molecul.data-dash>
                        {{-- <x-kiki.molecul.data-dash :label="'Jabatan'">
                            {{$anggota->Kepengurusan->jabatan}}
                        </x-kiki.molecul.data-dash> --}}
                        <x-kiki.molecul.data-dash :label="'Role'">
                            <span class="f-robotomon text-xs bg-gray-50 rounded px-1 ml-2 py-0.5 text-gray-500 shadow-sm">
                                {{json_encode($userlogin->getRoleNames())}}
                            </span>
                        </x-kiki.molecul.data-dash>
                        {{-- <x-kiki.molecul.data-dash :label="'Periode'">
                            {{$anggota->Kepengurusan->periode}}
                        </x-kiki.molecul.data-dash> --}}
                        <x-kiki.molecul.data-dash :label="'Status Beasiswa'">
                            @if ($anggota->isMenerimaBeasiswa($id_beasiswa))
                            <x-kiki.badge class="bg-green-200 text-gray-500">
                                Penerima
                            </x-kiki.badge>
                            @else
                            <x-kiki.badge class="bg-gray-200 text-gray-500">
                                Tidak menerima
                            </x-kiki.badge>
                            @endif
                        </x-kiki.molecul.data-dash>

                        <x-kiki.molecul.data-dash :label="'Uang Kas Terakhir'">
                            @if ($anggota->TanggalBayarUangKas)
                            <x-kiki.badge class="bg-green-200 text-gray-500">
                                Dibayar {{$anggota->TanggalBayarUangKas->format('d F Y')}}
                            </x-kiki.badge>
                            @else
                            <x-kiki.badge class="bg-red-200 text-gray-500">
                                Belum Bayar
                            </x-kiki.badge>
                            @endif
                        </x-kiki.molecul.data-dash>

                        <x-kiki.molecul.data-dash :label="'Status Keanggotaan'">
                            @if ($anggota->kepengurusan->tanggal_demisioner==NULL)
                            <x-kiki.badge class="bg-green-200 text-gray-500">
                                Pengurus Aktif
                            </x-kiki.badge>
                            @else
                            <x-kiki.badge class="bg-gray-200 text-gray-500">
                                Demisioner
                                {{$anggota->kepengurusan->tanggal_demisioner->format('d M y')}}
                            </x-kiki.badge>
                            @endif
                        </x-kiki.molecul.data-dash>
                        <x-kiki.molecul.data-dash :label="'Angkatan GenBI'">
                            {{$anggota->awalmasukgenbi}}
                        </x-kiki.molecul.data-dash>
                    </div>

                </div>
            </div>
            {{-- endgrid2 --}}





            <br><br><br>

        </div>


    </div>






</div>
