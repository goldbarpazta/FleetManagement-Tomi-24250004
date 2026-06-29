<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenggunaanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'pengemudi_id' => 'required|exists:pengemudi,id',
            'tujuan' => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_berangkat',
            'odometer_awal' => 'required|integer|min:0',
            'odometer_akhir' => 'nullable|integer|min:0',
            'status' => 'required|in:berlangsung,selesai,dibatalkan',
        ];
    }

    public function attributes(): array
    {
        return [
            'kendaraan_id' => 'Kendaraan',
            'pengemudi_id' => 'Pengemudi',
            'tujuan' => 'Tujuan',
            'tanggal_berangkat' => 'Tanggal Berangkat',
            'tanggal_kembali' => 'Tanggal Kembali',
            'odometer_awal' => 'Odometer Awal',
            'odometer_akhir' => 'Odometer Akhir',
            'status' => 'Status',
        ];
    }
}
