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


<div>

    <div id="atas" class="container mx-auto bg-gray-100 mb-28">

        {{-- table --}}
        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">
                Tanggal Pembayaran Uang Kas
                <x-kiki.loading-spin class="text-blue-500" />
            </div>
        </div>

        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

            <div class="grid grid-cols-4 items-center">
                <div class="flex p-2 space-x-1 col-span-2">
                    <button class="w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                        <i class="material-icons">search</i>
                    </button>
                    <x-kiki.input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" id="search"
                        class="w-full rounded p-2" />
                </div>

                <div class="p-2">
                    <x-kiki.select-standar wire:model="idBeasiswaTo">
                        <option value="" hidden selected>...</option>
                        @foreach ($selectBeasiswa as $item)
                        <option class="w-full" value='{{$item->id}}'>Beasiswa {{$item->tahun.", ".$item->semester}}</option>
                        @endforeach
                    </x-kiki.select-standar>
                </div>
                <div class="p-2">
                    <x-kiki.select-standar wire:model="filterBelum">
                        <option value="" selected>Filter Sudah Belum</option>
                        <option class="w-full" value='sudah'>Sudah Bayar</option>
                        <option class="w-full" value='belum'>Belum Bayar</option>
                    </x-kiki.select-standar>
                </div>
            </div>

            <table class="min-w-max w-full table-auto">
                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-3 text-left">No</th>
                        <th class="py-3 px-3 text-left">Nama</th>
                        <th class="py-3 px-3 text-left">Univ</th>
                        <th class="py-3 px-3 text-left">Tanggal Uang Kas</th>
                        <th class="py-3 px-3 text-center">Aksi</th>
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
                        <td class="py-3 px-3 text-left">
                            <span class="font-medium">
                                {{ $loop->iteration + $isiTabel->firstItem() - 1 }}
                            </span>
                        </td>
                        <td class="py-3 px-3 text-left">
                            {{$item->nama}}
                        </td>
                        <td class="py-3 px-3 text-left">
                            {{$item->universitas->singkatan}}
                        </td>
                        <td class="py-3 px-3 text-left">
                            @if ($item->pivot->tgl_uang_kas)
                                {{Carbon\Carbon::parse($item->pivot->tgl_uang_kas)}}
                            @endif
                        </td>
                        <td class="py-3 px-3 text-center">
                            <div class="flex item-center justify-center space-x-9">
                                <div wire:click="stampTanggalBayar({{$item->id}})"
                                    class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <span class="material-icons-outlined" style="font-size: 20px">
                                        done
                                    </span>
                                </div>
                                <div wire:click="$emit('swalToDeleted','FixHapusTglUangKas',{{$item->id}})" class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <span class="material-icons-outlined font-bold" style="font-size: 20px">
                                        close
                                    </span>
                                </div>
                            </div>
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
    {{-- id --}}


</div>
