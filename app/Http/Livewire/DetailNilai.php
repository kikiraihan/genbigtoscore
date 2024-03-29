<?php

namespace App\Http\Livewire;

use App\Models\Absensi;
use App\Models\anggota;
use App\Models\Beasiswa;
use Livewire\Component;

class DetailNilai extends Component
{
    public 
    $kembali,
    $idAnggota,
    $idBeasiswa
    ;

    public function mount($id,$kembali)
    {
        if( !($kembali=='dashboard' or $kembali=="hasilnilai") )
        abort(404);

        $this->kembali=$kembali;
        $this->idAnggota=$id;
        $this->idBeasiswa=Beasiswa::idTerakhir();
    }

    public function render()
    {
        $anggota=anggota::find($this->idAnggota);
        // dd($anggota->getEbPadaBeasiswa($this->idBeasiswa));

        return view('livewire.detail-nilai',[
            'absen'=>$anggota->getAbsenPadaBeasiswa($this->idBeasiswa)->groupBy('id_sb'),
            'piket'=>$anggota->getPiketPadaBeasiswa($this->idBeasiswa)->sortBy('id_sb'),
            'anggotaTimkhu'=>$anggota->getNilaiTimkhuPadaBeasiswa($this->idBeasiswa)->sortByDesc(function($query){
                return $query->timkhu->id;
            }),
            'anggota'=>$anggota,
            'tambahan'=>$anggota->getTambahanPadaBeasiswa($this->idBeasiswa)->sortBy('id'),
            'nilaieb'=>$anggota->getEbPadaBeasiswa($this->idBeasiswa),
            'beasiswa'=>Beasiswa::find($this->idBeasiswa),
        ]);
    }
}
