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
        'terkonfirmasiKepengurusanBaru'=>'kepengurusanBaru',
    ];

    public function kepengurusanBaru()
    {
        $form=FormPengurusBaru::with('anggota.kepengurusan')->get();

        $this->demisPengurusLama();
        // $this->emit('swalMessage','info','Berhasi, Pengurus baru telah diaktifkan!');

        //aktifkan lagi
        foreach ($form as $key => $value) {
            $value->anggota->kepengurusan->tanggal_demisioner = NULL;
            $value->anggota->kepengurusan->id_unit = $value->id_unit;
            $value->anggota->kepengurusan->save();
        }
        return $this->emit('swalMessage','success','Berhasi, Pengurus baru telah diaktifkan!');
        // return true;
    }

    public function demisPengurusLama(){
        //demisionerkan semua pengurus lama dulu
        foreach (
            anggota::with(['kepengurusan'])
            ->hanyaYangAktif()->get() as $key => $ang
            ) 
        {
            $this->dems($ang,TRUE);
        }
    }
}
