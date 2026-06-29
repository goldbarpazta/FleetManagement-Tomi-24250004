<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penggunaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->constrained('kendaraan')->cascadeOnDelete();
            $table->foreignId('pengemudi_id')->constrained('pengemudi')->cascadeOnDelete();
            $table->string('tujuan');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali')->nullable();
            $table->integer('odometer_awal');
            $table->integer('odometer_akhir')->nullable();
            $table->enum('status', ['berlangsung', 'selesai', 'dibatalkan'])->default('berlangsung');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggunaan');
    }
};
