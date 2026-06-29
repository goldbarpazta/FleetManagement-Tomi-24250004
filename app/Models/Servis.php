<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    use HasFactory;

    protected $table = 'servis';

    protected $fillable = [
        'kendaraan_id', 'tanggal', 'bengkel', 'jenis_servis',
        'odometer', 'biaya', 'status', 'catatan',
        'file_invoice', 'file_foto',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'biaya' => 'decimal:2',
        ];
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'jadwal' => 'Terjadwal',
            'proses' => 'Proses',
            'selesai' => 'Selesai',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'jadwal' => 'bg-info',
            'proses' => 'bg-warning',
            'selesai' => 'bg-success',
        ];
        return $badges[$this->status] ?? 'bg-secondary';
    }
}
