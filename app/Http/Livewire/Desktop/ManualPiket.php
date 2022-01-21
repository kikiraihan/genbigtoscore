<?php

namespace App\Http\Livewire\Desktop;

use App\Exports\PiketTemplate;
use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Piket;
use App\Models\Segmentbulanan;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ManualPiket extends Component
{
    use WithPagination, WithFileUploads;
    
    // untuk form
    public 
    $filepiket,
    $id_sb,
    $bobot;

    // bukan untuk form, tidak digunakan untuk input
    public $idBea;

    // untuk index
    public
    $search;

    protected $listeners=[
        'piketFixHapus'=>'delete',
        'fixBersihkanYangHadir'=>'bersihkanYangHadir',
        'fixHapusSemua'=>'hapusSemua',
    ];

    protected $CustomMessages = [
        'string' => 'Kolom :attribute, harus berupa teks',
        'required'=>'Kolom :attribute tidak boleh kosong',
        'unique'=>'Data kolom :attribute sudah ada sebelumnya',
    ];

    public function mount()
    {
        $this->bobot=-2;
        $bea=Beasiswa::yangTerakhir();
        $this->idBea=$bea->id;
        $this->id_sb=$bea->segmentbulanan->first()->id;
    }


    public function render()
    {
        $piketAnggota=Segmentbulanan::
            with(['PiketAnggotas.piket','PiketAnggotas.kepengurusan.unit.badan'])
            ->findOrFail($this->id_sb)
            ->piketAnggotas()
            ->hanyaYangAktif()
            ->orderBy('nama')
            ->where('nama', 'like', '%'.$this->search.'%')
            ;

        return view('livewire.desktop.manual-piket',[
            'isiTabel'=>$piketAnggota->paginate(100),
            'selectsegment'=>$this->selectsegment(),
            'selectBeasiswa'=>$this->selectBeasiswa(),
            'beasiswa'=>Beasiswa::yangTerakhir(),
        ]);
    }

    public function bersihkanYangHadir()
    {
        Piket::where('id_sb',$this->id_sb)
            ->where('jumlah_tidak_hadir',0)
            ->where('jumlah_izin',0)
            ->delete();
        $this->emit('swalUpdated');
    }

    public function hapusSemua()
    {
        Piket::where('id_sb',$this->id_sb)
            ->delete();
        $this->emit('swalUpdated');
    }


    public function selectBeasiswa()
    {
        return Beasiswa::whereHas('segmentbulanan')->get();
    }

    public function selectsegment()
    {
        return Segmentbulanan::
            HanyaSemesterIni($this->idBea)
            ->get();
    }

    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedIdBea()
    {
        $bea=Beasiswa::find($this->idBea);
        $this->id_sb=$bea->segmentbulanan->first()->id;
    }

    public function delete($id)
    {
        $toDelete=Piket::find($id);
        $toDelete->delete();
        $this->mount();
    }


    public function downloadTemplate() 
    {
        $waktu=Carbon::now();

        return Excel::download(new PiketTemplate(), 'template_piket_'.$waktu->format('Y_M_d').'.xlsx');
    }
}
