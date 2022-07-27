<?php

namespace App\Http\Livewire\Desktop;

use App\Models\Absensi;
use App\Models\anggota;
use App\Models\Kehadiran;
use Livewire\Component;
use Livewire\WithPagination;

class ManualKehadiran extends Component
{
    use WithPagination;

    public $idAbsen;

    //index
    public $search;
    public $filterKehadiran;

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
            // ->orderBy('pivot_kondisi', 'desc')
            ->orderBy('nama', 'asc')
            ;
                
        if ($this->filterKehadiran) $anggota->wherePivot('kondisi',$this->filterKehadiran);

        return view('livewire.desktop.manual-kehadiran',[
            'abs'=>$abs,
            'isiTabel'=>$anggota->paginate(30),
        ]);
    }

    public function ganti($param)
    {
        //filter uang kas, *tidak pake, smo blok di nilai langsung saja. Aman itu, karena bendum saja tidak bisa bkse mundur. baru sesuai dengan kenyataan karena memang hadir, cuma dalam penilaian tidak dihitung.
        // if ($param[1]!='tidakhadir')
        // {
        //     $tgluangkas=Kehadiran::find($param[0])->anggota->TanggalBayarUangKas;
        //     if (!$tgluangkas) 
        //         return $this->emit('swalMessageError','Anggota ini belum membayar uang kas');
        // }

        //lanjut
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
