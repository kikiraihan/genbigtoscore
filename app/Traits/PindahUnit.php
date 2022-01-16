<?php

namespace App\Traits;

use App\Models\anggota;
use App\Models\Unit;

// tidak terpakai ini skrg, soalnya so pake laravel excel
trait pindahUnit 
{
    public function pindahUnit($id)
    {
        $ang=anggota::find($id);
        
        if($ang->badan->id==1)//wilayah
        {
            $unit=Unit::
            with('badan')
            ->where('id_badan',$ang->id_universitas+1)
            //soalnya id univ dan id badan beda 1 angka.
            ->orWhere('id_badan',1)
            ->get();
        }
        else //komsat
        {
            $unit=Unit::
            with('badan')
            ->where('id_badan',$ang->badan->id)
            ->orWhere('id_badan',1)
            ->get();
        }

        $option=null;
        foreach ($unit as $key => $un) 
        {
            $option['badan-'.$un->badan->nama][$un->id]=$un->nama;
        }
        $this->emit('swalSelectPindahUnit',$ang->unit->nama,$option,$id);
    }

    public function fixPindahUnit($idUnit,$idAnggota)
    {
        $ang=anggota::find($idAnggota);

        //kalau KSB wilayah, KSB komsat, Kadiv tidak boleh, harus ganti dulu rolenya.
        if($ang->user->hasAnyRole([
            'Korwil','Kekom',
            'Sekwil','Sekom',
            'Benwil','Benkom',
            ]))
            return $this->emit('swalMessageError','KSB wilayah, KSB komsat hanya bisa dipindahkan, setelah diganti rolenya menjadi anggota biasa.');
        elseif($ang->user->hasAnyRole(['Kepala Unit']))
            return $this->emit('swalMessageError','Kadiv hanya bisa dipindahkan setelah diganti kadiv baru dipilih di menu unit.');

        $ang->kepengurusan->id_unit=$idUnit;
        $ang->kepengurusan->save();
        $this->emit('swalUpdated');
    }
}
