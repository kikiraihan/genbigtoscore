<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot>
    

<div class="container w-full md:max-w-4xl mx-auto pt-20"> {{-- xl:pt-0 --}}

    <div class="f-playfair font-bold text-2xl capitalize">
        Form Pengurus Baru
    </div>

        <div class="flex p-2 space-x-1 col-span-3">
            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Username (NIM)</label>
                <x-kiki.input-standar wire:model.lazy="username" id="username" type="text" placeholder="..." />
                <x-kiki.error-input :kolom="'username'" />
            </div>
            
            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Unit</label>
                    <x-kiki.select-standar wire:model="id_unit">
                        <option value="" hidden selected>...</option>
                        @foreach ($selectUnit as $item)
                        <option class="w-full" value="{{$item->id}}"> {{$item->nama}}/{{$item->singkat}}
                        </option>
                        @endforeach
                    </x-kiki.select-standar>
                    <x-kiki.error-input :kolom="'id_unit'" />
            </div>
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
                    <th class="py-3 px-6 text-left">Unit dipilih</th>
                    <th class="py-3 px-6 text-left">Badan</th>
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
                        {{$item->anggota->nama}} | nim : {{$item->anggota->user->username}}
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{$item->unit->nama}}
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{$item->unit->badan->nama}}
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
