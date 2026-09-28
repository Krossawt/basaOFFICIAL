<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class Users extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.users';

    protected static ?int $navigationSort = 102;

    // ── Navigation ───────────────────────────────────────────────
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

    // ── "Add User +" button in the page header ────────────────────
    protected function getHeaderActions(): array
    {
        return [
            Action::make('addUser')
                ->label('Add User +')
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
                User::with('roles')->select(['id', 'name', 'email', 'created_at', 'updated_at'])
            )
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->width('60px'),

                TextColumn::make('name')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email copied!')
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->color('warning')
                    ->separator(', ')
                    ->searchable(),

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

