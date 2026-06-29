<?php

namespace Database\Seeders;

use App\Models\Pajak;
use Illuminate\Database\Seeder;

class PajakSeeder extends Seeder
{
    public function run(): void
    {
        Pajak::factory(20)->create();
    }
}
