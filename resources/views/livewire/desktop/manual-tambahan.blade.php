<x-slot name="header">
    @include('layouts.navigation',['warna'=>'bg-white'])
    @include('layouts.navigation-tab',['warna'=>'bg-white'])
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
    {{-- Because she competes with no one, no one can compete with her. --}}


    <div id="atas" class="container mx-auto bg-gray-100 mb-28">

        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">
                Tambahan
                <span class="f-robotomon text-xs font-light">
                    (Prestasi/ Kehadiran Pengganti/ Tugas Lain)
                </span>
                <x-kiki.loading-spin wire:loading  class="text-blue-500"/>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <div class="text-xs">Beasiswa Semester</div>                
                    <x-kiki.select-standar wire:model="idBea" class="bg-gray-100 shadow-none text-lg">
                        <option value="" hidden selected>...</option>
                        @foreach ($selectBeasiswa as $item)
                            <option class="w-full" value='{{$item->id}}'>{{$item->tahun."/".$item->semester}}</option>
                        @endforeach
                    </x-kiki.select-standar>
                </div>
            </div>
        </div>



        {{-- form --}}
        <form wire:submit.prevent="{{$metode}}">

            <div class="container mx-auto md:grid md:grid-rows-2 md:grid-cols-2 md:grid-flow-col gap-2 px-2 mt-8">

                <div>
                    <label class="f-roboto ml-1 text-gray-500 text-sm">Judul</label>
                    <x-kiki.input-standar wire:model.lazy="judul" id="judul" type="text"
                        placeholder="..." />
                    <x-kiki.error-input :kolom="'judul'" />
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="f-roboto ml-1 text-gray-500 text-sm">Segment Bulan</label>
                        <x-kiki.select-standar wire:model="id_sb_ToInput">
                            <option value="" hidden selected>...</option>
                            @foreach ($selectsegment as $item)
                            <option class="w-full" value='{{$item->id}}'>{{$item->segtahun.", ".$item->namaBulan}}
                            </option>
                            @endforeach
                        </x-kiki.select-standar>
                        <x-kiki.error-input :kolom="'id_sb_ToInput'" />
                    </div>

                    <div>
                        <label class="f-roboto ml-1 text-gray-500 text-sm">Nilai</label>
                        <x-kiki.input-standar wire:model.lazy="nilai" id="nilai" type="number"
                            placeholder="..." />
                        <x-kiki.error-input :kolom="'nilai'" />
                    </div>
                </div>

                <div>
                    <label class="f-roboto ml-1 mr-2 text-gray-500 text-sm capitalize">Pilih Anggota</label>
                    <x-kiki.loading-spin wire:loading wire:target="setAnggota"  class="text-blue-300"/>
                    <x-kiki.molecul.select-search-lite :terpilih="$terpilihSelectAnggota"
                        wire:model.debounce.500ms="searchSelectAnggota">

                        @foreach ($selectAnggota as $item)
                        <li>
                            <p wire:click="setAnggota({{json_encode([$item->id,$item->nama])}})"
                                x-on:click="open = ! open"
                                class="p-2 block text-black hover:bg-blue-200 cursor-pointer">
                                {{$item->nama}}
                            </p>
                        </li>
                        @endforeach

                    </x-kiki.molecul.select-search-lite>
                    <x-kiki.error-input :kolom="'id_anggota'" />
                </div>


            </div>

            <x-kiki.loading-spin wire:loading wire:target="{{$metode}}"  class="text-blue-300"/>
            <div class="px-2 mt-3 w-1/2" wire:loading.remove wire:target="{{$metode}}">
                @if ($metode=="newTambahan")
                <input class="shadow p-2 w-full rounded focus:outline-none focus:ring-2             
                    focus:ring-green-300  text-white bg-green-500
                    cursor-pointer" type="submit" name="submitPass" id="submitPass" value="Tambah">
                @else
                <div class="flex space-x-2">
                    <button wire:click="resetAbisUpdate" type="button" class="shadow p-2 w-full rounded focus:outline-none focus:ring-2             
                        focus:ring-green-300  text-gray-600 bg-gray-200">Batal</button>

                    <input class="shadow p-2 w-full rounded focus:outline-none focus:ring-2             
                        focus:ring-green-300  text-white bg-yellow-500
                        cursor-pointer" type="submit" name="submitPass" id="submitPass" value="Update">
                </div>
                @endif
            </div>

        </form>




        {{-- table --}}
        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

            <div class="grid grid-cols-4 items-center">
                <div class="p-2">
                    <x-kiki.select-standar wire:model="id_sb">
                        <option value="" hidden selected>...</option>
                        @foreach ($selectsegment as $item)
                        <option class="w-full" value='{{$item->id}}'>{{$item->segtahun.", ".$item->namaBulan}}</option>
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
            </div>


            <table class="min-w-max w-full table-auto">

                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Judul</th>
                        <th class="py-3 px-6 text-center">Nilai</th>
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
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <span class="font-medium">
                                {{ $loop->iteration + $isiTabel->firstItem() - 1 }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="font-medium ">
                                {{$item->nama}}
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="font-medium ">
                                {{$item->pivot->judul}}
                            </div>
                        </td>

                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            <div class="font-medium ">
                                {{$item->pivot->nilai}}
                            </div>
                        </td>

                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <div wire:click="$emit('swalToDeleted','tambahanFixHapus',{{$item->pivot->id}})" class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <x-kiki.icon-trash/>
                                </div>
                            </div>
                        </td>

                    </tr>
                    @endforeach


                </tbody>
            </table>

            <div class="px-3 py-2">
                {{ $isiTabel->links() }}
            </div>

        </div>






    </div>



</div>
