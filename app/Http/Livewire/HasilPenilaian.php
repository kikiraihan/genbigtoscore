<?php

namespace App\Http\Livewire;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Segmentbulanan;
use Livewire\Component;
use Livewire\WithPagination;

class HasilPenilaian extends Component
{
    use WithPagination;

    public $id_beasiswa;


    // bukan untuk form, tidak digunakan untuk input
    public $id_sb;

    // untuk index
    public
    $search;


    public function mount()
    {
        $this->id_sb=Segmentbulanan::idTerkini();
        $this->id_beasiswa=Beasiswa::idTerakhir();
    }

    public function render()
    {
        $ang=anggota::
            with(['kepengurusan.unit.badan','universitas'])
            ->where('nama', 'like', '%'.$this->search.'%')
            ->whereHas('kepengurusan',function($q){
                $q->where('tanggal_demisioner', NULL);
            })
            ->orderBy('id_universitas')
            ->orderBy('nama')
            ;

        return view('livewire.hasil-penilaian',[
            'isiTabel'=>$ang->paginate(300),
            'selectsegment'=>$this->selectsegment(),
            'beasiswa'=>Beasiswa::yangTerakhir()
        ]);
    }

    // sama dengan evaluasi
    public function selectsegment()
    {
        $idBeasiswaKini=Beasiswa::idTerakhir();
        return Segmentbulanan::
                HanyaSemesterIni($idBeasiswaKini)
                ->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    //batas sama dengan evaluasi

}
