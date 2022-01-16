<?php

namespace App\Http\Livewire\Desktop;

use App\Models\anggota;
use App\Models\Unit;
use App\Models\User;
use App\Traits\demisionerkan;
use App\Traits\pindahUnit;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class DesktopAnggota extends Component
{
    use WithPagination,pindahUnit,demisionerkan;

    protected $listeners=[
        'terkonfirmasiDemisioner'=>'demisionerkan',
        'terkonfirmasiPindahUnit'=>'fixPindahUnit',
        'terkonfirmasiResetPasswordAnggota'=>'resetPassword',
        'terkonfirmasiEditRole'=>'fixEditRole',
        'terkonfirmasiKepengurusanBaru'=>'kepengurusanBaru',
    ];

    public 
    $angkatan,//$angkatan genbi
    $statusAktif=1;

    // untuk index
    public
    $search;

    public function render()
    {
        $ang=anggota::
            with(['kepengurusan.unit.badan','universitas','user'])
            ->where('nama', 'like', '%'.$this->search.'%')
            ->orderBy('id_universitas')
            ->orderBy('nama')
            ;

        if ($this->statusAktif) 
            $ang->hanyaYangAktif();
        else
            $ang->hanyaYangDemisioner();
        //yang tidak punya kepengurusan tidak akan tampl

        // {{$userlogin->anggota->awalmasukgenbi}}

        return view('livewire.desktop.desktop-anggota',[
            'isiTabel'=>$ang->paginate(100),
            'jumlahWilayah'=>(clone $ang)->hanyaYangAktif()->HanyaPengurusIni(1)->count(),
            'jumlahung'=>(clone $ang)->hanyaYangAktif()->HanyaPengurusIni(2)->count(),
            'jumlahIAIN'=>(clone $ang)->hanyaYangAktif()->HanyaPengurusIni(3)->count(),
            'jumlahUG'=>(clone $ang)->hanyaYangAktif()->HanyaPengurusIni(4)->count(),
        ]);
        //clone untuk mereplikasi atau menggandakan query. karena kalau tidak diclone, maka $ang akan termutasi dari scope sebelumnya.
    }

    /*------------------------------
    ...... info : FUNGSI Demisioner PAKE TRAIT demisionerkan
    ------------------------------*/ 
    
    /*------------------------------
    ...... info : FUNGSI PINDAH UNIT PAKE TRAIT PindahUnit
    ------------------------------*/ 


    public function resetPassword($id)
    {
        $p = User::whereHas('anggota', function ($q) use ($id){
            $q->where('id', $id);
        })->first();
        $p->password = 'password';
        $p->save();
    }

    
    public function editRole($id)
    {
        $user = User::whereHas('anggota', function ($q) use ($id){
            $q->where('id', $id);
        })
        // ->with()
        ->first();
        
        $checkRole='';
        $ro=Role::whereNotIn('id',[7,8])->get();
        foreach ($ro as $key => $r) 
        {
            if ($user->hasRole($r->name)) 
                $checkRole.='<div class="form-check divCheckboxRole"><input checked class="form-check-input checkboxRole" type="checkbox" value="TRUE" id="checkbox'.$r->id.'" name="roleInput['.$r->id.']"><label class="form-check-label" for="checkbox'.$r->id.'">'.$r->name.'</label></div>';
            else 
                $checkRole.='<div class="form-check divCheckboxRole"><input class="form-check-input checkboxRole" type="checkbox" value="TRUE" id="checkbox'.$r->id.'" name="roleInput['.$r->id.']"><label class="form-check-label" for="checkbox'.$r->id.'">'.$r->name.'</label></div>';
            
        }

        $this->emit('swalCheckboxPilihRole',$checkRole,$id);
    }

    public function fixEditRole($hasil,$idAnggota)
    {
        $user = User::whereHas('anggota', function ($q) use ($idAnggota){
            $q->where('id', $idAnggota);
        })
        ->first();
        $user->syncRoles($hasil);

        $this->emit('swalUpdated');
    }

    public function kepengurusanBaru($namaAktif)
    {
        $namaAktif=explode(PHP_EOL,$namaAktif); 
        sort($namaAktif);

        //cek jika ada error, tidak akan dilanjut
        $galat=$this->cekError($namaAktif);
        if(count($galat))
            return $this->emit(
                'swalErrorMulaiKepengurusan',
                view('swalForm.tampilError', ['galat'=>$galat])->render()
            );

        //demisionerkan semua dulu
        foreach (
            anggota::with(['kepengurusan'])
            ->hanyaYangAktif()->get() as $key => $ang
            ) 
        {
            $this->dems($ang,TRUE);
        }

        //aktifkan lagi aktifModel
        //harus disini karena dibagian demisioner harus duluan, kalau mo taruh diatas demis dpe deklarasi, dia mo anggap sebelum demisioner dpe deklarasi
        $aktifModel=anggota::with(['kepengurusan'])
        ->whereIn('nama',$namaAktif)->get();
        foreach (
            $aktifModel as $key => $ang
            )
        {
            $ang->kepengurusan->tanggal_demisioner=NULL;
            $ang->kepengurusan->save();
        }
        // dd($aktifModel);

        return $this->emit('swalUpdated');
    }


    public function cekError($dariInput)
    {
        $galat=[];
        $imodel=0;
        $iinput=0;
        $arrayModel=anggota::whereIn('nama',$dariInput)->select('nama')->orderBy('nama','asc')->get()->toArray();
        // dd($arrayModel,$dariInput);
        while ($imodel < count($arrayModel)) 
        {
            if(trim(strtolower($dariInput[$iinput]))==trim(strtolower($arrayModel[$imodel]["nama"])))
            {
                $imodel++;
                $iinput++;
            }
            else
            {
                // dd($iinput);
                $galat[]=$dariInput[$iinput];
                $iinput++;
            }
        }
        // dd($galat);
        while($iinput < count($dariInput))
        {
            $galat[]=$dariInput[$iinput];
            $iinput++;
        }
        // dd($galat);
        return $galat;
    }
}
