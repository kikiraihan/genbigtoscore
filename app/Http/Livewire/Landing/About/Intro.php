<?php

namespace App\Http\Livewire\Landing\About;

use Livewire\Component;

class Intro extends Component
{
    public function render()
    {
        return view('livewire.landing.about.intro')
        ->layout('layouts.landing.app');
    }
}
