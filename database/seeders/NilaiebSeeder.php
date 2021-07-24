<?php

namespace Database\Seeders;

use App\Models\anggota;
use App\Models\Nilaieb;
use App\Models\Segmentbulanan;
use Illuminate\Database\Seeder;

class NilaiebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // jadi setiap mbbuat segment baru harus dibuat juga EB nya
        // nilai ebs untuk tiap bulan
        $ang=anggota::query()->HanyaYangAktif()->get();
        foreach(Segmentbulanan::all() as $item)
        {
            foreach ($ang as $a) 
            {
                $n= new Nilaieb;
                $n->id_sb=$item->id;
                $n->id_anggota=$a->id;
                //nilai, default 0
                $n->save();
            }
        }
    }
}
