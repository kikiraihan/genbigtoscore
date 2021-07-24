@props([
    'item'=>NULL,
    'idpegawai'=>NULL,
    'parent'=>null,
])


@if ($item==NULL)
<div>
    kosong
</div>
@else


<div class="bg-white border pl-4 flex space-x-3">

    <div class="flex-auto grid grid-cols-4 mx-auto py-3 items-center gap-2">
        <div class="text-sm col-span-3">
            {{$item->nama}} : {{$item->judul_project}}
        </div>
        <div class="flex-1 text-gray-500 text-xs text-right">
            @if($item->isThisUserKepalaTim($idpegawai))
                <span class="text-xs px-1 rounded flex items-center space-x-1 justify-end">
                    <span class="material-icons-outlined text-sm">
                        record_voice_over
                    </span>
                    <span class="hidden sm:inline">Chief</span>
                </span>
            @else
                {{$item->getJumlahTugasSelesaiByIdPegawai($idpegawai)}}/{{$item->getJumlahTugasByIdPegawai($idpegawai)}} Tugas
            @endif
        </div>
        <p class="text-left flex-1 flex space-x-2 text-gray-500 text-xs col-span-3">
            <span class="flex flex-wrap space-x-1">
                <span class="material-icons text-sm">
                    query_builder
                </span>
                <span>
                    {{$item->target_pelaksanaan}}
                </span>
            </span>
            <span class="bg-yellow-100 text-center rounded-sm font-bold text-gray-500 px-1 align-middle"
                style="font-size: 11px;">
                {{$item->iku}}
            </span>
            <span class="bg-indigo-300 text-center rounded-sm font-bold text-gray-50 px-1 capitalize"
                style="font-size: 11px;">
                {{$item->jangka}}
            </span>
            
        </p>
        <p class="text-right flex-1 text-xs">
            <span 
            class="font-bold rounded-full text-gray-100 bg-blue-400  px-1.5 py-0.5 capitalize"
            style="font-size: 9px;">
                {{$item->status}}
            </span>
        </p>
    </div>

    <a 
    @if($item->isThisUserKepalaTim($idpegawai) and $parent!='they-team')
    href="{{ route('Katimboard.showteam', ['id'=>$item->id]) }}"
    @else
    href="{{ route('showteam', ['id'=>$item->id,'id_pegawai'=>$idpegawai]) }}"
    @endif
    class=" flex-initial  text-gray-500 p-1 flex flex-wrap content-center ">
        <span class="material-icons-outlined" style="font-size: 18px">
            navigate_next
        </span>
    </a>
    
</div>
@endif


{{-- <div class="bg-white border py-3 px-4 flex space-x-2">
    <div class="flex-auto grid grid-cols-2 mx-auto  items-center gap-2">
        <div class="text-sm">
            {{$item->nama}}
        </div>
        <div class="self-end text-right flex-1 text-gray-500 text-xs">
            <button class="">
                <span class="material-icons-outlined">
                    arrow_forward_ios
                </span>
            </button>
        </div>
        <p class="text-left flex-1 text-gray-500" style="font-size: 10px;">
            Waktu : {{$item->target_pelaksanaan}}
        </p>
        <p class="text-right flex-1 text-gray-500 text-xs">
            3/5 Tugas
        </p>
    </div>
</div> --}}
