<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    use HasFactory;

    protected $table = 'penggunaan';

    protected $fillable = [
        'kendaraan_id', 'pengemudi_id', 'tujuan',
        'tanggal_berangkat', 'tanggal_kembali',
        'odometer_awal', 'odometer_akhir', 'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_berangkat' => 'date',
            'tanggal_kembali' => 'date',
        ];
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function pengemudi()
    {
        return $this->belongsTo(Pengemudi::class);
    }

    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'berlangsung' => 'Berlangsung',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'berlangsung' => 'bg-warning',
            'selesai' => 'bg-success',
            'dibatalkan' => 'bg-danger',
        ];
        return $badges[$this->status] ?? 'bg-secondary';
    }
}
