<?php

namespace Database\Seeders;

use App\Models\Konfigurasi;
use Illuminate\Database\Seeder;

class KonfigurasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // make konfigurasi for standar nilai
        $k= new Konfigurasi;
        $k->name="standar_lulus";
        $k->value=85;
        $k->keterangan="standar nilai lulus beasiswa lanjutan";
        $k->save();
    }
}
