<?php

namespace App\Filament\Pages;

use App\Models\anggota;
use App\Traits\Demisionerkan;
use Filament\Pages\Page;

class ImportPengurusBaru extends Page
{
    public static $icon = 'heroicon-o-document-add';
    public static $navigationLabel = 'Pengurus Baru - Import';
    public static $navigationSort = 1.5;
    public static $title="Pengurus Baru - metode input banyak (bukan form)";

    public static $view = 'filament.pages.import-pengurus-baru';
    
    protected $listeners=[
        'terkonfirmasiKepengurusanBaru'=>'kepengurusanBaru',
    ];

    use Demisionerkan;

    public function kepengurusanBaru($nimAktif)
    {
        $nimAktif=explode(PHP_EOL,$nimAktif);
        
        //cek jika ada error, tidak akan dilanjut
        $galat=$this->cekError($nimAktif);
        if(count($galat))
            return $this->emit(
                'swalErrorMulaiKepengurusan',
                view('swalForm.tampilError', ['galat'=>$galat])->render()
            );

        //demisionerkan semua dulu
        foreach (
            anggota::with(['kepengurusan'])
            ->hanyaYangAktif()->get() as $key => $ang
            ) 
        {
            $this->dems($ang,TRUE);
        }

        //aktifkan lagi aktifModel
        //harus disini karena dibagian demisioner harus duluan, kalau mo taruh diatas demis dpe deklarasi, dia mo anggap sebelum demisioner dpe deklarasi
        $aktifModel=anggota::with(['kepengurusan'])
        ->whereIn('nim',$nimAktif)->get();
        foreach (
            $aktifModel as $key => $ang
            )
        {
            $ang->kepengurusan->tanggal_demisioner=NULL;
            $ang->kepengurusan->save();
        }
        // dd($aktifModel);

        return $this->emit('swalUpdated');
    }


    public function cekError($dariInput)
    {
        sort($dariInput);
        $galat=[];
        $imodel=0;
        $iinput=0;
        $arrayModel=anggota::whereIn('nim',$dariInput)->select('nim')->orderBy('nim','asc')->get()->toArray();
        $arrayModelExtract=[];
        foreach ($arrayModel as $a) $arrayModelExtract[]=$a['nim'];
        sort($arrayModelExtract);

        // dd($arrayModelExtract,$dariInput);
        while ($imodel < count($arrayModelExtract)) 
        {
            if($dariInput[$iinput]==$arrayModelExtract[$imodel])
            {
                $imodel++;
                $iinput++;
            }
            else
            {
                // dd($iinput);
                $galat[]=$dariInput[$iinput];
                $iinput++;
            }
        }
        // dd($galat);
        //sisanya yang tidak ditemukan, maka semua galat. ini biasanya karena yang didapat dari db kurang.
        while($iinput < count($dariInput))
        {
            $galat[]=$dariInput[$iinput];
            $iinput++;
        }
        // dd($galat);
        return $galat;
    }
}
