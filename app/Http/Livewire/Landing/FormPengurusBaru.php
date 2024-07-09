<?php

namespace App\Http\Livewire\Landing;

use App\Models\FormPengurusBaru as ModelsFormPengurusBaru;
use Livewire\Component;

class FormPengurusBaru extends Component
{
    public function render()
    {
        $ini=ModelsFormPengurusBaru::with('user.anggota')->get();

        return view('livewire.landing.form-pengurus-baru',[
            "isiTabel"=>$ini,
        ]);
    }
}
