<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use App\Models\Pajak;
use Illuminate\Database\Eloquent\Factories\Factory;

class PajakFactory extends Factory
{
    protected $model = Pajak::class;

    public function definition(): array
    {
        return [
            'kendaraan_id' => Kendaraan::factory(),
            'tanggal_jatuh_tempo' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'biaya' => $this->faker->randomFloat(2, 50000, 5000000),
            'status' => $this->faker->randomElement(['belum_dibayar', 'lunas', 'denda']),
            'bukti_bayar' => $this->faker->optional(0.5)->filePath(),
        ];
    }
}
