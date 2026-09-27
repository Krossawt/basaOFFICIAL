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
        // 1. Create all system roles (Role-001 … Role-019)
        $this->call(RoleSeeder::class);

        // 2. Create one user account per role
        $this->call(UserSeeder::class);
    }
}
