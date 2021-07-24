@props([
    'tgl'=>"2",
    'ini' => "4",
    ])

<div class="p-1 border border-gray-100 ">
    <div class="flex flex-col">
        <span class="flex-1 text-center">
            {{$tgl}}
            <span class="material-icons 
            @if ($ini<=4)
            text-gray-200
            @elseif ($ini<=6)
            text-green-300
            @elseif ($ini<=9)
            text-yellow-300
            @else
            text-red-300
            @endif
            " style="font-size: 9px">
                circle
            </span>
        </span>
        <div class="flex-1">

            <div class="flex flex-col flex-wrap">
                <span class="
                @if ($ini==0)
                bg-gray-100
                text-gray-400
                @elseif ($ini<=4)
                bg-green-200
                text-white
                @elseif ($ini<=6)
                bg-green-400
                text-white
                @elseif ($ini<=9)
                bg-yellow-300
                text-gray-700
                @else
                bg-red-300
                text-gray-700
                @endif
                text-center rounded-sm font-bold"
                    style="font-size: 11px;">
                    {{$ini}} <sub>/12</sub>
                    {{-- <span class="material-icons" style="font-size: 9px;">
                        more_time
                    </span> --}}
                </span>
            </div>

        </div>
    </div>
</div>