<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use App\Models\Pengemudi;
use App\Models\Penggunaan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenggunaanFactory extends Factory
{
    protected $model = Penggunaan::class;

    public function definition(): array
    {
        $tanggalBerangkat = $this->faker->dateTimeBetween('-6 months', 'now');
        $tanggalKembali = $this->faker->boolean(70)
            ? $this->faker->dateTimeBetween($tanggalBerangkat, '+1 week')
            : null;

        $odometerAwal = $this->faker->numberBetween(1000, 99999);
        $odometerAkhir = $tanggalKembali
            ? $odometerAwal + $this->faker->numberBetween(10, 500)
            : null;

        $status = $tanggalKembali ? 'selesai' : 'berlangsung';

        return [
            'kendaraan_id' => Kendaraan::inRandomOrder()->first()?->id ?? Kendaraan::factory(),
            'pengemudi_id' => Pengemudi::inRandomOrder()->first()?->id ?? Pengemudi::factory(),
            'tujuan' => $this->faker->city(),
            'tanggal_berangkat' => $tanggalBerangkat,
            'tanggal_kembali' => $tanggalKembali,
            'odometer_awal' => $odometerAwal,
            'odometer_akhir' => $odometerAkhir,
            'status' => $status,
        ];
    }
}
