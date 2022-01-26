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
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    
    <div class="container mx-auto bg-gray-100 mb-28">
        
        <div class="flex justify-between items-center mt-6 capitalize space-x-4 px-3 md:px-0">
            <div class="f-playfair font-bold text-2xl capitalize">
                Kehadiran
                <x-kiki.loading-spin wire:loading  class="text-blue-500"/>
            </div>
            <x-kiki.button-with-google-icon href="{{ route('kaunit.absen') }}" :icon="'arrow_back'" class="hover:text-blue-700">
                Kembali
            </x-kiki.button-with-google-icon>
        </div>
        <div class="md:flex block md:items-center">
            <div class="px-3 md:px-0">Absen : {{$abs->title}}</div>
            <div class="py-3 px-6  flex items-center justify-left space-x-2">
                <div class="text-green-500 items-center flex space-x-1">
                    <span class="material-icons-outlined text-base">
                        task_alt
                    </span> 
                    <span>
                        {{$abs->kehadiran()->hanyayanghadir()->count()}}
                    </span>
                </div>
                <div class="text-pink-500 items-center flex space-x-1">
                    <span class="material-icons-outlined text-base">
                        cancel
                    </span> 
                    <span>
                        {{$abs->kehadiran()->hanyayangtidakhadir()->count()}}
                    </span>
                </div>
                <div class="text-gray-500 items-center flex space-x-1">
                    <span class="material-icons-outlined text-base">
                        info
                    </span>
                    <span>
                        {{$abs->kehadiran()->hanyayangizin()->count()}}
                    </span> 
                </div>
            </div>
        </div>





        



        
        {{-- table --}}
        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
            
            

            <div class="flex p-2 space-x-1 col-span-3">
                <button class="w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                    <i class="material-icons">search</i>
                </button>
                <x-kiki.input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" id="search" class="w-full rounded p-2" />
            </div>
            
            
            

            <table class="min-w-max w-full table-auto">
                
                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        {{-- <th class="py-3 px-6 text-left">Id</th> --}}
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-center">Kehadiran</th>
                        <th class="py-3 px-6 text-center">Ganti</th>
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
                        {{-- <td class="py-3 px-6 text-left whitespace-nowrap">
                            <span class="font-medium">{{$item->id}}</span>
                        </td> --}}
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="font-medium ">{{-- w-10 truncate --}}
                                {{$item->nama}}
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center whitespace-nowrap capitalize">
                            @if ($item->pivot->kondisi=='hadir')
                            <span class="bg-green-200 text-green-600 py-0.5 px-1.5 rounded text-xs">
                                Hadir
                            </span>
                            @elseif ($item->pivot->kondisi=='tidakhadir')
                            <span class="bg-pink-200 text-pink-600 py-0.5 px-1.5 rounded text-xs">
                                Tidak Hadir
                            </span>
                            @elseif ($item->pivot->kondisi=='izin')
                            <span class="bg-gray-100 text-gray-500 border border-gray-200 py-0.5 px-1.5 rounded text-xs">
                                Izin
                            </span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center select-none">
                            <div class="flex item-center justify-around shadow rounded">
                                @if ($item->pivot->kondisi!='hadir')
                                <x-kiki.button-with-google-icon  :icon="'task_alt'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'hadir'])}})" 
                                class="transform hover:text-green-500 hover:scale-110 cursor-pointer">
                                    Hadir
                                </x-kiki.button-with-google-icon>
                                @endif
                                @if ($item->pivot->kondisi!='tidakhadir')
                                <x-kiki.button-with-google-icon  :icon="'unpublished'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'tidakhadir'])}})" 
                                class="transform hover:text-red-500 hover:scale-110 cursor-pointer">
                                    Tidak Hadir
                                </x-kiki.button-with-google-icon>
                                @endif
                                @if ($item->pivot->kondisi!='izin')
                                <x-kiki.button-with-google-icon  :icon="'info'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'izin'])}})" 
                                class="transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    Izin
                                </x-kiki.button-with-google-icon>
                                @endif
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
