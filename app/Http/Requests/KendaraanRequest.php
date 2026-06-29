<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KendaraanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('kendaraan');

        return [
            'no_plat' => ['required', 'string', 'max:20', Rule::unique('kendaraan')->ignore($id)],
            'no_polisi' => 'nullable|string|max:20',
            'merk' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'jenis' => 'required|in:mobil,motor',
            'kategori' => 'required|string|max:50',
            'tahun' => 'required|integer|min:2000|max:2030',
            'warna' => 'nullable|string|max:50',
            'no_mesin' => 'nullable|string|max:100',
            'no_rangka' => 'nullable|string|max:100',
            'vin' => 'nullable|string|max:50',
            'kapasitas_mesin' => 'nullable|string|max:50',
            'bahan_bakar' => 'nullable|string|max:50',
            'transmisi' => 'nullable|string|max:50',
            'kilometer' => 'nullable|integer|min:0',
            'tanggal_pajak' => 'nullable|date',
            'tanggal_stnk' => 'nullable|date',
            'tanggal_kir' => 'nullable|date',
            'status' => 'required|in:tersedia,dipakai,servis,nonaktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'no_plat' => 'Nomor Plat',
            'no_polisi' => 'Nomor Polisi',
            'merk' => 'Merk',
            'model' => 'Model',
            'jenis' => 'Jenis',
            'kategori' => 'Kategori',
            'tahun' => 'Tahun',
            'warna' => 'Warna',
            'no_mesin' => 'Nomor Mesin',
            'no_rangka' => 'Nomor Rangka',
            'vin' => 'VIN',
            'kapasitas_mesin' => 'Kapasitas Mesin',
            'bahan_bakar' => 'Bahan Bakar',
            'transmisi' => 'Transmisi',
            'kilometer' => 'Kilometer',
            'tanggal_pajak' => 'Tanggal Pajak',
            'tanggal_stnk' => 'Tanggal STNK',
            'tanggal_kir' => 'Tanggal KIR',
            'status' => 'Status',
            'foto' => 'Foto',
            'catatan' => 'Catatan',
        ];
    }
}
