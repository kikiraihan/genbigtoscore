{{-- @props([
    'color'=>'green'
    ]) --}}

<a 
    {!! $attributes->merge([
        'class'=>"rounded transform  hover:shadow-md f-roboto",
        'type'=>"button"
    ]) !!} >
    {{$slot}}
</a>