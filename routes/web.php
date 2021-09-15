<?php

use App\Http\Livewire\AturBeasiswa;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Desktop\ManualAbsen;
use App\Http\Livewire\Desktop\ManualEvaluasibulanan;
use App\Http\Livewire\Desktop\ManualKehadiran;
use App\Http\Livewire\Desktop\ManualPiket;
use App\Http\Livewire\Desktop\ManualTambahan;
use App\Http\Livewire\Desktop\ManualTimkhu;
use App\Http\Livewire\Desktop\ManualTimkhuAnggota;
use App\Http\Livewire\DetailNilai;
use App\Http\Livewire\HasilPenilaian;
use App\Models\anggota;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/coba', function () 
{   
    // dd(Carbon::now()->locale('in'));

    $a=anggota::with(['kepengurusan','universitas'])->get();
    foreach ($a as $key => $in) {
        echo $in->unit->nama."<br>";
    }

    dd();

    // $idSegment=$id;

    // $ang=anggota::find($id);
    // return $ang->getNilaiAkhir(15);
});

// $ini=anggota::whereHas('beasiswas', function($q){
//     $q->where('id',12);
// })
// // ->where('id_universitas',2)
// ->orderBy('nama','asc')
// ->get();
// // $ini=anggota::all();
// dd($ini);
// foreach ($ini as $key => $value) {
//     echo $value->nama."<br>";
// }

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

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




Route::get('manual/absen', ManualAbsen::class)
    ->middleware(['auth'])->name('manual.absen');
Route::get('manual/absen/kehadiran/{id}', ManualKehadiran::class)
    ->middleware(['auth'])->name('manual.absen.kehadiran');
Route::get('manual/timkhu', ManualTimkhu::class)
    ->middleware(['auth'])->name('manual.timkhu');
Route::get('manual/timkhu/{id}/anggota', ManualTimkhuAnggota::class)
    ->middleware(['auth'])->name('manual.timkhu.anggota');
Route::get('manual/piket', ManualPiket::class)
    ->middleware(['auth'])->name('manual.piket');
Route::get('manual/tambahan', ManualTambahan::class)
    ->middleware(['auth'])->name('manual.tambahan');
Route::get('manual/evaluasi', ManualEvaluasibulanan::class)
    ->middleware(['auth'])->name('manual.evaluasi');


// Tim
Route::get('beasiswa/atur', AturBeasiswa::class)
    ->middleware(['auth'])->name('beasiswa');
Route::get('hasilnilai', HasilPenilaian::class)
    ->middleware(['auth'])->name('hasilnilai');


