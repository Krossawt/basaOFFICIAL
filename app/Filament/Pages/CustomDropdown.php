<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class CustomDropdown extends Page
{
    protected string $view = 'filament.pages.custom-dropdown';

    protected static ?int $navigationSort = 103;

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-adjustments-horizontal';
    }

    public static function getNavigationLabel(): string
    {
        return 'Custom Dropdown';
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return 'System';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Custom Dropdown';
    }

    // ── "Create Dropdown +" button in the page header ─────────────
    protected function getHeaderActions(): array
    {
        return [
            Action::make('createDropdown')
                ->label('Create Dropdown +')
                ->color('primary')
                ->action(function () {
                    // TODO: open modal or redirect to create form
                }),
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }
}

