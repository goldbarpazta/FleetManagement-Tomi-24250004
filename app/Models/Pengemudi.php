<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengemudi extends Model
{
    use HasFactory;

    protected $table = 'pengemudi';

    protected $fillable = [
        'nama', 'nik', 'no_hp', 'email', 'alamat',
        'nomor_sim', 'jenis_sim', 'tanggal_berlaku_sim',
        'status', 'foto',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_berlaku_sim' => 'date',
        ];
    }

    public function penggunaan()
    {
        return $this->hasMany(Penggunaan::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('nik', 'like', "%{$search}%")
              ->orWhere('no_hp', 'like', "%{$search}%");
        });
    }

    public static function jenisSimList(): array
    {
        return ['A', 'B1', 'B2', 'C', 'D'];
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->status === 'aktif' ? 'Aktif' : 'Tidak Aktif';
    }

    public function getStatusBadgeAttribute(): string
    {
        return $this->status === 'aktif' ? 'bg-success' : 'bg-danger';
    }
}
