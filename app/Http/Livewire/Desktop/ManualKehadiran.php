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
        $namas=explode(PHP_EOL, $this->namabanyak);
        $abs=Absensi::findOrFail($this->idAbsen)->load('kehadiran','absensiable','absenanggota');
        $error=[];
        foreach ($namas as $key=>$na) 
        {
            $ag=$abs->absenanggota()
                ->HanyaYangAktif()
                ->where('nama', $na)
                ->first();
            
            if($ag)//jika tidak null
                $ag->kehadiranAbsensi()->updateExistingPivot($this->idAbsen, [
                    'kondisi' => $kondisi,
                ]);
            else// jika tidak ditemukan
                $error[]=$na;
        }

        //jika ada error
        if($error)
        {
            $this->emit('swalMessageError','Terdapat error pada '.json_encode($error));
            $this->namabanyak=$this->susunKembaliKata($error);
        }
        else
        {
            $this->emit('swalUpdated');
            $this->namabanyak=null;
        }
        
        $this->render();
    }

    public function susunKembaliKata($dup)
    {
        $kata='';
        $i=0;
        foreach ($dup as $value) 
        {
            if( $i == 0)
                $kata.=$value;
            else
                $kata.=PHP_EOL.$value;
            
            $i++;
        }
        return $kata;
    }
}
