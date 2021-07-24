<?php

namespace App\Http\Livewire;

use App\Models\Jurusan;
use App\Models\Universitas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class PengaturanAkun extends Component
{
    use WithFileUploads;

    public
    $nama,
    $nim,
    $id_jurusan,
    $id_universitas,
    $tahunmasukkuliah,
    $jenis_kelamin,
    $agama,
    $golongan_darah,
    $tgl_lahir,
    $domisili,
    $asal,
    $no_wa,
    // $awalmasukgenbi,

    $idUser,
    $avatar,
    $avatarNoRaw,

    $email,
    $username,
    $passwordLama,
    $passwordBaru;

    public $isAdmin;

    protected $CustomMessages = [
        'string' => 'Kolom :attribute, harus berupa teks',
        'required'=>'Kolom :attribute tidak boleh kosong',
        'unique'=>'Data kolom :attribute sudah ada sebelumnya',
    ];

    public function mount()
    {
        $user=User::find(Auth::user()->id);
        
        if(!$user->hasRole('Admin'))
        {
            
            $anggota=$user->anggota;
            $this->nama             =$anggota->nama;
            $this->nim              =$anggota->nim;
            $this->id_jurusan       =$anggota->id_jurusan;
            $this->id_universitas   =$anggota->id_universitas;
            $this->tahunmasukkuliah =$anggota->tahunmasukkuliah;
            $this->jenis_kelamin    =$anggota->jenis_kelamin;
            $this->agama            =$anggota->agama;
            $this->golongan_darah   =$anggota->golongan_darah;
            $this->tgl_lahir        =$anggota->tgl_lahir==NULL?null : $anggota->tgl_lahir->format('Y-m-d');
            $this->domisili         =$anggota->domisili;
            $this->asal             =$anggota->asal;
            $this->no_wa            =$anggota->no_wa;
            // $this->awalmasukgenbi   =$anggota->awalmasukgenbi;
        }
        
        $this->idUser=$user->id;
        // $this->avatar=$user->getRawOriginal('avatar');
        $this->avatarNoRaw=$user->avatar;
        $this->email=$user->email;
        $this->username=$user->username;
        $this->password=null;

        $this->isAdmin=$user->hasRole('Admin');
    }

    public function render()
    {
        $selectJurusan=Jurusan::all();
        $selectUniversitas=Universitas::all();

        return view('livewire.pengaturan-akun',
        compact(['selectJurusan','selectUniversitas']))
        // ->layout('layouts.app')
        ;
    }

    public function update()
    {

        $userToUpdate=User::find($this->idUser);

        $this->validate([
            'avatar' => 'image|nullable', // |max:1024, 1MB Max
            'nama'              => "required|string",
            'nim'               => "required|string",
            'id_jurusan'        => "required|integer",
            'id_universitas'    => "required|integer",
            'tahunmasukkuliah'  => "required|date_format:Y",
            'jenis_kelamin'     => "required|in:Laki-Laki,Perempuan",
            'agama'             => "required|in:Islam,Kristen,Katolik,Konghuchu,Hindu,Budha,Lainnya",
            'golongan_darah'    => "required|in:O,A,A+,B,B+,AB",
            'tgl_lahir'         => "required|date",
            'domisili'          => "required|string",
            'asal'              => "required|string",
            'no_wa'             => "required|string",
            // 'awalmasukgenbi'    => "required|date_format:Y",

            'email'             => "required|email|unique:App\Models\User,email,".$userToUpdate->id.",",
            'username'          => "required|string|unique:App\Models\User,username,".$userToUpdate->id.",",
        ], $this->CustomMessages);

        if($this->avatar)//jika tidak null
        {
            if($userToUpdate->getRawOriginal('avatar')) //jika tidak null
            Storage::disk('avatars')->delete($userToUpdate->getRawOriginal('avatar'));

            $avatar=$this->avatar->store($this->idUser, 'avatars');
            $userToUpdate->avatar = $avatar;
        }

        
        $userToUpdate->anggota->nama              =$this->nama;
        $userToUpdate->anggota->nim               =$this->nim;
        $userToUpdate->anggota->id_jurusan        =$this->id_jurusan;
        $userToUpdate->anggota->id_universitas    =$this->id_universitas;
        $userToUpdate->anggota->tahunmasukkuliah  =$this->tahunmasukkuliah;
        $userToUpdate->anggota->jenis_kelamin     =$this->jenis_kelamin;
        $userToUpdate->anggota->agama             =$this->agama;
        $userToUpdate->anggota->golongan_darah    =$this->golongan_darah;
        $userToUpdate->anggota->tgl_lahir         =$this->tgl_lahir;
        $userToUpdate->anggota->domisili          =$this->domisili;
        $userToUpdate->anggota->asal              =$this->asal;
        $userToUpdate->anggota->no_wa             =$this->no_wa;
        // $userToUpdate->anggota->awalmasukgenbi    =$this->awalmasukgenbi;
        $userToUpdate->anggota->save();
        
        $userToUpdate->username=$this->username;
        $userToUpdate->email=$this->email;
        // $userToUpdate->password=$this->password;
        $userToUpdate->save();

        $this->emit('swalUpdated');
    }


    public function updateAdmin()
    {
        $userToUpdate=User::find($this->idUser);

        $this->validate([
            'avatar' => 'image|nullable', // |max:1024, 1MB Max
            // 'nama' => "required|string",
            // 'nim' => "required|string",
            // 'no_wa' => "required|string",
            // 'username' => "required|string",
            // 'email' => "required|string",
        ]);        

        if($this->avatar)//jika tidak null
        {
            if($userToUpdate->getRawOriginal('avatar')) //jika tidak null
            Storage::disk('avatars')->delete($userToUpdate->getRawOriginal('avatar'));

            $avatar=$this->avatar->store($this->idUser, 'avatars');
            $userToUpdate->avatar = $avatar;
        }
        
        $userToUpdate->username=$this->username;
        $userToUpdate->email=$this->email;
        // $userToUpdate->password=$this->password;
        $userToUpdate->save();

        $this->emit('swalUpdated');
    }




    public function gantiPassword()
    {
        $userToUpdate=User::find($this->idUser);

        //validasi tambahan
        Validator::extend('checkHashedPass', function($attribute, $value, $parameters) use($userToUpdate)
        {
            if( ! Hash::check( $value , $userToUpdate->password ) )
            {
                return false;
            }
            return true;
        });


        //validasi
        $CustomMessages = [
            'string' => 'Kolom :attribute, harus berupa angka',
            'min' => 'Kolom :attribute, harus min 8 huruf',
            'check_hashed_pass' => 'Password lama salah!',
        ];

        $this->validate( [
            'passwordLama'             =>"required|string|min:8|checkHashedPass:" . $this->passwordLama,
            'passwordBaru'              =>"required|string|min:8",
        ],$CustomMessages);


        $userToUpdate->password =  $this->passwordBaru;
        $userToUpdate->save();

        $this->emit('swalUpdated');

    }
}
