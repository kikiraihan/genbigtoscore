<?php

namespace App\Http\Livewire\Form;

use App\Models\anggota;
use App\Models\Unit;
use App\Traits\demisionerkan;
use App\Traits\PindahUnit;
use Livewire\Component;
use Livewire\WithPagination;

class EditAnggotaUnit extends Component
{
    use WithPagination,PindahUnit,demisionerkan;

    protected $listeners=[
        'terkonfirmasiDemisioner'=>'demisionerkan',
        'terkonfirmasiPindahUnit'=>'fixPindahUnit',
        'terkonfirmasiPilihKetuaUnit'=>'fixPilihKetua',
        'terkonfirmasiResetKeanggotaan'=>'fixResetKeanggotaan',
        'editAnggotaUnitFixHapus'=>'fixRemove',
    ];


    // untuk index
    public
    $search;

    public $idUnit;

    public function mount($id)
    {
        
        // middleware kalau bukan unitnya
        $u=Unit::find($id);
        $us=auth()->user();
        if(!$us->hasRole(['Korwil','Admin']))
        {
            if($u->id_badan != $us->anggota->badan->id)
                abort(404);
        }

        $this->idUnit=$id;
    }

    public function render()
    {
        $u=Unit::with(['anggotaAktif.user'])->where('id',$this->idUnit)->first();

        return view('livewire.form.edit-anggota-unit',[
            'unit'=>$u,
            'isiTabel'=>$u->anggotaAktif()->where('nama', 'like', '%'.$this->search.'%')->paginate(30),
        ]);
    }

    public function fixPilihKetua($id)
    {
        $unit=Unit::find($this->idUnit);
        $pengganti=anggota::find($id)->load('user');
        if($unit->ketua)
        {
            $petahana=$unit->ketua->load('user');
            if($pengganti->user->hasAnyRole(['Korwil','Kekom']) OR $petahana->user->hasAnyRole(['Korwil','Kekom']))
                return $this->emit('swalMessageError','Korwil/Kekom tidak dapat diganti di menu ini');
        }
        elseif($pengganti->user->hasAnyRole(['Korwil','Kekom']))
            return $this->emit('swalMessageError','Korwil/Kekom tidak dapat diganti di menu ini');

        
        // $unit->id_ketua=$pengganti->id;
        $unit->save();

        if($unit->ketua)
        {
            $petahana->user->removeRole('Kepala Unit');
            $petahana->user->assignRole('Anggota');
        }
        $pengganti->user->removeRole('Anggota');
        $pengganti->user->assignRole('Kepala Unit');

        return $this->emit('swalUpdated');
    }


    public function fixResetKeanggotaan($id)
    {
        $a=anggota::find($id)->load('user');
        if($a->user->hasAnyRole(['Korwil','Kekom']))
            return $this->emit('swalMessageError','Korwil/Kekom tidak dapat direset di menu ini');
        
        // if($a->user->hasAnyRole(['Kepala Unit']))
        // {
        //     $unit=Unit::where('id_ketua',$a->id)->first();
        //     $unit->id_ketua=null;
        //     $unit->save();
        // }
        

        //role anggota
        $a->user->syncRoles(['Anggota']);

        //unit pengurus inti
        if($a->badan->id==1)//- wilayah id 1
            $a->kepengurusan->id_unit=1;
        elseif($a->badan->id==2)//- PI UNG id 8
            $a->kepengurusan->id_unit=8;
        elseif($a->badan->id==3)//- PI IAIN id 15
            $a->kepengurusan->id_unit=15;
        else//($a->badan->id==4) //- PI UG id 22
            $a->kepengurusan->id_unit=22;
        $a->kepengurusan->save();

        return $this->emit('swalUpdated');
    }
}
