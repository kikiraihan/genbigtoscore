<?php

namespace App\Http\Livewire\Desktop;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Kegiatan;
use App\Models\Segmentbulanan;
use App\Models\Timkhu;
use Livewire\Component;
use Livewire\WithPagination;

class ManualTimkhu extends Component
{
    use WithPagination;

    // untuk form
    public 
    // $id_kegiatan,
    $id_kepala,
    $id_sb_ToInput,
    $tim_nama,
    $bobot,
    $jenis,
    $kegiatan_nama,
    $keterangan,
    $tanggal_pelaksanaan,
    
    $searchSelectKetupat,
    $terpilihSelectKetupat;

    // bukan untuk form, tidak digunakan untuk input
    // public $id_sb;
    public $idBea;

    // untuk edit
    public 
    $metode,
    $idToUpdate;

    // untuk index
    public
    $search;

    protected $listeners=[
        'timkhuFixHapus'=>'delete'
    ];

    protected $CustomMessages = [
        'string' => 'Kolom :attribute, harus berupa teks',
        'required'=>'Kolom :attribute tidak boleh kosong',
        'unique'=>'Data kolom :attribute sudah ada sebelumnya',
    ];

    public function mount()
    {
        $this->metode='newTimkhu';
        // $this->id_sb=Segmentbulanan::idTerkini();
        $this->idBea=Beasiswa::idTerakhir();
    }

    public function render()
    {
        $timkhu=Timkhu::
            with(['anggotas','kepala','segmentbulanan'])
            // ->where('id_sb', $this->id_sb)
            ->YangPunyaSegmentPadaBeasiswaIni($this->idBea)
            ->where('nama', 'like', '%'.$this->search.'%')
            ->orderBy('id_sb','desc')
            // ->orderBy('created_at','desc')
            ;

        return view('livewire.desktop.manual-timkhu',[
            'isiTabel' => $timkhu->orderBy('created_at','desc')->paginate(30),
            'selectsegment'=>$this->selectsegment(),
            'selectKetupat'=>$this->selectketupat(),
            'selectBeasiswa'=>$this->selectBeasiswa(),
            'beasiswa'=>Beasiswa::find($this->idBea),
        ]);
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

    public function selectketupat()
    {
        return 
        anggota::query()
        ->HanyaYangAktif()
        ->Bernama($this->searchSelectKetupat)
        ->get()->take(7);
    }

    
    public function setKetupat($param)
    {
        $this->id_kepala=$param[0];
        $this->terpilihSelectKetupat=$param[1];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function newTimkhu()
    {

        $this->validate([
            'id_kepala'           =>'required|integer',
            'id_sb_ToInput'       =>'required|integer',
            'tim_nama'            =>'required|string',
            'bobot'               =>'required|integer',
            'jenis'               =>'required|in:panitia-besar,panitia-kecil',
            'kegiatan_nama'       =>'required|string',
            'keterangan'          =>'nullable|string',
            'tanggal_pelaksanaan' =>'required|string',
        ], $this->CustomMessages);


        $keg=new Kegiatan;
        $keg->nama                 =$this->kegiatan_nama;
        $keg->keterangan           =$this->keterangan;
        $keg->tanggal_pelaksanaan  =$this->tanggal_pelaksanaan;
        $keg->save();
        $tim=new Timkhu;
        $tim->nama          =$this->tim_nama;
        $tim->id_kegiatan   =$keg->id;
        $tim->id_kepala     =$this->id_kepala;
        $tim->id_sb         =$this->id_sb_ToInput;
        $tim->bobot         =$this->bobot;
        $tim->jenis         =$this->jenis;
        $tim->save();
        
        // $this->id_sb        =$this->id_sb_ToInput;
        $this->emit('swalAdded');
        $this->reset([
            'kegiatan_nama',
            'keterangan',
            'tanggal_pelaksanaan',
            'tim_nama',
            'id_kepala',
            'id_sb_ToInput',
            'bobot',
            'jenis',
            'searchSelectKetupat',
            'terpilihSelectKetupat',
        ]);
    }

    public function delete($id)
    {
        $toDelete=Timkhu::find($id);
        $toDelete->delete();
        // $this->mount();
    }

    public function tampilEdit($id)
    {
        
        $this->metode='updateTimkhu';
        $this->idToUpdate=$id;
        $tim=Timkhu::with(['kegiatan','kepala'])
            ->where('id',$id)->first();

        $this->id_kepala            =$tim->id_kepala;
        $this->id_sb_ToInput        =$tim->id_sb;
        $this->tim_nama             =$tim->nama;
        $this->bobot                =$tim->bobot;
        $this->jenis                =$tim->jenis;
        $this->kegiatan_nama        =$tim->kegiatan->nama;
        $this->keterangan           =$tim->kegiatan->keterangan;
        $this->tanggal_pelaksanaan  =$tim->kegiatan->tanggal_pelaksanaan;
        $this->terpilihSelectKetupat=$tim->kepala->nama;
    }


    public function updateTimkhu()
    {
        $tim=Timkhu::find($this->idToUpdate);

        $this->validate([
            'id_kepala'           =>'required|integer',
            'id_sb_ToInput'       =>'required|integer',
            'tim_nama'            =>'required|string',
            'bobot'               =>'required|integer',
            'jenis'               =>'required|in:panitia-besar,panitia-kecil',
            'kegiatan_nama'       =>'required|string',
            'keterangan'          =>'nullable|string',
            'tanggal_pelaksanaan' =>'required|string',
        ], $this->CustomMessages);


        $tim->nama          =$this->tim_nama;
        $tim->id_kepala     =$this->id_kepala;
        $tim->id_sb         =$this->id_sb_ToInput;
        $tim->bobot         =$this->bobot;
        $tim->jenis         =$this->jenis;
        $tim->save();
        $keg=$tim->kegiatan;
        $keg->nama                 =$this->kegiatan_nama;
        $keg->keterangan           =$this->keterangan;
        $keg->tanggal_pelaksanaan  =$this->tanggal_pelaksanaan;
        $keg->save();
        
        $this->emit('swalUpdated');
        $this->resetAbisUpdate();
    }

    public function resetAbisUpdate()
    {
        $this->reset([
            'kegiatan_nama',
            'keterangan',
            'tanggal_pelaksanaan',
            'tim_nama',
            'id_kepala',
            'id_sb_ToInput',
            'bobot',
            'jenis',
            'searchSelectKetupat',
            'terpilihSelectKetupat',
        ]);
        $this->metode="newTimkhu";
    }

}
