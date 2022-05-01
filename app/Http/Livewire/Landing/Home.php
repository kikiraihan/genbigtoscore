<?php

namespace App\Http\Livewire\Landing;

use App\Models\Absensi;
use App\Models\anggota;
use App\Models\Beasiswa;
use App\Traits\HitungNilai;
use Carbon\Carbon;
use Livewire\Component;

class Home extends Component
{
    use HitungNilai;

    public $idBea,$sekarang,$nilaiAkhir=[];

    protected $listeners=[
        'terkonfirmasiInisiasiNilai'=>'InisiasiNilai',
    ];

    public function mount()
    {
        $this->idBea=Beasiswa::idTerakhir();
        $this->sekarang=Carbon::now();
    }

    public function InisiasiNilai()
    {
        $this->nilaiAkhir=$this->allNilai(
            Beasiswa::yangTerakhir(),
            anggota::hanyaYangAktif()->get()
        );

        $this->AktifTigaTeratas();
        $this->AktifTigaTerbawah();
    }

    public function getModel($id)
    {
        return anggota::find($id);
    }

    public function AktifTigaTeratas()
    {
        arsort($this->nilaiAkhir);
        $output = array_slice($this->nilaiAkhir, 0, 3,true);
        return $output;
    }

    public function AktifTigaTerbawah()
    {
        asort($this->nilaiAkhir);
        $output = array_slice($this->nilaiAkhir, 0, 3,true);
        return $output;
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
            'teratas'=>$this->AktifTigaTeratas(),
            'terbawah'=>$this->AktifTigaTerbawah(),
            'anggotaAktif'=>anggota::hanyaYangAktif()->count(),
            'anggotaPenerima'=>anggota::HanyaPenerimaBeasiswaIni($this->idBea)->count(),
            'anggotaNonAktif'=>anggota::hanyaYangDemisioner()->count(),
        ])
        ->layout('layouts.landing.app');
    }
}
