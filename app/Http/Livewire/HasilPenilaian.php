<?php

namespace App\Http\Livewire;

use App\Exports\HasilPenilaianExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Segmentbulanan;
use App\Traits\HitungNilai;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class HasilPenilaian extends Component
{
    use WithPagination, HitungNilai;

    public $id_beasiswa;
    public $beasiswa;
    public $nilaiAkhir;

    // untuk index
    public
    $search;


    public function mount()
    {
        $this->id_beasiswa=Beasiswa::idTerakhir();
        $this->beasiswa=Beasiswa::yangTerakhir();
        $this->nilaiAkhir=$this->allNilai(
            $this->beasiswa,
            anggota::hanyaYangAktif()->get()
        );
    }

    public function render()
    {
        $ang=anggota::
            with(['kepengurusan.unit.badan','universitas',
            'tidakHadirAbsensi','piketSegments','timkhus','nilaiTambahanSegments','nilaiEbs'
            ])
            ->where('nama', 'like', '%'.$this->search.'%')
            // ->HanyaPenerimaBeasiswaIni($this->id_beasiswa)
            ->hanyaYangAktif()
            ->orderBy('id_universitas')
            ->orderBy('nama')
            ;

        return view('livewire.hasil-penilaian',[
            'isiTabel'=>$ang->paginate(300),
            'selectBeasiswa'=>$this->selectBeasiswa(),
            'beasiswa'=>Beasiswa::yangTerakhir(),
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

    public function export() 
    {
        $waktu=Carbon::now();

        return Excel::download(new HasilPenilaianExport($this->beasiswa,
        anggota::hanyaYangAktif()->get()), 'hasil_penilaian_'.$waktu->format('Y_M_d').'.xlsx');
    }

}
