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

    <script>
        window.livewire.on('swalEditMasterUnit', (judul,isi,idMahasiswa) => {
            
            const { value: formValues } = Swal.fire({
                title: judul,
                html: '<div class="px-1 pb-2">'+isi+'</div>',
                focusConfirm: false,
                showCancelButton: true,
                preConfirm: () => {
                    const nama = Swal.getPopup().querySelector('#nama').value
                    const singkat = Swal.getPopup().querySelector('#singkat').value
                    const badan = Swal.getPopup().querySelector('#badan').value
                    const status = Swal.getPopup().querySelector('#status').value
                    if (!nama) 
                        return Swal.showValidationMessage(`anda harus mengisi nama`)
                    else if (!singkat) 
                        return Swal.showValidationMessage(`anda harus mengisi nama singkat`)
                    else if (!badan) 
                        return Swal.showValidationMessage(`anda harus mengisi badan`)
                    else if (!status) 
                        return Swal.showValidationMessage(`anda harus mengisi status`)
                        
                    return { nama: nama, singkat: singkat, badan: badan, status: status  }
                }
            }).then((result)=>{
                if(result.isConfirmed)
                    window.livewire.emit('terkonfirmasiEditMasterUnit',result.value, idMahasiswa);
                    resolve()
            })
            
        })

        window.livewire.on('swalTambahMasterUnit', (judul,isi) => {
            
            const { value: formValues } = Swal.fire({
                title: judul,
                html: '<div class="px-1 pb-2">'+isi+'</div>',
                focusConfirm: false,
                showCancelButton: true,
                preConfirm: () => {
                    const nama = Swal.getPopup().querySelector('#nama').value
                    const singkat = Swal.getPopup().querySelector('#singkat').value
                    const badan = Swal.getPopup().querySelector('#badan').value
                    const status = Swal.getPopup().querySelector('#status').value
                    if (!nama) 
                        return Swal.showValidationMessage(`anda harus mengisi nama`)
                    else if (!singkat) 
                        return Swal.showValidationMessage(`anda harus mengisi nama singkat`)
                    else if (!badan) 
                        return Swal.showValidationMessage(`anda harus mengisi badan`)
                    else if (!status) 
                        return Swal.showValidationMessage(`anda harus mengisi status`)
                    
                    return { nama: nama, singkat: singkat, badan: badan, status: status  }
                },
            }).then((result)=>{
                if(result.isConfirmed)
                    window.livewire.emit('terkonfirmasiTambahMasterUnit',result.value);
                    resolve()
            })
            
        })
    </script>
</x-slot>


