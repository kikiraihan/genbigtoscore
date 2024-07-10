<?php

namespace App\Filament\Resources\FormPengurusBaruResource\Pages;

use App\Filament\Resources\FormPengurusBaruResource;
use Filament\Resources\Pages\ListRecords;

class ListFormPengurusBarus extends ListRecords
{
    public static $resource = FormPengurusBaruResource::class;

    // disini komponent livewirenya
    public function editUsername(){
        return dd('tes');
    }
}
