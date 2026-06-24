<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Actions\Action;
use App\Models\School;

class TeacherImport extends Page
{
    protected string $view = 'filament.pages.teacher-import';
    protected static ?string $navigationLabel = 'Personel Aktarımı';
    
    protected static string|\UnitEnum|null $navigationGroup = '🏫 Yönetim';
    
    protected static ?int $navigationSort = 50;
    
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-up-tray';
}
