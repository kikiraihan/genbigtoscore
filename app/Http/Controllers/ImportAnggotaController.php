<?php

namespace App\Http\Controllers;

use App\Imports\AnggotasImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDO;

class ImportAnggotaController extends Controller
{
    public function tes(){
        dd(Auth::guard('filament')->check());
        dd(Auth::user());
        dd('jadi');
    }
    
    public function store(Request $request)
    {
        $file =$request->file('anggotabaru');

        $import=new AnggotasImport;
        $collection=$import->import($file);// null, \Maatwebsite\Excel\Excel::XLSX
        
        // return redirect()->route('form.tambahanggota.store')->with('info','berhasil mengimport..');
        return redirect(url('/admin/anggota-tambah'))->with('info','berhasil mengimport..');
    }
}
