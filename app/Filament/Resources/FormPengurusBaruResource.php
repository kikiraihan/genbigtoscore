<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormPengurusBaruResource\Pages;
use App\Filament\Resources\FormPengurusBaruResource\RelationManagers;
use App\Filament\Roles;
use App\Models\anggota;
use App\Models\FormPengurusBaru;
use App\Models\Unit;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;
use Filament\Tables\RecordActions\Link;

class FormPengurusBaruResource extends Resource
{
    public static $model = FormPengurusBaru::class;
    public static $icon = 'heroicon-o-document-text';
    public static $navigationLabel = 'Pengurus Baru - Form';
    public static $navigationSort = 0;
    public static $label='Form Calon Pengurus Baru';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\BelongsToSelect::make('id_anggota')
                    ->relationship('anggota', 'nama'),
                Components\Select::make('id_unit')
                    ->placeholder('Pilih Unit')
                    ->options(
                        Unit::all()->pluck('nama', 'id'),
                    ),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                // Columns\Text::make('created_at')
                // ->formatUsing($callback = fn ($value) => $value->diffForHumans())->sortable()->primary(),
                Columns\Text::make('anggota.nama')->primary()->sortable()->searchable(),
                Columns\Text::make('unit.nama')->label('unit')->sortable(),
                Columns\Text::make('unit.badan.nama')->label('badan'),
                // Columns\Text::make('anggota.nama')->label('Finalisasi')->sortable()->action('editUsername'),
            ])
            ->filters([
                Filter::make('Wilayah', fn ($query) => $query->whereHas('unit', function($query) {
                    $query->where('id_badan', 1);
                })),
                Filter::make('Komsat UNG', fn ($query) => $query->whereHas('unit', function($query) {
                    $query->where('id_badan', 2);
                })),
                Filter::make('Komsat IAIN', fn ($query) => $query->whereHas('unit', function($query) {
                    $query->where('id_badan', 3);
                })),
                Filter::make('Komsat UG', fn ($query) => $query->whereHas('unit', function($query) {
                    $query->where('id_badan', 4);
                })),
                Filter::make('Komsat UMGO', fn ($query) => $query->whereHas('unit', function($query) {
                    $query->where('id_badan', 5);
                })),
                Filter::make('Komsat UBM', fn ($query) => $query->whereHas('unit', function($query) {
                    $query->where('id_badan', 6);
                })),
            ])
            // ->prependRecordActions([
            //     // Link::make('view')->url(fn ($record) => static::generateUrl('show')),
            // ])->defaultSort('tahun','desc')
            // ->primaryColumnAction(Null)
            ;
    }

    public static function relations()
    {
        return [
            //
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListFormPengurusBarus::routeTo('/', 'index'),
            Pages\CreateFormPengurusBaru::routeTo('/create', 'create'),
            Pages\EditFormPengurusBaru::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
