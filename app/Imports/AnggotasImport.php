<?php

namespace App\Imports;

use App\Models\anggota;
use App\Models\Kepengurusan;
use App\Models\Unit;
use App\Models\Universitas;
use App\Models\User;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class AnggotasImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation
{
    use Importable, SkipsErrors;

    public $semuaIdUnit;
    public $semuaIdUniversitas;

    public function __construct()
    {
        $this->semuaIdUnit=Unit::semuaId();
        $this->semuaIdUniversitas=Universitas::semuaId();
    }

    // public function onRow(Row $row)
    // {
    //     $rowIndex = $row->getIndex();
    //     $row      = $row->toArray();

    //     $user=new User();
    //     $user->username  =$row['nim'];
    //     $user->email     =$row['email'];
    //     $user->password  ='password';
    //     $user->assignRole('Anggota');//jadi anggota diawal
    //     $user->save();

    //     $ang= new Anggota;
    //     $ang->id_user           =$user->id;
    //     $ang->nama              =$row['nama'];
    //     $ang->nim               =$row['nim'];
    //     $ang->id_universitas    =$row['id_universitas'];
    //     $ang->save();

    //     $kep =new Kepengurusan;
    //     $kep->id_Anggota        =$ang->id;
    //     $kep->id_unit           =$row['id_unit'];
    //     $kep->jabatan           ='Anggota';
    //     $kep->save();
    // }

    
    public function rules(): array
    {
        return [
            'nama' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'nim' => [
                'required',
                // 'string',
                'unique:anggotas,nim',
                'unique:users,username',
            ],
            'id_universitas' => [
                'required',
                Rule::in($this->semuaIdUniversitas),
            ],
            'id_unit' => [
                'required',
                Rule::in($this->semuaIdUnit),
            ],
        ];
    }

    public function model(array $row)
    {
        // nama
        // email
        // nim
        // id_universitas
        // id_unit


        $user=new User([
            'username'  =>trim($row['nim']),
            'email'     =>trim($row['email']),
            'password'  =>'password',
        ]);

        // $user->anggota()->create
        $ang=new Anggota([
            // 'id_user'         =>$user->id,
            'nama'            =>trim($row['nama']),
            'nim'             =>trim($row['nim']),
            'id_universitas'  =>trim($row['id_universitas']),
        ]);

        
        $kep=new Kepengurusan([
            // 'id_Anggota'      =>$ang->id,
            'id_unit'         =>trim($row['id_unit']),
            // 'jabatan'         =>'Anggota',
        ]);

        $user->save();
        $user->assignRole('Anggota');//jadi anggota diawal
        $user->anggota()->save($ang);
        $user->anggota->kepengurusan()->save($kep);

        return $user;
    }

    // public function onError(Throwable $e)
    // {
    //     // Handle the exception how you'd like.
    //     // $failures = $e->failures();
    //     // foreach ($failures as $failure) {
    //     //     $failure->row(); // row that went wrong
    //     //     $failure->attribute(); // either heading key (if using heading row concern) or column index
    //     //     $failure->errors(); // Actual error messages from Laravel validator
    //     //     $failure->values(); // The values of the row that has failed.
    //     // }
    // }
}
