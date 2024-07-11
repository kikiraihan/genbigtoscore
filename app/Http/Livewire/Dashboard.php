<?php

namespace App\Http\Livewire;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Konfigurasi;
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
    public $standar_lulus;

    public function mount()
    {
    }


    public function render()
    {
        $userlogin=Auth::user();
        $anggota=anggota::with('kepengurusan.unit.badan')
            ->where('id_user', $userlogin->id)->first();

        return view('livewire.dashboard',[
            'userlogin'=>$userlogin,
            'anggota'=>$anggota,
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
