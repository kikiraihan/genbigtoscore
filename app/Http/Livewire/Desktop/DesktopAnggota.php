<?php

namespace App\Http\Livewire\Desktop;

use App\Exports\AnggotaExport;
use App\Models\anggota;
use App\Models\Badan;
use App\Models\Beasiswa;
use App\Models\Unit;
use App\Models\User;
use App\Traits\Demisionerkan;
use App\Traits\PindahUnit;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class DesktopAnggota extends Component
{
    use WithPagination,PindahUnit,Demisionerkan;

    protected $listeners=[
        'terkonfirmasiDemisioner'=>'demisionerkan',
        'terkonfirmasiPindahUnit'=>'fixPindahUnit',
        'terkonfirmasiResetPasswordAnggota'=>'resetPassword',
        'terkonfirmasiEditRole'=>'fixEditRole',
        'terkonfirmasiKepengurusanBaru'=>'kepengurusanBaru',
    ];

    public 
    $idBeasiswaTerakhir,
    $angkatan,//$angkatan genbi
    $statusAktif=1;

    // untuk index
    public
    $search;

    public function mount()
    {
        $this->idBeasiswaTerakhir=Beasiswa::idTerakhir();
    }

    public function render()
    {
        $ang=anggota::
            with(['kepengurusan.unit.badan','universitas','user'])
            ->where(function ($query) {
                $query->where('nama', 'like', '%'.$this->search.'%')
                    ->orWhere('nim', 'like', '%'.$this->search.'%');
            })
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
        ->first();
        
        $radio=Role::whereNotIn('id',[7,8])->whereNotIn('name',['Tim Penilai','Admin'])->get();
        $check=Role::whereNotIn('id',[7,8])->whereIn('name',['Tim Penilai','Admin'])->get();
        $this->emit(
            'swalCheckboxPilihRole',
        view('swalForm.editRoleAnggota',[
                        'radio'=>$radio,
                        'check'=>$check,
                        'user'=>$user,
                    ])->render(),
        $id);
    }

    public function fixEditRole($satu,$dua,$idAnggota)
    {
        $user = User::whereHas('anggota', function ($q) use ($idAnggota){
            $q->where('id', $idAnggota);
        })
        ->first();
        $badanUser=$user->anggota->badan;
        $unitUser=$user->anggota->unit;

        if($user->hasRole(['Korwil','Kekom']) and ($satu!="Korwil" and $satu!="Kekom"))
            return $this->emit('swalMessageError','Untuk mengganti Korwil/Kekom adalah calon pengganti yang diganti rolenya, kemudian yang lama akan direset otomatis');
        elseif($badanUser->id==1 and ($satu=="Kekom" OR $satu=="Sekom" OR $satu=="Benkom"))
            return $this->emit('swalMessageError','Dari wilayah ke role komsat tidak boleh, pindahkan dulu unitnya');
        elseif($badanUser->id!=1 and ($satu=="Korwil" OR $satu=="Sekwil" OR $satu=="Benwil"))
            return $this->emit('swalMessageError','Dari Komsat ke role wilayah tidak boleh, pindahkan dulu unitnya');

        //jika form memilih -> korwil/kekom
        if($satu=="Korwil" OR $satu=="Kekom")
        {
            if(!auth()->user()->hasRole(['Admin','Korwil']))
            {
                return $this->emit('swalMessageError','yang bisa mengganti korwil hanya admin/korwil');
            }

            if($satu=="Korwil")
            {
                //reset korwil lama
                $korseb=User::UserYangPunyaRoleIni(["Korwil"])->first();
                if($korseb)
                    $korseb->syncRoles(['Anggota','Admin']);
                
                // pindah ke unit inti
                $user->anggota->kepengurusan->id_unit=1;//$korseb->anggota->unit->id;
                $user->anggota->kepengurusan->save();
            }
            elseif($satu=="Kekom")
            {
                //reset kekom lama, yang punya badan sama
                $keseb=User::UserYangPunyaRoleIni(["Kekom"])->whereHas('anggota',function($q)use($badanUser){
                    $q->HanyaPengurusIni($badanUser->id);
                })->first();
                if($keseb)
                {
                    $keseb->syncRoles(['Anggota']);
                }

                // hardcoding
                // pindah ke unit inti
                if($badanUser->id==2)
                    $user->anggota->kepengurusan->id_unit=8;//$korseb->anggota->unit->id;
                elseif($badanUser->id==3)
                    $user->anggota->kepengurusan->id_unit=15;//$korseb->anggota->unit->id;
                elseif($badanUser->id==4)
                    $user->anggota->kepengurusan->id_unit=22;//$korseb->anggota->unit->id;

                $user->anggota->kepengurusan->save();
            }
        }
        elseif($satu=="Kepala Unit")
        {
            // reset kepala unit lama, pada unitnya
            $petahana=User::UserYangPunyaRoleIni(["Kepala Unit"])->whereHas('anggota',function($q)use($unitUser){
                $q->HanyaYangPunyaUnitIni($unitUser->id);
            })->first();
            if($petahana){
                $petahana->removeRole('Kepala Unit');
                $petahana->assignRole('Anggota');
            }
        }

        $user->syncRoles($dua);
        $user->assignRole($satu);

        $this->emit('swalUpdated');
    }









    public function kepengurusanBaru($nimAktif)
    {
        $nimAktif=explode(PHP_EOL,$nimAktif);
        
        //cek jika ada error, tidak akan dilanjut
        $galat=$this->cekError($nimAktif);
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
        ->whereIn('nim',$nimAktif)->get();
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
        sort($dariInput);
        $galat=[];
        $imodel=0;
        $iinput=0;
        $arrayModel=anggota::whereIn('nim',$dariInput)->select('nim')->orderBy('nim','asc')->get()->toArray();
        $arrayModelExtract=[];
        foreach ($arrayModel as $a) $arrayModelExtract[]=$a['nim'];
        sort($arrayModelExtract);

        // dd($arrayModelExtract,$dariInput);
        while ($imodel < count($arrayModelExtract)) 
        {
            if($dariInput[$iinput]==$arrayModelExtract[$imodel])
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
        //sisanya yang tidak ditemukan, maka semua galat. ini biasanya karena yang didapat dari db kurang.
        while($iinput < count($dariInput))
        {
            $galat[]=$dariInput[$iinput];
            $iinput++;
        }
        // dd($galat);
        return $galat;
    }

    public function export() 
    {
        $waktu=Carbon::now();

        return Excel::download(new AnggotaExport($this->statusAktif), 'anggota_export_'.$waktu->format('Y_M_d').'.xlsx');
    }
}
