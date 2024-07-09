<?php

namespace App\Traits;

use App\Models\User;
use Spatie\Permission\Models\Role;

// tidak terpakai ini skrg, soalnya so pake laravel excel
trait EditRole {
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

        // validasi
        if($user->hasRole(['Korwil','Kekom']) and ($satu!="Korwil" and $satu!="Kekom"))
            return $this->emit('swalMessageError','Tidak bisa mengganti Korwil dan Kekom. Cara mengganti korwil adalah dengan mengganti role anggota dari calon pengganti Korwil/kekom, kemudian kekom yang lama akan direset otomatis');
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
}