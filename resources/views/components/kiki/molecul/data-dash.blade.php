@props([
    'label'=>null,
    ])

<div class="f-roboto">
    <sub class=" text-gray-500 ">{{$label}} :</sub>
    <div class="text-sm">
        {{$slot}}
    </div>
</div>