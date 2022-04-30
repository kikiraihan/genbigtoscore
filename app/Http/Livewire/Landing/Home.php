<?php

namespace App\Http\Livewire\Landing;

use App\Models\Absensi;
use App\Models\Beasiswa;
use Carbon\Carbon;
use Livewire\Component;

class Home extends Component
{
    public $idBea,$sekarang;

    public function mount()
    {
        $this->idBea=Beasiswa::idTerakhir();
        $this->sekarang=Carbon::now();
    }

    public function getQuote()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://api.kanye.rest/');
        $xml = $response->getBody()->getContents();
        return json_decode($xml)->quote;
    }

    public function render()
    {
        $absen=Absensi::with(['absensiable','kehadiran'])
                ->YangPunyaSegmentPadaBeasiswaIni($this->idBea)
                // ->where('title', 'like', '%'.$this->search.'%')
                ->orderBy('id_sb','desc')
                ->orderBy('date','desc')
                ;

        return view('livewire.landing.home',[
            'quote'=>$this->getQuote(),
            'absensi'=>$absen->take(6)->get(),
        ])
        ->layout('layouts.landing.app');
    }
}
