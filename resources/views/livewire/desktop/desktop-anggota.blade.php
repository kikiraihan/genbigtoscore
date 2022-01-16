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
        window.livewire.on('swalErrorMulaiKepengurusan', (tampilError) => {
        Swal.fire({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            icon: 'warning',
            title: 'Terjadi kesalahan',
            html: tampilError,
        });
        //$('#modalInput').modal('hide');
    })
    </script>
</x-slot>

{{--------------------------------------------------------------------------------}}


<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div id="atas" class="container mx-auto bg-gray-100 mb-28">
        
        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">
                All Anggota
                <x-kiki.loading-spin wire:loading  class="text-blue-500"/>
            </div>
            
            {{-- hanya tampil di paginasi pertama --}}
            @if ($jumlahWilayah)
            <span class="flex items-center space-x-2 text-sm">
                <span class="material-icons-outlined" style="font-size: 20px">
                    group
                </span>
                <span>Jumlah Pengurus Aktif </span>
                <div class="bg-white shadow-sm px-2 rounded">
                    <span>
                        {{$jumlahWilayah+$jumlahung+$jumlahIAIN+$jumlahUG}} :
                    </span>
                    <span class="text-xs">
                        [ Wil {{$jumlahWilayah}},
                    </span>
                    <span class="text-xs">
                        UNG {{$jumlahung}},
                    </span>
                    <span class="text-xs">
                        IAIN {{$jumlahIAIN}},
                    </span>
                    <span class="text-xs">
                        UG {{$jumlahUG}} ]
                    </span>
                </div>
            </span>
            @endif
            
        </div>

        <div class="mt-2">
            <x-kiki.button-with-google-icon :icon="'flag'" class="bg-white shadow-sm text-gray-500  inline-flex p-2 rounded cursor-pointer hover:shadow-md hover:text-gray-600 "
            wire:click="$emit('swalMulaiKepengurusanBaru')">
                Mulai kepengurusan baru
            </x-kiki.button-with-google-icon>

            <x-kiki.button-with-google-icon href="{{ route('form.tambahanggota') }}" :icon="'group_add'" class="bg-white shadow-sm text-green-500  inline-flex p-2 rounded cursor-pointer   hover:shadow-md  hover:text-green-600">
                Import Anggota Baru
            </x-kiki.button-with-google-icon>

        </div>

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

                {{-- <div class="p-2">
                    <x-kiki.select-standar wire:model="angkatan">
                        <option value="" hidden selected>...</option>
                        <option value="1">1</option>
                        @foreach ($selectsegment as $item)
                        <option class="w-full" value='{{$item->id}}'>{{$beasiswa->tahun.", ".$item->namaBulan}}</option>
                        @endforeach
                    </x-kiki.select-standar>
                </div> --}}
                <div class="text-center">
                    <label for="toggle" class="text-xs text-gray-700 mr-2">
                        Hanya Demisioner
                    </label>
                    <x-kiki.toggle :label="'Hanya aktif'">
                        <input wire:model="statusAktif" type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                    </x-kiki.toggle>
                </div>
            </div>


            <table class="min-w-max w-full table-auto">

                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        {{-- <th class="py-3 px-6 text-left">Universitas</th> --}}
                        <th class="py-3 px-6 text-left">Role</th>
                        <th class="py-3 px-6 text-right">Unit</th>
                        <th class="py-3 px-6 text-right">Angkatan</th>
                        <th class="py-3 px-6 text-center">Penerima</th>
                        <th class="py-3 px-6 text-center">Aktif/Pasif</th>
                        
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
                                {{$item->nama}}
                            </div>
                        </td>
                        {{-- <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="font-medium ">
                                {{$item->universitas->singkatan}}
                            </div>
                        </td> --}}

                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="font-medium ">
                                {{json_encode($item->user->getRoleNames())}}
                            </div>
                        </td>

                        <td class="py-3 px-6 text-right whitespace-nowrap">
                            <div class="font-medium ">
                                @if ($item->kepengurusan)
                                {{$item->namaUnitSingkat}}
                                @endif
                            </div>
                        </td>

                        <td class="py-3 px-6 text-right whitespace-nowrap space-x-1">
                            @if ($item->tahunmasukkuliah)
                            <x-kiki.badge class="border-gray-200 border text-gray-500">
                                <sup>Univ : </sup> {{$item->tahunmasukkuliah}}
                            </x-kiki.badge>
                            @else
                            <x-kiki.badge class="border-gray-200 border text-gray-500">
                                ...
                            </x-kiki.badge>
                            @endif
                            <x-kiki.badge class="bg-blue-200 text-gray-500">
                                <sup>GenBI : </sup> <span class="font-bold">{{$item->awalmasukgenbi}}</span>
                            </x-kiki.badge>
                        </td>


                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            @if ($item->menerima_beasiswa)
                            <x-kiki.badge class="bg-green-200 text-gray-500">
                                Penerima
                            </x-kiki.badge>
                            @else
                            <x-kiki.badge class="bg-gray-200 text-gray-500">
                                Tidak menerima
                            </x-kiki.badge>
                            @endif
                        </td>

                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            @if($item->kepengurusan->tanggal_demisioner==NULL && $item->awalmasukgenbi=="not found")
                            <x-kiki.badge class="bg-blue-400 text-white">
                                GenBI Baru
                            </x-kiki.badge>
                            @elseif ($item->kepengurusan->tanggal_demisioner==NULL)
                            <x-kiki.badge class="bg-green-300 text-white">
                                Aktif
                            </x-kiki.badge>
                            @else
                            <x-kiki.badge class="bg-gray-200 text-gray-500">
                                <small>Demis :</small> {{$item->kepengurusan->tanggal_demisioner->format('d M y')}}
                            </x-kiki.badge>
                            @endif
                        </td>

                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <x-kiki.molecul.dropdown-tabel :title="'Opsi'">
                                    <x-kiki.molecul.dropdown-tabel-item class="cursor-pointer" wire:click="editRole({{$item->id}})">
                                        <div class="flex items-center space-x-2 text-gray-500">
                                            <span class="material-icons">
                                                change_circle
                                            </span>
                                            <span>Edit Role</span>
                                        </div>
                                    </x-kiki.molecul.dropdown-tabel-item>
                                    <x-kiki.molecul.dropdown-tabel-item class="cursor-pointer" wire:click="pindahUnit({{$item->id}})">
                                        <div class="flex items-center space-x-2 text-yellow-300">
                                            <span class="material-icons">
                                                social_distance
                                            </span>
                                            <span>Pindah Unit</span>
                                        </div>
                                    </x-kiki.molecul.dropdown-tabel-item>
                                    
                                    @if ($item->kepengurusan->tanggal_demisioner==NULL)
                                    <x-kiki.molecul.dropdown-tabel-item class="cursor-pointer" 
                                        wire:click="$emit('swalAndaYakin','terkonfirmasiDemisioner',{{$item->id}}, 'Anda akan mendemisionerkan anggota ini. Status akan menjadi nonaktif/pasif dan semua role akan dihapus dan diset kembali menjadi anggota biasa')">
                                        <div class="flex items-center space-x-2 text-red-300">
                                            <span class="material-icons">
                                                unpublished
                                            </span>
                                            <span>Non Aktifkan</span>
                                        </div>
                                    </x-kiki.molecul.dropdown-tabel-item>
                                    @else
                                    <x-kiki.molecul.dropdown-tabel-item class="cursor-pointer" wire:click="aktifkanKembali({{$item->id}})">
                                        <div class="flex items-center space-x-2 text-green-400">
                                            <span class="material-icons">
                                                check_circle
                                            </span>
                                            <span>Aktifkan</span>
                                        </div>
                                    </x-kiki.molecul.dropdown-tabel-item>
                                    @endif
                                    
                                    <x-kiki.molecul.dropdown-tabel-item class="cursor-pointer" 
                                        wire:click="$emit('swalAndaYakin','terkonfirmasiResetPasswordAnggota',{{$item->id}}, 'Anda akan me-reset password user ini. Untuk login kembali masukan kata `password` di kolom password')">
                                        <div class="flex items-center space-x-2">
                                            <span class="material-icons">
                                                password
                                            </span>
                                            <span>ResetPassword</span>
                                        </div>
                                    </x-kiki.molecul.dropdown-tabel-item>
                                </x-kiki.molecul.dropdown-tabel>

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
