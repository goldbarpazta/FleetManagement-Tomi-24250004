<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    use HasFactory;

    protected $table = 'pajak';

    protected $fillable = [
        'kendaraan_id', 'tanggal_jatuh_tempo', 'biaya', 'status', 'bukti_bayar',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_jatuh_tempo' => 'date',
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
            'belum_dibayar' => 'Belum Dibayar',
            'lunas' => 'Lunas',
            'denda' => 'Denda',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'belum_dibayar' => 'bg-danger',
            'lunas' => 'bg-success',
            'denda' => 'bg-warning',
        ];
        return $badges[$this->status] ?? 'bg-secondary';
    }
}
