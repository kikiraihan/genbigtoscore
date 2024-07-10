<?php

namespace App\Filament\Resources\FormPengurusBaruResource\Pages;

use App\Filament\Resources\FormPengurusBaruResource;
use App\Models\anggota;
use App\Models\Unit;
use Filament\Resources\Forms\Components\Select;
use Filament\Resources\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditFormPengurusBaru extends EditRecord
{
    public static $resource = FormPengurusBaruResource::class;

    protected function form(Form $form)
    {
        return $form
            ->schema([
                Select::make('id_anggota')
                    ->placeholder('Pilih Anggota')
                    ->options(
                        anggota::all()->pluck('nama', 'id'),
                    )->disabled(),
                Select::make('id_unit')
                    ->placeholder('Pilih Unit')
                    ->options(
                        Unit::all()->pluck('nama', 'id'),
                    ),
            ]);
    }
}
