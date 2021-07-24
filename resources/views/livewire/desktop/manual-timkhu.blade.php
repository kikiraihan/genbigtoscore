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
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    
    <div id="atas" class="container mx-auto bg-gray-100 mb-28">
        
        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">Tim Khusus</div>
            <div>Semester {{$beasiswa->tahun.'/'.$beasiswa->semester}}</div>
        </div>
        


        {{-- form --}}
        <form wire:submit.prevent="{{$metode}}">

            <div class="container mx-auto md:grid md:grid-rows-3 md:grid-cols-2 md:grid-flow-col gap-2 px-2 mt-8">

                {{-- $kegiatan_nama,text --}}
                <div>
                    <h3>Kegiatan</h3>
                    <label class="f-roboto ml-1 text-gray-500 text-sm">Nama Kegiatan</label>
                    <x-kiki.input-standar wire:model.lazy="kegiatan_nama" id="kegiatan_nama" type="text" placeholder="..." />
                    <x-kiki.error-input :kolom="'kegiatan_nama'" />
                </div>

                {{-- $keterangan, texarea --}}
                <div>
                    <label class="f-roboto ml-1 text-gray-500 text-sm">Keterangan</label>
                    <x-kiki.input-standar wire:model.lazy="keterangan" id="keterangan" type="text" placeholder="..." />
                    <x-kiki.error-input :kolom="'keterangan'" />
                </div>

                {{-- $tanggal_pelaksanaan; text --}}
                <div>
                    <label class="f-roboto ml-1 text-gray-500 text-sm">Waktu/Metode Pelaksanaan</label>
                    <x-kiki.input-standar wire:model.lazy="tanggal_pelaksanaan" id="tanggal_pelaksanaan" type="text" placeholder="..." />
                    <x-kiki.error-input :kolom="'tanggal_pelaksanaan'" />
                </div>

                <div class="grid grid-cols-4 gap-3 items-end">
                    {{-- $tim_nama,text --}}
                    <div class="col-span-3">
                        <h3>Tim</h3>
                        <label class="f-roboto ml-1 text-gray-500 text-sm">Nama Tim <sup class="text-gray-400">*singkatan nama kegiatan</sup></label>
                        <x-kiki.input-standar wire:model.lazy="tim_nama" id="tim_nama" type="text" placeholder="..." />
                        <x-kiki.error-input :kolom="'tim_nama'" />
                    </div>

                    {{-- $bobot,number --}}
                    <div>
                        <label class="f-roboto ml-1 text-gray-500 text-sm">Bobot</label>
                        <x-kiki.input-standar wire:model.lazy="bobot" id="bobot" type="number" placeholder="..." />
                        <x-kiki.error-input :kolom="'bobot'" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    {{-- $id_sb_ToInput, selectBiasa --}}
                    <div>
                        <label class="f-roboto ml-1 text-gray-500 text-sm">Segment Bulan</label>
                        <x-kiki.select-standar wire:model="id_sb_ToInput">
                            <option value="" hidden selected>...</option>
                            @foreach ($selectsegment as $item)
                                <option class="w-full" value='{{$item->id}}'>{{$beasiswa->tahun.", ".$item->namaBulan}}</option>
                            @endforeach
                        </x-kiki.select-standar>
                        <x-kiki.error-input :kolom="'id_sb_ToInput'" />
                    </div>


                    {{-- $jenis,selectBiasa --}}
                    <div>
                        <label class="f-roboto ml-1 text-gray-500 text-sm">Jenis</label>
                        <x-kiki.select-standar wire:model="jenis">
                            <option value="" hidden selected>...</option>
                            <option class="w-full" value='panitia-besar'>Panitia Besar</option>
                            <option class="w-full" value='panitia-kecil'>Panitia Kecil</option>
                        </x-kiki.select-standar>
                        <x-kiki.error-input :kolom="'jenis'" />
                    </div>
                </div>

                {{-- $id_kepala, selectsearch --}}
                <div>
                    <label class="f-roboto ml-1 mr-2 text-gray-500 text-sm capitalize">Pilih Kepala/Ketupat</label>
                    <x-kiki.loading-spin wire:loading wire:target="setKetupat"  class="text-blue-300"/>
                    <x-kiki.molecul.select-search-lite :terpilih="$terpilihSelectKetupat" wire:model="searchSelectKetupat">
                        
                        @foreach ($selectKetupat as $item)
                            <li>
                                <p wire:click="setKetupat({{json_encode([$item->id,$item->nama])}})" x-on:click="open = ! open"
                                    class="p-2 block text-black hover:bg-blue-200 cursor-pointer">
                                    {{$item->nama}}
                                </p>
                            </li>
                        @endforeach
                        
                    </x-kiki.molecul.select-search-lite>
                    <x-kiki.error-input :kolom="'id_kepala'" />
                </div>

                
            </div>

            <x-kiki.loading-spin wire:loading wire:target="{{$metode}}"  class="text-blue-300"/>
            <div class="px-2 mt-3 w-1/2" wire:loading.remove wire:target="{{$metode}}">
                @if ($metode=="newTimkhu")
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

            <div class="grid grid-cols-4 items-center">
                <div class="p-2">
                    <x-kiki.select-standar wire:model="id_sb">
                        <option value="" hidden selected>...</option>
                        @foreach ($selectsegment as $item)
                            <option class="w-full" value='{{$item->id}}'>{{$beasiswa->tahun.", ".$item->namaBulan}}</option>
                        @endforeach
                    </x-kiki.select-standar>
                </div>

                <div class="flex p-2 space-x-1 col-span-3">
                    <button class="w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                        <i class="material-icons">search</i>
                    </button>
                    <x-kiki.input-standar placeholder="Search" type="text" wire:model.debounce.500="search" id="search" class="w-full rounded p-2" />
                </div>
            </div>
            
            <div class="px-3 py-2">
                {{ $isiTabel->links() }}
            </div>
            

            <table class="min-w-max w-full table-auto">
                
                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Id</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Bobot</th>
                        <th class="py-3 px-6 text-left">Kepala Tim</th>
                        <th class="py-3 px-6 text-center">Anggota</th>
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
                            <span class="font-medium">{{$item->id}}</span>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="font-medium ">{{-- w-10 truncate --}}
                                {{$item->nama}}
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap capitalize">
                            <div class="font-medium ">{{-- w-10 truncate --}}
                                {{$item->bobot}} : {{$item->jenis}}
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap capitalize">
                            <div class="font-medium ">{{-- w-10 truncate --}}
                                {{$item->kepala->nama}}
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center whitespace-nowrap capitalize">
                            <div class="font-medium ">{{-- w-10 truncate --}}
                                {{$item->anggotas()->count()}}
                            </div>
                        </td>
                        
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <a href="{{ route('manual.timkhu.anggota', ['id'=>$item->id]) }}" class="w-4 transform hover:text-purple-500 hover:scale-110">
                                    <span class="material-icons-outlined" style="font-size: 20px">
                                        {{-- person_add_alt --}}
                                        how_to_reg
                                    </span>
                                </a>
                                <a href="#atas" wire:click="tampilEdit({{$item->id}})" 
                                    class="w-4 transform hover:text-purple-500 hover:scale-110">
                                    <x-kiki.icon-edit/>
                                </a>
                                <div wire:click="$emit('swalToDeleted','timkhuFixHapus',{{$item->id}})" class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
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
