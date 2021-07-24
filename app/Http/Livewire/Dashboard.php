<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{


    public function render()
    {
        $userlogin=User::find(Auth::user()->id)->load('anggota.kepengurusan.unit.badan');
        
        return view('livewire.dashboard',compact(['userlogin']));
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
