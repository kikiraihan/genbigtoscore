<div wire:ignore.self :class="{ 'translate-y-full' : !dropUpOpen , }" 
        class="fixed inset-x-0 bottom-0 z-10
        transform transition translate-y-full duration-200 ease-in-out
        min-w-screen bg-white pb-5 rounded-t-2xl shadow border border-gray-200 opacity-95
        flex flex-col space-y-2  justify-between h-screen overflow-auto
        "{{-- h-3/4 --}}
        >

        {{$slot}}

        <br>

        {{$pilihanButton}}
</div>