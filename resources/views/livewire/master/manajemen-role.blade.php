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
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div id="atas" class="container mx-auto bg-gray-100 mb-28">

        {{-- table --}}
        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">
                Manajemen - Role
                <x-kiki.loading-spin class="text-blue-500" />
            </div>
        </div>

        @foreach ($roleUsers as $role=>$isiTabel)
        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

            <div class="flex items-center py-2 px-4 justify-between">
                {{-- <x-kiki.button-with-google-icon :icon="'add'" class="bg-white shadow-sm text-gray-500  inline-flex p-2 rounded cursor-pointer hover:shadow-md hover:text-gray-600 hover:bg-green-200 "
                    wire:click="tampilTambah">
                        Tambah
                </x-kiki.button-with-google-icon> --}}
                <div class="text-center">
                    {{$role}}
                </div>
            </div>

            <table class="min-w-max w-full table-auto">
                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Username</th>
                        <th class="py-3 px-6 text-left">Email</th>
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
                        <td class="py-3 px-6 text-left">
                            {{$item->anggota->nama}} 
                            @if ($item->anggota->kepengurusan->tanggal_demisioner==NULL)
                            <x-kiki.badge class="bg-green-300 text-white">
                                Aktif
                            </x-kiki.badge>
                            @else
                            <x-kiki.badge class="bg-gray-200 text-gray-500">
                                <small>Demis</small>
                            </x-kiki.badge>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{$item->username}}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{$item->email}}
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
                                </x-kiki.molecul.dropdown-tabel>
                            </div>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>


        </div>{{-- div kotak pertama --}}
        @endforeach

    </div>
    {{-- id --}}


</div>
