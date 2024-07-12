<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>
    

<div class="container w-full md:max-w-4xl mx-auto pt-20"> {{-- xl:pt-0 --}}

    <div class="f-playfair font-bold text-2xl capitalize text-center">
        Form Absensi
    </div>

    <div class="flex p-2 space-x-1 col-span-3 items-center justify-center">
        <span>
            {{$absensi->title}}
        </span>
        <span class="py-3 px-6 text-center capitalize font-semibold">
            @if ($absensi->skope=="badan")
            <div class="inline-flex absensis-center space-x-1 bg-gray-200 text-gray-600 rounded">
                <span class="material-icons-outlined text-sm rounded-l p-0.5 text-white @if ($absensi->absensiable->id==1) bg-blue-500 @elseif ($absensi->absensiable->id==2) bg-red-400 @elseif ($absensi->absensiable->id==3) bg-green-400 @elseif ($absensi->absensiable->id==4) bg-yellow-400 @endif">
                    people
                </span>
                <span class="text-xs py-0.5 px-1.5">
                    All {{$absensi->absensiable->nama}}
                </span>
            </div>
            @elseif ($absensi->skope=="unit")
            <span class="bg-gray-100 text-gray-500 border border-gray-200 py-0.5 px-1.5 rounded text-xs">
                {{$absensi->absensiable->singkat}}
            </span>
            @elseif ($absensi->skope=="timkhu")
            <span class="bg-yellow-200 text-yellow-600 py-0.5 px-1.5 rounded text-xs">
                @if ($absensi->absensiable)
                    {{$absensi->absensiable->nama}}
                @else
                    {{$absensi->absensiable_id}}
                @endif
            </span>
            @elseif ($absensi->skope=="seluruh-genbi")
            <span class="bg-blue-200 text-blue-600 py-0.5 px-1.5 rounded text-xs">
                All GenBI
            </span>
            @endif
        </span>
        <span>
            {{-- {{$absensi->date->diffForHumans()}} --}}
            {{$absensi->date->format('D, d M Y. h:i a')}}
        </span>
    </div>

    <div class="flex p-2 space-x-1 col-span-3">
        <div>
            <label class="f-roboto ml-1 text-gray-500 text-sm">Username (NIM)</label>
            <x-kiki.input-standar wire:model.lazy="username" id="username" type="text" placeholder="..." />
            <x-kiki.error-input :kolom="'username'" />
        </div>

        <div>
            <label class="f-roboto ml-1 text-gray-500 text-sm">Password</label>
            <x-kiki.input-standar wire:model.lazy="password" id="password" type="text" placeholder="..." />
            <x-kiki.error-input :kolom="'password'" />
        </div>
        
        {{-- <div>
            <label class="f-roboto ml-1 text-gray-500 text-sm">Unit</label>
                <x-kiki.select-standar wire:model="id_unit">
                    <option value="" hidden selected>...</option>
                    @foreach ($selectUnit as $item)
                    <option class="w-full" value="{{$item->id}}"> {{$item->nama}}/{{$item->singkat}}
                    </option>
                    @endforeach
                </x-kiki.select-standar>
                <x-kiki.error-input :kolom="'id_unit'" />
        </div> --}}
    </div>
    
    <x-kiki.button-standar wire:click="addForm" class="bg-green-200 shadow-sm text-green-500  inline-flex p-2 rounded cursor-pointer hover:shadow-md ">
            simpan
        </x-kiki.button-standar>

    



    {{-- table --}}
    <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

        <div class="grid grid-cols-4 items-center py-2">
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
                    <th class="py-3 px-6 text-center">Diisi/belum</th>
                    <th class="py-3 px-6 text-center">Status</th>
                </tr>
            </thead>
            @else
            <div class="text-center p-4">
                kosong
            </div>
            @endif

            <tbody class="text-gray-600 text-sm font-light">

                @foreach ($isiTabel as $kehadiran)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">
                        <span class="font-medium">
                            {{ $loop->iteration + $isiTabel->firstItem() - 1 }}
                        </span>
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{$kehadiran->anggota->nama}}
                    </td>
                    <td class="py-3 px-6 text-center">
                        @if ($kehadiran->sudah_diisi)
                        <span class="bg-gray-200 text-gray-600 py-0.5 px-1.5 rounded text-xs">
                            Diisi
                        </span>
                        @else
                        <span class="bg-gray-200 text-gray-600 py-0.5 px-1.5 rounded text-xs">
                            Belum
                        </span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center whitespace-nowrap capitalize">
                        @if ($kehadiran->kondisi=='hadir')
                        <span class="bg-green-200 text-green-600 py-0.5 px-1.5 rounded text-xs">
                            Hadir
                        </span>
                        @elseif ($kehadiran->kondisi=='tidakhadir')
                        <span class="bg-pink-200 text-pink-600 py-0.5 px-1.5 rounded text-xs">
                            Tidak Hadir
                        </span>
                        @elseif ($kehadiran->kondisi=='izin')
                        <span class="bg-gray-100 text-gray-500 border border-gray-200 py-0.5 px-1.5 rounded text-xs">
                            Izin
                        </span>
                        @endif
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>

        <div class="px-3 col-span-3">
            {{ $isiTabel->links() }}
        </div>

    </div>

</div>
