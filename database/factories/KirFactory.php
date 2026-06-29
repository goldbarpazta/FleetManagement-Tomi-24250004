<?php

namespace Database\Factories;

use App\Models\Kir;
use Illuminate\Database\Eloquent\Factories\Factory;

class KirFactory extends Factory
{
    protected $model = Kir::class;

    public function definition(): array
    {
        $tanggal_berlaku = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $tanggal_habis = (clone $tanggal_berlaku)->modify('+1 year');

        return [
            'kendaraan_id' => \App\Models\Kendaraan::factory(),
            'tanggal_berlaku' => $tanggal_berlaku->format('Y-m-d'),
            'tanggal_habis' => $tanggal_habis->format('Y-m-d'),
            'status' => $this->faker->randomElement(['berlaku', 'habis', 'menunggu']),
            'dokumen' => null,
        ];
    }
}
