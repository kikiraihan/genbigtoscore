<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Roles;
use App\Models\User;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;
use Filament\Tables\RecordActions\Link;

class UserResource extends Resource
{
    public static $model = User::class;
    public static $icon = 'heroicon-o-collection';
    public static $navigationLabel = 'Master - User Role';
    public static $navigationSort = 3-0.9;

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('username')
                    ->placeholder('username (harus nim)'),
                Components\TextInput::make('password')
                    ->placeholder('isi password baru'),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('anggota.nama')->primary()->sortable()->searchable(),
                Columns\Text::make('username')->primary()->sortable()->searchable(),
                Columns\Text::make('anggota.nim')->primary()->sortable()->searchable(),
                Columns\Text::make('email')->primary()->sortable()->searchable(),
                // Columns\Text::make('Jumlahrole')->primary()->sortable()->searchable(),
                Columns\Text::make('roles')->getValueUsing($callback = fn ($record) => $record->getAttribute('roles')->pluck('name'))->sortable()->searchable(),
                Columns\Text::make('created_at')->primary()->sortable()->searchable(),
            ])
            ->filters([
                Filter::make(
                    'User Yang Nim dan Username tidak sama', 
                    fn ($query) => $query->whereHas('anggota', function ($query) {
                        $query->whereColumn('users.username', '!=', 'anggotas.nim');
                    })
                ),
                Filter::make(
                    'User Tanpa Anggota', 
                    fn ($query) => $query->doesntHave('anggota')
                ),
                Filter::make(
                    'User tanpa Role', 
                    fn ($query) => $query->whereDoesntHave('roles')
                ),
                // "Admin",
                Filter::make(
                    'Role : Admin', 
                    fn ($query) => $query->role('admin')
                ),
                // "Anggota",
                Filter::make(
                    'Role : Anggota', 
                    fn ($query) => $query->role('admin')
                ),
                // "Benkom",
                Filter::make(
                    'Role : Benkom',
                    fn ($query) => $query->role('benkom')
                ),
                // "Benwil",
                Filter::make(
                    'Role : Benwil',
                    fn ($query) => $query->role('benwil')
                ),
                // "Demisioner",
                Filter::make(
                    'Role : Demisioner',
                    fn ($query) => $query->role('demisioner')
                ),
                // "Kekom",
                Filter::make(
                    'Role : Kekom',
                    fn ($query) => $query->role('kekom')
                ),
                // "Kepala Unit",
                Filter::make(
                    'Role : Kepala Unit',
                    fn ($query) => $query->role('kepala unit')
                ),
                // "Korwil",
                Filter::make(
                    'Role : Korwil',
                    fn ($query) => $query->role('korwil')
                ),
                // "Pembina",
                Filter::make(
                    'Role : Pembina',
                    fn ($query) => $query->role('pembina')
                ),
                // "Sekom",
                Filter::make(
                    'Role : Sekom',
                    fn ($query) => $query->role('sekom')
                ),
                // "Sekwil",
                Filter::make(
                    'Role : Sekwil',
                    fn ($query) => $query->role('sekwil')
                ),
                // "Tim Penilai"
                Filter::make(
                    'Role : Tim Penilai',
                    fn ($query) => $query->role('tim penilai')
                ),
            ])
            ->prependRecordActions([
                Link::make('view')->action('hey'),
            ]);
            ;
    }

    public function hey(User $user){
        $user->password = 'password';
        $user->save();
    }

    public static function relations()
    {
        return [
            RelationManagers\RolesRelationManager::class,
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListUsers::routeTo('/', 'index'),
            Pages\CreateUser::routeTo('/create', 'create'),
            Pages\EditUser::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
