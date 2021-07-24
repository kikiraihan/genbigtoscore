<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\Segmentbulanan;
use App\Models\Timkhu;
use Illuminate\Database\Seeder;

class TimkhuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keg=new Kegiatan;
        $keg->nama='Capacity Building 2021';
        $keg->keterangan='baru ini adalah keterangannya';
        $keg->tanggal_pelaksanaan='juni guys';
        $keg->save();
        $tim=new Timkhu;
        $tim->nama          ='Panitia CB';
        $tim->id_kegiatan   =$keg->id;
        $tim->id_kepala     =4;
        $tim->id_sb         =Segmentbulanan::idTerkini();
        $tim->bobot         =20;
        $tim->jenis         ='panitia-besar';
        $tim->save();

        $keg=new Kegiatan;
        $keg->nama='TOT SIAPIK';
        $keg->keterangan='agak lama sih ini, dan ini adalah keterangannya';
        $keg->tanggal_pelaksanaan='yang lalu guys';
        $keg->save();
        $tim=new Timkhu;
        $tim->nama          ='Tim SIAPIK';
        $tim->id_kegiatan   =$keg->id;
        $tim->id_kepala     =12;
        $tim->id_sb         =Segmentbulanan::idTerkini();
        $tim->bobot         =10;
        $tim->jenis         ='panitia-kecil';
        $tim->save();
    }
}
