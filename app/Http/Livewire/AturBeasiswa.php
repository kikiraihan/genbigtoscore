<?php

namespace App\Http\Livewire;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Segmentbulanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        'fixHapusBeasiswa'=>'hapusBeasiswa',
        'terkonfirmasiMulaiBeasiswaBaru'=>'storeMulaiBeasiswaBaru',
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
        $namas=explode(PHP_EOL, $this->namabanyak);
        $bea=Beasiswa::find($this->idTo);
        foreach ($namas as $key=>$na) //dengan begini maka key $dariInput akan sama dengan namaModel
            $anggota[$key]=anggota::where('nama', $na)->first();

        foreach ($anggota as $key => $ang) 
        {
            if($ang and !($bea->anggotas()->where('id',$ang->id)->first()))//jika ditemukan, dan belum masuk beasiswa
                $bea->anggotas()->attach($ang->id);//masukan ke penerima
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
                $kata.=PHP_EOL.$value;
            
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
        $segment=$bea->segmentbulanan()->orderBy('segtahun','desc')->orderBy('bulan','desc')->first();
        $bulanAkhir=$segment->bulan;
        $tahunAkhir=$segment->segtahun;
        // dd($tahunAkhir);

        $seg=new Segmentbulanan;
        $seg->id_beasiswa=$this->idTo;
        if($bulanAkhir==12)
        {
            $seg->bulan=1;
            $seg->segtahun = $tahunAkhir!=null?$tahunAkhir+1:Carbon::now()->year;
        }
        else
        {
            $seg->bulan=$bulanAkhir+1;
            $seg->segtahun = $tahunAkhir!=null?$tahunAkhir:Carbon::now()->year;
        }
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



    public function hapusBeasiswa($id)
    {
        Beasiswa::find($id)->delete();
        // $this->mount();
    }




    public function mulaiBeasiswaBaru()
    {
        // $m=ModelsMahasiswa::find($idMahasiswa);
        // dd(Carbon::now()->month);

        $isi = view('swalForm.mulaiBeasiswaBaru', [
            'sekarang'=>Carbon::now(),
            'beaTerakhir'=>Beasiswa::yangTerakhir()->tahun,
            // 'idMahasiswa'=>$idMahasiswa,
            ])->render();
        
        $this->emit('swalMulaiBeasiswaBaru','Beasiswa : Semester Baru',$isi);
    }

    public function storeMulaiBeasiswaBaru($value)
    {
        $b=new Beasiswa;
        $b->tahun=$value['tahun'];
        $b->semester=$value['semester'];
        $b->save();

        $seg= new Segmentbulanan;
        $seg->id_beasiswa=$b->id;
        $seg->bulan=$value['bulan_awal'];
        $seg->segtahun=$value['tahun'];
        $seg->save();

        $this->emit('swalAdded',1);
    }

}
