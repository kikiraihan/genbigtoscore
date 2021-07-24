<x-app-layout>
    <x-slot name="header">
        @include('layouts.navigationback',['warna'=>'bg-white','kata'=>'Pengaturan Akun','link_balik'=>"dashboard"])
    </x-slot>
    <x-slot name="footer">
        {{-- @include('layouts.navigationbawah') --}}
    </x-slot>
    <x-slot name="stylehalaman">
        @livewireStyles
    </x-slot>

    <x-slot name="scripthalaman">
        @livewireScripts
        @include('layouts.scriptsweetalert')
    </x-slot>


    
    <livewire:pengaturan-akun/>




    {{-- <br><br><br>
    <br><br> --}}


</x-app-layout>
