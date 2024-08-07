<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    public static $resource = UserResource::class;

    public function hey(User $record){
        dd($record->toArray());
    }
}
