<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Order matters: roles must exist before users are assigned to them.
     */
    public function run(): void
    {
        // 1. Seed system permissions (Create, Read, Update, Delete, Print, Import, Export)
        $this->call(PermissionSeeder::class);

        // 2. Create all system roles (Role-001 … Role-019)
        $this->call(RoleSeeder::class);

        // 3. Create one user account per role
        $this->call(UserSeeder::class);
    }
}
