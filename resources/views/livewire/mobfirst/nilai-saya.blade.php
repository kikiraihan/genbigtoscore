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
            <div>
                <div x-data="{detail_nilai:false}" class="bg-white rounded-xl shadow-md">
                    <div class="grid grid-cols-3 p-2 mx-auto bg-blue-400 items-end gap-2 rounded-xl ">
                        <x-kiki.sublabel class="uppercase text-sm justify-between flex items-center col-span-3">
                            <span class="text-gray-100">Nilai</span>
                            <span class="material-icons text-yellow-200">
                                emoji_events
                            </span>
                        </x-kiki.sublabel>

                        @php
                            $nilai=$nilaiAkhir;
                        @endphp
                        <div
                            class="text-4xl justify-center self-end font-medium text-gray-100 f-robotomon flex items-end col-span-3 mb-2">
                            @if ($nilai < (int)$standar_lulus)
                                <span
                                    class="material-icons text-xs rounded-full px-1 font-bold bg-white text-red-400 mb-1">
                                    priority_high
                                </span>
                            @else
                                <span
                                    class="material-icons text-xs rounded-full px-1 font-bold bg-white text-green-400 mb-1">
                                    check
                                </span>
                            @endif
                            <span>
                                @if ($tampilkanNilai or $nilai==0)
                                    {{round($nilai,2)}}
                                @else
                                    ---
                                @endif
                            </span>
                        </div>

                        <x-kiki.select-standar wire:model="id_beasiswa" class="py-0.5 bg-gray-200 opacity-60 text-gray-600 col-span-3 mt-3">
                            <option value="" hidden selected>...</option>
                            @foreach ($selectBeasiswa as $item)
                                <option class="w-full" value="{{$item->id}}"> {{$item->tahun}}/{{$item->semester}}
                            </option>
                            @endforeach
                        </x-kiki.select-standar>

                        <a href="#" x-on:click="detail_nilai=!detail_nilai"
                            class="py-0.5 p-2 rounded justify-between flex bg-blue-200 text-white bg-opacity-60 col-span-3 hover:shadow">
                            <span class="material-icons-outlined text-base">
                                info
                            </span>
                            <span>Detail </span>
                        </a>

                    </div>


                    <div x-show="detail_nilai" x-transition class="transition duration-200 ease-in-out">
                        <div
                            class="grid grid-cols-3 grid-flow-row-dense items-center gap-2 text-sm py-2 font-bold shadow-sm">
                            <div class=" text-center">
                                Bulan
                            </div>
                            <div class=" text-center">
                                ATP
                            </div>
                            <div class=" text-center">
                                EB
                            </div>
                        </div>

                        @foreach ($beasiswa->segmentbulanan as $seg)
                        <div
                            class="grid grid-cols-3 grid-flow-row-dense items-center gap-2 text-sm f-robotomon  divide-y divide-y-reverse">
                            <div class="text-center">
                                {{substr($seg->namaBulan,0,3)}}
                            </div>
                            <div class=" text-center">
                                @if ($tampilkanNilai or $nilai==0)
                                {{round($anggota->getAtpSayaPadaSegment($seg->id)+30,2)}}
                                @else
                                -
                                @endif
                            </div>
                            <div class=" text-center">
                                @if ($tampilkanNilai or $nilai==0)
                                {{round($anggota->getEbSayaPadaSegment($seg->id),2)}}
                                @else
                                -
                                @endif
                            </div>
                        </div>
                        @endforeach

                        <div class="py-3 grid grid-cols-3 grid-flow-row-dense items-center gap-2 text-sm">
                            <div class=" text-center f-nunito font-bold">
                                Total
                            </div>
                            <div class=" text-center f-robotomon">
                                @if ($tampilkanNilai or $nilai==0)
                                    {{round($anggota->getAtpBeasiswaFull($beasiswa),2)}}
                                @else
                                    -
                                @endif
                            </div>
                            <div class=" text-center f-robotomon">
                                @if ($tampilkanNilai or $nilai==0)
                                    {{round($anggota->getEbBeasiswaFull($beasiswa),2)}}
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('detailnilai', ['id'=>$anggota->id,'kembali'=>'dashboard']) }}" x-on:click="detail_nilai=!detail_nilai"
                            class="py-0.5 p-2 rounded-b justify-between flex bg-gray-200 text-gray-500 bg-opacity-60 col-span-3 hover:shadow">
                            <span class="font-bold f-roboto">Selengkapnya </span>
                            <span class="material-icons-outlined text-base">
                                double_arrow
                            </span>
                        </a>

                    </div>

                </div>
            </div>
            {{-- endgrid1 --}}



            {{-- grid2 --}}

            {{-- endgrid2 --}}





            <br><br><br>

        </div>


    </div>






</div>
