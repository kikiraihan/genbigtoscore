<div>
    <x-filament::app-header :title="__($title)" />

    {{-- Dari Layout App lama --}}
    @include('layouts.app-style-in-filament')
    
    <x-filament::app-content>
        <livewire:form.desktop-tambahanggota/>
    </x-filament::app-content>

    @include('layouts.app-script-in-filament')>
</div>
