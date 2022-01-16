<div class="text-left">
    <div>
        <label class="f-roboto ml-1 text-gray-500 text-sm">Nama</label>
        <input class="shadow text-sm border-none p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-300 placeholder-gray-300" type="text" wire:model="nama" id="nama" placeholder="..." >
    </div>

    <div>
        <label class="f-roboto ml-1 text-gray-500 text-sm">Singkatan</label>
        <input class="shadow text-sm border-none p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-300 placeholder-gray-300" type="text" wire:model="singkat" id="singkat" placeholder="...">
    </div>
    
    <div>
        <label class="f-roboto ml-1 text-gray-500 text-sm">Badan</label>
        <x-kiki.select-standar wire:model="badan" id="badan">
            @foreach ($badan as $key=>$item)
                <option class="w-full" value='{{$item->id}}'>{{$item->nama}}</option>
            @endforeach
        </x-kiki.select-standar>
    </div>

    <div>
        <label class="f-roboto ml-1 text-gray-500 text-sm">Status</label>
        <x-kiki.select-standar wire:model="status" id="status">
            <option class="w-full"  value='aktif'>Aktif</option>
            <option class="w-full" value='non-aktif'>non-aktif</option>
        </x-kiki.select-standar>
    </div>
</div>