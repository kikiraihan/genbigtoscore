<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class timpenilai extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ini=[4,];
        foreach ($ini as $id) {
            $user=User::find($id);
            $user->assignRole('Tim Penilai');
        }

        $user=User::find(1);
        $user->assignRole('Admin');

    }
}
