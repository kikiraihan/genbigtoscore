{{-- <x-slot name="header">
    @include('layouts.navigationback',['warna'=>'bg-white','kata'=>'Pengaturan Akun','link_balik'=>"dashboard"])
</x-slot>
<x-slot name="footer">
</x-slot>
<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
</x-slot> --}}







<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <form wire:submit.prevent="
    @if($isAdmin)
        updateAdmin
    @else
        update
    @endif
    ">



        <div class="container mx-auto p-4 flex flex-col space-y-4">

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm block text-center">Avatar</label>
                <!-- component -->
                <x-kiki.upload-avatar wire:model.lazy="avatar" :fotoLama="asset($avatarNoRaw)"/>
            </div>

            <x-kiki.sublabel class="pt-4 text-base text-center">Bio anggota</x-kiki.sublabel>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Username</label>
                <x-kiki.input-standar wire:model.lazy="username" id="username" placeholder="..."/>
                <x-kiki.error-input :kolom="'username'"/>
            </div>
            
            @if (!$isAdmin)

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Nama</label>
                <x-kiki.input-standar wire:model.lazy='nama' id="nama" placeholder="..."/>
                <x-kiki.error-input :kolom="'nama'"/>
            </div>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">NIM</label>
                <x-kiki.input-standar wire:model.lazy="nim" id="nim" placeholder="..."/>
                <x-kiki.error-input :kolom="'nim'"/>
            </div>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Jurusan</label>
                <x-kiki.select-standar wire:model="id_jurusan">
                    <option value="" hidden selected>...</option>
                    @foreach ($selectJurusan as $item)
                        <option class="w-full" value="{{$item->id}}">{{$item->nama}}</option>
                    @endforeach
                </x-kiki.select-standar>
                <x-kiki.error-input :kolom="'id_jurusan'"/>
            </div>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Universitas</label>
                <x-kiki.select-standar wire:model="id_universitas">
                    <option value="" hidden selected>...</option>
                    @foreach ($selectUniversitas as $item)
                        <option class="w-full" value="{{$item->id}}">{{$item->nama}}</option>
                    @endforeach
                </x-kiki.select-standar>
                <x-kiki.error-input :kolom="'id_universitas'"/>
            </div>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Angkatan Kuliah</label>
                <x-kiki.input-standar wire:model.lazy="tahunmasukkuliah" id="tahunmasukkuliah" placeholder="2011"/>
                <x-kiki.error-input :kolom="'tahunmasukkuliah'"/>
            </div>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Gender</label>
                <x-kiki.select-standar wire:model="jenis_kelamin">
                    <option value="" hidden selected>...</option>
                    <option class="w-full" value='Laki-Laki'>Lelaki seutuhnya</option>
                    <option class="w-full" value='Perempuan'>Perempuan</option>
                </x-kiki.select-standar>
                <x-kiki.error-input :kolom="'jenis_kelamin'"/>
            </div>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Agama</label>
                <x-kiki.select-standar wire:model="agama">
                    <option value="" hidden selected>...</option>
                    <option class="w-full" value='Islam'>Islam</option>
                    <option class="w-full" value='Kristen'>Kristen</option>
                    <option class="w-full" value='Katolik'>Katolik</option>
                    <option class="w-full" value='Konghuchu'>Konghuchu</option>
                    <option class="w-full" value='Hindu'>Hindu</option>
                    <option class="w-full" value='Budha'>Budha</option>
                    <option class="w-full" value='Lainnya'>Lainnya</option>
                </x-kiki.select-standar>
                <x-kiki.error-input :kolom="'agama'"/>
            </div>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Golongan Darah</label>
                <x-kiki.select-standar wire:model="golongan_darah">
                    <option value="" hidden selected>...</option>
                    <option class="w-full" value="O">O</option>
                    <option class="w-full" value="A">A</option>
                    <option class="w-full" value="A+">A+</option>
                    <option class="w-full" value="B">B</option>
                    <option class="w-full" value="B+">B+</option>
                    <option class="w-full" value="AB">AB</option>
                </x-kiki.select-standar>
                <x-kiki.error-input :kolom="'golongan_darah'"/>
            </div>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Tanggal Lahir</label>
                <x-kiki.input-standar type="date" wire:model.lazy="tgl_lahir" id="tgl_lahir"/>
                <x-kiki.error-input :kolom="'tgl_lahir'"/>
            </div>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Domisili</label>
                <x-kiki.textarea-standar wire:model.lazy="domisili" id="domisili" placeholder="Alamat domisili"/>
                <x-kiki.error-input :kolom="'domisili'"/>
            </div>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Asal</label>
                <x-kiki.textarea-standar wire:model.lazy="asal" id="asal" placeholder="Alamat Asal"/>
                <x-kiki.error-input :kolom="'asal'"/>
            </div>



            <x-kiki.sublabel class="pt-4 text-base text-center">Contact</x-kiki.sublabel>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Nomor WA</label>
                <x-kiki.input-standar wire:model.lazy="no_wa" id="no_wa" placeholder="..."/>
                <x-kiki.error-input :kolom="'no_wa'"/>
            </div>
            @endif

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Email</label>
                <x-kiki.input-standar wire:model.lazy="email" id="email" placeholder="..." />
                <x-kiki.error-input :kolom="'email'"/>
            </div>


            <div>
                <input class="shadow p-2 w-full rounded focus:outline-none focus:ring-2 
                                focus:ring-green-300  text-white bg-green-500
                                " type="submit" name="submit" id="submit" value="Simpan">
            </div>

        </div>

    </form>




        <hr>

    <form wire:submit.prevent="gantiPassword">

        <div class="container mx-auto p-4 flex flex-col space-y-4 mt-8">
            <x-kiki.sublabel class="pt-4 text-base text-center">Ganti Password</x-kiki.sublabel>
            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">Password lama</label>
                <x-kiki.input-standar wire:model.lazy="passwordLama" id="passwordLama" type="password" placeholder="..."/>
                <x-kiki.error-input :kolom="'passwordLama'"/>
            </div>

            <div>
                <label class="f-roboto ml-1 text-gray-500 text-sm">New Password</label>
                <x-kiki.input-standar wire:model.lazy="passwordBaru" id="passwordBaru" type="password" placeholder="..."/>
                <x-kiki.error-input :kolom="'passwordBaru'"/>
            </div>

            <div>
                <input class="shadow p-2 w-full rounded focus:outline-none focus:ring-2 
                                focus:ring-green-300  text-white bg-green-500
                                " type="submit" name="submitPass" id="submitPass" value="Ganti password">
            </div>
        </div>

        

    </form>



</div>
