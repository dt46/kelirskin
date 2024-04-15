<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat role baru
        $adminRoleId = Str::uuid(); // Generate UUID for admin role
        $admin_role = Role::create([
            'id' => $adminRoleId->toString(), // Convert UUID object to string
            'name' => 'admin'
        ]);

        $resellerRoleId = Str::uuid(); // Generate UUID for reseller role
        $reseller_role = Role::create([
            'id' => $resellerRoleId->toString(), // Convert UUID object to string
            'name' => 'reseller'
        ]);

        // Menggunakan UUID dari role yang telah dibuat untuk membuat user
        $adminUserId = Str::uuid(); // Generate UUID for admin user
        $admin = User::create([
            'id' => $adminUserId->toString(), // Convert UUID object to string
            'role_id' => $adminRoleId->toString(), // Convert UUID object to string
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123')
        ]);
    }
}
