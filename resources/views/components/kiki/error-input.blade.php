@props([
    'kolom'=>null,
    ])

@error($kolom) 
    <span {!! $attributes->merge(['class' => 'text-xs text-red-300']) !!}>
        {{ $message }}
    </span>
@enderror
