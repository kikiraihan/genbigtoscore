<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ImportPengurusBaru extends Page
{
    public static $icon = 'heroicon-o-document-add';
    public static $navigationLabel = 'Pengurus Baru - Import';
    public static $navigationSort = 1.5;
    public static $title="Pengurus Baru - metode input banyak (bukan form)";

    public static $view = 'filament.pages.import-pengurus-baru';
}
