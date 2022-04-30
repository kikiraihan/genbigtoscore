<div class="container mx-auto p-3  divide-y-2 divide-gray-50 overflow-auto" >
    
    <div class="f-oswald font-bold text-blue-300 mt-2 pl-2">
        Schedule Kegiatan
    </div>

    @foreach ($isiTabel as $key=>$item)

    <div class=" bg-white p-2 space-y-1">
        <div class="flex justify-between">
            <div class="text-xs">
                <div class="flex items-center space-x-2">
                    <span class="material-icons-outlined text-sm">
                        insert_invitation
                    </span>
                    <span>
                        {{-- {{$item->date->diffForHumans()}} --}}
                        {{$item->date->format('d M Y, h:i A')}}
                        @if ($item->deadline_absen!=null)
                            - {{$item->deadline_absen->format('d M Y, h:i')}}
                        @endif
                    </span> 
                </div>
            </div>
            <div class="text-xs">
                @if ($item->skope=="badan")
                    <div class="bg-gray-200 text-gray-600 inline-flex items-center space-x-1 rounded">
                        <span class="material-icons-outlined text-sm rounded-l p-0.5 text-white @if ($item->absensiable->id==1) bg-blue-500 @elseif ($item->absensiable->id==2) bg-red-400 @elseif ($item->absensiable->id==3) bg-green-400 @elseif ($item->absensiable->id==4) bg-yellow-400 @endif">
                            people
                        </span>
                        <span class="text-xs py-0.5 px-1.5">
                            All {{$item->absensiable->nama}}
                        </span>
                    </div>
                    @elseif ($item->skope=="unit")
                    <span class=" bg-gray-100 text-gray-500 border border-gray-200 py-0.5 px-1.5 rounded text-xs">
                        {{$item->absensiable->singkat}}
                    </span>
                    @elseif ($item->skope=="timkhu")
                    <span class=" bg-yellow-200 text-yellow-600 py-0.5 px-1.5 rounded text-xs">
                        {{$item->absensiable->nama}}
                    </span>
                    @elseif ($item->skope=="seluruh-genbi")
                    <span class=" bg-blue-200 text-blue-600 py-0.5 px-1.5 rounded text-xs">
                        All GenBI
                    </span>
                @endif
            </div>
        </div>
        <div class="text-sm f-robotomon">
            {{$item->title}}
        </div>
    </div>
    @endforeach

    <div class="text-center py-6">
        <a class="bg-gradient-to-r from-orange-300 to-amber-300 hover:underline text-gray-800 font-extrabold rounded py-2 px-4 shadow-lg" href="{{ route('landing.schedule') }}">
            Lihat Selengkapnya
        </a>
    </div>
</div>