<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div id="atas" class="container mx-auto bg-gray-100 mb-28">

        {{-- table --}}
        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">
                Struktur - Unit
                <x-kiki.loading-spin class="text-blue-500" />
            </div>
        </div>

        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

            <div class="flex items-center py-2 px-4 justify-between">
                <x-kiki.button-with-google-icon :icon="'add'" class="bg-white shadow-sm text-gray-500  inline-flex p-2 rounded cursor-pointer hover:shadow-md hover:text-gray-600 hover:bg-green-200 "
                    wire:click="tampilTambah">
                        Tambah
                </x-kiki.button-with-google-icon>
                <div class="text-center">
                    Unit
                </div>
            </div>

            <table class="min-w-max w-full table-auto">
                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Badan</th>
                        <th class="py-3 px-6 text-left">KODE/ID</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left hidden lg:table-cell">Anggota</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                @else
                <div class="text-center p-4">
                    kosong
                </div>
                @endif

                <tbody class="text-gray-600 text-sm font-light">

                    @foreach ($isiTabel as $key=>$item)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">
                            <span class="font-medium">
                                {{ $key + 1 }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-left bold
                        @if ($item->badan->id==1)
                        text-blue-500
                        @elseif ($item->badan->id==2)
                        text-red-500
                        @elseif ($item->badan->id==3)
                        text-green-500
                        @elseif ($item->badan->id==4)
                        text-yellow-500
                        @endif
                        ">
                            {{$item->badan->nama}}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{$item->singkat}}/{{$item->id}}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{$item->nama}}
                        </td>
                        <td class="py-3 px-6 text-left justify-start space-x-4 hidden lg:flex">
                            <div class="flex items-center space-x-1">
                                <span class="material-icons-outlined text-green-400" style="font-size: 20px">
                                    person
                                </span>
                                <span>
                                    {{$item->anggotaAktif->count()}}
                                </span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <span class="material-icons-outlined text-gray-400" style="font-size: 20px">
                                    person_off
                                </span>
                                <span>
                                    {{$item->anggotaDemisioner->count()}}
                                </span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <span class="text-xs">
                                     :
                                </span>
                                @if ($item->ketua)
                                <span>
                                    {{$item->ketua->nama}}
                                    {{-- <sup>
                                        id: {{$item->ketua->id}}
                                    </sup> --}}
                                </span>
                                @else
                                <span class="">
                                    ...
                                </span>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <span class="capitalize px-1 py-0.5 rounded text-xs @if($item->status=="aktif") bg-green-400 text-green-50 @else bg-gray-300 text-gray-600 @endif">
                                Unit {{$item->status}}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <a href="{{ route('master.unit.edit-anggota', ['id'=>$item->id]) }}" class="w-4 transform hover:text-purple-500 hover:scale-110">
                                    <span class="material-icons-outlined" style="font-size: 20px">    
                                        manage_accounts
                                    </span>
                                </a>
                                <div wire:click="tampilEdit({{$item->id}})" 
                                    class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <x-kiki.icon-edit/>
                                </div>
                                <div wire:click="$emit('swalToDeleted','masterUnitFixHapus',{{$item->id}})" class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <x-kiki.icon-trash/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>


        </div>{{-- div kotak pertama --}}




        <hr>


        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

            <div class="grid grid-cols-4 items-center p-2">
                <div class="flex items-center justify-center space-x-1">
                    <span class="material-icons-outlined text-gray-500" style="font-size: 20px">
                        person_off
                    </span>
                    <span class="text-gray-400 p-2 rounded text-lg bold f-bebas">
                        Demisioner
                    </span>
                </div>
                <div class="flex p-2 space-x-1 col-span-3">
                    <button class="w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                        <i class="material-icons">search</i>
                    </button>
                    <x-kiki.input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" id="search"
                        class="w-full rounded p-2" />
                </div>
            </div>

            <table class="min-w-max w-full table-auto">
                @if ($demis->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Role Sebelumnya</th>
                        <th class="py-3 px-6 text-left">Tanggal Demis</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                @else
                <div class="text-center p-4">
                    kosong
                </div>
                @endif

                <tbody class="text-gray-600 text-sm font-light">

                    @foreach ($demis as $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">
                            <span class="font-medium">
                                {{ $loop->iteration + $demis->firstItem() - 1 }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{$item->anggota->nama}}
                        </td>
                        <td class="py-3 px-6 text-left text-xs">
                            {{$item->jabatan}} | {{$item->anggota->namaunitsingkat}}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{$item->anggota->kepengurusan->tanggal_demisioner->diffForHumans()}}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <div 
                                wire:click="$emit('swalAndaYakin','terkonfirmasiAktifkanAnggotaUnit',{{$item->anggota->id}},'anda akan mengaktifkan dan memasukannya kembali ke dalam kepengurusan anda')" class="w-4 transform hover:text-purple-500 hover:scale-110 flex items-center cursor-pointer"
                                class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <span class="material-icons-outlined" style="font-size: 20px">    
                                        how_to_reg
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

            <div class="px-3 col-span-3">
                {{ $demis->links() }}
            </div>

        </div>


    </div>
    {{-- id --}}


</div>
