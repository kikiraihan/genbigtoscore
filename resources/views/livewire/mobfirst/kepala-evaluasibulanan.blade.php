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
    {{-- The whole world belongs to you. --}}


    <div id="atas" class="container mx-auto bg-gray-100 mb-28">

        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">
                Evaluasi Bulanan
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






        {{-- table --}}
        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

            <div class="grid grid-cols-8 items-center">
                <div class="p-2 col-span-3">
                    <x-kiki.select-standar wire:model="id_sb">
                        <option value="" hidden selected>...</option>
                        @foreach ($selectsegment as $item)
                        <option class="w-full" value='{{$item->id}}'>{{$item->segtahun.", ".$item->namaBulan}}</option>
                        @endforeach
                    </x-kiki.select-standar>
                </div>

                <div class="flex p-2 space-x-1 col-span-4">
                    <button class="w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                        <i class="material-icons">search</i>
                    </button>
                    <x-kiki.input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" id="search"
                        class="w-full rounded p-2" />
                </div>
                <div class="p-2">
                    <button wire:click="refreshEb" type="button"
                    class="shadow px-2 py-2 rounded focus:outline-none focus:ring-2 w-full truncate
                        items-center flex justify-center
                        hover:bg-gray-200 focus:ring-blue-300 text-gray-600 bg-gray-100">
                        <x-kiki.loading-spin wire:loading wire:target='refreshEb' class="text-blue-400"/>
                        <span wire:loading.remove wire:target='refreshEb' class="material-icons-outlined md:hidden" style="font-size: 21px">
                        sync
                        </span>
                        <span class="hidden md:inline text-sm">Sinkronkan</span>
                    </button>
                </div>
            </div>


            <table class="min-w-max w-full table-auto">

                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Unit</th>
                        {{-- <th class="py-3 px-6 text-center">
                            Nilai
                        </th> --}}
                        <th class="py-3 px-6 text-center">
                            Ganti
                            <x-kiki.loading-spin wire:loading wire:target="ganti"  class="ml-2 text-blue-300"/>
                        </th>
                        {{-- <th class="py-3 px-6 text-center">Actions</th> --}}
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
                                {{$item->nama}} <sup>#{{$item->id}}</sup>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="font-medium ">
                                {{$item->unit->nama}}
                            </div>
                        </td>

                        {{-- <td class="py-3 px-6 text-center whitespace-nowrap capitalize">
                            {{$item->pivot->nilai}}
                        </td> --}}

                        <td class="py-3 px-6 text-center select-none">
                            <div class="flex item-center justify-around shadow rounded">
                                
                                <x-kiki.button-with-google-icon  :icon="'star_outline'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'0'])}})" 
                                class="transform hover:text-red-500 hover:scale-110 cursor-pointer 
                                {{-- @if($item->pivot->nilai=='0')  --}}
                                text-red-300
                                {{-- @endif --}}
                                ">
                                    0
                                </x-kiki.button-with-google-icon>

                                <x-kiki.button-with-google-icon  :icon="'star_outline'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'1/5'])}})" 
                                class="transform hover:text-red-400 hover:scale-110 cursor-pointer">
                                    1
                                </x-kiki.button-with-google-icon>
                                
                                <x-kiki.button-with-google-icon  :icon="'star_outline'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'2/5'])}})" 
                                class="transform hover:text-yellow-500 hover:scale-110 cursor-pointer">
                                    2
                                </x-kiki.button-with-google-icon>
                                
                                <x-kiki.button-with-google-icon  :icon="'star_outline'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'3/5'])}})" 
                                class="transform hover:text-green-300 hover:scale-110 cursor-pointer">
                                    3
                                </x-kiki.button-with-google-icon>

                                <x-kiki.button-with-google-icon  :icon="'star_outline'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'4/5'])}})" 
                                class="transform hover:text-green-500 hover:scale-110 cursor-pointer">
                                    4
                                </x-kiki.button-with-google-icon>

                                <x-kiki.button-with-google-icon  :icon="'star_outline'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'5/5'])}})" 
                                class="transform hover:text-green-500 hover:scale-110 cursor-pointer">
                                    5
                                </x-kiki.button-with-google-icon>
                                
                            </div>

                            <div>
                                <div class="h-3 relative w-full overflow-hidden">
                                    <div class="w-full h-full bg-gray-200 absolute"></div>
                                    <div id="bar" class="h-full absolute
                                        @if (explode("/",$item->pivot->nilai)[0]>=4)
                                            bg-green-400
                                        @elseif (explode("/",$item->pivot->nilai)[0]>=3)
                                            bg-green-300
                                            @elseif (explode("/",$item->pivot->nilai)[0]>=2)
                                            bg-yellow-300
                                        @else
                                            bg-red-400
                                        @endif
                                        @if (explode("/",$item->pivot->nilai)[0]==5)
                                            w-full
                                        @else
                                            w-{{explode("/",$item->pivot->nilai)[0]}}/5
                                        @endif
                                    "> . </div>
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