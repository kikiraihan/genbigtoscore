<?php

namespace App\Http\Livewire\Landing;

use Livewire\Component;

class Home extends Component
{


    public function getQuote()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://api.kanye.rest/');
        $xml = $response->getBody()->getContents();
        return json_decode($xml)->quote;
    }

    public function render()
    {
        return view('livewire.landing.home',[
            // 'quote'=>$this->getQuote(),
        ])
        ->layout('layouts.landing.app');
    }
}
