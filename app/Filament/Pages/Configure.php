<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Configure extends Page
{
    protected string $view = 'filament.pages.configure';

    protected static ?int $navigationSort = 103;

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-cog-6-tooth';
    }

    public static function getNavigationLabel(): string
    {
        return 'Configure';
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return 'System';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Configure';
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }
}
