<?php

namespace App\Http\Livewire;

use App\Models\Beasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{

    public $id_beasiswa;

    public function mount()
    {
        $this->id_beasiswa=Beasiswa::idTerakhir();
    }


    public function render()
    {
        $userlogin=User::find(Auth::user()->id)->load('anggota.kepengurusan.unit.badan');
        $anggota=$userlogin->anggota;

        return view('livewire.dashboard',[
            'userlogin'=>$userlogin,
            'selectBeasiswa'=>$anggota->beasiswas,
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
