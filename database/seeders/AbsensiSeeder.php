<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\anggota;
use App\Models\Kehadiran;
use App\Models\Segmentbulanan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        

        for ($i=0; $i <10 ; $i++) 
        {     
            $absen=new Absensi;
            $absen->title               ='coba'.$i;
            $absen->date                = Carbon::now()->addDay($i);
            $absen->deadline_absen      = Carbon::now()->addDay($i+1);
            $absen->skope               ='seluruh-genbi';
            $absen->absensiable_type    =null;
            $absen->absensiable_id      =null;
            $absen->pengurangan         ='2';
            $absen->id_sb               =Segmentbulanan::idTerkini();
            $absen->save();
            $this->isiAnggota($absen);
        }
    }

    protected function isiAnggota(Absensi $abs)
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
                $ke->save();
            }
        }
        return $abs->save();
    }
}
