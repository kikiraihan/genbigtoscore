<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign created permissions
        Role::create(['name' => 'Ketua']);
        Role::create(['name' => 'Sekretaris']);
        Role::create(['name' => 'Bendahara']);
        Role::create(['name' => 'Kepala Unit']);
        Role::create(['name' => 'Tim Penilai']);
        Role::create(['name' => 'Anggota']);
        Role::create(['name' => 'Demisioner']);
        Role::create(['name' => 'Pembina']);
        Role::create(['name' => 'Admin']);
        
        // $this->command->info('Berhasil Menambahkan Roles');
        // $user->assignRole('Mahasiswa');

    }
}
