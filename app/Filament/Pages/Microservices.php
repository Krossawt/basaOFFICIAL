<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Microservices extends Page
{
    // ── View (non-static in Filament v5) ─────────────────────────
    protected string $view = 'filament.pages.microservices';

    // ── Navigation sort (static ?int — safe to override) ─────────
    protected static ?int $navigationSort = 99;

    // ── Navigation ───────────────────────────────────────────────
    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-squares-2x2';
    }

    public static function getNavigationLabel(): string
    {
        return 'Microservices';
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return 'System';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Microservices';
    }

    // ── "Create a Service +" button in the page header ───────────
    protected function getHeaderActions(): array
    {
        return [
            Action::make('createService')
                ->label('Create a Service +')
                ->color('primary')
                ->action(function () {
                    // TODO: open a modal or redirect to create form
                }),
        ];
    }

    // ── Restrict to Super Admin only ─────────────────────────────
    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }
}
