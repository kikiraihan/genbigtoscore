@props([
    'isi1'=>null,
    'isi2'=>null,
    ])

<div class="flex justify-between pr-3 pt-3 w-full f-nunito">
    
    @isset($isi1)    
        <span class="pl-3 select-none">
            {{$isi1}}@isset($isi2)<span class="text-xs text-gray-500">, {{$isi2}}</span>@endisset
        </span>
    @endisset

    <span {{ $attributes->merge(['class' => 'text-gray-300 rounded-2xl cursor-pointer select-none']) }}>
        <span class="material-icons-outlined">
            close
        </span>
    </span>
</div>