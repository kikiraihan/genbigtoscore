<?php

namespace App\Http\Livewire\Form;

use App\Imports\AnggotasImport;
use App\Models\Unit;
use App\Models\Universitas;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class DesktopTambahanggota extends Component
{
    use WithFileUploads;
 
    public $anggotabaru;

    public function render()
    {
        return view('livewire.form.desktop-tambahanggota',
        [
            'univ'=>Universitas::all(),
            'unit'=>Unit::with('badan')->get()->groupBy('id_badan'),
        ]);
    }






    // // error
    // public function import()
    // {
    //     // $collection = Excel::toCollection(new AnggotasImport, );
    //     $path=$this->anggotabaru->temporaryUrl();
    //     // dd($path);
    //     // $collection=(new AnggotasImport)->toArray($path, null, \Maatwebsite\Excel\Excel::XLSX);
    //     $collection = Excel::toCollection(new AnggotasImport, $path, null,\Maatwebsite\Excel\Excel::XLSX);
    //     dd($collection);
    // }
}
