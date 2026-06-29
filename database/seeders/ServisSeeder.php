<?php

namespace Database\Seeders;

use App\Models\Servis;
use Illuminate\Database\Seeder;

class ServisSeeder extends Seeder
{
    public function run(): void
    {
        Servis::factory(100)->create();
    }
}
