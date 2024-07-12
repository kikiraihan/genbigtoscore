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
        'terkonfirmasiDemisioner'=>'_demisionerkan',
        'terkonfirmasiPindahUnit'=>'_fixPindahUnit',
        'terkonfirmasiResetPasswordAnggota'=>'resetPassword',
        'terkonfirmasiEditRole'=>'_fixEditRole',
        // 'terkonfirmasiKepengurusanBaru'=>'kepengurusanBaru',
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
            'isiTabel'=>$ang->paginate(10),
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
    public function _demisionerkan($id){
        $this->demisionerkan($id);
    }
    
    
    /*------------------------------
    ...... info : FUNGSI PINDAH UNIT PAKE TRAIT PindahUnit
    ------------------------------*/ 
    public function _fixPindahUnit($idUnit,$idAnggota){
        $this->fixPindahUnit($idUnit,$idAnggota);
    }

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
    public function _fixEditRole($satu,$dua,$idAnggota){
        $this->fixEditRole($satu,$dua,$idAnggota);
    }

    public function export() 
    {
        $waktu=Carbon::now();
        return Excel::download(new AnggotaExport($this->statusAktif), 'anggota_export_'.$waktu->format('Y_M_d').'.xlsx');
    }
}
