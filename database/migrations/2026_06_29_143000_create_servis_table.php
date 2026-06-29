<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->constrained('kendaraan')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('bengkel');
            $table->string('jenis_servis');
            $table->integer('odometer');
            $table->decimal('biaya', 12, 2);
            $table->enum('status', ['jadwal', 'proses', 'selesai'])->default('jadwal');
            $table->text('catatan')->nullable();
            $table->string('file_invoice')->nullable();
            $table->string('file_foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servis');
    }
};
