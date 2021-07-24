<?php

namespace Database\Seeders;

use App\Models\Badan;
use Illuminate\Database\Seeder;

class BadanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peng = new Badan;
        $peng->nama="Wilayah"; 
        $peng->save();
        $peng = new Badan;
        $peng->nama="Komisariat UNG";
        $peng->save();
        $peng = new Badan;
        $peng->nama="Komisariat IAIN";
        $peng->save();
        $peng = new Badan;
        $peng->nama="Komisariat UG";
        $peng->save();
    }
}
