<?php

namespace Database\Seeders;

use App\Models\Penggunaan;
use Illuminate\Database\Seeder;

class PenggunaanSeeder extends Seeder
{
    public function run(): void
    {
        Penggunaan::factory(100)->create();
    }
}
