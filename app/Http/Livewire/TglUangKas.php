<?php

namespace App\Http\Livewire;

use App\Models\anggota;
use App\Models\Beasiswa;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class TglUangKas extends Component
{
    use WithPagination;

    protected $listeners = [
        'FixHapusTglUangKas' => 'nullKanTglUangKas',
    ];

    public $idBeasiswaTo;
    public $search;
    public $filterBelum=false;

    public function mount()
    {
        $this->idBeasiswaTo=Beasiswa::idTerakhir();
    }

    public function render()
    {
        $bea = Beasiswa::with(['segmentbulanan','anggotas.universitas'])
            ->find($this->idBeasiswaTo);
        $tabel=$bea->anggotas()->where('nama','like','%'.$this->search.'%')
        ->orderBy('id_universitas');
        
        if ($this->filterBelum=='sudah') $tabel->wherePivot('tgl_uang_kas','!=',null);
        elseif ($this->filterBelum=='belum') $tabel->wherePivot('tgl_uang_kas',null);

        return view('livewire.tgl-uang-kas',[
            'isiTabel'=>$tabel->paginate('50'),
            'beasiswa'=>$bea,
            'selectBeasiswa' => Beasiswa::all(),
        ]);
    }

    public function stampTanggalBayar($idAnggota)
    {
        $ang = anggota::find($idAnggota);
        $ang->beasiswas()->updateExistingPivot($this->idBeasiswaTo, [
            'tgl_uang_kas' => Carbon::now(),
        ]);
        $this->emit('swalUpdated');
    }

    public function nullKanTglUangKas($idAnggota)
    {
        $ang = anggota::find($idAnggota);
        $ang->beasiswas()->updateExistingPivot($this->idBeasiswaTo, [
            'tgl_uang_kas' => null,
        ]);
        $this->emit('swalUpdated');
    }
}
