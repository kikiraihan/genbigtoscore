<?php

namespace App\Http\Livewire\Mobfirst;

use App\Models\Absensi;
use App\Models\anggota;
use App\Models\Badan;
use App\Models\Beasiswa;
use App\Models\Kehadiran;
use App\Models\Segmentbulanan;
use App\Models\Timkhu;
use App\Models\Unit;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class KaunitAbsen extends Component
{
    use WithPagination;

    // untuk form
    public
    $title,
    $date,
    $deadline_absen,
    $skope,
    $absensiable_type,
    $absensiable_id,
    $pengurangan,
    
    $inisial_kondisi;

    // bukan untuk form, tidak digunakan untuk input
    public $idBea;//$id_sb,

    // untuk edit
    public 
    $metode,
    $idToUpdate;

    // untuk index
    public
    $search,
    $ditemukan
    ;

    //untuk membatasi perubahan
    public $nyalakanBatas=false;

    protected $listeners=[
        'absenFixHapus'=>'delete'
    ];

    protected $CustomMessages = [
        'string' => 'Kolom :attribute, harus berupa teks',
        'required'=>'Kolom :attribute tidak boleh kosong',
        'unique'=>'Data kolom :attribute sudah ada sebelumnya',
        'before'=>'Terlalu jauh ke atas, Data kolom :attribute melewati bulan di segment terakhir beasiswa',
        'after'=>'Terlalu jauh ke bawah, Data kolom :attribute melewati bulan di segment pertama beasiswa',
    ];

    public function mount()
    {
        $this->inisial_kondisi='hadir';
        $this->pengurangan='-2';
        $this->metode='newAbsen';
        $this->skope='unit';
        $this->absensiable_type='App\Models\Unit';
        $this->absensiable_id=auth()->user()->anggota->unit->id;
        $this->idBea=Beasiswa::idTerakhir();
    }

    public function render()
    {
        $absensi=Absensi::
            with(['absensiable','kehadiran'])
            ->YangPunyaUnitIni(auth()->user()->anggota->unit->id)
            ->YangPunyaSegmentPadaBeasiswaIni($this->idBea)
            ->where('skope', 'unit')
            ->where('title', 'like', '%'.$this->search.'%')
            ->orderBy('id_sb','desc')
            ->orderBy('date','desc');
            ;
        // $this->ditemukan=$absensi->count();

        return view('livewire.mobfirst.kaunit-absen',[
            'isiTabel' => $absensi->paginate(30),
            'selectBeasiswa'=>$this->selectBeasiswa(),
            'beasiswa'=>Beasiswa::find($this->idBea),
            'unit'=>auth()->user()->anggota->unit,
        ]);
    }

    public function selectBeasiswa()
    {
        return Beasiswa::whereHas('segmentbulanan')->get();
    }

    public function setDeadlinetonull()
    {
        $this->deadline_absen=NULL;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }







    public function newAbsen()
    {

        $this->validate([
            'title'             =>"required|string",
            'date'              =>"required|date|before:".Segmentbulanan::tanggalTerakhirBeasiswaIni(Beasiswa::find($this->idBea)).
                                                "|after:".Segmentbulanan::tanggalPertamaBeasiswaIni(Beasiswa::find($this->idBea)),
            'deadline_absen'    =>"nullable|date|after_or_equal:date",
            'skope'             =>"required|string",
            'absensiable_type'  =>"nullable|string",
            'absensiable_id'    =>"nullable|integer",
            'pengurangan'       =>"required|in:-2,-3,-5",
        ], $this->CustomMessages);

        $abs = new Absensi;
        $abs->title             =$this->title;
        $abs->date              =$this->date;
        $abs->deadline_absen    =$this->deadline_absen;
        $abs->skope             =$this->skope;
        $abs->absensiable_type  =$this->absensiable_type;
        $abs->absensiable_id    =$this->absensiable_id;
        $abs->pengurangan       =$this->pengurangan;
        $abs->id_sb             =Segmentbulanan::idSegmentPadaBeasiswaIdDanBulan($this->idBea,$abs->date->month);

        $abs->save();
        $abs=$this->isiAnggota($abs,$this->inisial_kondisi);
        
        
        $this->emit('swalAdded');
        $this->reset([
            'title',
            'date',
            'deadline_absen',
        ]);
    }

    protected function isiAnggota(Absensi $abs,$inisial_kondisi)
    {
        // anggotaAktif
        foreach ($abs->absensiable->anggotaAktif 
            as $value) 
        {
            $ke= new Kehadiran;
            $ke->id_absen=$abs->id;
            $ke->id_anggota=$value->id;
            $ke->valid=TRUE;
            $ke->kondisi=$inisial_kondisi;
            $ke->save();
        }
        return $abs->save();
    }

    public function delete($id)
    {
        //ada di blade
        // $this->emit('swalDeleted','emitdisini','idhapus');

        $toDelete=Absensi::find($id);
        if(Carbon::now()->gt($toDelete->date->addDays(1)) && $this->nyalakanBatas)
            return $this->emit('swalMessageError','Batas edit absen sudah berakhir');

        $toDelete->delete();
        $this->mount();
    }


    public function tampilEdit($id)
    {
        $abs=Absensi::find($id);
        if(Carbon::now()->gt($abs->date->addDays(1)) && $this->nyalakanBatas)
            return $this->emit('swalMessageError','Batas edit absen sudah berakhir');
        
        $this->metode='updateAbsen';
        $this->idToUpdate=$id;

        $this->title            = $abs->title;
        $this->date             = $abs->date->format('Y-m-d')."T".$abs->date->format('h:i');
        if($abs->deadline_absen)
            $this->deadline_absen   = $abs->deadline_absen->format('Y-m-d')."T".$abs->deadline_absen->format('h:i');
        $this->pengurangan      = $abs->pengurangan;
        
    }

    public function updateAbsen()
    {
        $abs=Absensi::find($this->idToUpdate);

        $this->validate([
            'title'             =>"required|string",
            'date'              =>"required|date|before:".Segmentbulanan::tanggalTerakhirBeasiswaIni(Beasiswa::find($this->idBea))."|after:".Segmentbulanan::tanggalPertamaBeasiswaIni(Beasiswa::find($this->idBea)),
            'deadline_absen'    =>"nullable|date|after_or_equal:date",
            'pengurangan'       =>"required|in:-2,-3,-5",
        ], $this->CustomMessages);


        $abs->title             =$this->title;
        $abs->date              =$this->date;
        $abs->deadline_absen    =$this->deadline_absen;
        $abs->pengurangan       =$this->pengurangan;
        $abs->id_sb             =Segmentbulanan::idSegmentPadaBeasiswaIdDanBulan($this->idBea,$abs->date->month);
        $abs->save();
        
        $this->emit('swalUpdated');
        $this->resetAbisUpdate();
    }

    public function resetAbisUpdate()
    {
        $this->reset([
            'title',
            'date',
            'deadline_absen',
        ]);
        $this->metode="newAbsen";
    }


}
