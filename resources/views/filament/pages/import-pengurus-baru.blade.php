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
        <x-kiki.button-with-google-icon :icon="'flag'" class="bg-white shadow-sm text-gray-500  inline-flex p-2 rounded cursor-pointer hover:shadow-md hover:text-gray-600 "
            wire:click="$emit('swalMulaiKepengurusanBaru')">
                Mulai kepengurusan baru
        </x-kiki.button-with-google-icon>
    </x-filament::app-content>

    @include('layouts.app-script-in-filament')
</div>
