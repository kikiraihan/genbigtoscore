<div>
    <x-filament::app-header :title="__($title)" />

    {{-- Dari Layout App lama --}}
    @include('layouts.app-style-in-filament')
    
    <x-filament::app-content>

        <div class="bg-blue-100 p-2 rounded shadow-sm">
            <div class="font-bold">Kebutuhan data: </div>
            <div class="text-justify py-2 px-4">
                Daftar penerima beasiswa. 
                <ul class="list-disc list-inside text-sm">
                    <li>Penerima beasiswa terbaru, termasuk</li>
                    <li>GenBI lama yang diperpanjang beasiswa, termasuk</li>
                    <li>GenBI lama yang tidak diperpanjang beasiswa tapi masih mau aktif, <b>tidak termasuk </b></li>
                    <li>Hanya nama lengkap saja</li>
                </ul>
            </div>
        </div>

        <livewire:atur-beasiswa />
    </x-filament::app-content>

    @include('layouts.app-script-in-filament')
    
</div>
