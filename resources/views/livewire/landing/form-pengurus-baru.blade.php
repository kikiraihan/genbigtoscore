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
    {{-- Be like water. --}}

    <div id="atas" class="container mx-auto bg-gray-100 mb-28">

        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold md:text-2xl capitalize">
                Anggota
                <x-kiki.loading-spin wire:loading  class="text-blue-500"/>
            </div>
        </div>


        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

            <div class="grid grid-cols-4 items-center py-2">
                <div class="flex p-2 space-x-1 col-span-3">
                    <button class="w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                        <i class="material-icons">search</i>
                    </button>
                    <x-kiki.input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" id="search"
                        class="w-full rounded p-2" />
                </div>

                <div class="text-center">
                    Unit
                </div>
            </div>

            <table class="min-w-max w-full table-auto">
                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Kampus</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
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
                        <td class="py-3 px-6 text-left">
                            <span class="font-medium">
                                {{ $loop->iteration + $isiTabel->firstItem() - 1 }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{$item->nama}} 
                            @if ($item->user->hasRole(['Kepala Unit','Korwil','Kekom']))
                            <span class="material-icons-outlined" style="font-size: 20px">    
                                supervised_user_circle
                            </span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-left flex space-x-1">
                            @foreach ($item->user->getRoleNames() as $r)
                                <x-kiki.badge class="bg-blue-200 text-gray-500">
                                    {{$r}}
                                </x-kiki.badge>
                            @endforeach
                        </td>

                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <x-kiki.molecul.dropdown-tabel :title="'Opsi'">
                                    <x-kiki.molecul.dropdown-tabel-item class="cursor-pointer" wire:click="$emit('swalAndaYakin','terkonfirmasiPilihKetuaUnit',{{$item->id}},'anda akan menunjuk dia sebagai Kadiv/Ketua')">
                                        <div class="flex items-center space-x-2 text-gray-500">
                                            <span class="material-icons-outlined">
                                                supervised_user_circle
                                            </span>
                                            <span>Pilih Kepala</span>
                                        </div>
                                    </x-kiki.molecul.dropdown-tabel-item>
                                    <x-kiki.molecul.dropdown-tabel-item class="cursor-pointer" wire:click="pindahUnit({{$item->id}})">
                                        <div class="flex items-center space-x-2 text-yellow-300">
                                            <span class="material-icons-outlined">
                                                social_distance
                                            </span>
                                            <span>Pindah Unit</span>
                                        </div>
                                    </x-kiki.molecul.dropdown-tabel-item>
                                    
                                    <x-kiki.molecul.dropdown-tabel-item class="cursor-pointer" 
                                    wire:click="$emit('swalAndaYakin','terkonfirmasiDemisioner',{{$item->id}}, 'Anda akan mendemisionerkan anggota ini. Dia akan dikeluarkan dari pengurus, status akan menjadi nonaktif/pasif dan semua role akan direset kembali menjadi anggota biasa. Kecuali data unitnya terakhir akan tetap disimpan.')">
                                        <div class="flex items-center space-x-2 text-red-300">
                                            <span class="material-icons-outlined">
                                                person_off
                                            </span>
                                            <span>Demisionerkan</span>
                                        </div>
                                    </x-kiki.molecul.dropdown-tabel-item>
                                    
                                    <x-kiki.molecul.dropdown-tabel-item class="cursor-pointer" 
                                    wire:click="$emit('swalAndaYakin','terkonfirmasiResetKeanggotaan',{{$item->id}},'Keanggotaan dalam pengurus akan direset: semua role akan dihapus dan tersisa `anggota` dan unit menjadi `pengurus inti`')">
                                        <div class="flex items-center space-x-2">
                                            <span class="material-icons-outlined">
                                                restart_alt
                                            </span>
                                            <span>Reset Keanggotaan</span>
                                        </div>
                                    </x-kiki.molecul.dropdown-tabel-item>
                                </x-kiki.molecul.dropdown-tabel>

                            </div>
                        </td>

                        {{-- <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <div wire:click="$emit('swalAndaYakin','terkonfirmasiPilihKetuaUnit',{{$item->id}},'anda akan menunjuk dia sebagai Kadiv/Ketua')" class="w-4 transform hover:text-purple-500 hover:scale-110 flex items-center  cursor-pointer">
                                    <span class="material-icons-outlined" style="font-size: 20px">    
                                        supervised_user_circle
                                    </span>
                                </div>
                                <div wire:click="pindahUnit({{$item->id}})" class="w-4 transform hover:text-yellow-400 hover:scale-110 flex items-center  cursor-pointer">
                                    <span class="material-icons-outlined text-base font-bold "  style="font-size: 20px">
                                        social_distance
                                    </span>
                                </div>
                                <div class="w-4 transform hover:text-red-300 hover:scale-110 flex items-center  cursor-pointer"
                                    wire:click="$emit('swalAndaYakin','terkonfirmasiDemisioner',{{$item->id}}, 'Anda akan mendemisionerkan anggota ini. Dia akan dikeluarkan dari pengurus, status akan menjadi nonaktif/pasif dan semua role akan direset kembali menjadi anggota biasa. Kecuali data unitnya terakhir akan tetap disimpan.')">
                                    <span class="material-icons-outlined text-base font-bold "  style="font-size: 20px">
                                        person_off
                                    </span>
                                </div>
                                <div wire:click="$emit('swalAndaYakin','terkonfirmasiResetKeanggotaan',{{$item->id}},'Keanggotaan dalam pengurus akan direset: semua role akan dihapus dan tersisa `anggota` dan unit menjadi `pengurus inti`')" class="w-4 transform hover:text-purple-500 hover:scale-110 flex items-center cursor-pointer">
                                    <span class="material-icons-outlined" style="font-size: 20px">    
                                        restart_alt
                                    </span>
                                </div>
                            </div>
                        </td> --}}
                    </tr>
                    @endforeach


                </tbody>
            </table>

            <div class="px-3 col-span-3">
                {{ $isiTabel->links() }}
            </div>
            {{-- <div class="px-3">
                <button type="button" class="shadow p-2 w-full rounded focus:outline-none 
                            focus:ring-2 focus:ring-green-300  text-gray-600 bg-gray-200
                            hover:bg-green-300
                            ">
                    <span class="material-icons-outlined text-base">
                        add
                    </span>
                    Mulai Beasiswa Baru
                </button>
            </div> --}}

        </div>

    </div>
</div>
