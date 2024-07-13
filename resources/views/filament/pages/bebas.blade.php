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
        <div class="gap-2 flex-col flex">
            @foreach ([
            [route('landing.form-pengurus-baru'),'Form Pengurus Baru'],
            ['https://s.id/genbi-penilaian-panduan','Catatan Panduan'],
            ['https://s.id/drive-gss','Drive Video Tutorial'],
        ] as $key=>$item)
            <div class="py-2 px-4 bg-gray-50  rounded shadow-sm inline-flex gap-2 justify-between">
                <label>{{$item[1]}}</label>
                <x-kiki.button-copy-url :url="$item[0]" :id="$key" :text="$item[0]" />
            </div>
        @endforeach
        </div>
    </x-filament::app-content>
</div>
