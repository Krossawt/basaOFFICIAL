<?php

namespace App\Filament\Pages;

use App\Models\Dropdown;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\DB;

class CreateCustomDropdown extends Page
{
    protected string $view = 'filament.pages.create-custom-dropdown';

    protected static bool $shouldRegisterNavigation = false;

    /** @var array<string, mixed> */
    public ?array $data = [];

    public function mount(?string $record = null): void
    {
        $this->form->fill([
            'dropdown_status' => true,
            'dropdown_data' => [[]],
        ]);
    }

    public function getTitle(): string|Htmlable
    {
        return 'Create Dropdown';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Dropdown Details')
                    ->schema([
                        TextInput::make('dropdown_Name')
                            ->label('Dropdown Name')
                            ->required()
                            ->maxLength(25),
                        Select::make('dropdown_status')
                            ->label('Dropdown Status')
                            ->options([
                                true => 'Active',
                                false => 'Inactive',
                            ])
                            ->required()
                            ->native(false),
                    ])
                    ->columns(2),
                Section::make('Table Section')
                    ->description('Add the values that users can select in this dropdown.')
                    ->schema([
                        Repeater::make('dropdown_data')
                            ->label('Dropdown Data')
                            ->schema([
                                TextInput::make('dropdown_data_no')
                                    ->label('Dropdown Data Table No.')
                                    ->placeholder('Generated when saved')
                                    ->readOnly(),
                                TextInput::make('dropdown_data_name')
                                    ->label('Dropdown Data Name')
                                    ->required()
                                    ->maxLength(25),
                            ])
                            ->table([
                                TableColumn::make('Dropdown Data Table No.'),
                                TableColumn::make('Dropdown Data Name'),
                            ])
                            ->extraItemActions([
                                Action::make('editDropdownData')
                                    ->icon('heroicon-m-pencil-square')
                                    ->tooltip('Edit this dropdown data')
                                    ->modalHeading('Edit Dropdown Data')
                                    ->fillForm(fn (array $arguments, Repeater $component): array => $component->getItemState($arguments['item']))
                                    ->schema([
                                        TextInput::make('dropdown_data_name')
                                            ->label('Dropdown Data Name')
                                            ->required()
                                            ->maxLength(25),
                                    ])
                                    ->action(function (array $data, array $arguments, Repeater $component): void {
                                        $component->getChildSchema($arguments['item'])->fill($data);
                                    }),
                            ])
                            ->addActionLabel('Add Dropdown Data')
                            ->defaultItems(1)
                            ->reorderable(false)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        DB::transaction(function () use ($data): void {
            $dropdown = Dropdown::create([
                'dropdown_Name' => $data['dropdown_Name'],
                'dropdown_status' => $data['dropdown_status'],
            ]);

            foreach ($data['dropdown_data'] ?? [] as $dropdownData) {
                if (blank($dropdownData['dropdown_data_name'] ?? null)) {
                    continue;
                }

                $dropdown->data()->create([
                    'dropdown_data_name' => $dropdownData['dropdown_data_name'],
                ]);
            }
        });

        Notification::make()
            ->title('Dropdown created')
            ->success()
            ->send();

        $this->redirect(CustomDropdown::getUrl(), navigate: true);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }
}
