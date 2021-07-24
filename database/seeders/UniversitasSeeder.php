<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Universitas;

class UniversitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uni = new Universitas;
        $uni->nama="Universitas Negeri Gorontalo";
        $uni->singkatan="UNG";
        $uni->save();

        $uni = new Universitas;
        $uni->nama="Institut Agama Islam Negeri Sultan Amai Gorontalo";
        $uni->singkatan="IAIN SAG";
        $uni->save();

        $uni = new Universitas;
        $uni->nama="Universitas Gorontalo";
        $uni->singkatan="UG";
        $uni->save();
    }
}
