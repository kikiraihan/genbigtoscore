@props([
    'icon'=>'clear'
    ])

<a 
    {!! $attributes->merge([
        'class'=>"flex space-x-2 flex item-center"
    ]) !!} >
    <span class="material-icons-outlined text-base">
        {{$icon}}
    </span>
    <span>{{$slot}}</span>
</a>