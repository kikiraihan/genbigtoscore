<div>
    <x-filament::app-header :title="__($title)" />

    @include('layouts.app-style-in-filament')
    
    <x-filament::app-content>
        @livewireStyles
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


        {{-- Page content --}}
        <div class="bg-blue-100 p-2 rounded shadow-sm">
            <div class="font-bold">Kebutuhan data: </div>
            <div class="text-justify py-2 px-4">
                Daftar username(nim) semua calon pengurus.
                <ul class="list-disc list-inside text-sm">
                    <li>GenBI baru Penerima beasiswa, <b class="text-blue-500">termasuk</b></li>
                    <li>GenBI lama yang diperpanjang beasiswa, <b class="text-blue-500">termasuk</b></li>
                    <li>GenBI lama yang tidak diperpanjang beasiswa tapi masih mau aktif, <b class="text-blue-500">termasuk</b></li>
                    <li>Hanya nim saja</li>
                </ul>
            </div>
        </div>
        <br>

        <x-kiki.button-with-google-icon :icon="'flag'" class="bg-white shadow-sm text-gray-500  inline-flex p-2 rounded cursor-pointer hover:shadow-md hover:text-gray-600 "
            wire:click="$emit('swalMulaiKepengurusanBaru')">
                Mulai kepengurusan baru
        </x-kiki.button-with-google-icon>
    </x-filament::app-content>

    @include('layouts.app-script-in-filament')
</div>
