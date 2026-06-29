<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('no_plat')->unique();
            $table->string('no_polisi')->nullable();
            $table->string('merk');
            $table->string('model');
            $table->enum('jenis', ['mobil', 'motor']);
            $table->string('kategori');
            $table->year('tahun');
            $table->string('warna')->nullable();
            $table->string('no_mesin')->nullable();
            $table->string('no_rangka')->nullable();
            $table->string('vin')->nullable();
            $table->string('kapasitas_mesin')->nullable();
            $table->string('bahan_bakar')->nullable();
            $table->string('transmisi')->nullable();
            $table->integer('kilometer')->default(0);
            $table->date('tanggal_pajak')->nullable();
            $table->date('tanggal_stnk')->nullable();
            $table->date('tanggal_kir')->nullable();
            $table->enum('status', ['tersedia', 'dipakai', 'servis', 'nonaktif'])->default('tersedia');
            $table->string('foto')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
