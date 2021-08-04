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
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    
    <div class="container mx-auto bg-gray-100 mb-28">
        
        <div class="flex justify-between items-center mt-6 capitalize">
            <div class="f-playfair font-bold text-2xl">
                Anggota Tim
                <x-kiki.loading-spin wire:loading  class="text-blue-500"/>
            </div>
            <div class="items-center flex space-x-2">
                <sup>Tim :</sup>
                <span>{{$tim->nama}}</span>
                <span class="text-xs bg-gray-50 py-0.5 px-1.5 rounded-full text-blue-400 font-bold">
                    {{explode('-',$tim->jenis)[1]}} : {{$tim->bobot}}
                </span>
            </div>
            <x-kiki.button-with-google-icon href="{{ route('manual.timkhu') }}" :icon="'arrow_back'" class="hover:text-blue-700">
                Kembali
            </x-kiki.button-with-google-icon>
        </div>

        {{-- form --}}
        {{-- form --}}
        <form wire:submit.prevent="{{$metode}}">

            <div class="container mx-auto md:grid md:grid-rows-2 md:grid-cols-2 md:grid-flow-col gap-2 px-2 mt-8">

                

                {{-- $id_kepala, selectsearch --}}
                <div>
                    <h5 class="flex space-x-2 items-center ml-2 mb-1">
                        <span class="material-icons-outlined" style="font-size: 20px">
                            person_add_alt
                        </span>
                        <span>
                            Tambah Anggota Baru
                        </span>
                    </h5>
                    <label class="f-roboto ml-1 mr-2 text-gray-500 text-sm capitalize">Pilih Anggota</label>
                    <x-kiki.loading-spin wire:loading wire:target="setAbar"  class="text-blue-300"/>
                    <x-kiki.molecul.select-search-lite :terpilih="$terpilihSelectAbar" wire:model="searchSelectAbar">
                        
                        @foreach ($selectAbar as $item)
                            <li>
                                <p wire:click="setAbar({{json_encode([$item->id,$item->nama])}})" x-on:click="open = ! open"
                                    class="p-2 block text-black hover:bg-blue-200 cursor-pointer">
                                    {{$item->nama}}
                                </p>
                            </li>
                        @endforeach
                        
                    </x-kiki.molecul.select-search-lite>
                    <x-kiki.error-input :kolom="'id_abar'" />
                </div>

                <div>
                    <label class="f-roboto ml-1 text-gray-500 text-sm">Peran</label>
                    <x-kiki.select-standar wire:model="peran">
                        <option value="" hidden selected>...</option>
                        <option class="w-full" value='kepala'>Kepala/Ketupat</option>
                        <option class="w-full" value='anggota'>Anggota</option>
                        <option class="w-full" value='pengurus-inti'>Pengurus Inti</option>
                    </x-kiki.select-standar>
                    <x-kiki.error-input :kolom="'peran'" />
                </div>

                
            </div>
            
            <x-kiki.loading-spin wire:loading wire:target="{{$metode}}"  class="text-blue-300"/>
            <div class="px-2 mt-3 w-1/2" wire:loading.remove wire:target="{{$metode}}">
                @if ($metode=="newTimkhuAnggota")
                <input class="shadow p-2 w-full rounded focus:outline-none focus:ring-2             
                focus:ring-green-300  text-white bg-green-500
                cursor-pointer" type="submit" name="submitPass"
                id="submitPass" value="Tambah">
                @else
                <div class="flex space-x-2">
                    <button wire:click="resetAbisUpdate" type="button" class="shadow p-2 w-full rounded focus:outline-none focus:ring-2             
                    focus:ring-green-300  text-gray-600 bg-gray-200" >Batal</button>
                    
                    <input class="shadow p-2 w-full rounded focus:outline-none focus:ring-2             
                        focus:ring-green-300  text-white bg-yellow-500
                        cursor-pointer" type="submit" name="submitPass"
                        id="submitPass" value="Update">
                </div>
                @endif
            </div>

        </form>



        
        {{-- table --}}
        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
            
            

            <div class="flex p-2 space-x-1 col-span-3">
                <button class="w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                    <i class="material-icons">search</i>
                </button>
                <x-kiki.input-standar placeholder="Search" type="text" wire:model.debounce.500="search" id="search" class="w-full rounded p-2" />
            </div>
            
            
            <div class="px-3 py-2">
                {{ $isiTabel->links() }}
            </div>

            

            <table class="min-w-max w-full table-auto">
                
                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        {{-- <th class="py-3 px-6 text-left">Id</th> --}}
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-center">Peran</th>
                        <th class="py-3 px-6 text-center">
                            Nilai <x-kiki.loading-spin wire:loading wire:target="ganti"  class="text-blue-300 ml-2"/>
                        </th>
                        <th class="py-3 px-6 text-center text-green-600">
                            Ganti Nilai
                        </th>
                        
                        <th class="py-3 px-6 text-center text-green-600">Action</th>
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
                        <td class="py-3 px-6 text-center whitespace-nowrap capitalize select-none">
                            @if ($item->pivot->peran=='kepala')
                            <span class="bg-pink-200 text-pink-600 py-0.5 px-1.5 rounded text-xs">
                                Kepala Tim
                            </span>
                            @elseif ($item->pivot->peran=='anggota')
                            <span class="bg-gray-100 text-gray-500 border border-gray-200 py-0.5 px-1.5 rounded text-xs">
                                Anggota
                            </span>
                            @elseif ($item->pivot->peran=='pengurus-inti')
                            <span class="bg-gray-100 text-gray-500 border border-gray-200 py-0.5 px-1.5 rounded text-xs mr-2">
                                Pengurus Inti
                            </span>
                            <sup>*bobot setengah</sup>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center whitespace-nowrap capitalize">
                            {{$item->pivot->nilai}}
                        </td>
                        <td class="py-3 px-6 text-center select-none">
                            <div class="flex item-center justify-around shadow rounded">
                                
                                <x-kiki.button-with-google-icon  :icon="'star_outline'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'0'])}})" 
                                class="transform text-red-300 hover:text-red-500 hover:scale-110 cursor-pointer">
                                    0
                                </x-kiki.button-with-google-icon>

                                <x-kiki.button-with-google-icon  :icon="'star_outline'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'1/5'])}})" 
                                class="transform hover:text-pink-500 hover:scale-110 cursor-pointer">
                                    1
                                </x-kiki.button-with-google-icon>
                                
                                <x-kiki.button-with-google-icon  :icon="'star_outline'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'2/5'])}})" 
                                class="transform hover:text-yellow-500 hover:scale-110 cursor-pointer">
                                    2
                                </x-kiki.button-with-google-icon>
                                
                                <x-kiki.button-with-google-icon  :icon="'star_outline'" 
                                wire:click="ganti({{json_encode([$item->pivot->id,'3/5'])}})" 
                                class="transform hover:text-yellow-500 hover:scale-110 cursor-pointer">
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
                        </td>

                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                {{-- <a href="#atas" wire:click="tampilEdit({{$item->id}})" 
                                    class="w-4 transform hover:text-purple-500 hover:scale-110">
                                    <x-kiki.icon-edit/>
                                </a> --}}
                                <div wire:click="$emit('swalToDeleted','anggotaTimkhuFixHapus',{{$item->id}})" class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <x-kiki.icon-trash/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

        </div>








    </div>



</div>
