<?php

namespace App\Http\Livewire\Mobfirst;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Nilaieb;
use App\Models\Segmentbulanan;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class KepalaEvaluasibulanan extends Component
{
    use WithPagination;

    // untuk form
    public 
    $id_anggota,
    $id_sb_ToInput;

    // bukan untuk form, tidak digunakan untuk input
    public $id_sb;
    public $idBea;

    // untuk index
    public
    $search;

    //untuk membatasi perubahan
    public $nyalakanBatas=false;


    public function mount()
    {   
        $bea=Beasiswa::yangTerakhir();
        $this->idBea=$bea->id;
        $this->id_sb=$bea->segmentbulanan->last()->id;
    }

    public function render()
    {

        

        

        return view('livewire.mobfirst.kepala-evaluasibulanan',[
            'isiTabel'=>$this->getYangAkanDiEvaluasi()->paginate(30),
            'selectsegment'=>$this->selectsegment(),
            'selectBeasiswa'=>$this->selectBeasiswa(),
            'beasiswa'=>Beasiswa::yangTerakhir(),
        ]);
    }



    //filter untuk Korwil, Kekom, Kepala Unit
    public function getYangAkanDiEvaluasi($untukRefresh=false)
    {
        if($untukRefresh)
        {
            //untuk method refreshEB
            $ang=anggota::query()->HanyaYangAktif()->whereDoesntHave('nilaiEbs',function ($q){
                $q->where('segmentbulanans.id',$this->id_sb);
            });
        }
        else
        {
            //untuk method render
            $ang=Segmentbulanan::
                with(['nilaiEbsPerAnggota'])->findOrFail($this->id_sb)
                ->nilaiEbsPerAnggota()
                ->hanyaYangAktif()
                ->where('nama', 'like', '%'.$this->search.'%')
                ;

        }


        $angLogin=auth()->user()->anggota;

        if(auth()->user()->hasRole('Kepala Unit'))
            $ang->hanyaYangPunyaUnitIni($angLogin->unit->id);
        elseif(auth()->user()->hasRole('Kekom'))
        {
            $ang
            ->HanyaPengurusIni($angLogin->badan->id)
            ->where(function($q) use($angLogin){
                $q
                    ->hanyaYangPunyaUnitIni($angLogin->unit->id)
                    ->orWhere(function($que) {
                        $que->HanyaYangPunyaRoleIni(["Kepala Unit"]);
                    });
            });
        }
        elseif(auth()->user()->hasRole('Korwil'))
        {
            $ang
            ->where(function($q) use($angLogin){
                $q
                    ->HanyaPengurusIni($angLogin->badan->id)
                    ->orWhere(function($que) {
                        $que->HanyaYangPunyaRoleIni(["Kekom"]);
                    });
            })
            ->where(function($q) use($angLogin){
                $q
                    ->hanyaYangPunyaUnitIni($angLogin->unit->id)
                    ->orWhere(function($que) {
                        $que->HanyaYangPunyaRoleIni(["Kepala Unit","Kekom"]);
                    });
            });
        }

        return $ang;
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





    // kemungkinan yang terpakai hanya ini
    public function delete($id)
    {
        $toDelete=Nilaieb::find($id);
        $toDelete->delete();
        // $this->mount();
    }

    public function ganti($param)
    {
        //ada kase mati dulu dpe filter soalnya masih ba input nilai kemarin
        //filter cek kalau bukan bulan dan tahun ini
        if( 
            (Segmentbulanan::find($this->id_sb)->bulan != Carbon::now()->month ) and
            (Segmentbulanan::find($this->id_sb)->segtahun != Carbon::now()->year ) and
            $this->nyalakanBatas
        )
            return $this->emit('swalMessageError','Batas pengisian evaluasi sudah berakhir');
        
        $ke=Nilaieb::find($param[0]);
        if( $ke->id != auth()->user()->anggota->id )
                return $this->emit('swalMessageError','Hmmm tidak bisa menilai diri sendiri :v');

        $ke->nilai=$param[1];
        $ke->save();
        $this->emit('swalUpdated');
        // $this->render();
    }

    public function refreshEb()
    {
        $ini=$this->getYangAkanDiEvaluasi(true)->get();
        if($ini->isEmpty())
            return $this->emit('swalMessageError','Sudah up to date!');

        foreach ( $ini as $value) 
        {
            $n= new Nilaieb;
            $n->id_sb=$this->id_sb;
            $n->id_anggota=$value->id;
            $n->save();
        };
    }
    // batas--- kemungkinan yang terpakai hanya ini
}
