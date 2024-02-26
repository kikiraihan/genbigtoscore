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
        window.livewire.on('swalEditMasterBadan', (namaOld,id) => {
            
            const { value: nama } = Swal.fire({
            title: 'Edit Badan',
            text:"Nama sebelumnya : "+namaOld,
            input: 'text',
            inputPlaceholder: 'Masukan nama baru',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Anda harus mengisinya!'
                }
                return new Promise((resolve) => {
                    // console.log(value)
                    window.livewire.emit('terkonfirmasiEditMasterBadan',value, id);
                    resolve()
                })
            }
            
        })
            
        })

        window.livewire.on('swalTambahMasterBadan', () => {
            
            const { value: nama } = Swal.fire({
            title: 'Tambah Badan',
            input: 'text',
            inputPlaceholder: 'Masukan nama badan',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Anda harus mengisinya!'
                }
                return new Promise((resolve) => {
                    // console.log(value)
                    window.livewire.emit('terkonfirmasiTambahMasterBadan',value);
                    resolve()
                })
            }
            
        })
            
        })
    </script>
</x-slot>


<div>
        {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div id="atas" class="container mx-auto bg-gray-100 mb-28">

        {{-- table --}}
        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">
                Struktur - Badan
                <x-kiki.loading-spin class="text-blue-500" />
            </div>
        </div>

        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

            <div class="flex items-center py-2 px-4 space-x-2">
                <x-kiki.button-with-google-icon :icon="'add'" class="bg-white shadow-sm text-gray-500  inline-flex p-2 rounded cursor-pointer hover:shadow-md hover:text-gray-600 hover:bg-green-200 "
                    wire:click="$emit('swalTambahMasterBadan')">
                    Tambah
                </x-kiki.button-with-google-icon>
                <div class=" w-full">
                    <div class="flex space-x-1">
                        <button class="w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                            <i class="material-icons">search</i>
                        </button>
                        <x-kiki.input-standar placeholder="Search" type="text" wire:model.debounce.500ms="search" id="search"
                            class="w-full rounded p-2" />
                    </div>
                </div>
            </div>

            <table class="min-w-max w-full table-auto">
                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Unit</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
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
                            {{$item->id}}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{$item->nama}}
                        </td>
                        <td class="py-3 px-6 text-left space-x-4">
                            <div class="flex items-center space-x-1">
                                <span class="material-icons-outlined text-green-400" style="font-size: 20px">
                                    group
                                </span>
                                <span>
                                    {{$item->units->count()}}
                                </span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <div wire:click="$emit('swalEditMasterBadan','{{$item->nama}}',{{$item->id}})" 
                                    class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <x-kiki.icon-edit/>
                                </div>
                                <div wire:click="$emit('swalToDeleted','masterBadanFixHapus',{{$item->id}})" class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <x-kiki.icon-trash/>
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
