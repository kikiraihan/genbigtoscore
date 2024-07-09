<?php

namespace App\Traits;

use App\Models\anggota;
use App\Models\User;
use Carbon\Carbon;

// tidak terpakai ini skrg, soalnya so pake laravel excel
trait Demisionerkan 
{
    public function demisionerkan($id)
    {
        // dd($id);
        $ang=anggota::find($id);
        
        if($this->dems($ang))
            $this->emit('swalUpdated');
    }

    protected function getJabatanFromRole(User $u)
    {
        if(count($u->getRoleNames())==1)
            // switch ($u->getRoleNames()[0]) {
            //     case 'Korwil':
            //         $return='Koordinator Wilayah';
            //     break;
            //     case 'Sekwil':
            //         $return='Sekretaris Wilayah';
            //     break;
            //     case "Benwil":
            //         $return='Bendahara Wilayah';
            //     break;
            //     case 'Kekom':
            //         $return='Koordinator Komisariat';
            //     break;
            //     case 'Sekom':
            //         $return='Sekretaris Komisariat';
            //     break;
            //     case 'Benkom':
            //         $return='Bendahara Komisariat';
            //     break;
            //     default:
            //     $return=$u->getRoleNames()[0];
            // }
            $return=$u->getRoleNames()[0];
        else
            $return=json_encode($u->getRoleNames()[0]);

        return $return;
    }

    public function dems(anggota $ang,$mulaiBaru=false)
    {
        $us=$ang->user;

        if ($us->hasRole(['Korwil','Kekom']) and !$mulaiBaru)
        {
            $this->emit('swalMessageError','Korwil/Kekom tidak dapat didemisionerkan sebelum korwil atau kekom baru dipilih. Silahkan tentukan calon pengganti dahulu, kemudian edit rolenya menjadi Korwil/Kekom di menu anggota');
            return false;
        }
        elseif($us->hasRole(['Korwil','Admin']))
            $us->syncRoles(['Anggota','Admin']);
        else
            $us->syncRoles(['Anggota']);

        $ang->kepengurusan->tanggal_demisioner=Carbon::now();
        // $ang->kepengurusan->jabatan=$this->getJabatanFromRole($us);
        $ang->kepengurusan->save();

        return true;
    }

    public function aktifkanKembali($id)
    {
        // dd($id);
        $ang=anggota::find($id);
        $ang->kepengurusan->tanggal_demisioner=NULL;
        $ang->kepengurusan->save();
        $this->emit('swalUpdated');
    }
}
