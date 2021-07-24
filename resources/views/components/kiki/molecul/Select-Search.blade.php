@props([
    'idmodel',
    'namamodel',
    'search',
    'alternatif',
    'selected',
    ])


{{-- awal edit kepala tim --}}
@if($id_model==null)
<li class="px-4">
    <label class="f-roboto ml-1 text-gray-500 text-sm flex items-center space-x-1">
        <span class="material-icons-outlined text-sm">
            record_voice_over
        </span>
        <span>Pilih {{$namamodel}}</span>
    </label>
    <div class="flex shadow">
        <span class="material-icons-outlined flex items-center pl-2 pr-1 bg-white rounded-l text-gray-500">
            search
        </span>
        <input 
            {!! $attributes->merge([
                "class"=>"block py-2 pl-1 pr-2 w-full rounded-r  focus:outline-none focus:ring-2 focus:ring-green-300",
                'placeholder'=>"Masukan nama atau nip",
                'type'=>"text",
            ]) !!} 
            >
    </div>
    
    @if ($search)
    <span class="block text-xs mt-2 text-gray-400 pl-1">Ditemukan : {{$alternatif->count()}}</span>
    @endif

</li>

<div class="flex flex-row space-x-5 overflow-x-auto horscroll p-4">
    @if ($search)
        {{$slot}}
    @endif
</div>

@else
<div class="px-4">
    <label class="f-roboto ml-1 text-gray-500 text-sm flex items-center space-x-1">
        <span class="material-icons-outlined text-sm">
            record_voice_over
        </span>
        <span>Pilih Kepala</span>
    </label>
    <div class="flex items-center space-x-2 mt-2">
        <div class="shadow rounded-full bg-white w-14 h-14 overflow-hidden">
            <img src="{{$selected->avatar}}" class="w-14 h-14 object-cover">
        </div>
        <span class="f-roboto">{{$selected->nama}}</span>
    </div>
    {{$batal}}
</div>
@endif

{{-- akhir edit kepala tim --}}