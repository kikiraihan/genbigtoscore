<?php

namespace App\Http\Livewire\Landing;

use App\Models\Absensi;
use Livewire\Component;

class FromAbsenPublic extends Component
{
    public $id_absen;
    public $search;
    public $username, $password;

    public function mount($id_absen){
        $this->id_absen = $id_absen;
    }

    public function render()
    {
        $absensi=Absensi::with('kehadiran.anggota')->findOrFail($this->id_absen);
        $kehadiran=$absensi->kehadiran()->whereHas('anggota', function($query){
            $query->bernama($this->search);
        })->paginate(50);

        return view('livewire.landing.from-absen-public',[
            "absensi" => $absensi,
            "isiTabel" => $kehadiran,
        ])->layout('layouts.public-form.app');
    }
}
