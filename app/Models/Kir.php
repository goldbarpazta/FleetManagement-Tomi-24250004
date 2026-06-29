<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kir extends Model
{
    use HasFactory;

    protected $table = 'kir';

    protected $fillable = [
        'kendaraan_id',
        'tanggal_berlaku',
        'tanggal_habis',
        'status',
        'dokumen',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_berlaku' => 'date',
            'tanggal_habis' => 'date',
        ];
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'berlaku' => 'Berlaku',
            'habis' => 'Habis',
            'menunggu' => 'Menunggu',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'berlaku' => 'bg-success',
            'habis' => 'bg-danger',
            'menunggu' => 'bg-warning',
        ];
        return $badges[$this->status] ?? 'bg-secondary';
    }
}
