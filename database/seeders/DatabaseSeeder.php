<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UniversitasSeeder::class);
        $this->call(BadanSeeder::class);
        $this->call(JurusanSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(BeasiswaSeeder::class);
        $this->call(SegmentbulananSeeder::class);
        $this->call(AnggotaSeeder::class);
        // $this->call(TimkhuSeeder::class);
        // $this->call(NilaiebSeeder::class);
        // $this->call(AbsensiSeeder::class);
    }
}
