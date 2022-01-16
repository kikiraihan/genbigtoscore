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

    // untuk index
    public
    $search;


    public function mount()
    {
        $this->id_beasiswa=Beasiswa::idTerakhir();
    }

    public function render()
    {
        $ang=anggota::
            with(['kepengurusan.unit.badan','universitas'])
            ->where('nama', 'like', '%'.$this->search.'%')
            // ->HanyaPenerimaBeasiswaIni($this->id_beasiswa)
            ->hanyaYangAktif()
            ->orderBy('id_universitas')
            ->orderBy('nama')
            ;

        return view('livewire.hasil-penilaian',[
            'isiTabel'=>$ang->paginate(300),
            'selectBeasiswa'=>$this->selectBeasiswa(),
            'beasiswa'=>Beasiswa::yangTerakhir()
        ]);
    }

    // sama dengan evaluasi
    public function selectBeasiswa()
    {
        return Beasiswa::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    //batas sama dengan evaluasi

}
