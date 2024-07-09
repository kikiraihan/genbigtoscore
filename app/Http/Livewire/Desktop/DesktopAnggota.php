<?php

namespace App\Http\Livewire\Desktop;

use App\Exports\AnggotaExport;
use App\Models\anggota;
use App\Models\Badan;
use App\Models\Beasiswa;
use App\Models\Unit;
use App\Models\User;
use App\Traits\Demisionerkan;
use App\Traits\EditRole;
use App\Traits\PindahUnit;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class DesktopAnggota extends Component
{
    use WithPagination,PindahUnit,Demisionerkan, EditRole;

    protected $listeners=[
        'terkonfirmasiDemisioner'=>'demisionerkan',
        'terkonfirmasiPindahUnit'=>'fixPindahUnit',
        'terkonfirmasiResetPasswordAnggota'=>'resetPassword',
        'terkonfirmasiEditRole'=>'fixEditRole',
        'terkonfirmasiKepengurusanBaru'=>'kepengurusanBaru',
    ];

    public 
    $idBeasiswaTerakhir,
    $angkatan,//$angkatan genbi
    $statusAktif=1;

    // untuk index
    public
    $search;

    public function mount()
    {
        $this->idBeasiswaTerakhir=Beasiswa::idTerakhir();
    }

    public function render()
    {
        $ang=anggota::
            with(['kepengurusan.unit','universitas','user']) #.badan
            ->where(function ($query) {
                $query->where('nama', 'like', '%'.$this->search.'%')
                    ->orWhere('nim', 'like', '%'.$this->search.'%');
            })
            ->orderBy('id_universitas')
            ->orderBy('nama')
            ;

        if ($this->statusAktif) 
            $ang->hanyaYangAktif();
        else
            $ang->hanyaYangDemisioner();
        //yang tidak punya kepengurusan tidak akan tampl

        // {{$userlogin->anggota->awalmasukgenbi}}

        return view('livewire.desktop.desktop-anggota',[
            'isiTabel'=>$ang->paginate(100),
            'jumlahWilayah'=>(clone $ang)->hanyaYangAktif()->HanyaPengurusIni(1)->count(),
            'jumlahung'=>(clone $ang)->hanyaYangAktif()->HanyaPengurusIni(2)->count(),
            'jumlahIAIN'=>(clone $ang)->hanyaYangAktif()->HanyaPengurusIni(3)->count(),
            'jumlahUG'=>(clone $ang)->hanyaYangAktif()->HanyaPengurusIni(4)->count(),
        ]);
        //clone untuk mereplikasi atau menggandakan query. karena kalau tidak diclone, maka $ang akan termutasi dari scope sebelumnya.
    }

    /*------------------------------
    ...... info : FUNGSI Demisioner PAKE TRAIT demisionerkan
    ------------------------------*/ 
    
    /*------------------------------
    ...... info : FUNGSI PINDAH UNIT PAKE TRAIT PindahUnit
    ------------------------------*/ 


    public function resetPassword($id)
    {
        $p = User::whereHas('anggota', function ($q) use ($id){
            $q->where('id', $id);
        })->first();
        $p->password = 'password';
        $p->save();
    }

    /*------------------------------
    ...... info : FUNGSI EDIT ROLE PAKE TRAIT EditRole
    ------------------------------*/ 
    









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

    public function export() 
    {
        $waktu=Carbon::now();

        return Excel::download(new AnggotaExport($this->statusAktif), 'anggota_export_'.$waktu->format('Y_M_d').'.xlsx');
    }
}
