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

    <script>
        window.livewire.on('swalToBersihkanPiket', () => {
            Swal.fire({
                title: 'Bersihkan Piket Hadir',
                text: "Piket yang berisi 0 tidak hadir dan 0 izin memang tidak akan dihitung disistem, dan akan dihapus",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.value) {
                    
                    window.livewire.emit('fixBersihkanYangHadir');
                    
                    Swal.fire(
                    'Terhapus!',
                    'data telah dihapus.',
                    'success'
                    )
                    
                }
            });
        })

        window.livewire.on('swalToDeletedAllPiket', () => {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda akan semua piket pada segment bulan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.value) {
                    
                    window.livewire.emit('fixHapusSemua');
                    
                    Swal.fire(
                    'Terhapus!',
                    'data telah dihapus.',
                    'success'
                    )
                    
                }
            });
        })
    </script>
</x-slot>

{{--------------------------------------------------------------------------------}}


<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}


    <div id="atas" class="container mx-auto bg-gray-100 mb-28">

        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">
                Piket
                <span class="f-robotomon text-xs font-light">
                    (Yang tidak hadir)
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
        <form action="{{ route('manual.piket.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="md:grid md:grid-cols-2 px-2 mt-8 gap-2">

                
                <div class="container mx-auto">

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="f-roboto ml-1 text-gray-500 text-sm">Segment Bulan</label>
                            <x-kiki.select-standar wire:model="id_sb" name="id_sb">
                                <option value="" hidden selected>...</option>
                                @foreach ($selectsegment as $item)
                                <option class="w-full" value='{{$item->id}}'>{{$item->segtahun.", ".$item->namaBulan}}
                                </option>
                                @endforeach
                            </x-kiki.select-standar>
                            <x-kiki.error-input :kolom="'id_sb'" />
                        </div>
    
                        <div>
                            <label class="f-roboto ml-1 text-gray-500 text-sm">Bobot Pengurangan</label>
                            <x-kiki.select-standar wire:model="bobot" name="bobot">
                                <option value="" hidden selected>...</option>
                                <option class="w-full" value='-2'> - 2</option>
                                {{-- <option class="w-full" value='-3'>3</option> --}}
                                <option class="w-full" value='-5'> - 5</option>
                            </x-kiki.select-standar>
                            <x-kiki.error-input :kolom="'bobot'" />
                        </div>

                        <div class="text-left space-y-1 col-span-2">
                            <label class="f-roboto ml-1 text-gray-500 text-sm block">Upload template (.xlsx)</label>
                            <input type="file" wire:model="filepiket" name="filepiket" class="bg-white shadow text-sm border-none p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-300 placeholder-gray-300">
                            @error('filepiket') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
    

                    <div class="mt-3">
                        <x-kiki.button-manual type="submit" name="submitPass" id="submitPass">
                            Proses
                        </x-kiki.button-manual>
                        {{-- menampilkan error validasi --}}
                        @if (count($errors) > 0)
                        <br>
                        <div class="bg-yellow-100 p-2 text-justify rounded">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
        
                        {{-- menampilkan notif sukses--}}
                        @if ($message = Session::get('info'))
                        <div class="bg-green-100 p-2 text-justify rounded">
                            <span class="text-sm">{{ $message }}</span>
                        </div>
                        @endif
                    </div>


                </div>


                <div class="space-y-2 bg-white py-2 px-4">{{-- keterangan --}}
                    <div class="text-left">
                        <label class="f-roboto ml-1 text-gray-500 text-sm block">Template</label>
                        <x-kiki.button-with-google-icon wire:click="downloadTemplate" :icon="'download'" class="bg-gray-100  shadow-sm text-green-500  inline-flex p-2 rounded cursor-pointer   hover:shadow-md  hover:text-green-400"> {{-- href="{{ asset('keperluan_import/template_piket.xlsx') }}" --}}
                            template.xlsx
                        </x-kiki.button-with-google-icon>
                    </div>

                    <div>Keterangan</div>
                    <div class="text-justify">
                        <span class="text-sm">Template ini memiliki kolom-kolom dengan ketentuan sebagai berikut :</span>
                        <ul class="list-disc list-inside text-sm space-y-3">
                            <li>
                                <b>nama</b>,<br>
                                Berisi nama lengkap dari anggota, sesuai database
                            </li>
                            <li>
                                <b>Jumlah Tidak Piket</b>,<br>
                                Jumlah tidak hadir piket pada segment yang dipilih
                            </li>
                            <li>
                                <b>Jumlah Izin</b>,<br>
                                Jumlah isin pada segment yang dipilih
                            </li>
                        </ul>
                    </div>
                </div>


            </div>

        </form>




        {{-- table --}}
        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

            <div class="grid grid-cols-4 items-center">
                <div class="flex p-2 space-x-1 col-span-3">
                    <button class="w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                        <i class="material-icons">search</i>
                    </button>
                    <x-kiki.input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" id="search"
                        class="w-full rounded p-2" />
                </div>
                <div class="p-2 flex gap-4">
                    <x-kiki.button-table class="w-full" wire:click="$emit('swalToBersihkanPiket')" :warna="'green'">
                        <x-kiki.loading-spin-inline wire:loading wire:target='bersihkanYangHadir' class="text-green-400"/>
                        <span wire:loading.remove wire:target='bersihkanYangHadir' class="material-icons-outlined" style="font-size: 21px">
                            cleaning_services
                        </span>
                        <span class="hidden lg:inline text-sm">Clear Hadir</span>
                    </x-kiki.button-table>

                    <x-kiki.button-table class="w-full" wire:click="$emit('swalToDeletedAllPiket')" :warna="'red'">
                        <x-kiki.loading-spin-inline wire:loading wire:target='hapusSemua' class="text-red-400"/>
                        <span wire:loading.remove wire:target='hapusSemua' class="material-icons-outlined" style="font-size: 21px">
                            delete
                        </span>
                        <span class="hidden lg:inline text-sm">Hapus Semua</span>
                    </x-kiki.button-table>
                </div>
            </div>


            <table class="min-w-max w-full table-auto">

                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Badan</th>
                        <th class="py-3 px-6 text-center">Jumlah Nilai</th>
                        <th class="py-3 px-6 text-center">Total</th>
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
                                {{$item->nama}} <sup>id:{{$item->id}}</sup>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="font-medium ">
                                {{$item->badan->nama}}
                            </div>
                        </td>
                        <td class="py-3 px-6  flex items-center justify-center space-x-2">
                            <div class="text-pink-500 items-center flex space-x-1">
                                <span class="material-icons-outlined text-base">
                                    cancel
                                </span> 
                                <span>
                                    {{$item->pivot->jumlah_tidak_hadir}}
                                </span>
                                {{-- <span class="text-xs">({{$item->pivot->bobot}})</span> --}}
                            </div>
                            {{-- <div> + </div> --}}
                            <div class="text-gray-500 items-center flex space-x-1">
                                <span class="material-icons-outlined text-base">
                                    info
                                </span>
                                <span>
                                    {{$item->pivot->jumlah_izin}}
                                </span> 
                                {{-- <span class="text-xs">(-1)</span> --}}
                            </div>
                        </td>

                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            <div class="font-medium ">
                                {{($item->pivot->jumlah_tidak_hadir*$item->pivot->bobot)+($item->pivot->jumlah_izin*-1)}}
                            </div>
                        </td>

                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <div wire:click="$emit('swalToDeleted','piketFixHapus',{{$item->pivot->id}})" class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
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
