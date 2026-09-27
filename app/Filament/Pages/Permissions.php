<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Permissions extends Page
{
    protected string $view = 'filament.pages.permissions';

    protected static ?int $navigationSort = 101;

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-key';
    }

    public static function getNavigationLabel(): string
    {
        return 'Permissions';
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return 'System';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Permissions';
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }
}
