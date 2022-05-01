<?php

namespace App\Http\Livewire;

use App\Models\Beasiswa;
use App\Models\User;
use App\Traits\HitungNilai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    use HitungNilai;

    public $id_beasiswa;
    public $beasiswa;
    public $tampilkanNilai;
    public $nilaiAkhir;

    public function mount()
    {
        $this->id_beasiswa=Beasiswa::idTerakhir();
        $this->beasiswa=Beasiswa::yangTerakhir();
        $this->tampilkanNilai=false;

        $userlogin=User::find(Auth::user()->id)->load('anggota.kepengurusan.unit.badan');
        $anggota=$userlogin->anggota;
        $this->nilaiAkhir=$this->getNilaiAkhir($this->beasiswa, $anggota->id);
    }


    public function render()
    {
        $userlogin=User::find(Auth::user()->id)->load('anggota.kepengurusan.unit.badan');
        $anggota=$userlogin->anggota;

        return view('livewire.dashboard',[
            'userlogin'=>$userlogin,
            'selectBeasiswa'=>
            // Beasiswa::with(['anggotas'])->whereHas('anggotas', function($q){
            //     return $q->where('id',auth::user()->anggota->id);
            // })->last(),
            Beasiswa::whereBetween('id', [$anggota->beasiswas->first()->id, Beasiswa::idTerakhir()])->get(),
            'beasiswa'=>Beasiswa::find($this->id_beasiswa),
        ]);
        // ->layout('layouts.app')// defaultnya bgtu jadi tida usah edit
    }


    public function renderAsAdmin($userlogin)
    {
        if($userlogin->hasRole('Admin'))
        return $this->renderAsAdmin($userlogin);
        else
        return $this->renderAsNotAdmin($userlogin);
        // dd();
        // $jumPegawai=Pegawai::count();
        // $jumUnit=Unit::count();

        return view('livewire.admin.dashboard-admin',compact(['userlogin','jumPegawai',"jumUnit"]));
    }

    public function renderAsNotAdmin($userlogin)
    {
    }
}
