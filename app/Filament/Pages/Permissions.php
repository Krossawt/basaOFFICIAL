<?php

namespace App\Filament\Pages;

use App\Models\Permission;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class Permissions extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.permissions';

    protected static ?int $navigationSort = 101;

    // ── Navigation ───────────────────────────────────────────────
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

    // ── "Add Permissions +" button in the page header ────────────
    protected function getHeaderActions(): array
    {
        return [
            Action::make('addPermission')
                ->label('Add Permissions +')
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
                Permission::query()->select(['id', 'name', 'guard_name', 'isActive', 'created_at', 'updated_at'])
            )
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->width('60px'),

                TextColumn::make('name')
                    ->label('Permission')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('guard_name')
                    ->label('Guard')
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                IconColumn::make('isActive')
                    ->label('Active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
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
            ->defaultSort('id')
            ->striped()
            ->paginated([10, 25, 50]);
    }

    // ── Restrict to Super Admin only ─────────────────────────────
    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }
}

