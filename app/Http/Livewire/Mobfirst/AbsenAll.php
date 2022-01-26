<?php

namespace App\Http\Livewire\Mobfirst;

use App\Models\Absensi;
use App\Models\Beasiswa;
use Carbon\Carbon;
use Livewire\Component;

class AbsenAll extends Component
{
    public $idBea,$sekarang;

    public function mount()
    {
        $this->idBea=Beasiswa::idTerakhir();
        $this->sekarang=Carbon::now();
    }

    public function render()
    {
        $absensi=Absensi::
            with(['absensiable','kehadiran'])
            ->YangPunyaSegmentPadaBeasiswaIni($this->idBea)
            // ->where('title', 'like', '%'.$this->search.'%')
            ->orderBy('id_sb','desc')
            ->orderBy('date','desc');
            ;

        return view('livewire.mobfirst.absen-all',[
            'isiTabel' => $absensi->paginate(30),
        ]);
    }
}
