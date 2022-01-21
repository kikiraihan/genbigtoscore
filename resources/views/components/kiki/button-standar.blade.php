@props([
    'tipe'=>'button'
    ])

<button 
    {!! $attributes->merge([
        'class'=>"rounded transform hover:scale-105 hover:shadow-md f-roboto",
        'type'=>$tipe
    ]) !!} >
    {{$slot}}
</button>