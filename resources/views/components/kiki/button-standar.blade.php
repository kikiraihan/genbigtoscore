@props([
    'tipe'=>'button'
    ])

<button 
    {!! $attributes->merge([
        'class'=>"px-1.5 py-0.5 rounded transform hover:scale-105 hover:shadow-md f-roboto",
        'type'=>$tipe
    ]) !!} >
    {{$slot}}
</button>