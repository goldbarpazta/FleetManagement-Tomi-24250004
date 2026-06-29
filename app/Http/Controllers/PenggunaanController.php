<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenggunaanRequest;
use App\Models\Kendaraan;
use App\Models\Pengemudi;
use App\Models\Penggunaan;
use Illuminate\Http\Request;

class PenggunaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penggunaan::with(['kendaraan', 'pengemudi']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('tujuan', 'like', "%{$search}%")
                  ->orWhereHas('kendaraan', fn ($q) => $q->where('no_plat', 'like', "%{$search}%"))
                  ->orWhereHas('pengemudi', fn ($q) => $q->where('nama', 'like', "%{$search}%"));
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $sortField = $request->input('sort', 'created_at');
        $sortDir = $request->input('direction', 'desc');
        $query->orderBy($sortField, $sortDir);

        $penggunaan = $query->paginate(10)->withQueryString();

        return view('penggunaan.index', compact('penggunaan'));
    }

    public function create()
    {
        $kendaraan = Kendaraan::orderBy('no_plat')->get();
        $pengemudi = Pengemudi::orderBy('nama')->get();

        return view('penggunaan.create', compact('kendaraan', 'pengemudi'));
    }

    public function store(PenggunaanRequest $request)
    {
        $data = $request->validated();

        $penggunaan = Penggunaan::create($data);

        Kendaraan::where('id', $data['kendaraan_id'])->update(['status' => 'dipakai']);

        return redirect()->route('penggunaan.index')
            ->with('success', 'Penggunaan kendaraan berhasil dicatat.');
    }

    public function show(Penggunaan $penggunaan)
    {
        $penggunaan->load(['kendaraan', 'pengemudi']);

        return view('penggunaan.show', compact('penggunaan'));
    }

    public function edit(Penggunaan $penggunaan)
    {
        $kendaraan = Kendaraan::orderBy('no_plat')->get();
        $pengemudi = Pengemudi::orderBy('nama')->get();

        return view('penggunaan.edit', compact('penggunaan', 'kendaraan', 'pengemudi'));
    }

    public function update(PenggunaanRequest $request, Penggunaan $penggunaan)
    {
        $data = $request->validated();

        $oldStatus = $penggunaan->status;
        $penggunaan->update($data);

        if ($oldStatus !== 'selesai' && $data['status'] === 'selesai') {
            Kendaraan::where('id', $penggunaan->kendaraan_id)->update(['status' => 'tersedia']);
        }

        return redirect()->route('penggunaan.index')
            ->with('success', 'Penggunaan kendaraan berhasil diperbarui.');
    }

    public function destroy(Penggunaan $penggunaan)
    {
        $penggunaan->delete();

        return redirect()->route('penggunaan.index')
            ->with('success', 'Penggunaan kendaraan berhasil dihapus.');
    }
}
