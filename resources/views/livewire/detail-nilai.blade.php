<x-slot name="header">
    @include('layouts.navigation',['warna'=>'bg-white'])
</x-slot>

<x-slot name="footer">
</x-slot>
<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    {{-- @include('layouts.scriptsweetalert') --}}
</x-slot>

{{--------------------------------------------------------------------------------}}


<div>
    {{-- Be like water. --}}


    <div id="atas" class="container mx-auto bg-gray-100 mb-28 px-3 md:px-0">

        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">
                Detail Nilai
                <x-kiki.loading-spin wire:loading class="text-blue-500" />
            </div>
            {{-- <div>Semester {{$beasiswa->tahun.'/'.$beasiswa->semester}} </div> --}}
        <x-kiki.button-with-google-icon href="{{ route($kembali) }}" :icon="'arrow_back'"
            class="hover:text-blue-700">
            <span class="d-none d-md-inline">Kembali</span>
        </x-kiki.button-with-google-icon>
    </div>



    {{-- table --}}
    <x-kiki.sublabel class="mt-6 text-xl">
        Absensi
    </x-kiki.sublabel>

    <div class="bg-white shadow-md rounded overflow-x-auto">
        <table class="min-w-max w-full table-auto">

            @if ($absen->isNotEmpty())
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Tanggal</th>
                    <th class="py-3 px-6 text-left">Title</th>
                    <th class="py-3 px-6 text-center">Skope</th>
                    <th class="py-3 px-6 text-center bg-red-100">Nilai</th>
                </tr>
            </thead>
            @else
            <div class="text-center p-4">
                kosong
            </div>
            @endif

            <tbody class="text-gray-600 text-sm font-light">
                @php
                    $no=1
                @endphp
                @foreach ($absen as $id_sb => $absen_sb)
                <tr class="border-b border-gray-200 hover:bg-gray-100 text-center">
                    <td class="f-robotomon text-gray-400 py-1 ">
                        {{$absen_sb[0]->segmentbulanan->namaBulan}}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach ($absen_sb as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100
                @if ($item->pivot->kondisi=="tidakhadir")
                bg-red-50
                @elseif ($item->pivot->kondisi=="izin")
                bg-yellow-100
                @endif
                ">
                    <td class="py-3 px-6 text-left">
                            {{$item->date->format('d M Y, h:i')}}
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="font-medium truncate">
                            {{$item->title}}
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span class="text-center capitalize font-semibold space-x-2">
                            @if ($item->skope=="badan")
                            <div class="inline-flex items-center space-x-1 bg-gray-200 text-gray-600 rounded">
                                <span class="material-icons-outlined text-sm rounded-l p-0.5 text-white @if ($item->absensiable->id==1) bg-blue-500 @elseif ($item->absensiable->id==2) bg-red-400 @elseif ($item->absensiable->id==3) bg-green-400 @elseif ($item->absensiable->id==4) bg-yellow-400 @endif">
                                    people
                                </span>
                                <span class="text-xs py-0.5 px-1.5">
                                    All {{$item->absensiable->nama}}
                                </span>
                            </div>
                            @elseif ($item->skope=="unit")
                            <span
                                class="bg-gray-100 text-gray-500 border border-gray-200 py-0.5 px-1.5 rounded text-xs">
                                {{$item->absensiable->singkat}}
                            </span>
                            @elseif ($item->skope=="timkhu")
                            <span class="bg-yellow-200 text-yellow-600 py-0.5 px-1.5 rounded text-xs">
                                {{$item->absensiable->nama}}
                            </span>
                            @elseif ($item->skope=="seluruh-genbi")
                            <span class="bg-blue-200 text-blue-600 py-0.5 px-1.5 rounded text-xs">
                                All GenBI
                            </span>
                            @endif
                        </span>
                    </td>
                    <td class="py-3 px-6 text-center capitalize font-semibold space-x-2">
                        @if ($item->pivot->kondisi=="tidakhadir")
                        <span class="bg-pink-200 text-pink-600 py-0.5 px-1 rounded text-xs">
                            {{$item->pengurangan}}
                        </span>
                        @elseif ($item->pivot->kondisi=="hadir")
                        <span class="bg-gray-200 text-gray-600 py-0.5 px-1.5 rounded text-xs">
                            <span class="material-icons text-xs font-bold text-green-400 mb-1">
                                check
                            </span>
                        </span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endforeach


            </tbody>
        </table>

    </div>




    {{-- table --}}
    <x-kiki.sublabel class="mt-6 text-xl">
        Piket
    </x-kiki.sublabel>

    <div class="bg-white shadow-md rounded overflow-x-auto">
        <table class="min-w-max w-full table-auto">

            @if ($piket->isNotEmpty())
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    {{-- <th class="py-3 px-6 text-left">Id</th> --}}
                    <th class="py-3 px-6 text-left">Bulan</th>
                    <th class="py-3 px-6 text-center">Kehadiran</th>
                    <th class="py-3 px-6 text-center bg-red-100">Nilai</th>
                </tr>
            </thead>
            @else
            <div class="text-center p-4">
                kosong
            </div>
            @endif

            <tbody class="text-gray-600 text-sm font-light">

                @foreach ($piket as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="font-medium truncate">
                            {{$item->segmentbulanan->namaBulan}}
                        </div>
                    </td>
                    <td class="py-3 px-6  flex items-center justify-center space-x-2">
                        <div class="text-pink-500 items-center flex space-x-1">
                            <span class="material-icons-outlined text-base">
                                cancel
                            </span>
                            <span>
                                {{$item->jumlah_tidak_hadir}}
                            </span>
                        </div>
                        {{-- <div> + </div> --}}
                        <div class="text-gray-500 items-center flex space-x-1">
                            <span class="material-icons-outlined text-base">
                                info
                            </span>
                            <span>
                                {{$item->jumlah_izin}}
                            </span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center ">
                        {{$item->total}}
                    </td>
                </tr>
                @endforeach



            </tbody>
        </table>

    </div>




    {{-- table --}}
    <x-kiki.sublabel class="mt-6 text-xl">
        Tim Khusus
    </x-kiki.sublabel>

    <div class="bg-white shadow-md rounded overflow-x-auto">
        <table class="min-w-max w-full table-auto">

            @if ($anggotaTimkhu->isNotEmpty())
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Bulan</th>
                    <th class="py-3 px-6 text-left">Judul</th>
                    <th class="py-3 px-6 text-left">Peran</th>
                    <th class="py-3 px-6 text-center">Penilaian x Bobot</th>
                    <th class="py-3 px-6 text-center bg-green-100">Nilai</th>
                </tr>
            </thead>
            @else
            <div class="text-center p-4">
                kosong
            </div>
            @endif

            <tbody class="text-gray-600 text-sm font-light">

                @foreach ($anggotaTimkhu as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        {{$item->timkhu->segmentbulanan->namaBulan}}
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="font-medium truncate">
                            {{$item->timkhu->nama}}
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap capitalize select-none">
                        @if ($item->peran=='kepala')
                        <span class="bg-blue-200 text-blue-600 py-0.5 px-1.5 rounded text-xs">
                            Kepala Tim
                        </span>
                        @elseif ($item->peran=='anggota')
                        <span class="bg-blue-100 text-blue-500 border border-blue-200 py-0.5 px-1.5 rounded text-xs">
                            Anggota
                        </span>
                        @elseif ($item->peran=='pengurus-inti')
                        <span
                            class="bg-gray-100 text-gray-500 border border-gray-200 py-0.5 px-1.5 rounded text-xs mr-2">
                            Pengurus Inti
                        </span>
                        @endif
                    </td>
                    <td class="py-3 px-6  flex items-center justify-center space-x-2">
                        <div class="text-blue-500 diagonal-fractions">
                            {{$item->nilai}}
                        </div>
                        <sup>x</sup>
                        <div class="text-gray-500 diagonal-fractions">
                            @if ($item->peran=='pengurus-inti')
                            {{$item->timkhu->bobot}}/2
                            @else
                            {{$item->timkhu->bobot}}
                            @endif
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center ">
                        {{$item->totalNilai}}
                    </td>
                </tr>
                @endforeach



            </tbody>
        </table>

    </div>




    {{-- table --}}
    <x-kiki.sublabel class="mt-6 text-xl">
        Tambahan
    </x-kiki.sublabel>

    <div class="bg-white shadow-md rounded overflow-x-auto">
        <table class="min-w-max w-full table-auto">

            @if ($tambahan->isNotEmpty())
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Bulan</th>
                    <th class="py-3 px-6 text-left">Judul</th>
                    <th class="py-3 px-6 text-center bg-green-100">Nilai</th>
                </tr>
            </thead>
            @else
            <div class="text-center p-4">
                kosong
            </div>
            @endif

            <tbody class="text-gray-600 text-sm font-light">

                @foreach ($tambahan as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        {{$item->namaBulan}}
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="font-medium truncate">
                            {{$item->pivot->judul}}
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center ">
                        {{$item->pivot->nilai}}
                    </td>
                </tr>
                @endforeach



            </tbody>
        </table>

    </div>





    {{-- table --}}
    <x-kiki.sublabel class="mt-6 text-xl">
        Evaluasi Bulanan
    </x-kiki.sublabel>

    <div class="bg-white shadow-md rounded overflow-x-auto">
        <table class="min-w-max w-full table-auto">

            @if ($nilaieb->isNotEmpty())
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Bulan</th>
                    <th class="py-3 px-6 text-center">Penilaian</th>
                    <th class="py-3 px-6 text-center bg-green-100">Nilai</th>
                </tr>
            </thead>
            @else
            <div class="text-center p-4">
                kosong
            </div>
            @endif

            <tbody class="text-gray-600 text-sm font-light">

                @foreach ($nilaieb as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        {{$item->segmentbulanan->namaBulan}}
                    </td>
                    <td class="py-3 px-6  flex items-center justify-center space-x-2">
                        <div class="text-blue-500 diagonal-fractions">
                            {{$item->nilai}}
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center ">
                        {{$item->totalNilai}}
                    </td>
                </tr>
                @endforeach



            </tbody>
        </table>

    </div>











</div>
