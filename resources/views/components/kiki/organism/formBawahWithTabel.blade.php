@props([
'metode'=>null
])


<div class="flex justify-between items-center mt-6">
    {{$header}}
</div>

{{-- form input --}}
<form wire:submit.prevent="{{$metode}}">
    <div class="container mx-auto md:grid md:grid-cols-2 gap-2 px-2 mt-8">
        {{$inputan}}
    </div>
    {{$buttonInputan}}
</form>

{{-- table bawah --}}
<div class="bg-white shadow-md rounded my-6  p-2 scrolling-touch">
    {{$slot}}
</div>
