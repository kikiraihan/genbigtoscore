<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign created permissions
        $Ketua          =Role::create(['name' => 'Ketua']);
        $Sekretaris     =Role::create(['name' => 'Sekretaris']);
        $Bendahara      =Role::create(['name' => 'Bendahara']);
        $KepalaUnit     =Role::create(['name' => 'Kepala Unit']);
        // $ketupat        =Role::create(['name' => 'Kepala Tim']);//baru//tidak perlu
        $TimPenilai     =Role::create(['name' => 'Tim Penilai']);
        $Anggota        =Role::create(['name' => 'Anggota']);
        $Demisioner     =Role::create(['name' => 'Demisioner']);
        $Pembina        =Role::create(['name' => 'Pembina']);
        $Admin          =Role::create(['name' => 'Admin']);
        
        // $this->command->info('Berhasil Menambahkan Roles');
        // $user->assignRole('Mahasiswa');

        // $permission = Permission::create(['name' => 'absen']);
        // $permission->assignRole($TimPenilai);


    }
}
