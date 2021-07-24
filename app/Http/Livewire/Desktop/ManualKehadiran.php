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
            ->orderBy('pivot_kondisi', 'desc');
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
}
