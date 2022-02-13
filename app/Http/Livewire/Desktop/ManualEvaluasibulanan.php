<?php

namespace App\Http\Livewire\Desktop;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Nilaieb;
use App\Models\Segmentbulanan;
use Livewire\Component;
use Livewire\WithPagination;

class ManualEvaluasibulanan extends Component
{
    use WithPagination;

    // untuk form
    public 
    $id_anggota,
    $id_sb_ToInput,
    // $judul,
    // $nilai,

    $searchSelectAnggota,
    $terpilihSelectAnggota;

    // bukan untuk form, tidak digunakan untuk input
    public $id_sb;
    public $idBea;

    // untuk edit
    public 
    $metode,
    $idToUpdate;

    // untuk index
    public
    $search;

    protected $listeners=[
        'evaluasiFixHapus'=>'delete'
    ];

    protected $CustomMessages = [
        'string' => 'Kolom :attribute, harus berupa teks',
        'required'=>'Kolom :attribute tidak boleh kosong',
        'unique'=>'Data kolom :attribute sudah ada sebelumnya',
    ];

    public function mount()
    {
        $this->metode='newEvaluasi';
        
        $bea=Beasiswa::yangTerakhir();
        $this->idBea=$bea->id;
        $this->id_sb=$bea->segmentbulanan->first()->id;
    }

    public function render()
    {
        $ang=Segmentbulanan::
            with(['nilaiEbsPerAnggota'])->findOrFail($this->id_sb)
            ->nilaiEbsPerAnggota()
            ->hanyaYangAktif()
            ->where('nama', 'like', '%'.$this->search.'%')
            ;

        return view('livewire.desktop.manual-evaluasibulanan',[
            'isiTabel'=>$ang->paginate(30),
            'selectsegment'=>$this->selectsegment(),
            'selectBeasiswa'=>$this->selectBeasiswa(),
            'selectAnggota'=>$this->selectanggota(),
            'beasiswa'=>Beasiswa::yangTerakhir(),
        ]);
    }


    // mulai dari sini kebawah, sama dengan manual tambahan
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

    public function updatedIdBea()
    {
        $bea=Beasiswa::find($this->idBea);
        $this->id_sb=$bea->segmentbulanan->first()->id;
    }
    // batas sama dengan manual tambahan




    public function newEvaluasi()
    {
        $this->validate([
            'id_anggota'          =>'required|integer',
            'id_sb_ToInput'       =>'required|integer',
        ], $this->CustomMessages);

        if(Nilaieb::where('id_anggota',$this->id_anggota)->where('id_sb',$this->id_sb_ToInput)->first())
            $this->emit('swalMessageError','Data segment bulanan dan anggota sudah ada, coba lakukan pencarian');//, alias Piket anggota pada segment bulan tersebut sudah ada
        else
        {
            $tam=new Nilaieb;
            $tam->id_anggota         =$this->id_anggota;
            $tam->id_sb              =$this->id_sb_ToInput;
            $tam->save();

            $this->emit('swalAdded');
            $this->reset([
                'id_anggota',
                'searchSelectAnggota',
                'terpilihSelectAnggota',
            ]);
        }

    }



    




    // kemungkinan yang terpakai hanya ini
    public function delete($id)
    {
        $toDelete=Nilaieb::find($id);
        $toDelete->delete();
        // $this->mount();
    }


    public function ganti($param)
    {
        $ke=Nilaieb::find($param[0]);
        $ke->nilai=$param[1];
        $ke->save();
        $this->emit('swalUpdated');
        // $this->render();
    }

    public function refreshEb()
    {
        $ini=anggota::query()->HanyaYangAktif()->whereDoesntHave('nilaiEbs',function ($q){
            $q->where('segmentbulanans.id',$this->id_sb);
        })->get();
        if($ini->isEmpty())
            return $this->emit('swalMessageError','Sudah up to date!');

        foreach ( $ini as $value) 
        {
            $n= new Nilaieb;
            $n->id_sb=$this->id_sb;
            $n->id_anggota=$value->id;
            $n->nilai='3/5';
            $n->save();
        };
    }
    // batas--- kemungkinan yang terpakai hanya ini

}
