<?php

namespace App\Http\Livewire\Landing\About;

use App\Models\User;
use Livewire\Component;

class Timeline extends Component
{
    public function render()
    {
        $user=User::whereIn('id',[
            1,
            37,
            147,
            208,
            5,
            114,
            149,
            219,
        ])->get();
        $key=[
            'kiki',
            'naswa',
            'tasya',
            'roly',
            'komang',
            'aco',
            'minarti',
            'apik',
        ];
        $foto = array_combine($key, $user->pluck('avatar')->toArray());

        return view('livewire.landing.about.timeline',[
            'foto'=>$foto
        ])
        ->layout('layouts.landing.app');;
    }
}
