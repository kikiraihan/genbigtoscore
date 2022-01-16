<div class="text-left space-y-4">
    {{-- Keterangan --}}
    <div class="bg-blue-100 p-2 rounded shadow-sm">
        <div class="font-bold">Keterangan</div>
        <div class="text-justify py-2 px-4">
            <span class="text-sm">Mohon perhatikan ketentuan berikut :</span>
            <ul class="list-disc list-outside text-sm">
                <li>
                    Setiap beasiswa terhubung dengan sistem penilaian.
                </li>
                <li>
                    Beasiswa yang memiliki tahun dan semester paling besar dapat dianggap sebagai beasiswa terkini.
                </li>
                <li>
                    <b>Harap jangan melakukan penambahan atau memulai beasiswa baru apabila memang belum masuk pada tahap beasiswa tersebut.</b>
                </li>
                <li>
                    Pembuatan beasiswa baru disarankan pada tahap ketika semua nilai sudah fix dan sudah diberikan ke pembina.
                </li>
            </ul>
        </div>
    </div>

    <div>
        <label class="f-roboto ml-1 text-gray-500 text-sm">Tahun</label>
        <x-kiki.select-standar wire:model="tahun" id="tahun">
            <option value="" hidden selected>...</option>
            @for ($i = ($sekarang->year-10); $i < ($sekarang->year+10); $i++)
                <option class="w-full" value='{{$i}}' @if($beaTerakhir==$i) selected @endif>{{$i}}</option>
            @endfor
        </x-kiki.select-standar>
    </div>
    
    <div>
        <label class="f-roboto ml-1 text-gray-500 text-sm">Semester</label>
        <x-kiki.select-standar wire:model="semester" id="semester">
            <option value="" hidden selected>...</option>
            <option class="w-full" value='1'>Ganjil - 1</option>
            <option class="w-full" value='2'>Genap - 2</option>
        </x-kiki.select-standar>
    </div>
    
    <div>
        <label class="f-roboto ml-1 text-gray-500 text-sm">Bulan awal dimulai semester (segment pertama)</label>
        <x-kiki.select-standar wire:model="bulan_awal" id="bulan_awal">
            <option value="" hidden selected>...</option>
            @foreach ([
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember',
            ] as $key=>$item)
                <option class="w-full" @if($sekarang->month==($key+1)) selected @endif value='{{$key+1}}'>{{$item}}</option>
            @endforeach
        </x-kiki.select-standar>
    </div>
</div>