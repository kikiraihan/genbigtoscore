<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BadanResource\Pages;
use App\Filament\Resources\BadanResource\RelationManagers;
use App\Filament\Roles;
use App\Models\Badan;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class BadanResource extends Resource
{
    public static $model = Badan::class;
    public static $icon = 'heroicon-o-collection';
    public static $navigationLabel = 'Master - Badan';
    public static $navigationSort = 3;
    public static $title="Badan";

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('nama')
                    ->placeholder('nama badan'),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('nama')->primary()->sortable()->searchable(),
                Columns\Text::make('unit')->getValueUsing($callback = fn ($record) => $record->getAttribute('units')->count())->sortable()->primary(),
            ])
            ->filters([
                //
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
            Pages\ListBadans::routeTo('/', 'index'),
            Pages\CreateBadan::routeTo('/create', 'create'),
            Pages\EditBadan::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
