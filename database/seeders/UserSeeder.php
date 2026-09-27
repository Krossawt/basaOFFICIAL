<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Create one demo user account for each BASA system role.
     *
     * Credentials pattern:
     *   Email    → {slug}@basa.edu.ph
     *   Password → Password@123 (same for all demo accounts)
     */
    public function run(): void
    {
        $accounts = [
            [
                'name'      => 'Super Admin',
                'email'     => 'superadmin@basa.edu.ph',
                'role'      => 'Super Admin',
            ],
            [
                'name'      => 'School Admin',
                'email'     => 'schooladmin@basa.edu.ph',
                'role'      => 'School Admin',
            ],
            [
                'name'      => 'Principal',
                'email'     => 'principal@basa.edu.ph',
                'role'      => 'Principal',
            ],
            [
                'name'      => 'Academic Coordinator',
                'email'     => 'academic.coordinator@basa.edu.ph',
                'role'      => 'Academic Coordinator',
            ],
            [
                'name'      => 'Accountant',
                'email'     => 'accountant@basa.edu.ph',
                'role'      => 'Accountant',
            ],
            [
                'name'      => 'Inventory Manager',
                'email'     => 'inventory.manager@basa.edu.ph',
                'role'      => 'Inventory Manager',
            ],
            [
                'name'      => 'Teacher',
                'email'     => 'teacher@basa.edu.ph',
                'role'      => 'Teacher',
            ],
            [
                'name'      => 'Class Teacher',
                'email'     => 'class.teacher@basa.edu.ph',
                'role'      => 'Class Teacher',
            ],
            [
                'name'      => 'Librarian',
                'email'     => 'librarian@basa.edu.ph',
                'role'      => 'Librarian',
            ],
            [
                'name'      => 'Hostel Warden',
                'email'     => 'hostel.warden@basa.edu.ph',
                'role'      => 'Hostel Warden',
            ],
            [
                'name'      => 'Transport-in-Charge',
                'email'     => 'transport@basa.edu.ph',
                'role'      => 'Transport-in-Charge',
            ],
            [
                'name'      => 'Admission Officer',
                'email'     => 'admission.officer@basa.edu.ph',
                'role'      => 'Admission Officer',
            ],
            [
                'name'      => 'Event Coordinator',
                'email'     => 'event.coordinator@basa.edu.ph',
                'role'      => 'Event Coordinator',
            ],
            [
                'name'      => 'Club Adviser',
                'email'     => 'club.adviser@basa.edu.ph',
                'role'      => 'Club Adviser',
            ],
            [
                'name'      => 'Guidance Counselor',
                'email'     => 'guidance.counselor@basa.edu.ph',
                'role'      => 'Guidance Counselor',
            ],
            [
                'name'      => 'School Nurse',
                'email'     => 'school.nurse@basa.edu.ph',
                'role'      => 'School Nurse',
            ],
            [
                'name'      => 'Parent Guardian',
                'email'     => 'parent.guardian@basa.edu.ph',
                'role'      => 'Parent / Guardian',
            ],
            [
                'name'      => 'Student',
                'email'     => 'student@basa.edu.ph',
                'role'      => 'Student',
            ],
            [
                'name'      => 'Alumni',
                'email'     => 'alumni@basa.edu.ph',
                'role'      => 'Alumni',
            ],
        ];

        $defaultPassword = Hash::make('Password@123');

        foreach ($accounts as $account) {
            $user = User::firstOrCreate(
                ['email' => $account['email']],
                [
                    'name'              => $account['name'],
                    'password'          => $defaultPassword,
                    'email_verified_at' => now(),
                ]
            );

            // Assign the matching role (sync replaces any existing role)
            $role = Role::where('name', $account['role'])->where('guard_name', 'web')->first();

            if ($role) {
                $user->syncRoles([$account['role']]);
            } else {
                $this->command->warn("⚠️  Role [{$account['role']}] not found — skipped for {$account['email']}");
            }
        }

        $this->command->info('✅ ' . count($accounts) . ' user accounts seeded successfully.');
        $this->command->line('   Default password: <comment>Password@123</comment>');
    }
}
