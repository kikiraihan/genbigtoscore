<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AnggotaTambah extends Page
{
    public static $icon = 'heroicon-o-user-add';
    public static $navigationLabel = 'Penerima Baru - Import';
    public static $navigationSort = 2;
    public static $title="Import Penerima Beasiswa (GenBI Baru)";

    public static $view = 'filament.pages.anggota-tambah';

    // dd(static::generateUrl('index'));
    // "http://127.0.0.1:8000/admin/anggota-tambah"
}
