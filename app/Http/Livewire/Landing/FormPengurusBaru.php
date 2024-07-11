<?php

namespace App\Http\Livewire\Landing;

use App\Models\anggota;
use App\Models\FormPengurusBaru as ModelsFormPengurusBaru;
use App\Models\Unit;
use App\Models\User;
use Livewire\Component;

class FormPengurusBaru extends Component
{
    public $username, $id_unit;

    public $selectUnit;

    public function mount()
    {
        $this->selectUnit = Unit::all();
    }

    public function render()
    {
        $ini=ModelsFormPengurusBaru::with(['anggota','unit']);

        return view('livewire.landing.form-pengurus-baru',[
            "isiTabel"=>$ini->paginate(10),
        ])->layout('layouts.public-form.app');
    }

    public function addForm()
    {
        $this->validate([
            'username' =>'required',
            'id_unit' =>'required',
        ]);
        
        $user=User::with('anggota')->where('username', $this->username)->first();
        if(!$user){
            return $this->emit(
                'swalMessageError','user tidak ditemukan'
            );
        }
        $existForm=ModelsFormPengurusBaru::where('id_anggota', $user->anggota->id)->first();
        if($existForm){
            return $this->emit(
                'swalMessageError','user sudah terdaftar'
            );
        }


        ModelsFormPengurusBaru::create([
            'id_anggota' => $user->anggota->id,
            'id_unit' => $this->id_unit,
        ]);
    }
}
