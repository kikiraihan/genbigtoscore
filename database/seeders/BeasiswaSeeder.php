<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beasiswa;

class BeasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2014';
        $bea->semester='1';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2014';
        $bea->semester='2';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2015';
        $bea->semester='1';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2015';
        $bea->semester='2';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2016';
        $bea->semester='1';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2016';
        $bea->semester='2';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2017';
        $bea->semester='1';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2017';
        $bea->semester='2';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2018';
        $bea->semester='1';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2018';
        $bea->semester='2';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2019';
        $bea->semester='1';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2019';
        $bea->semester='2';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2020';
        $bea->semester='1';
        $bea->save();
        
        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2020';
        $bea->semester='2';
        $bea->save();

        $bea=new Beasiswa;
        $bea->tanggal;
        $bea->tahun='2021';
        $bea->semester='1';
        $bea->save();
    }
}
