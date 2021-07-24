@props([
    'data'=>null,
    'pegawaiYangLogin'=>null,
    ])

<li class="bg-white border-t border-b pl-4 flex space-x-3">
    
    

    {{-- <div class="flex-auto grid grid-cols-4 mx-auto py-3 items-center gap-2">
        <div class="text-sm col-span-4">
            {{$data['namatim']}} : {{$data['judul']}}
        </div>
        
        <p class="text-left flex-1 flex space-x-2 text-gray-500 text-xs col-span-3">
            <span>{{Carbon\Carbon::parse($data['startdate'])->format('d M')}}</span>
            <span>-</span>
            <span>{{Carbon\Carbon::parse($data['duedate'])->format('d M')}}</span>
        </p>
        <p class="text-right flex-1 text-gray-500 text-xs">
            <span class="font-bold rounded-full bg-blue-100  px-1.5 capitalize" style="font-size: 9px;">
                {{$data['status']}}
            </span>
        </p>
    </div> --}}

    <div class="flex-auto grid grid-cols-4 mx-auto py-3 items-center gap-2">
        <div class="text-sm col-span-4 select-none">
            {{$data['judul']}}
        </div>
        
        <p class="text-left flex-1 flex space-x-2 text-gray-500 text-xs col-span-4">
            <span class="flex flex-wrap space-x-1">
                <span class="material-icons text-sm">
                    groups
                </span>
                <span class="select-none">{{$data['namatim']}}</span>
            </span>
            <span class="bg-gray-100 text-center rounded-sm font-bold text-gray-400 px-1" style="font-size: 11px;">
                {{$data['level']}} <sub>Load</sub>
            </span>
            <span class="font-bold rounded-full bg-blue-100  px-1.5 capitalize" style="font-size: 9px;">{{$data['status']}}</span>
        </p>
        <p class="text-right flex-1 text-gray-500 text-xs col-span-4">
            <span>{{Carbon\Carbon::parse($data['startdate'])->format('d M')}}</span>
            <span>-</span>
            <span>{{Carbon\Carbon::parse($data['duedate'])->format('d M')}}</span>
        </p>
    </div>
    

    




    @if(Auth::user()->pegawai->isMeKepalaTim($data['id_tim']))
        <a href="{{ route('task.edit', ['id'=>$data['id']]) }}" class="flex-initial  text-gray-500 p-1 flex flex-wrap content-center bg-yellow-50">
            <span class="material-icons-outlined" style="font-size: 18px">
                edit
            </span>
        </a>
    @else
        {{-- pegawai login yang punya tugas itu --}}
        {{-- @if($data['id_pegawai']==$pegawaiYangLogin->id) --}}
        <a href="{{ route('showteam', ['id'=>$data['id_tim'],'id_pegawai'=>$data['id_pegawai']]) }}" class="flex-initial  text-gray-500 p-1 flex flex-wrap content-center">
            <span class="material-icons-outlined" style="font-size: 18px">
                folder_shared
            </span>
        </a>
        {{-- @endif --}}
    @endif
            
    
</li>