@props([
    'idtugas'=>null,
    'judul'=>"kosong",
    'startdate' => "0",
    'duedate' => "0",
    "status"=>"kosong",
    "isKepalaTim"=>false,
    "isMilikLogin"=>null,
    ])


<div class="bg-white border pl-4 flex space-x-3">
    {{--  @if((!$isKepalaTim) and (!$isMilikLogin)) pr-4 @endif --}}
    {{-- @if(!$isKepalaTim) pr-4 @endif --}}

    <div class="flex-auto grid grid-cols-4 mx-auto py-3 items-center gap-2">
        <div class="text-sm col-span-4">
            {{$judul}}
        </div>
        {{-- <div class="self-end text-right flex-1 text-gray-500 text-xs">
            Start : {{$startdate}}
        </div> --}}
        <p class="text-left flex-1 flex space-x-2 text-gray-500 text-xs col-span-3">
            <span>{{$startdate}}</span>
            <span>-</span>
            <span>{{$duedate}}</span>
        </p>
        <p class="text-right flex-1 text-gray-500 text-xs">
            <span class="font-bold rounded-full 
            @if ($status=="done")
            bg-green-200  
            @else
            bg-blue-100  
            @endif
            px-1.5 capitalize"
                style="font-size: 9px;">
                {{$status}}
            </span>
            
        </p>
    </div>

    @if ($isKepalaTim)

    <button @click="dropUpOpen = !dropUpOpen" onclick="Livewire.emit('dropUppekerjaansetid',{{$idtugas}})" class="flex-initial  text-gray-500 p-1 flex flex-wrap content-center">
        <span class="material-icons-outlined" style="font-size: 18px">
            more_vert
        </span>
    </button>

    @else
    <button @click="dropUpOpen = !dropUpOpen" onclick="Livewire.emit('dropUpTugas',{{$idtugas}})" class="flex-initial  text-gray-500 p-1 flex flex-wrap content-center">
        <span class="material-icons-outlined" style="font-size: 18px">
            more_vert
        </span>
    </button>
    @endif
        
    
</div>
