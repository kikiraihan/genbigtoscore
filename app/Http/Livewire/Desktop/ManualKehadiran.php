<?php

namespace App\Http\Livewire\Desktop;

use App\Models\Absensi;
use App\Models\Kehadiran;
use Livewire\Component;
use Livewire\WithPagination;

class ManualKehadiran extends Component
{
    use WithPagination;

    public $idAbsen;

    //index
    public $search;

    // form
    public $namabanyak;

    public function mount($id)
    {
        $this->idAbsen=$id;
    }

    public function render()
    {
        $abs=Absensi::findOrFail($this->idAbsen)->load('kehadiran','absensiable','absenanggota');
        $anggota=$abs
            ->absenanggota()
            ->HanyaYangAktif()//scope
            ->bernama($this->search)
            ->orderBy('pivot_kondisi', 'desc')
            ->orderBy('nama', 'asc')
            ;
        return view('livewire.desktop.manual-kehadiran',[
            'abs'=>$abs,
            'isiTabel'=>$anggota->paginate(30),
        ]);
    }

    public function ganti($param)
    {
        $ke=Kehadiran::find($param[0]);
        $ke->kondisi=$param[1];
        $ke->save();
        $this->emit('swalUpdated');
        $this->render();
    }

    public function absenBanyak($kondisi)
    {
        $namas=explode(";", $this->namabanyak);
        $abs=Absensi::findOrFail($this->idAbsen)->load('kehadiran','absensiable','absenanggota');
        foreach ($namas as $key=>$na) 
        {
            $anggota[$key]=$abs->absenanggota()
            ->HanyaYangAktif()
            ->where('nama', $na)
            ->first();
        }
        foreach ($anggota as $key => $ang) 
        {
            if($ang)//jika tidak null
            $ang->kehadiranAbsensi()->updateExistingPivot($this->idAbsen, [
                'kondisi' => $kondisi,
            ]);
        }
        $this->emit('swalUpdated');
        $this->render();
    }
}