<?php

namespace App\Http\Controllers;

use App\Imports\AnggotasImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportAnggotaController extends Controller
{
    public function store(Request $request)
    {
        $file =$request->file('anggotabaru');

        $import=new AnggotasImport;
        $collection=$import->import($file);// null, \Maatwebsite\Excel\Excel::XLSX
        
        return redirect()->route('form.tambahanggota.store')->with('info','berhasil mengimport..');
    }
}
