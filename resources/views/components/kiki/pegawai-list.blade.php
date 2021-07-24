@props([
    "idpegawai"=>1,
    'gravatar'=>"https://www.gravatar.com/avatar/?d=robohash&s=200&r=pg",
    'nama' => "nama",
    'unit' => "unit"
    ])


<a href="{{ route('theytask.workload', ['id'=>$idpegawai]) }}" {{ $attributes->merge(['class'=>"pl-0 max-w-sm mx-auto flex items-center space-x-4"]) }} >
    <div class="flex-shrink-0">
        <img class="h-14 w-14 bg-gray-200 rounded-full shadow-sm object-cover"
            src="{{asset($gravatar)}}">
    </div>
    <div class="flex-1">
        <div class="font-bold text-black">{{$nama}}</div>
        <p class="text-xs text-gray-500">{{$unit}}</p>
    </div>
</a>