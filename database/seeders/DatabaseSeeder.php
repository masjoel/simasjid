<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Dante;
use App\Models\OrderItem;
use App\Models\ProfilBisnis;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Category::factory(5)->create();
        // \App\Models\Banner::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        ProfilBisnis::create([
            'nama_client' => 'Bakorsi',
            'nama_app' => 'Bakorsi',
            'versi_app' => '1.0',
            'desc_app' => 'Aplikasi untuk mencatat BAKORSI',
            'alamat_client' => 'Jl. Raya No.1',
            'signature' => 'dr. Ganis Irawan, SpPD',
            'email' => 'ganesi@gmail.com',
            'logo' => null,
            'jam' => now(),
            'mcad' => null,
            'init' => null,
            'bank' => null,
            'footnot' => null,
            'jdigit' => 0,
            'jdelay' => 0,
        ]);
        // Dante::create([
        //     'nama' => 'dr. Ganis Irawan, SpPD',
        // ]);
        $this->call([
            UserSeeder::class,
            FromJsonSeeder::class,
            // ToJsonSeeder::class,
        ]);
    }
}