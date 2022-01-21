<?php

namespace App\Http\Controllers;

use App\Imports\PiketImport;
use Illuminate\Http\Request;

class ImportPiketController extends Controller
{
    public function store(Request $request)
    {
        $file =$request->file('filepiket');

        $import=new PiketImport($request->id_sb,$request->bobot);
        $collection=$import->import($file);// null, \Maatwebsite\Excel\Excel::XLSX
        
        return redirect()->route('manual.piket')->with('info','berhasil mengimport..');
    }
}