<x-filament-panels::page>
    <form wire:submit="create" class="space-y-6">
        {{ $this->form }}

        <div class="flex items-center gap-3">
            <x-filament::button type="submit">
                Save Changes
            </x-filament::button>

            <x-filament::button
                color="gray"
                :href="\App\Filament\Pages\CustomDropdown::getUrl()"
                tag="a"
            >
                Cancel
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
