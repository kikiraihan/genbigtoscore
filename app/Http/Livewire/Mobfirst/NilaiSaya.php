<?php

namespace App\Http\Livewire\Mobfirst;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Konfigurasi;
use App\Models\User;
use App\Traits\HitungNilai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NilaiSaya extends Component
{
    use HitungNilai;

    public $id_beasiswa;
    public $beasiswa;
    public $tampilkanNilai;
    public $nilaiAkhir;
    public $standar_lulus;

    public function mount()
    {
        $this->standar_lulus=Konfigurasi::langsung('standar_lulus');
        $this->id_beasiswa=Beasiswa::idTerakhir();
        $this->beasiswa=Beasiswa::yangTerakhir();
        $this->tampilkanNilai=false;

        $userlogin=User::find(Auth::user()->id)->load('anggota.kepengurusan.unit.badan');
        $anggota=$userlogin->anggota;
        $this->nilaiAkhir=$this->getNilaiAkhir($this->beasiswa, $anggota->id);
    }

    public function render()
    {
        $userlogin=Auth::user();
        $anggota=anggota::with('kepengurusan.unit.badan')
            ->where('id_user', $userlogin->id)->first();

        return view('livewire.mobfirst.nilai-saya',[
            'userlogin'=>$userlogin,
            'anggota'=>$anggota,
            'selectBeasiswa'=>
            // Beasiswa::with(['anggotas'])->whereHas('anggotas', function($q){
            //     return $q->where('id',auth::user()->anggota->id);
            // })->last(),
            Beasiswa::whereBetween('id', [$anggota->beasiswas->first()->id, Beasiswa::idTerakhir()])->get(),
            'beasiswa'=>Beasiswa::find($this->id_beasiswa),
        ]);
        // ->layout('layouts.app')// defaultnya bgtu jadi tida usah edit
    }
}
