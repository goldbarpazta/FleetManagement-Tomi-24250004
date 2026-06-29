<?php

namespace Database\Factories;

use App\Models\Pengemudi;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengemudiFactory extends Factory
{
    protected $model = Pengemudi::class;

    public function definition(): array
    {
        return [
            'nama' => fake()->name('male'),
            'nik' => fake()->numerify('################'),
            'no_hp' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'alamat' => fake()->address(),
            'nomor_sim' => strtoupper(fake()->bothify('SIM-#######')),
            'jenis_sim' => fake()->randomElement(['A', 'B1', 'B2', 'C', 'D']),
            'tanggal_berlaku_sim' => fake()->dateTimeBetween('-2 years', '+3 years'),
            'status' => fake()->randomElement(['aktif', 'aktif', 'aktif', 'tidak_aktif']),
            'foto' => null,
        ];
    }
}
