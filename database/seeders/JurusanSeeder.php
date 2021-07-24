<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach (
        [
            'D3-Pertanian/Agribisnis/Kehutanan',
            'D3-Peternakan',
            'D3-Pariwisata/Perhotelan/Tata Boga/Bisnis Biro Perjalanan',
            'D3-Kelautan',
            'D3-Perikanan/Kemaritiman',
            'D3-Ekonomi Kreatif',
            'D3-Akuntansi/Ekonomi Bisnis/Administrasi Bisnis',
            'D3-Keperawatan',

            'S1-Ilmu Ekonomi/Ekonomi Pembangunan',
            'S1-Manajemen/Pendidikan Ekonomi Manajemen',
            'S1-Akuntansi/Pendidikan Akuntansi',
            'S1-Perbankan/Keuangan Syariah',
            'S1-Ekonomi Islam/Ekonomi Syariah',
            'S1-Matematika/Pendidikan Matematika',
            'S1-Statistika',
            'S1-Pertanian/Peternakan/Agribisnis/Hortikultura',
            'S1-Perikanan',
            'S1-Sosial Ekonomi Pertanian/Sosial Ekonomi Perikanan',
            'S1-Administrasi Publik',
            'S1-Ilmu Hukum/Hukum Ekonomi Syariah',
            'S1-Ilmu Pemerintahan',
            'S1-Ilmu Sosial/Ilmu Politik',
            'S1-Komunikasi/Ilmu Komunikasi',
            'S1-Pendidikan Teknologi Informasi',
            'S1-Sistem Informasi',
            'S1-Ilmu Komputer/Informatika',
            'S1-Kesehatan Masyarakat',
            'S1-Keperawatan',
            'S1-Kedokteran',
        ]
        as $value) {
            $jur = new Jurusan;
            $jur->nama = $value;
            
            if(explode("-",$value)[0]=="S1") $jur->strata ="S1";
            elseif(explode("-",$value)[0]=="D3") $jur->strata ="D3";
            elseif(explode("-",$value)[0]=="D4") $jur->strata ="D4";
            else $jur->strata=null; 

            $jur->save();
        }
        
    }
}
