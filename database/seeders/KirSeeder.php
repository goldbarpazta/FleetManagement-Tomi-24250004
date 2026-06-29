<?php

namespace Database\Seeders;

use App\Models\Kir;
use Illuminate\Database\Seeder;

class KirSeeder extends Seeder
{
    public function run(): void
    {
        Kir::factory(20)->create();
    }
}
