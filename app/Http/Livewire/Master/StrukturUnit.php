<?php

namespace App\Http\Livewire\Master;

use App\Models\anggota;
use App\Models\Badan;
use App\Models\Kepengurusan;
use App\Models\Unit;
use App\Traits\demisionerkan;
use App\Traits\pindahUnit;
use Livewire\Component;
use Livewire\WithPagination;

class StrukturUnit extends Component
{
    use WithPagination,pindahUnit,demisionerkan;

    protected $listeners=[
        'terkonfirmasiEditMasterUnit'=>'fixEdit',
        'terkonfirmasiTambahMasterUnit'=>'fixTambah',
        'masterUnitFixHapus'=>'fixHapus',
        'terkonfirmasiAktifkanAnggotaUnit'=>'aktifkanKembali'
    ];

    // untuk index
    public
    $search;

    public function render()
    {
        $u=Unit::with(['badan','anggotaAktif','anggotaDemisioner','RelasiKetua'])
            ->orderBy('id_badan','asc');

        //filter jika bukan korwil
        $us=auth()->user();
        $badanUser=$us->anggota->badan;
        if(!$us->hasRole(['Korwil','Admin']))
        {
            $u->where('id_badan',$badanUser->id);
            $kepeng=$badanUser->load('kepengurusans.anggota')
                ->kepengurusans()
                ->whereHas('anggota',function($qu){
                    $qu->HanyaYangDemisioner()
                    ->where('nama', 'like', '%'.$this->search.'%');
                });
        }
        else
        {
            $kepeng=Kepengurusan::with(['anggota'])
            ->whereHas('anggota',function($qu){
                $qu->HanyaYangDemisioner()
                ->where('nama', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.master.struktur-unit',[
            'demis'=>$kepeng->paginate(10),
            'isiTabel'=>$u->get(),
        ]);
    }

    public function getBadanFilteredAuth()
    {
        if(!auth()->user()->hasRole(['Korwil','Admin']))
            return Badan::where('id',auth()->user()->anggota->badan->id)->get();
        else
            return Badan::all();
    }

    public function tampilEdit($id)
    {
        $isi = view('swalForm.editMasterUnit', [
            'toEdit'=>Unit::with(['badan'])->where('id',$id)->first(),
            'badan'=>$this->getBadanFilteredAuth(),
            'id'=>$id,
            ])->render();
        
        $this->emit('swalEditMasterUnit','Edit Unit',$isi, $id);
    }

    public function fixEdit($value, $id)
    {
        $u=Unit::find($id);
        $u->nama=$value['nama'];
        $u->singkat=$value['singkat'];
        $u->status=$value['status'];
        //edit badan khusus korwil/admin saja
        if(auth()->user()->hasRole(['Korwil','Admin']))
            $u->id_badan=$value['badan'];

        $u->save();
        $this->emit('swalUpdated');
    }

    public function fixHapus($id)
    {
        $u=Unit::find($id);
        if($u->kepengurusan->isNotEmpty())
            $this->emit('swalMessageError','Tidak dapat menghapus! unit ini masih memiliki anggota, pindahkan dulu anggota tersebut ke unit lain..');
        else
            $u->delete();
    }


    public function tampilTambah()
    {
        $isi = view('swalForm.tambahMasterUnit', [
            'badan'=>$this->getBadanFilteredAuth(),
            ])->render();
        
        $this->emit('swalTambahMasterUnit','Tambah Unit',$isi);
    }

    public function fixTambah($value)
    {
        $u=new Unit;
        $u->nama=$value['nama'];
        $u->singkat=$value['singkat'];
        $u->id_badan=$value['badan'];
        $u->status=$value['status'];
        $u->save();
        
        $this->emit('swalAdded');
    }
}
