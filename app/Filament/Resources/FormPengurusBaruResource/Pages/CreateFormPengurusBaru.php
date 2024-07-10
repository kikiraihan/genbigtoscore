<?php

namespace App\Filament\Resources\FormPengurusBaruResource\Pages;

use App\Filament\Resources\FormPengurusBaruResource;
use App\Models\anggota;
use App\Models\Unit;
use Filament\Resources\Forms\Actions\Button;
use Filament\Resources\Forms\Components\BelongsToSelect;
use Filament\Resources\Forms\Components\Select;
use Filament\Resources\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateFormPengurusBaru extends CreateRecord
{
    public static $resource = FormPengurusBaruResource::class;

    protected function getRedirectUrl(Model $record): string
    {
        return $this->getResource()::generateUrl(static::$indexRoute);
    }

    // public function actions(){
    //     return [
    //         Button::make(static::$cancelButtonLabel)
    //             ->url($this->getResource()::generateUrl(static::$indexRoute)),
    //     ];
    // }

    // protected function form(Form $form)
    // {
    //     return $form
    //         ->schema([
    //             // Select::make('id_anggota')
    //             //     ->placeholder('Pilih Anggota')
    //             //     ->options(
    //             //         anggota::all()->pluck('nama', 'id'),
    //             //     ),
    //             BelongsToSelect::make('id_anggota')
    //                 ->relationship('anggota', 'nama'),
    //             Select::make('id_unit')
    //                 ->placeholder('Pilih Unit')
    //                 ->options(
    //                     Unit::all()->pluck('nama', 'id'),
    //                 ),
    //         ]);
    // }
}
