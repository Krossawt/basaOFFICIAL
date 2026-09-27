<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Users extends Page
{
    protected string $view = 'filament.pages.users';

    protected static ?int $navigationSort = 102;

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-users';
    }

    public static function getNavigationLabel(): string
    {
        return 'Users';
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return 'System';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Users';
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }
}
