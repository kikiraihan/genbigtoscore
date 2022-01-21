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
    @include('layouts.scriptsweetalert')
</x-slot>

{{--------------------------------------------------------------------------------}}


<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    
    <div id="atas" class="container mx-auto bg-gray-100 mb-28">
        
        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">
                Hasil Penilaian
                <x-kiki.loading-spin wire:loading  class="text-blue-500"/>
            </div>
            <div>
                {{-- <div>Semester {{$beasiswa->tahun.'/'.$beasiswa->semester}}</div> --}}
                <span class="flex items-center">
                    <span class="material-icons-outlined" style="font-size: 20px">
                        group
                    </span>
                    <span>
                        all
                        {{-- {{$isiTabel->count()}} --}}
                    </span>
                </span>
            </div>
        </div>

        {{-- table --}}
        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

            <div class="grid grid-cols-5 items-center">
                <div class="p-2">
                    <x-kiki.select-standar wire:model="id_beasiswa">
                        <option value="" hidden selected>...</option>
                        @foreach ($selectBeasiswa as $item)
                        <option class="w-full" value='{{$item->id}}'>Semester {{$item->tahun." / ".$item->semester}}</option>
                        @endforeach
                    </x-kiki.select-standar>
                </div>

                <div class="flex p-2 space-x-1 col-span-3">
                    <button class="w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                        <i class="material-icons">search</i>
                    </button>
                    <x-kiki.input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" id="search"
                        class="w-full rounded p-2" />
                </div>

                <div class="p-2 text-right">
                    <x-kiki.button-with-google-icon :icon="'file_download'" class="bg-green-400 shadow-sm text-gray-100  inline-flex p-2 rounded cursor-pointer hover:shadow-md hover:bg-green-600"
                        wire:click="export">
                        <span wire:loading wire:target="export">
                            Processing
                        </span>
                        <span wire:loading.remove wire:target="export">
                            Export Excell
                        </span>
                    </x-kiki.button-with-google-icon>
                </div>
            </div>

            <div class="px-3 py-2">
                {{ $isiTabel->links() }}
            </div>


            <table class="min-w-max w-full table-auto">

                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Universitas</th>
                        <th class="py-3 px-6 text-center">Nilai</th>
                        <th class="py-3 px-6 text-center">Beasiswa Lama</th>
                        <th class="py-3 px-6 text-center">Status Kelulusan</th>
                        
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                @else
                <div class="text-center p-4">
                    kosong
                </div>
                @endif

                <tbody class="text-gray-600 text-sm font-light">

                    @foreach ($isiTabel as $item)

                    @php
                        $nilai=$item->getNilaiAkhir($id_beasiswa);
                    @endphp

                    <tr class="border-b border-gray-200 hover:bg-gray-100
                    @if ($nilai<70)
                        bg-red-100
                    @endif
                    ">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <span class="font-medium">
                                {{ $loop->iteration + $isiTabel->firstItem() - 1 }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="font-medium ">
                                {{$item->nama}} <sup>id: {{$item->id}}</sup>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="font-medium ">
                                {{$item->universitas->singkatan}}
                            </div>
                        </td>

                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            <div class="font-medium ">
                                {{round($nilai,2)}}
                            </div>
                        </td>

                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            @if ($item->menerima_beasiswa)
                            <x-kiki.badge class="bg-green-200 text-gray-500">
                                Penerima
                            </x-kiki.badge>
                            @else
                            <x-kiki.badge class="bg-gray-200 text-gray-500">
                                Tidak menerima
                            </x-kiki.badge>
                            @endif
                        </td>

                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            <div class="font-medium ">
                                @if ($nilai<70)
                                Tidak Lulus
                                @elseif ($item->Menerima4Kali)
                                Menerima 4 kali
                                @else
                                Lulus
                                @endif
                            </div>
                        </td>

                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <a href="{{ route('detailnilai', ['id'=>$item->id,'kembali'=>'hasilnilai']) }}" class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <x-kiki.icon-view/>
                                </a>

                            </div>
                        </td>

                    </tr>
                    @endforeach


                </tbody>
            </table>

        </div>



    </div>




</div>
