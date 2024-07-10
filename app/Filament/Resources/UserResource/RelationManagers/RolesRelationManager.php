<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\RelationManager;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class RolesRelationManager extends RelationManager
{
    public static $primaryColumn = 'name';

    public static $relationship = 'roles';

    public function canCreate(){
        return false;
    }
    public function canDelete(){
        return false;
    }


    public static function form(Form $form)
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('name')->primary()->sortable()->searchable(),
            ])
            ->filters([
                //
            ]);
    }
}
