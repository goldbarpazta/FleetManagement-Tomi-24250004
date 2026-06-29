<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KendaraanFactory extends Factory
{
    protected $model = Kendaraan::class;

    public function definition(): array
    {
        $jenis = $this->faker->randomElement(['mobil', 'motor']);
        $kategoriMobil = ['SUV', 'MPV', 'Sedan', 'Pickup', 'Truck'];
        $kategoriMotor = ['Motor Bebek', 'Motor Matic', 'Motor Sport'];
        $merkMobil = ['Toyota', 'Honda', 'Suzuki', 'Mitsubishi', 'Daihatsu', 'Nissan', 'BMW', 'Mercedes-Benz'];
        $merkMotor = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'Vespa'];
        $merks = $jenis === 'mobil' ? $merkMobil : $merkMotor;

        return [
            'no_plat' => strtoupper($this->faker->bothify('? #### ??')),
            'no_polisi' => strtoupper($this->faker->bothify('?????')),
            'merk' => $this->faker->randomElement($merks),
            'model' => $this->faker->word(),
            'jenis' => $jenis,
            'kategori' => $this->faker->randomElement($jenis === 'mobil' ? $kategoriMobil : $kategoriMotor),
            'tahun' => $this->faker->numberBetween(2015, 2025),
            'warna' => $this->faker->safeColorName(),
            'no_mesin' => strtoupper($this->faker->bothify('##########')),
            'no_rangka' => strtoupper($this->faker->bothify('##########')),
            'vin' => strtoupper($this->faker->bothify('################')),
            'kapasitas_mesin' => $this->faker->randomElement(['1000 cc', '1300 cc', '1500 cc', '2000 cc', '2500 cc', '110 cc', '125 cc', '150 cc']),
            'bahan_bakar' => $this->faker->randomElement(['Bensin', 'Solar', 'Listrik']),
            'transmisi' => $this->faker->randomElement(['Manual', 'Matic']),
            'kilometer' => $this->faker->numberBetween(0, 200000),
            'tanggal_pajak' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'tanggal_stnk' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'tanggal_kir' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'status' => $this->faker->randomElement(['tersedia', 'dipakai', 'servis']),
            'foto' => null,
            'catatan' => $this->faker->optional()->sentence(),
        ];
    }
}
