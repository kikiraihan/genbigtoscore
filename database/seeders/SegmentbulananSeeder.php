<?php

namespace Database\Seeders;


use App\Models\Segmentbulanan;
use Illuminate\Database\Seeder;

class SegmentbulananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // maret 
        $sb=new Segmentbulanan;
        $sb->id_beasiswa=15;
        $sb->bulan=3;
        $sb->save();
        
        // April
        $sb=new Segmentbulanan;
        $sb->id_beasiswa=15;
        $sb->bulan=4;
        $sb->save();

        // Mei
        $sb=new Segmentbulanan;
        $sb->id_beasiswa=15;
        $sb->bulan=5;
        $sb->save();
        
        // Juni
        $sb=new Segmentbulanan;
        $sb->id_beasiswa=15;
        $sb->bulan=6;
        $sb->save();
        
        // Juli
        $sb=new Segmentbulanan;
        $sb->id_beasiswa=15;
        $sb->bulan=7;
        $sb->save();
        
        // Agustus
        $sb=new Segmentbulanan;
        $sb->id_beasiswa=15;
        $sb->bulan=8;
        $sb->save();

        // jadi setiap mbbuat segment baru harus dibuat juga EB nya
        // nilai ebs untuk tiap bulan ada di seeder nilai EB
    }
}
