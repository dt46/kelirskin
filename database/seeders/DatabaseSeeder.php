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
        $adminRoleId = Str::uuid()->toString(); // Generate UUID and convert to string for admin role
        $admin_role = Role::create([
            'id' => $adminRoleId,
            'name' => 'admin'
        ]);
    
        $resellerRoleId = Str::uuid()->toString(); // Generate UUID and convert to string for reseller role
        $reseller_role = Role::create([
            'id' => $resellerRoleId,
            'name' => 'reseller'
        ]);
    
        // Menggunakan UUID dari role yang telah dibuat untuk membuat user
        $adminUserId = Str::uuid()->toString(); // Generate UUID and convert to string for admin user
        $admin = User::create([
            'id' => $adminUserId,
            'role_id' => $adminRoleId,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123')
        ]);
    
        $resellerUserId = Str::uuid()->toString(); // Generate UUID and convert to string for reseller user
        $reseller = User::create([
            'id' => $resellerUserId,
            'role_id' => $resellerRoleId,
            'name' => 'Reseller',
            'email' => 'reseller@gmail.com',
            'password' => Hash::make('123')
        ]); 
    }    
}
