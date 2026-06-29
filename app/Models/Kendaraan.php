<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';

    protected $fillable = [
        'no_plat', 'no_polisi', 'merk', 'model', 'jenis', 'kategori',
        'tahun', 'warna', 'no_mesin', 'no_rangka', 'vin', 'kapasitas_mesin',
        'bahan_bakar', 'transmisi', 'kilometer', 'tanggal_pajak', 'tanggal_stnk',
        'tanggal_kir', 'status', 'foto', 'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tahun' => 'integer',
            'kilometer' => 'integer',
            'tanggal_pajak' => 'date',
            'tanggal_stnk' => 'date',
            'tanggal_kir' => 'date',
        ];
    }

    public function servis()
    {
        return $this->hasMany(Servis::class);
    }

    public function penggunaan()
    {
        return $this->hasMany(Penggunaan::class);
    }

    public function pajak()
    {
        return $this->hasMany(Pajak::class);
    }

    public function kir()
    {
        return $this->hasMany(Kir::class);
    }

    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }

    public function scopeByJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('no_plat', 'like', "%{$search}%")
              ->orWhere('merk', 'like', "%{$search}%")
              ->orWhere('model', 'like', "%{$search}%")
              ->orWhere('no_polisi', 'like', "%{$search}%");
        });
    }

    public static function jenisList(): array
    {
        return ['mobil', 'motor'];
    }

    public static function kategoriMobil(): array
    {
        return ['SUV', 'MPV', 'Sedan', 'Pickup', 'Truck'];
    }

    public static function kategoriMotor(): array
    {
        return ['Motor Bebek', 'Motor Matic', 'Motor Sport'];
    }

    public static function statusList(): array
    {
        return ['tersedia', 'dipakai', 'servis', 'nonaktif'];
    }

    public function getJenisLabelAttribute(): string
    {
        return $this->jenis === 'mobil' ? 'Mobil' : 'Motor';
    }

    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'tersedia' => 'Tersedia',
            'dipakai' => 'Dipaksi',
            'servis' => 'Servis',
            'nonaktif' => 'Nonaktif',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'tersedia' => 'bg-success',
            'dipakai' => 'bg-warning',
            'servis' => 'bg-danger',
            'nonaktif' => 'bg-secondary',
        ];
        return $badges[$this->status] ?? 'bg-secondary';
    }
}
