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
    {{-- Stop trying to control. --}}

    
    <div id="atas" class="container mx-auto bg-gray-100 mb-28">
        
        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">Absensi</div>
            <div>Semester {{$beasiswa->tahun.'/'.$beasiswa->semester}}</div>
        </div>
        




        {{-- form --}}
        <form wire:submit.prevent="{{$metode}}">

            <div class="container mx-auto grid grid-rows-3 grid-cols-2 grid-flow-col gap-2 px-2 mt-8">

                <div>
                    <label class="f-roboto ml-1 text-gray-500 text-sm">Title</label>
                    <x-kiki.input-standar wire:model.lazy="title" id="title" type="text" placeholder="..." />
                    <x-kiki.error-input :kolom="'title'" />
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="f-roboto ml-1 text-gray-500 text-sm">Start</label>
                        <x-kiki.input-standar type="datetime-local" wire:model.lazy="date" id="date" />
                        <x-kiki.error-input :kolom="'date'" />
                    </div>
    
                    <div>
                        <label class="f-roboto ml-1 text-gray-500 text-sm">Deadline</label>
                        <div class="flex items-center">
                            <x-kiki.input-standar type="datetime-local" wire:model.lazy="deadline_absen" id="deadline_absen" />
                            @if ($deadline_absen)
                            <span wire:click="setDeadlinetonull" class="cursor-pointer select-none text-gray-400 px-2">
                                <span class="material-icons-outlined text-base">
                                    clear
                                </span>
                            </span>
                            @endif
                        </div>
                        <x-kiki.error-input :kolom="'deadline_absen'" />
                    </div>
                </div>

                <div>
                    <label class="f-roboto ml-1 text-gray-500 text-sm">Bobot Pengurangan</label>
                    <x-kiki.select-standar wire:model="pengurangan">
                        <option value="" hidden selected>...</option>
                        <option class="w-full" value='-2'>2</option>
                        {{-- <option class="w-full" value='-3'>3</option> --}}
                        <option class="w-full" value='-5'>5</option>
                    </x-kiki.select-standar>
                    <x-kiki.error-input :kolom="'pengurangan'" />
                </div>

                @if ($metode=="newAbsen")
                {{-- <div>
                    <label class="f-roboto ml-1 text-gray-500 text-sm">Kondisi awal</label>
                    <x-kiki.select-standar wire:model="inisial_kondisi">
                        <option value="" hidden selected>...</option>
                        <option class="w-full" value="hadir">Hadir semua</option>
                        <option class="w-full" value="tidakhadir">Tidak Hadir semua</option>
                        <option class="w-full" value="izin">Izin</option>
                    </x-kiki.select-standar>
                    <x-kiki.error-input :kolom="'inisial_kondisi'" />
                </div> --}}
                <div>
                    <label class="f-roboto ml-1 text-gray-500 text-sm">Skope</label>
                    <x-kiki.select-standar wire:model="skope">
                        <option value="" hidden selected>...</option>
                        <option class="w-full" value='seluruh-genbi'> Seluruh Genbi</option>
                        <option class="w-full" value='badan'>Badan </option>
                        {{-- *Wilayah/Komisariat --}}
                        <option class="w-full" value='unit'>Unit </option>
                        {{-- *Departemen/Divisi --}}
                        <option class="w-full" value='timkhu'>Tim Khusus </option>
                        {{-- *Khusus panitia --}}
                    </x-kiki.select-standar>
                    <x-kiki.error-input :kolom="'skope'" />
                </div>
                @endif

                @if (!($skope==null or $skope=='seluruh-genbi') and $metode=="newAbsen")
                <div>
                    <label class="f-roboto ml-1 mr-2 text-gray-500 text-sm capitalize">Pilih {{$skope}}</label>
                    <x-kiki.loading-spin wire:loading wire:target="setAbsensiable"  class="text-blue-300"/>
                    <x-kiki.molecul.select-search-lite :terpilih="$terpilihSelectSkope" wire:model="searchSelectSkope">
                        
                        @foreach ($selectAbsensiable as $item)
                            <li>
                                <p wire:click="setAbsensiable({{json_encode([$item->id,$item->nama])}})" x-on:click="open = ! open"
                                    class="p-2 block text-black hover:bg-blue-200 cursor-pointer">
                                    {{$item->nama}}
                                </p>
                            </li>
                        @endforeach
                        {{-- {{ $selectAbsensiable->links() }} --}}
                        
                    </x-kiki.molecul.select-search-lite>
                    <x-kiki.error-input :kolom="'absensiable_id'" />
                </div>
                @endif


                
            </div>

            <x-kiki.loading-spin wire:loading wire:target="{{$metode}}"  class="text-blue-300"/>
            <div class="px-2 mt-3 w-1/2" wire:loading.remove wire:target="{{$metode}}">
                @if ($metode=="newAbsen")
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
                        <th class="py-3 px-6 text-left">Title</th>
                        <th class="py-3 px-6 text-right">Date</th>
                        <th class="py-3 px-6 text-center">Skope</th>
                        <th class="py-3 px-6 text-center">Peserta</th>
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
                            <div class="font-medium w-96 truncate">
                                {{$item->title}}
                                <sup>bobot : -{{$item->pengurangan}}</sup>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-right">
                            <div>
                                <sup>Waktu :</sup> {{$item->date->format('d M Y, h:i')}}
                            </div>
                            <div class="text-red-400">
                                @if ($item->deadline_absen!=null)
                                <sup>Deadline :</sup> {{$item->deadline_absen->format('d M Y, h:i')}}
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center capitalize font-semibold">
                            @if ($item->skope=="badan")
                            <span class="bg-gray-200 text-gray-600 py-0.5 px-1.5 rounded text-xs">
                                {{$item->absensiable->nama}}
                            </span>
                            @elseif ($item->skope=="unit")
                            <span class="bg-gray-100 text-gray-500 border border-gray-200 py-0.5 px-1.5 rounded text-xs">
                                {{$item->absensiable->singkat}}
                            </span>
                            @elseif ($item->skope=="timkhu")
                            <span class="bg-yellow-200 text-yellow-600 py-0.5 px-1.5 rounded text-xs">
                                {{$item->absensiable->nama}}
                            </span>
                            @elseif ($item->skope=="seluruh-genbi")
                            <span class="bg-blue-200 text-blue-600 py-0.5 px-1.5 rounded text-xs">
                                All GenBI
                            </span>
                            @endif
                        </td>
                        <td class="py-3 px-6  flex items-center justify-center space-x-2">
                            <div class="text-green-500 items-center flex space-x-1">
                                <span class="material-icons-outlined text-base">
                                    task_alt
                                </span> 
                                <span>
                                    {{$item->kehadiran()->hanyayanghadir()->count()}}
                                </span>
                            </div>
                            <div class="text-pink-500 items-center flex space-x-1">
                                <span class="material-icons-outlined text-base">
                                    cancel
                                </span> 
                                <span>
                                    {{$item->kehadiran()->hanyayangtidakhadir()->count()}}
                                </span>
                            </div>
                            <div class="text-gray-500 items-center flex space-x-1">
                                <span class="material-icons-outlined text-base">
                                    info
                                </span>
                                <span>
                                    {{$item->kehadiran()->hanyayangizin()->count()}}
                                </span> 
                            </div>
                            {{-- /{{$item->kehadiran->count()}}  --}}
                        </td>

                        
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <a href="{{ route('manual.absen.kehadiran', ['id'=>$item->id]) }}" class="w-4 transform hover:text-purple-500 hover:scale-110">
                                    <span class="material-icons-outlined" style="font-size: 20px">
                                        how_to_reg
                                    </span>
                                </a>
                                <a href="#atas" wire:click="tampilEdit({{$item->id}})" 
                                    class="w-4 transform hover:text-purple-500 hover:scale-110">
                                    <x-kiki.icon-edit/>
                                </a>
                                <div wire:click="$emit('swalToDeleted','absenFixHapus',{{$item->id}})" class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
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
