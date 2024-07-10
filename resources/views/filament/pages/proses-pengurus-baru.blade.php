<div>
    <x-filament::app-header :title="__($title)" />

    <x-filament::app-content>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @include('layouts.scriptsweetalert')
        {{-- Page content --}}
        {{-- <h1 class="hover:bg-danger-700">Mulai Kepengurusan Baru</h1> --}}
        <div style="text-align: left;">
            <div><b class="text-danger">Perhatian </b>yang akan terjadi setelah anda menekan tombol ok adalah:</div>
            <small>
                <ul>
                    <li>
                        1. Anggota lama akan didemisionerkan semua. Semua demisioner akan direset rolenya menjadi anggota/alumni tapi tidak masuk dalam kepengurusan. 
                    </li>
                    <li>
                        2. untuk Korwil sebelumnya rolenya akan menjadi admin, karena dia akan memilih korwil baru nanti. 
                    </li>
                    <li>
                        3. Semua anggota yang diinputkan, akan dimasukan ke unit masing-masing dan akan memiliki role sebagai anggota.
                        Selanjutnya untuk mengatur role dan kepala unit dapat dilakukan manual pada menu manajemen role dan struktur unit.
                    </li>
                    <li>
                        4. Jangan lupa menghapus form pendaftaran, setelah proses selesai.
                    </li>

                </ul>
            </small>
            <br><small>Pastikan anda menginput nama sesuai dengan database.</small>
        </div>

        <div class="flex justify-end">
            <x-filament::button type="button" color="primary" class="mr-2" wire:click="$emit('swalAndaYakinTrigger','terkonfirmasiKepengurusanBaru')">Proses</x-filament::button>
        </div>
        
    </x-filament::app-content>
</div>
