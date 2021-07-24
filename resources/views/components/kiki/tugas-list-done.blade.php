@props([
    'judul'=>"kosong",
    "status"=>"kosong"
    ])






<div class="bg-green-50 border pl-4 flex space-x-3">

    <div class="flex-auto grid grid-cols-4 mx-auto py-3 items-center gap-2">
        <div class="text-sm col-span-4 ">
            <span class="text-gray-400">{{$judul}}</span>
            
            <span class="font-bold rounded-full bg-green-300 text-gray-50 px-1.5 capitalize"
                style="font-size: 9px;">{{$status}}</span>
        </div>

    </div>

    <button class="flex-initial  text-gray-500 p-1 flex flex-wrap content-center ">
        <span class="material-icons-outlined" style="font-size: 18px">
            more_vert
        </span>
    </button>
    
</div>

