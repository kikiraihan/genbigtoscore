<?php

namespace App\Http\Livewire\Master;

use App\Models\User;
use App\Traits\EditRole;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class ManajemenRole extends Component
{
    use WithPagination, EditRole;

    protected $listeners=[
        'terkonfirmasiEditRole'=>'fixEditRole',
    ];

    public function render()
    {
        $daftar = [
            "Admin",
            // "Anggota",
            "Benkom",
            "Benwil",
            "Demisioner",
            "Kekom",
            "Kepala Unit",
            "Korwil",
            "Pembina",
            "Sekom",
            "Sekwil",
            "Tim Penilai"
        ];

        $roles = Role::withCount('users')
            ->whereIn('name', $daftar)
            ->orderBy('users_count', 'desc')
            ->with('users.anggota.kepengurusan')  // Ganti 'anggota' dengan relasi yang sesuai jika diperlukan
            ->get();

        $roleUsers = [];
        // Urutkan pengguna berdasarkan peran
        foreach ($roles as $role) {
            $roleUsers[$role->name] = $role->users;
        }
        $roleUsers['User tanpa Role']=User::with('anggota')->whereDoesntHave('roles')->get();
        $roleUsers['User tanpa Anggota']=User::doesntHave('anggota')->get();

        return view('livewire.master.manajemen-role',[
            'roleUsers' => $roleUsers,
        ]);
    }
}
