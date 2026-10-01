<?php

namespace App\Filament\Pages;

use App\Models\Dropdown;
use App\Models\DropdownData;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class Roles extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.roles';

    protected static ?int $navigationSort = 100;

    // ── Navigation ───────────────────────────────────────────────
    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-shield-check';
    }

    public static function getNavigationLabel(): string
    {
        return 'Roles';
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return 'System';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Roles';
    }

    // ── "Create Role +" button in the page header ────────────────
    protected function getHeaderActions(): array
    {
        return [
            Action::make('createRole')
                ->label('Create Role +')
                ->color('primary')
                ->action(function () {
                    // TODO: open modal or redirect to create form
                }),
        ];
    }

    // ── Table definition ─────────────────────────────────────────
    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Fetch dropdown_data rows that belong to the dropdown
                // flagged as the Roles Dropdown (is_roles_dropdown = true)
                DropdownData::query()
                    ->whereHas('dropdown', fn (Builder $q) => $q->where('is_roles_dropdown', true))
                    ->with('dropdown')
            )
            ->columns([
                TextColumn::make('dropdown_data_official_no')
                    ->label('Official No.')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('dropdown_data_no')
                    ->label('Role No.')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->badge()
                    ->color('warning'),

                TextColumn::make('dropdown_data_name')
                    ->label('Role Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('dropdown.dropdown_Name')
                    ->label('From Dropdown')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('dropdown_data_official_no')
            ->striped()
            ->paginated([10, 25, 50])
            ->emptyStateHeading('No roles found')
            ->emptyStateDescription('No dropdown has been designated as the Roles Dropdown yet, or it has no data.');
    }

    // ── Restrict to Super Admin only ─────────────────────────────
    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }
}
