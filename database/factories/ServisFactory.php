<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use App\Models\Servis;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServisFactory extends Factory
{
    protected $model = Servis::class;

    public function definition(): array
    {
        return [
            'kendaraan_id' => Kendaraan::inRandomOrder()->first()->id ?? Kendaraan::factory(),
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'bengkel' => $this->faker->company(),
            'jenis_servis' => $this->faker->randomElement([
                'Servis Ringan', 'Servis Berat', 'Ganti Oli', 'Ganti Ban',
                'Tune Up', 'Overhaul Mesin', 'Service AC', 'Spooring Balancing',
                'Kampas Rem', 'Ganti Aki',
            ]),
            'odometer' => $this->faker->numberBetween(1000, 200000),
            'biaya' => $this->faker->randomFloat(2, 50000, 5000000),
            'status' => $this->faker->randomElement(['jadwal', 'proses', 'selesai']),
            'catatan' => $this->faker->optional()->sentence(),
            'file_invoice' => null,
            'file_foto' => null,
        ];
    }
}
