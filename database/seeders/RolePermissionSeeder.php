<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create Roles
        $superAdmin = Role::firstOrCreate(
            ['name' => 'super_admin'],
            ['display_name' => 'Super Admin', 'description' => 'Full system access']
        );

        $admin = Role::firstOrCreate(
            ['name' => 'admin'],
            ['display_name' => 'Admin', 'description' => 'Admin access']
        );

        $organization = Role::firstOrCreate(
            ['name' => 'organization'],
            ['display_name' => 'Organization', 'description' => 'Organization account']
        );

        $donor = Role::firstOrCreate(
            ['name' => 'donor'],
            ['display_name' => 'Donor', 'description' => 'Donor account']
        );

        $user = Role::firstOrCreate(
            ['name' => 'user'],
            ['display_name' => 'User', 'description' => 'Regular user']
        );

        // Create default admin account
        User::firstOrCreate(
            ['email' => 'admin@zariyah.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Admin@123'),
                'role' => 'super_admin',
                'status' => 'active',
                'is_verified' => true,
                'verified_at' => now(),
                'trust_score' => 100,
            ]
        );
    }
}
