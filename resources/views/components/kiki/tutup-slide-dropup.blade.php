@props([
    'isi1'=>null,
    'isi2'=>null,
    ])

<span {{ $attributes->merge(['class' => 'w-full text-center rounded-2xl cursor-pointer select-none py-2']) }}>
    
    <span>
    @isset($isi1)    
        {{$isi1}}@isset($isi2)<span class="text-xs text-gray-500">, {{$isi2}}</span>@endisset
    @else
        <span class="material-icons-outlined">
            {{-- drag_handle --}}
            expand_more
        </span>
    @endisset
    </span>
    
</span>