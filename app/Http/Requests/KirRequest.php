<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KirRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tanggal_berlaku' => 'required|date',
            'tanggal_habis' => 'required|date|after:tanggal_berlaku',
            'status' => 'required|in:berlaku,habis,menunggu',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'kendaraan_id' => 'Kendaraan',
            'tanggal_berlaku' => 'Tanggal Berlaku',
            'tanggal_habis' => 'Tanggal Habis',
            'status' => 'Status',
            'dokumen' => 'Dokumen',
        ];
    }
}
