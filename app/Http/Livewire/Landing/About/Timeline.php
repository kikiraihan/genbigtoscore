<?php

namespace App\Http\Livewire\Landing\About;

use App\Models\User;
use Livewire\Component;

class Timeline extends Component
{
    public function render()
    {
        $foto=[
            'kiki'=>User::find(1)->avatar,
            'naswa'=>User::find(37)->avatar,
            'tasya'=>User::find(147)->avatar,
            'roly'=>User::find(208)->avatar,
            'komang'=>User::find(5)->avatar,
            'aco'=>User::find(114)->avatar,
            'minarti'=>User::find(149)->avatar,
            'apik'=>User::find(219)->avatar,
        ];

        return view('livewire.landing.about.timeline',[
            'foto'=>$foto
        ])
        ->layout('layouts.landing.app');;
    }
}
