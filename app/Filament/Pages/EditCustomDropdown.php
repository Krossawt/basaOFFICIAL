<?php

namespace App\Filament\Pages;

use App\Models\Dropdown;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\DB;

class EditCustomDropdown extends CreateCustomDropdown
{
    protected string $view = 'filament.pages.edit-custom-dropdown';

    protected static ?string $slug = 'custom-dropdown/{record}/edit';

    public Dropdown $dropdown;

    public function mount(?string $record = null): void
    {
        $this->dropdown = Dropdown::query()
            ->with('data')
            ->findOrFail($record);

        $this->form->fill([
            'dropdown_Name' => $this->dropdown->dropdown_Name,
            'dropdown_status' => $this->dropdown->dropdown_status,
            'dropdown_data' => $this->dropdown->data
                ->map(fn ($data): array => [
                    'dropdown_data_no' => $data->dropdown_data_no,
                    'dropdown_data_name' => $data->dropdown_data_name,
                ])
                ->all(),
        ]);
    }

    public function getTitle(): string|Htmlable
    {
        return 'Edit Dropdown';
    }

    public function create(): void
    {
        $data = $this->form->getState();

        DB::transaction(function () use ($data): void {
            $this->dropdown->update([
                'dropdown_Name' => $data['dropdown_Name'],
                'dropdown_status' => $data['dropdown_status'],
                'dropdown_updated_on' => now(),
            ]);

            $items = collect($data['dropdown_data'] ?? [])
                ->filter(fn (array $item): bool => filled($item['dropdown_data_name'] ?? null));
            $existingNumbers = $items->pluck('dropdown_data_no')->filter()->all();

            $dataQuery = $this->dropdown->data();

            if (filled($existingNumbers)) {
                $dataQuery->whereNotIn('dropdown_data_no', $existingNumbers)->delete();
            } else {
                $dataQuery->delete();
            }

            foreach ($items as $item) {
                if (filled($item['dropdown_data_no'] ?? null)) {
                    $this->dropdown->data()
                        ->where('dropdown_data_no', $item['dropdown_data_no'])
                        ->update(['dropdown_data_name' => $item['dropdown_data_name']]);

                    continue;
                }

                $this->dropdown->data()->create([
                    'dropdown_data_name' => $item['dropdown_data_name'],
                ]);
            }
        });

        Notification::make()
            ->title('Dropdown updated')
            ->success()
            ->send();

        $this->redirect(CustomDropdown::getUrl(), navigate: true);
    }
}
