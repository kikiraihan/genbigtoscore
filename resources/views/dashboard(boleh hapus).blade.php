<x-app-layout>
    <x-slot name="header">
        @include('layouts.navigation',['warna'=>'bg-white'])
    </x-slot>

    <x-slot name="footer">
        @include('layouts.navigationbawah')
    </x-slot>

    
    <x-slot name="scripthalaman">
        
    </x-slot>

    <x-slot name="stylehalaman">
        
    </x-slot>


    <livewire:dashboard />

</x-app-layout>
