<?php

use App\Http\Controllers\ImportAnggotaController;
use App\Http\Controllers\ImportPiketController;
use App\Http\Livewire\AturBeasiswa;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Desktop\DesktopAnggota;
use App\Http\Livewire\Desktop\ManualAbsen;
use App\Http\Livewire\Desktop\ManualEvaluasibulanan;
use App\Http\Livewire\Desktop\ManualKehadiran;
use App\Http\Livewire\Desktop\ManualPiket;
use App\Http\Livewire\Desktop\ManualTambahan;
use App\Http\Livewire\Desktop\ManualTimkhu;
use App\Http\Livewire\Desktop\ManualTimkhuAnggota;
use App\Http\Livewire\DetailNilai;
use App\Http\Livewire\Form\DesktopTambahanggota;
use App\Http\Livewire\Form\EditAnggotaUnit;
use App\Http\Livewire\HasilPenilaian;
use App\Http\Livewire\Landing\About\Intro;
use App\Http\Livewire\Landing\About\Timeline;
use App\Http\Livewire\Landing\Home;
use App\Http\Livewire\Landing\Schedule;
use App\Http\Livewire\Master\StrukturBadan;
use App\Http\Livewire\Master\StrukturUnit;
use App\Http\Livewire\Mobfirst\AbsenAll;
use App\Http\Livewire\Mobfirst\KaunitAbsen;
use App\Http\Livewire\Mobfirst\KaunitKehadiran;
use App\Http\Livewire\Mobfirst\KepalaEvaluasibulanan;
use App\Models\anggota;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => ''], function ($landing) {
    $landing->get('/', Home::class)->name('landing.home');
    $landing->get('/schedule', Schedule::class)->name('landing.schedule');
    $landing->get('/intro', Intro::class)->name('landing.intro');
    $landing->get('/timeline', Timeline::class)->name('landing.timeline');
});



/*
|--------------------------------------------------------------------------
| COBA
|--------------------------------------------------------------------------
*/
Route::get('/coba', function () 
{   
    // dd(Carbon::now()->locale('in'));

    $a=anggota::with(['kepengurusan','universitas','user'])->hanyaYangAktif()->get();
    foreach ($a as $key => $in) {
        echo $in->nama." | ".$in->user->username."<br>";
    }
    // $idSegment=$id;
    // $ang=anggota::find($id);
    // return $ang->getNilaiAkhir(15);
});

Route::get('/pasmulai',function(){
    $a=anggota::with(['kepengurusan','universitas','user'])->hanyaYangAktif()->orderBy('nama')->get();
    foreach ($a as $key => $in) {
        echo "<b>".$in->nama."</b> | Username : ".$in->user->username."<br>";
    }
});



/*
|--------------------------------------------------------------------------
| AFTER LOGIN
|--------------------------------------------------------------------------
*/
// dashboard
Route::get('/dashboard', Dashboard::class)
->middleware(['auth'])->name('dashboard');
Route::get('/detail-nilai/{id}/{kembali}', DetailNilai::class)
->middleware(['auth'])->name('detailnilai');

// Route::get('/setting', PengaturanAkun::class)
// ->middleware(['auth'])->name('setting');
Route::get('/setting', function () {
    return view('pengaturanAkun');
})->middleware(['auth'])->name('setting');

require __DIR__.'/auth.php';





/*------------------------------------------------------------------------
DESKTOP
------------------------------------------------------------------------*/

//PENILAIAN MANUAL
Route::group(['prefix' => 'manual'], function ($manual) {
    $manual->get('absen', ManualAbsen::class)->middleware(['auth','role:Tim Penilai|Korwil'])->name('manual.absen');
    $manual->get('absen/kehadiran/{id}', ManualKehadiran::class)->middleware(['auth','role:Tim Penilai|Korwil'])->name('manual.absen.kehadiran');
    $manual->get('timkhu', ManualTimkhu::class)->middleware(['auth','role:Tim Penilai|Korwil'])->name('manual.timkhu');
    $manual->get('timkhu/{id}/anggota', ManualTimkhuAnggota::class)->middleware(['auth','role:Tim Penilai|Korwil'])->name('manual.timkhu.anggota');
    $manual->get('piket', ManualPiket::class)->middleware(['auth','role:Tim Penilai|Korwil'])->name('manual.piket');
    $manual->post('piket/store', [ImportPiketController::class,'store'])->middleware(['auth','role:Tim Penilai|Korwil'])->name('manual.piket.store');
    $manual->get('tambahan', ManualTambahan::class)->middleware(['auth','role:Tim Penilai|Korwil'])->name('manual.tambahan');
    $manual->get('evaluasi', ManualEvaluasibulanan::class)->middleware(['auth','role:Tim Penilai|Korwil'])->name('manual.evaluasi');
});

//ANGGOTA
Route::group(['middleware' => ['auth','role:Admin|Korwil']], function ($anggota) {
    $anggota->get('desktop/anggota', DesktopAnggota::class)->name('desktop.anggota');
    $anggota->get('desktop/tambahanggota', DesktopTambahanggota::class)->name('form.tambahanggota');
    $anggota->post('desktop/tambahanggota', [ImportAnggotaController::class,'store'])->name('form.tambahanggota.store');
});

//MASTER STRUKTUR
Route::get('desktop/master/struktur/badan', StrukturBadan::class)
    ->middleware(['auth','role:Admin|Korwil'])->name('master.badan');
Route::get('desktop/master/struktur/unit', StrukturUnit::class)
    ->middleware(['auth','role:Admin|Korwil|Kekom'])->name('master.unit');
Route::get('desktop/master/struktur/unit/{id}/edit-anggota', EditAnggotaUnit::class)
    ->middleware(['auth','role:Admin|Korwil|Kekom'])->name('master.unit.edit-anggota');


// Tim
Route::get('beasiswa/atur', AturBeasiswa::class)
    ->middleware(['auth','role:Admin'])->name('beasiswa');
Route::get('hasilnilai', HasilPenilaian::class)
    ->middleware(['auth','role:Admin|Korwil'])->name('hasilnilai');






/*------------------------------------------------------------------------
MOBILE FIRST
------------------------------------------------------------------------*/
//PENILAIAAN EVALUASI BULANAN

Route::get('/evaluasi', KepalaEvaluasibulanan::class)
    ->middleware(['auth','role:Korwil|Kekom|Kepala Unit'])->name('kepala.evaluasi');
Route::get('/absen/kaunit', KaunitAbsen::class)
    ->middleware(['auth','role:Kepala Unit'])->name('kaunit.absen');
Route::get('absen/kaunit/kehadiran/{id}', KaunitKehadiran::class)
    ->middleware(['auth','role:Kepala Unit'])->name('kaunit.absen.kehadiran');
Route::get('absen/all', AbsenAll::class)
    ->middleware(['auth'])->name('absen.all');




