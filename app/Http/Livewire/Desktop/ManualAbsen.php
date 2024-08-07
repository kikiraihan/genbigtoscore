<?php

namespace App\Http\Livewire\Desktop;

use App\Models\Absensi;
use App\Models\anggota;
use App\Models\Badan;
use App\Models\Beasiswa;
use App\Models\Kehadiran;
use App\Models\Segmentbulanan;
use App\Models\Timkhu;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class ManualAbsen extends Component
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
    
    $inisial_kondisi,
    $searchSelectSkope,
    $terpilihSelectSkope
    ;

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
        $this->inisial_kondisi='tidakhadir';
        $this->pengurangan='-2';
        $this->metode='newAbsen';
        // $this->id_sb=Segmentbulanan::idTerkini();
        $this->idBea=Beasiswa::idTerakhir();
    }

    public function render()
    {
        $absensi=Absensi::
            with(['absensiable','kehadiran'])
            // ->where('id_sb', $this->id_sb)
            ->YangPunyaSegmentPadaBeasiswaIni($this->idBea)
            ->where('title', 'like', '%'.$this->search.'%')
            ->orderBy('id_sb','desc')
            ->orderBy('date','desc');
            ;
        // $this->ditemukan=$absensi->count();

        return view('livewire.desktop.manual-absen',[
            'isiTabel' => $absensi->paginate(10),
            // 'selectsegment'=>$this->selectsegment(),
            'selectBeasiswa'=>$this->selectBeasiswa(),
            'selectAbsensiable'=>$this->selectabsensiable(),
            'beasiswa'=>Beasiswa::find($this->idBea),
        ]);
    }

    public function selectBeasiswa()
    {
        return Beasiswa::whereHas('segmentbulanan')->get();
    }

    public function selectsegment()//belum terpakai
    {
        return Segmentbulanan::
                HanyaSemesterIni($this->idBea)
                ->get();
    }

    public function selectabsensiable()
    {
        $selectAbsensiable=null;
        if($this->skope=='badan')
            $selectAbsensiable=Badan::where('nama', 'like', '%'.$this->searchSelectSkope.'%')
                ->get()->take(7);
        
        elseif ($this->skope=='unit') 
            $selectAbsensiable=Unit::where('nama', 'like', '%'.$this->searchSelectSkope.'%')
                ->get()->take(7);

        elseif ($this->skope=='timkhu') 
        {
            $selectAbsensiable=Timkhu::where('nama', 'like', '%'.$this->searchSelectSkope.'%')
                ->HanyaSekitarSemesterIni($this->idBea)->get();
            if($selectAbsensiable->isNotEmpty())
                $selectAbsensiable=$selectAbsensiable->take(7);
        }

        return $selectAbsensiable;
    }

    public function setAbsensiable($param)
    {

        if(!($this->skope==null or $this->skope=='seluruh-genbi'))
        {
            // if($this->skope=='badan') dd(Badan::find($param[0]));
            // elseif($this->skope=='unit') dd(Unit::find($param[0]));
            // elseif($this->skope=='timkhus') Timkhu::find($param[0]);

            if($this->skope=='badan') $this->absensiable_type='App\Models\Badan';
            elseif($this->skope=='unit') $this->absensiable_type='App\Models\Unit';
            elseif($this->skope=='timkhu') $this->absensiable_type='App\Models\Timkhu';

            $this->absensiable_id=$param[0];
            $this->terpilihSelectSkope=$param[1];
        }

    }

    public function setDeadlinetonull()
    {
        $this->deadline_absen=NULL;
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingskope()
    {
        $this->absensiable_id=null;
        $this->absensiable_type=null;
        $this->terpilihSelectSkope=null;
        $this->searchSelectSkope=null;
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
        $abs->open              =1;
        $abs->id_sb             =Segmentbulanan::idSegmentPadaBeasiswaIdDanBulan($this->idBea,$abs->date->month);

        $abs->save();
        $abs=$this->isiAnggota($abs,$this->inisial_kondisi);
        
        
        $this->emit('swalAdded','satu');
        $this->reset([
            'title',
            'date',
            'deadline_absen',
            'skope',
            'absensiable_type',
            'absensiable_id',
            'pengurangan',
        ]);
    }

    protected function isiAnggota(Absensi $abs,$inisial_kondisi)
    {
        if($abs->skope=='timkhu')
        {
            // anggotas
            foreach ($abs->absensiable->anggotas
                as $value) 
            {
                $ke= new Kehadiran;
                $ke->id_absen=$abs->id;
                $ke->id_anggota=$value->id;
                $ke->valid=TRUE;
                $ke->kondisi=$inisial_kondisi;
                $ke->save();
            }
        }
        elseif($abs->skope=='unit'){
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
        }
        elseif($abs->skope=='badan'){
            // foreach unit
            foreach ($abs->absensiable->units as $unit) 
            {
                // foreach anggota
                foreach ($unit->anggotaAktif as $value) {
                    $ke= new Kehadiran;
                    $ke->id_absen=$abs->id;
                    $ke->id_anggota=$value->id;
                    $ke->valid=TRUE;
                    $ke->kondisi=$inisial_kondisi;
                    $ke->save();
                }
            }
        }
        elseif($abs->skope=='seluruh-genbi'){
            
            // foreach anggota
            foreach (anggota::query()->HanyaYangAktif()->get() as $value) {
                $ke= new Kehadiran;
                $ke->id_absen=$abs->id;
                $ke->id_anggota=$value->id;
                $ke->valid=TRUE;
                $ke->kondisi=$inisial_kondisi;
                $ke->save();
            }
        }
        return $abs->save();
    }

    public function delete($id)
    {
        //ada di blade
        // $this->emit('swalDeleted','emitdisini','idhapus');

        $toDelete=Absensi::find($id);
        $toDelete->delete();
        $this->mount();
    }


    public function tampilEdit($id)
    {
        
        $this->metode='updateAbsen';
        $this->idToUpdate=$id;
        $abs=Absensi::find($id);

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
            'date'              =>"required|date|before:".Segmentbulanan::tanggalTerakhirBeasiswaIni(Beasiswa::find($this->idBea)).
                                                "|after:".Segmentbulanan::tanggalPertamaBeasiswaIni(Beasiswa::find($this->idBea)),
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
            'pengurangan'
        ]);
        $this->metode="newAbsen";
    }

}
