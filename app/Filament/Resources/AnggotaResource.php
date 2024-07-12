<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnggotaResource\Pages;
use App\Filament\Resources\AnggotaResource\RelationManagers;
use App\Filament\Roles;
use App\Models\anggota;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class AnggotaResource extends Resource
{
    public static $icon = 'heroicon-o-collection';
    public static $model = anggota::class;
    public static $navigationLabel = 'Master - Anggota';
    public static $navigationSort = 3;

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('nama')
                ->placeholder('nama'),
                Components\TextInput::make('nim')
                ->placeholder('nim'),
                Components\TextInput::make('no_wa')
                ->placeholder('no_wa'),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('nama')->primary()->sortable()->searchable(),
                Columns\Text::make('nim')->sortable()->searchable(),
                Columns\Text::make('no_wa')->sortable()->searchable(),
            ])
            ->filters([
                Filter::make('UNG', fn ($query) => $query->where('id_universitas', 1)),
                Filter::make('IAIN', fn ($query) => $query->where('id_universitas', 2)),
                Filter::make('UG', fn ($query) => $query->where('id_universitas', 3)),
                Filter::make('UMGO', fn ($query) => $query->where('id_universitas', 4)),
                Filter::make('UBM', fn ($query) => $query->where('id_universitas', 5)),
            ]);
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
            Pages\ListAnggotas::routeTo('/', 'index'),
            Pages\CreateAnggota::routeTo('/create', 'create'),
            Pages\EditAnggota::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
