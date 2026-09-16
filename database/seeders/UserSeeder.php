<?php

namespace Database\Seeders;

use App\Enums\SystemRole;
use App\Models\Access\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::slug(SystemRole::SUPER_ADMIN->value)->firstOrFail();
        $superAdminRole->users()->updateOrCreate(
            ['email' => 'super_admin@mail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'mfa_enabled' => false,
                'is_active' => true
            ]
        );

        $adminRole = Role::slug(SystemRole::ADMIN->value)->firstOrFail();
        $adminRole->users()->updateOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'mfa_enabled' => false,
                'is_active' => true
            ]
        );

        $moderatorRole = Role::slug(SystemRole::MODERATOR->value)->firstOrFail();
        $moderatorRole->users()->updateOrCreate(
            ['email' => 'moderator@mail.com'],
            [
                'name' => 'Moderator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'mfa_enabled' => true,
                'is_active' => true
            ]
        );
    }
}