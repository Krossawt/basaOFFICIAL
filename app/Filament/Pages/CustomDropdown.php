<?php

namespace App\Filament\Pages;

use App\Models\Dropdown;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class CustomDropdown extends Page implements HasTable
{
    use InteractsWithTable;

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
                ->url(CreateCustomDropdown::getUrl()),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Dropdown::query()->select([
                    'dropdown_no',
                    'dropdown_Name',
                    'dropdown_created_on',
                    'dropdown_updated_on',
                ])
            )
            ->columns([
                TextColumn::make('dropdown_no')
                    ->label('Dropdown No.')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('dropdown_Name')
                    ->label('Dropdown Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('dropdown_created_on')
                    ->label('Created On')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
                TextColumn::make('dropdown_updated_on')
                    ->label('Updated On')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->iconButton()
                    ->tooltip('Edit dropdown')
                    ->url(fn (Dropdown $record): string => EditCustomDropdown::getUrl(['record' => $record])),
            ])
            ->defaultSort('dropdown_created_on', 'desc')
            ->paginated([10, 25, 50]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }
}
