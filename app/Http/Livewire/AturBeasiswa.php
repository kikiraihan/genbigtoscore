<?php

namespace App\Http\Livewire;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Segmentbulanan;
use Livewire\Component;
use Livewire\WithPagination;

class AturBeasiswa extends Component
{
    use WithPagination;

    // untuk form
    public 
    $tanggal,
    $tahun,
    $semester;

    // untuk edit
    public 
    $metode,
    $idTo;

    // untuk tambah anggota
    public $namabanyak;

    protected $listeners=[
        'fixHapusAnggota'=>'detachAnggota',
        'fixHapusSegment'=>'detachSegment',
    ];
    protected $CustomMessages = [
        'string' => 'Kolom :attribute, harus berupa teks',
        'required'=>'Kolom :attribute tidak boleh kosong',
        'unique'=>'Data kolom :attribute sudah ada sebelumnya',
    ];

    public function mount()
    {
        $this->metode=null;
    }

    public function render()
    {
        $bea = Beasiswa::with(['segmentbulanan','anggotas'])
                ->orderBy('id','desc');
        
        $tabelBawah=null;
        if($this->metode=="newPenerima")
            $tabelBawah=Beasiswa::find($this->idTo)->anggotas->load('universitas')->groupBy('id_universitas');
        elseif($this->metode=="newSegment")
            $tabelBawah=Beasiswa::find($this->idTo)->segmentbulanan;
        
        $beasiswaTo=null;
        if($this->idTo)
            $beasiswaTo=Beasiswa::find($this->idTo);
        
        return view('livewire.atur-beasiswa',[
            'isiTabel' => $bea->paginate(5),
            'tabelBawah'=>$tabelBawah,
            'beasiswaTo'=>$beasiswaTo,
        ]);
    }

    public function batalForm()
    {
        $this->metode=null;
        $this->namabanyak=null;
    }

    public function tampilTambahPenerima($id)
    {
        $this->metode="newPenerima";
        $this->idTo=$id;
    }

    public function detachAnggota($id)
    {
        Beasiswa::find($this->idTo)->anggotas()->detach($id);
        $this->render();
    }

    public function isiAnggotaBanyak()
    {
        $dup=[];
        $namas=explode(";", $this->namabanyak);
        $bea=Beasiswa::find($this->idTo);
        foreach ($namas as $key=>$na) 
            $anggota[$key]=anggota::where('nama', $na)->first();

        foreach ($anggota as $key => $ang) 
        {
            if($ang and !($bea->anggotas()->where('id',$ang->id)->first()))
            $bea->anggotas()->attach($ang->id);
            elseif($ang)
            $dup[]=$ang->nama;
            elseif(!$ang)
            $dup[]=$namas[$key];
        }
        //jika ada error
        if($dup)
        {
            $this->emit('swalMessageError','Terdapat error pada '.json_encode($dup));
            $this->namabanyak=$this->susunKembaliKata($dup);
        }
        else
        {
            $this->emit('swalUpdated');
            $this->namabanyak=null;
        }
        $this->render();
    }

    public function susunKembaliKata($dup)
    {
        $kata='';
        $i=0;
        foreach ($dup as $value) 
        {
            if( $i == 0)
                $kata.=$value;
            else
                $kata.=';'.$value;
            
            $i++;
        }
        return $kata;
    }



    public function tampilTambahSegment($id)
    {
        $this->metode="newSegment";
        $this->idTo=$id;
    }

    public function tambahSegment()
    {
        $bea=Beasiswa::find($this->idTo);
        $bulanAkhir=$bea->segmentbulanan()->orderBy('bulan','desc')->first()->bulan;

        $seg=new Segmentbulanan;
        $seg->id_beasiswa=$this->idTo;
        $seg->bulan=$bulanAkhir+1;
        $seg->save();

        $this->emit('swalUpdated');
        $this->render();
    }

    public function detachSegment($id)
    {
        Segmentbulanan::find($id)->delete();
        // Beasiswa::find($this->idTo)->segmentbulanan()->detach($id);
        $this->render();
    }

}
