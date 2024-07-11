<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    public static $model = Role::class;
    public static $icon = 'heroicon-o-collection';
    public static $navigationLabel = 'Master - Role';
    public static $navigationSort = 3-0.9;

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('name')
                    ->placeholder('nama role'),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('name')->primary()->sortable()->searchable(),
                Columns\Text::make('user')->getValueUsing($callback = fn ($record) => $record->getAttribute('users')->count())->sortable()->primary(),
            ])
            ->filters([
                //
            ]);
    }

    public static function relations()
    {
        return [
            //
            RelationManagers\UsersRelationManager::class,
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListRoles::routeTo('/', 'index'),
            Pages\CreateRole::routeTo('/create', 'create'),
            Pages\EditRole::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
