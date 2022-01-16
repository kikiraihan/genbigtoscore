<?php

namespace App\Http\Livewire\Desktop;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Segmentbulanan;
use App\Models\Tambahan;
use Livewire\Component;
use Livewire\WithPagination;

class ManualTambahan extends Component
{
    use WithPagination;

    // untuk form
    public 
    $id_anggota,
    $id_sb_ToInput,
    $judul,
    $nilai,

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
        'tambahanFixHapus'=>'delete'
    ];

    protected $CustomMessages = [
        'string' => 'Kolom :attribute, harus berupa teks',
        'required'=>'Kolom :attribute tidak boleh kosong',
        'unique'=>'Data kolom :attribute sudah ada sebelumnya',
    ];

    public function mount()
    {
        $this->metode='newTambahan';
        $this->nilai=0;

        $bea=Beasiswa::yangTerakhir();
        $this->idBea=$bea->id;
        $this->id_sb=$bea->segmentbulanan->first()->id;
    }

    public function render()
    {

        // ganti
        $tambahan=Segmentbulanan::
            with(['TambahanNilaiAnggotas'])->findOrFail($this->id_sb)
            ->TambahanNilaiAnggotas()
            ->hanyaYangAktif()
            ->where('nama', 'like', '%'.$this->search.'%')
            ;

        // dd($tambahan->get());

        return view('livewire.desktop.manual-tambahan',[
            'isiTabel'=>$tambahan->paginate(30),
            'selectsegment'=>$this->selectsegment(),
            'selectAnggota'=>$this->selectanggota(),
            'selectBeasiswa'=>$this->selectBeasiswa(),
            'beasiswa'=>Beasiswa::yangTerakhir(),
        ]);
    }

    // mulai dari sini kebawah, sama dengan evaluasi
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
    //batas sama dengan evaluasi







    public function newTambahan()
    {
        $this->validate([
            'id_anggota'          =>'required|integer',
            'id_sb_ToInput'       =>'required|integer',
            'judul'               =>'required|string',
            'nilai'               =>'required|integer',  
        ], $this->CustomMessages);

        $tam=new Tambahan;
        $tam->id_anggota         =$this->id_anggota;
        $tam->id_sb              =$this->id_sb_ToInput;
        $tam->judul              =$this->judul;
        $tam->nilai              =$this->nilai;
        $tam->save();

        $this->emit('swalAdded');
        $this->reset([
            'id_anggota',
            // 'judul',
            // 'nilai',
            'searchSelectAnggota',
            'terpilihSelectAnggota',
        ]);
        $this->id_sb=$this->id_sb_ToInput;
    }

    public function delete($id)
    {
        Tambahan::find($id)->delete();
        // $this->mount();
    }

}
