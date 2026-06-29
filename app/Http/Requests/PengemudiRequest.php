<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PengemudiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('pengemudi');

        return [
            'nama' => 'required|string|max:100',
            'nik' => ['required', 'string', 'size:16', Rule::unique('pengemudi')->ignore($id)],
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'nomor_sim' => 'nullable|string|max:50',
            'jenis_sim' => 'nullable|in:A,B1,B2,C,D',
            'tanggal_berlaku_sim' => 'nullable|date',
            'status' => 'required|in:aktif,tidak_aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama',
            'nik' => 'NIK',
            'no_hp' => 'No. HP',
            'email' => 'Email',
            'alamat' => 'Alamat',
            'nomor_sim' => 'Nomor SIM',
            'jenis_sim' => 'Jenis SIM',
            'tanggal_berlaku_sim' => 'Tanggal Berlaku SIM',
            'status' => 'Status',
            'foto' => 'Foto',
        ];
    }
}
