<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PajakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tanggal_jatuh_tempo' => 'required|date',
            'biaya' => 'required|numeric|min:0',
            'status' => 'required|in:belum_dibayar,lunas,denda',
            'bukti_bayar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'kendaraan_id' => 'Kendaraan',
            'tanggal_jatuh_tempo' => 'Tanggal Jatuh Tempo',
            'biaya' => 'Biaya',
            'status' => 'Status',
            'bukti_bayar' => 'Bukti Bayar',
        ];
    }
}
