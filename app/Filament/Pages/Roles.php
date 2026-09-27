<?php

namespace App\Filament\Pages;

use App\Models\Role;
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
                Role::query()->select(['id', 'roleID', 'roleName', 'created_at', 'updated_at'])
            )
            ->columns([
                TextColumn::make('roleID')
                    ->label('Role ID')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->badge()
                    ->color('warning'),

                TextColumn::make('roleName')
                    ->label('Role Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('roleID')
            ->striped()
            ->paginated([10, 25, 50]);
    }

    // ── Restrict to Super Admin only ─────────────────────────────
    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }
}
