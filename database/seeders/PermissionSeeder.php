<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the core system permissions.
     * Uses updateOrCreate so re-running the seeder is safe.
     */
    public function run(): void
    {
        $permissions = [
            'Create',
            'Read',
            'Update',
            'Delete',
            'Print',
            'Import',
            'Export',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission, 'guard_name' => 'web'],
                ['isActive' => true]
            );
        }

        $this->command->info('✔ Permissions seeded: ' . implode(', ', $permissions));
    }
}
