<x-slot name="stylehalaman">
</x-slot>
<x-slot name="scripthalaman">
    @livewireScripts
    {{-- @include('layouts.scriptsweetalert') --}}
</x-slot>

<div class="container w-full md:max-w-4xl mx-auto pt-20">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}


    <!-- info bar -->
    <div class="container mx-auto p-3 bg-gradient-to-b from-slate-50 to-gray-100 divide-y-2 divide-gray-50 rounded-t-xl">
        
        @foreach ($isiTabel as $key=>$item)
        @if ( ($key!=0 and $isiTabel[$key]->date->monthName!=$isiTabel[$key-1]->date->monthName) OR $key==0)
        <div class="f-oswald text-gray-500 mt-2 pl-2">
            {{$item->date->monthName}}
            {{-- {{$item->date->format('M y')}} --}}
        </div>
        @endif

        <div class="@if ($sekarang->gt($item->date)) text-gray-400 @else @endif bg-white p-2 space-y-1">
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
                        <div class="@if ($sekarang->gt($item->date)) opacity-40 @endif bg-gray-200 text-gray-600 inline-flex items-center space-x-1 rounded">
                            <span class="material-icons-outlined text-sm rounded-l p-0.5 text-white @if ($item->absensiable->id==1) bg-blue-500 @elseif ($item->absensiable->id==2) bg-red-400 @elseif ($item->absensiable->id==3) bg-green-400 @elseif ($item->absensiable->id==4) bg-yellow-400 @endif">
                                people
                            </span>
                            <span class="text-xs py-0.5 px-1.5">
                                All {{$item->absensiable->nama}}
                            </span>
                        </div>
                        @elseif ($item->skope=="unit")
                        <span class="@if ($sekarang->gt($item->date)) opacity-40 @endif bg-gray-100 text-gray-500 border border-gray-200 py-0.5 px-1.5 rounded text-xs">
                            {{$item->absensiable->singkat}}
                        </span>
                        @elseif ($item->skope=="timkhu")
                        <span class="@if ($sekarang->gt($item->date)) opacity-40 @endif bg-yellow-200 text-yellow-600 py-0.5 px-1.5 rounded text-xs">
                            {{$item->absensiable->nama}}
                        </span>
                        @elseif ($item->skope=="seluruh-genbi")
                        <span class="@if ($sekarang->gt($item->date)) opacity-40 @endif bg-blue-200 text-blue-600 py-0.5 px-1.5 rounded text-xs">
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

        <div class="px-3 py-2">
            {{ $isiTabel->links() }}
        </div>

        <br><br><br>
    </div>


</div>
