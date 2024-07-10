<?php

namespace App\Filament\Resources\RoleResource\RelationManagers;

use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\RelationManager;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class UsersRelationManager extends RelationManager
{
    public static $primaryColumn = 'username';

    public static $relationship = 'users';

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
                Columns\Text::make('username')->primary()->sortable()->searchable(),
                Columns\Text::make('email')->primary()->sortable()->searchable(),
                Columns\Text::make('anggota.nama')->primary()->sortable()->searchable(),
            ])
            ->filters([
                //
            ])->pagination(true);
    }
}
