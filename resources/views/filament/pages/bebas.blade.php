<div>
    <x-filament::app-header :title="__($title)" />

    <x-filament::app-content>
        @include('layouts.app-style-in-filament')
        @include('layouts.app-script-in-filament')
        {{-- @livewireStyles --}}
        {{-- @livewireScripts --}}
        {{-- @include('layouts.scriptsweetalert') --}}
        {{-- @include('layouts.kikiassets') --}}
        {{-- Page content --}}
        Catatan Panduan
        <x-kiki.button-copy-url :url="'https://s.id/genbi-penilaian-panduan'" :id="1" :text="'https://s.id/genbi-penilaian-panduan'" />
        <br><br>
        Drive Video Tutorial
        <x-kiki.button-copy-url :url="'https://s.id/drive-gss'" :text="'https://s.id/drive-gss'" />
    </x-filament::app-content>
</div>
