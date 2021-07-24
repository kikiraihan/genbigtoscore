@props([
    'terpilih'=>'...',
    ])


<div class="relative" x-data="{ open: false }">

    <button type="button" x-on:click="open = ! open"
            class="cursor-pointer py-1.5 px-3 bg-white 
            shadow text-sm border-none w-full rounded
            flex justify-between
            text-gray-500  focus:outline-none focus:ring-2 focus:ring-blue-300">
        <span>
            {{$terpilih}}
        </span>
        <span class="material-icons-outlined float-right fill-current">
            expand_more
        </span>
    </button>

    <div x-show="open"
    class="rounded shadow-md my-2 absolute pin-t pin-l bg-gray-50 w-full z-20">
        <ul class="list-reset">
            <li class="p-2">
                <input 
                    {!! $attributes->merge([
                        "class"=>"border-2 rounded h-8 w-full",
                        'placeholder'=>"Cari",
                        'type'=>"text",
                    ]) !!} >
                <br>
            </li>
            {{$slot}}
        </ul>
    </div>

</div>