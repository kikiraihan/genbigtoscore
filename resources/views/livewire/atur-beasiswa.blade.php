{{-- <x-slot name="header">
    @include('layouts.navigation',['warna'=>'bg-white'])
</x-slot>

<x-slot name="footer">
</x-slot> --}}
{{-- <x-slot name="stylehalaman">
</x-slot>
<x-slot name="scripthalaman">    
</x-slot> --}}

{{--------------------------------------------------------------------------------}}


<div>
    {{-- styleHalaman --}}
    @livewireStyles
    {{-- scripthalaman --}}
    @livewireScripts
    @include('layouts.scriptsweetalert')
    <script>
        window.livewire.on('swalMulaiBeasiswaBaru', (judul,isi) => {
            
            const { value: formValues } = Swal.fire({
                title: judul,
                html: '<div class="px-1 pb-2">'+isi+'</div>',
                focusConfirm: false,
                showCancelButton: true,
                preConfirm: () => {
                    const tahun = Swal.getPopup().querySelector('#tahun').value
                    const semester = Swal.getPopup().querySelector('#semester').value
                    const bulan_awal = Swal.getPopup().querySelector('#bulan_awal').value
                    return { tahun: tahun, semester: semester, bulan_awal: bulan_awal  }
                }
            }).then((result)=>{
                if(result.isConfirmed)
                    window.livewire.emit('terkonfirmasiMulaiBeasiswaBaru',result.value);
                    resolve()
            })
            
        })
    </script>
    {{-- Be like water. --}}



    <div id="atas" class="container mx-auto bg-gray-100 mb-28">

        {{-- table --}}
        <div class="flex justify-between items-center mt-6">
            <div class="f-playfair font-bold text-2xl capitalize">
                Beasiswa
                <x-kiki.loading-spin wire:loading class="text-blue-500" />
            </div>
        </div>

        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

            <div class="grid grid-cols-4 items-center py-2">
                <div class="px-3 col-span-3">
                    {{ $isiTabel->links() }}
                </div>
                <div class="px-3">
                    <button wire:click="mulaiBeasiswaBaru" type="button" class="shadow p-2 w-full rounded focus:outline-none 
                                focus:ring-2 focus:ring-green-300  text-gray-600 bg-gray-200
                                hover:bg-green-300
                                ">
                        <span class="material-icons-outlined text-base">
                            add
                        </span>
                        Mulai Beasiswa Baru
                    </button>
                </div>
            </div>

            <table class="min-w-max w-full table-auto">
                @if ($isiTabel->isNotEmpty())
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Id</th>
                        <th class="py-3 px-6 text-left">Dibuat Pada</th>
                        <th class="py-3 px-6 text-left">Tahun/Semester</th>
                        <th class="py-3 px-6 text-center">Penerima</th>
                        <th class="py-3 px-6 text-center">Segment</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                @else
                <div class="text-center p-4">
                    kosong
                </div>
                @endif

                <tbody class="text-gray-600 text-sm font-light">

                    @foreach ($isiTabel as $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">
                            <span class="font-medium">{{$item->id}}</span>
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{$item->created_at->diffForHumans()}}
                        </td>
                        <td class="py-3 px-6 text-left">
                            Beasiswa {{$item->tahun}}/{{$item->semester}}
                        </td>
                        <td class="py-3 px-6 text-center flex justify-center space-x-1">
                            <span class="material-icons-outlined text-gray-400" style="font-size: 20px">
                                group
                            </span>
                            <span>
                                {{$item->anggotas->count()}}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex justify-center space-x-1">
                                <span class="material-icons-outlined text-gray-400" style="font-size: 20px">
                                    segment
                                </span>
                                <span>
                                    {{$item->segmentbulanan->count()}}
                                </span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-7">
                                <a href="#" wire:click="tampilTambahPenerima({{$item->id}})"
                                    class="w-4 transform hover:text-purple-500 hover:scale-110">
                                    <span class="material-icons-outlined" style="font-size: 20px">
                                        person_add
                                    </span>
                                </a>
                                <a href="#atas" wire:click="tampilTambahSegment({{$item->id}})"
                                    class="w-4 transform hover:text-purple-500 hover:scale-110">
                                    <span class="material-icons-outlined" style="font-size: 20px">
                                        playlist_add
                                    </span>
                                </a>
                                <div wire:click="$emit('swalToDeleted','fixHapusBeasiswa',{{$item->id}})"
                                    class="w-4 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <x-kiki.icon-trash />
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

        </div>






        {{-- form --}}
        @if ($metode=="newPenerima")
        <br><br>
        <x-kiki.organism.formBawahWithTabel>
            <x-slot name="header">
                <div class="f-playfair font-bold text-2xl capitalize">
                    Tambah Anggota
                    <x-kiki.loading-spin wire:loading class="text-blue-500" />
                </div>
                <div class="md:space-x-2 flex shadow rounded-md px-2 py-0.5 bg-blue-400 text-white">
                    <span>
                        Beasiswa {{$beasiswaTo->tahun}}/{{$beasiswaTo->semester}}
                    </span>
                    <span class="flex items-center">
                        <span class="material-icons-outlined" style="font-size: 20px">
                            group
                        </span>
                        <span>
                            {{$beasiswaTo->anggotas->count()}}
                        </span>
                    </span>
                </div>
                <button type="button" wire:click="batalForm()"
                    class="flex space-x-2 item-center hover:text-blue-700 text-gray-500 mr-2">
                    <span class="material-icons-outlined text-base" style="font-size: 20px">
                        close
                    </span>
                </button>
            </x-slot>

            <x-slot name="inputan">
                <div>
                    <label class="f-roboto ml-1 text-gray-500 text-sm">Tambah penerima banyak</label>
                    <x-kiki.textarea-standar wire:model.lazy="namabanyak" id="namabanyak"
                        placeholder="A. Rehan Fajrul Islam
