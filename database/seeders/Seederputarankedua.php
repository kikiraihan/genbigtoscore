<?php

namespace Database\Seeders;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Segmentbulanan;
use App\Models\User;
use Illuminate\Database\Seeder;

class Seederputarankedua extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TIM PENILAI
        // 147 Tasya amanda, 7 Ella, 6 nineng,
        $ini=[147,7,6];
        foreach ($ini as $id) {
            $user=User::find($id);
            $user->assignRole('Tim Penilai');
        }

        // JADIKAN ADMIN Kiki
        $user=User::find(1);
        $user->assignRole('Admin');

        // isi tahun pada tiap segment pada beasiswa 2021/1
        $seg=Segmentbulanan::where('id_beasiswa',15)->get();
        foreach ($seg as $key => $value) {
            $value->segtahun=2021;
            $value->save();
        }

        $ganti=anggota::where('nama','Lutfiah Husain')->first();
        $ganti->nama='Lutfiah Husain';
        $ganti->save();

        // php artisan db:seed --class=Seederputarankedua
    }
}
