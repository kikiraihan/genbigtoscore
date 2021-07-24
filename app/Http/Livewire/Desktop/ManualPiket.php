<?php

namespace App\Http\Livewire\Desktop;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Piket;
use App\Models\Segmentbulanan;
use Livewire\Component;
use Livewire\WithPagination;

class ManualPiket extends Component
{
    use WithPagination;
    
    // untuk form
    public 
    $id_anggota,
    $id_sb_ToInput,
    $bobot,
    $jumlah_tidak_hadir,
    $jumlah_izin,
    
    $searchSelectAnggota,
    $terpilihSelectAnggota;

    // bukan untuk form, tidak digunakan untuk input
    public $id_sb;

    // untuk edit
    public 
    $metode,
    $idToUpdate;

    // untuk index
    public
    $search;

    protected $listeners=[
        'piketFixHapus'=>'delete'
    ];

    protected $CustomMessages = [
        'string' => 'Kolom :attribute, harus berupa teks',
        'required'=>'Kolom :attribute tidak boleh kosong',
        'unique'=>'Data kolom :attribute sudah ada sebelumnya',
    ];

    public function mount()
    {
        $this->metode='newPiket';
        $this->jumlah_izin=0;
        $this->jumlah_tidak_hadir=0;
        $this->bobot=-2;
        $this->id_sb=Segmentbulanan::idTerkini();
    }


    public function render()
    {
        $piketAnggota=Segmentbulanan::
            with(['PiketAnggotas.piket'])->findOrFail($this->id_sb)
            ->piketAnggotas()
            ->hanyaYangAktif()
            ->where('nama', 'like', '%'.$this->search.'%')
            ;

        return view('livewire.desktop.manual-piket',[
            'isiTabel'=>$piketAnggota->paginate(10),
            'selectsegment'=>$this->selectsegment(),
            'selectAnggota'=>$this->selectanggota(),
            'beasiswa'=>Beasiswa::yangTerakhir(),
        ]);
    }

    public function selectsegment()
    {
        $idBeasiswaKini=Beasiswa::idTerakhir();
        return Segmentbulanan::
                HanyaSemesterIni($idBeasiswaKini)
                ->get();
    }

    public function selectanggota()
    {
        return 
        anggota::query()
        ->HanyaYangAktif()
        ->Bernama($this->searchSelectAnggota)
        ->get()->take(7);
    }

    public function setAnggota($param)
    {
        $this->id_anggota=$param[0];
        $this->terpilihSelectAnggota=$param[1];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function newPiket()
    {
        $this->validate([
            'id_anggota'          =>'required|integer',
            'id_sb_ToInput'       =>'required|integer',
            'bobot'               =>'required|in:-5,-3,-2',
            'jumlah_tidak_hadir'  =>'required|integer',  
            'jumlah_izin'         =>'required|integer',  
        ], $this->CustomMessages);


        if(Piket::where('id_anggota',$this->id_anggota)->where('id_sb',$this->id_sb_ToInput)->first())
            $this->emit('swalMessageError','Kombinasi piket anggota dan segment bulan tersebut sudah ada');//, alias Piket anggota pada segment bulan tersebut sudah ada
        else
        {
            $pik=new Piket;
            $pik->id_anggota         =$this->id_anggota;
            $pik->id_sb              =$this->id_sb_ToInput;
            $pik->bobot              =$this->bobot;
            $pik->jumlah_tidak_hadir =$this->jumlah_tidak_hadir;
            $pik->jumlah_izin        =$this->jumlah_izin;
            $pik->save();

            $this->emit('swalAdded');
            $this->reset([
                'id_anggota',
                // 'jumlah_tidak_hadir',
                // 'jumlah_izin',
                'searchSelectAnggota',
                'terpilihSelectAnggota',
            ]);
            $this->id_sb=$this->id_sb_ToInput;
            $this->jumlah_tidak_hadir=0;
            $this->jumlah_izin=0;
        }

        
    }

    public function delete($id)
    {
        $toDelete=Piket::find($id);
        $toDelete->delete();
        $this->mount();
    }




}
