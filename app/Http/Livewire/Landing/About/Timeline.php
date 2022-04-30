<?php

namespace App\Http\Livewire\Landing\About;

use Livewire\Component;

class Timeline extends Component
{
    public function render()
    {
        return view('livewire.landing.about.timeline')
        ->layout('layouts.landing.app');;
    }
}
