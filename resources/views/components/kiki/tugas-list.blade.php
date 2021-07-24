@props([
    'idtugas'=>null,
    'judul'=>"kosong",
    'startdate' => "0",
    'duedate' => "0",
    "workload"=>"0",
    "prosingkat"=>"kosong",
    "status"=>"kosong"
    ])


<div class="bg-white border pl-4 flex space-x-3">

    <div class="flex-auto grid grid-cols-4 mx-auto py-3 items-center gap-2">
        <div class="text-sm col-span-4">
            {{$judul}}
        </div>
        {{-- <div class="self-end text-right flex-1 text-gray-500 text-xs">
            Start : {{$startdate}}
        </div> --}}
        <p class="text-left flex-1 flex space-x-2 text-gray-500 text-xs col-span-3">
            <span class="flex flex-wrap space-x-1">
                <span class="material-icons text-sm">
                    groups
                </span>
                <span>{{$prosingkat}}</span>
            </span>
            <span class="bg-gray-100 text-center rounded-sm font-bold text-gray-400 px-1"
                style="font-size: 11px;">
                {{$workload}} <sub>/12</sub>
            </span>
            <span class="font-bold rounded-full bg-blue-100  px-1.5 capitalize"
                style="font-size: 9px;">{{$status}}</span>
        </p>
        <p class="text-right flex-1 text-gray-500 text-xs">
            Start : {{$startdate}} <br>
            Due : {{$duedate}}
        </p>
    </div>

    <button @click="dropUpOpen = !dropUpOpen" wire:click="$emitTo('mytask.dropupworkload', 'dropUpTugas',{{$idtugas}})" class="flex-initial  text-gray-500 p-1 flex flex-wrap content-center ">
        <span class="material-icons-outlined" style="font-size: 18px">
            more_vert
        </span>
    </button>
    
</div>
