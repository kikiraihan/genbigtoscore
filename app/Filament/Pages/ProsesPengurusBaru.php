<?php

namespace App\Filament\Pages;

use App\Models\anggota;
use App\Models\FormPengurusBaru;
use App\Traits\Demisionerkan;
use Filament\Pages\Page;

class ProsesPengurusBaru extends Page
{
    use Demisionerkan;

    public static $icon = 'heroicon-o-document-text'; #'heroicon-o-document-download';
    public static $navigationLabel = 'Pengurus Baru - Form Run';
    public static $navigationSort = 0;
    public static $title="Run Form Calon Pengurus Baru";

    public static $view = 'filament.pages.proses-pengurus-baru';

    protected $listeners=[
        'terkonfirmasiFormKepengurusanBaru'=>'kepengurusanBaruForm',
    ];

    public function kepengurusanBaruForm()
    {
        // demis pengurus lama
        $this->demisPengurusLama();


        //aktifkan calon pengurus
        // Klo disini wajib pemanggilan setelah di demis. soalnya mengikut session database. dua kali pemanggilan
        $calon = anggota::with(['kepengurusan','formPengurusBaru'])->whereHas('formPengurusBaru')->get();
        foreach ($calon as $key => $value) {
            $value->kepengurusan->tanggal_demisioner = NULL;
            $value->kepengurusan->id_unit = $value->formPengurusBaru->id_unit;
            $value->kepengurusan->save();
        }

        return $this->emit('swalMessage','success','Berhasi, Pengurus baru telah diaktifkan!');
    }

    public function demisPengurusLama(){
        $aktiflama=anggota::with(['kepengurusan'])
            ->hanyaYangAktif()->get();
        foreach ($aktiflama as $key => $ang) 
        {
            $this->dems($ang,TRUE);
        }
    }
}
