<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('servi');

        return [
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tanggal' => 'required|date',
            'bengkel' => 'required|string',
            'jenis_servis' => 'required|string',
            'odometer' => 'required|integer|min:0',
            'biaya' => 'required|numeric|min:0',
            'status' => 'required|in:jadwal,proses,selesai',
            'catatan' => 'nullable|string',
            'file_invoice' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'kendaraan_id' => 'Kendaraan',
            'tanggal' => 'Tanggal',
            'bengkel' => 'Bengkel',
            'jenis_servis' => 'Jenis Servis',
            'odometer' => 'Odometer',
            'biaya' => 'Biaya',
            'status' => 'Status',
            'catatan' => 'Catatan',
            'file_invoice' => 'File Invoice',
            'file_foto' => 'Foto',
        ];
    }
}
