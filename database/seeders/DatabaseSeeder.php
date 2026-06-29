<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@fleet.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@fleet.com',
            'role' => 'staff',
        ]);

        User::factory(3)->create();

        $this->call([
            KendaraanSeeder::class,
            PengemudiSeeder::class,
            ServisSeeder::class,
            PajakSeeder::class,
            PenggunaanSeeder::class,
            KirSeeder::class,
        ]);
    }
}
