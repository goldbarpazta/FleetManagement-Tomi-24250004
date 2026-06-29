<?php

namespace Database\Seeders;

use App\Models\Pengemudi;
use Illuminate\Database\Seeder;

class PengemudiSeeder extends Seeder
{
    public function run(): void
    {
        Pengemudi::factory(20)->create();
    }
}
