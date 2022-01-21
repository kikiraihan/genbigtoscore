@props([
    'warna'=>'gray'
    ])

<button 
{!! $attributes->merge([
    'class'=>"shadow px-2 py-2 rounded focus:outline-none focus:ring-2 truncate items-center flex justify-center gap-2 hover:bg-".$warna."-200 focus:ring-blue-300 text-".$warna."-600 bg-".$warna."-100",
    'type'=>"button",
]) !!} >
    {{$slot}}
</button>