Abd. Wahid Ibrahim
Adinda Pratiwi Musa
                        " />
                    <x-kiki.error-input :kolom="'namabanyak'" />
                </div>

                {{-- Keterangan --}}
                <div class="bg-blue-100 p-2 rounded shadow-sm">
                    <div class="font-bold">Keterangan</div>
                    <div class="text-justify py-2 px-4">
                        <div>
                            <x-kiki.button-with-google-icon class="hover:text-blue-500 text-blue-400 inline-flex italic" href="https://beautifytools.com/excel-to-csv-converter.php" :icon="'link'">
                                <span>Link web konversi excell ke text</span>
                            </x-kiki.button-with-google-icon>
                        </div>
                        <span class="text-sm">Mohon perhatikan ketentuan berikut :</span>
                        <ul class="list-disc list-inside text-sm">
                            <li>
                                Pada bagian ini adalah nama-nama penerima beasiswa pada beasiswa semester yang dipilih.
                            </li>
                            <li>
                                Setiap data penerima terhubung dengan nilai bulanan, nilai absen, dll. <b>Harap jangan sembarang melakukan penghapusan anggota penerima langsung, tanpa konfirmasi terlebih dahulu.</b>
                            </li>
                            <li>
                                Kecuali jika masih pada masa pengisian data penerima atau inisiasi semester, tidak apa-apa untuk menghapus. 
                                Misal sedang mengisi nama-nama penerima semester A, kemudian ada anggota penerima yang salah atau dibatalkan menerima maka bisa dihapus.
                                Yang tidak boleh adalah jika sudah sementara berjalan penilain, dan menghapus nama anggota dari penerima.
                            </li>
                        </ul>
                    </div>
                </div>
            </x-slot>

            <x-slot name="buttonInputan">
                <x-kiki.loading-spin wire:loading wire:target="isiAnggotaBanyak" class="text-blue-300" />
                <div class="px-2 mt-3 md:w-1/2" wire:loading.remove wire:target="isiAnggotaBanyak">
                    <button wire:click="isiAnggotaBanyak" type="button" class="shadow p-2 w-full rounded focus:outline-none focus:ring-2
                                focus:ring-green-300  text-gray-600 bg-gray-200
                                hover:bg-green-300
                                ">
                        <span class="material-icons-outlined text-base">
                            add
                        </span>
                        Tambahkan
                    </button>
                </div>
            </x-slot>


            {{-- isi tabel --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                @forelse($tabelBawah as $key=>$univ)
                <div class="font-bold col-span-1 md:col-span-4 py-3 text-center">
                    {{$univ[0]->universitas->nama}} ({{$univ->count()}})
                </div>
                @foreach ($univ->sortBy('nama') as $ag)
                <div class="hover:bg-blue-200  p-2 flex justify-between rounded shadow">
                    <span>{{$ag->nama}}</span>
                    <button type="button" wire:click="$emit('swalToDeleted','fixHapusAnggota',{{$ag->id}})"
                        class="flex space-x-2 item-center hover:text-red-500 text-gray-400">
                        <span class="material-icons-outlined text-base font-bold">
                            close
                        </span>
                    </button>
                </div>
                @endforeach
                @empty
                <div class="text-center col-span-1 md:col-span-3">kosong..</div>
                @endforelse
            </div>


        </x-kiki.organism.formBawahWithTabel>

        @elseif ($metode=="newSegment")
        <br><br>
        <x-kiki.organism.formBawahWithTabel>
            <x-slot name="header">
                <div class="f-playfair font-bold text-2xl capitalize">
                    Tambah Segment
                    <x-kiki.loading-spin wire:loading class="text-blue-500" />
                </div>
                <div class="md:space-x-2 flex shadow rounded-md px-2 py-0.5 bg-blue-400 text-white">
                    <span>
                        Beasiswa {{$beasiswaTo->tahun}}/{{$beasiswaTo->semester}}
                    </span>
                    <span class="flex items-center">
                        <span class="material-icons-outlined" style="font-size: 20px">
                            segment
                        </span>
                        <span>
                            {{$beasiswaTo->segmentBulanan->count()}}
                        </span>
                    </span>
                </div>
                <button type="button" wire:click="batalForm()"
                    class="flex space-x-2 item-center hover:text-blue-700 text-gray-500 mr-2">
                    <span class="material-icons-outlined text-base" style="font-size: 20px">
                        close
                    </span>
                </button>
            </x-slot>

            <x-slot name="inputan">
                {{-- isi disini inputan --}}

                {{-- Keterangan --}}
                <div class="bg-blue-100 p-2 rounded shadow-sm">
                    <div class="font-bold">Keterangan</div>
                    <div class="text-justify py-2 px-4">
                        <span class="text-sm">Mohon perhatikan ketentuan berikut :</span>
                        <ul class="list-disc list-inside text-sm">
                            <li>
                                Pada bagian ini adalah segment atau bulan-bulan yang ada dalam sebuah semester penerimaan beasiswa.
                            </li>
                            <li>
                                Setiap segment terhubung dengan nilai bulanan, nilai absen, dll. <b>harap jangan sembarang melakukan penghapusan segment langsung tanpa konfirmasi terlebih dahulu.</b>
                            </li>
                        </ul>
                    </div>
                </div>
            </x-slot>

            <x-slot name="buttonInputan">
                <x-kiki.loading-spin wire:loading wire:target="tambahSegment" class="text-blue-300" />
                <div class="px-2 mt-3 md:w-1/2" wire:loading.remove wire:target="tambahSegment">
                    <button wire:click="tambahSegment" type="button" class="shadow p-2 w-full rounded focus:outline-none focus:ring-2
                                focus:ring-green-300  text-gray-600 bg-gray-200
                                hover:bg-green-300
                                ">
                        <span class="material-icons-outlined text-base">
                            add
                        </span>
                        Tambahkan
                    </button>
                </div>
            </x-slot>


            {{-- isi tabel --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                @forelse($tabelBawah as $key=>$item)
                    <div class="hover:bg-blue-200  p-2 flex justify-between rounded shadow">
                        <span>{{$item->namaBulan}}</span>
                        <button type="button" wire:click="$emit('swalToDeleted','fixHapusSegment',{{$item->id}})"
                            class="flex space-x-2 item-center hover:text-red-500 text-gray-400">
                            <span class="material-icons-outlined text-base font-bold">
                                close
                            </span>
                        </button>
                    </div>
                @empty
                    <div class="text-center col-span-1 md:col-span-3">kosong..</div>
                @endforelse
            </div>
        </x-kiki.organism.formBawahWithTabel>


        @endif









    </div>
    {{-- id --}}





</div>
