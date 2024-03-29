<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(3)->create();
        User::create([
            'perusahaan_id' => 1,
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'roles' => 'admin',
            'phone' => '081111111111',
            'bio' => 'admin',
            'email_verified_at' => now(),
        ]);
        User::create([
            'perusahaan_id' => 1,
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@superadmin.com',
            'password' => Hash::make('super123'),
            'roles' => 'superadmin',
            'phone' => '081111111111',
            'bio' => 'Owner',
            'email_verified_at' => now(),
        ]);
    }
}
