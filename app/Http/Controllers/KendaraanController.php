<?php

namespace App\Http\Controllers;

use App\Http\Requests\KendaraanRequest;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kendaraan::query();

        if ($search = $request->input('search')) {
            $query->search($search);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($jenis = $request->input('jenis')) {
            $query->where('jenis', $jenis);
        }

        if ($merk = $request->input('merk')) {
            $query->where('merk', $merk);
        }

        if ($tahun = $request->input('tahun')) {
            $query->where('tahun', $tahun);
        }

        $sortField = $request->input('sort', 'created_at');
        $sortDir = $request->input('direction', 'desc');
        $query->orderBy($sortField, $sortDir);

        $kendaraan = $query->paginate(10)->withQueryString();

        $merks = Kendaraan::select('merk')->distinct()->pluck('merk');
        $tahuns = Kendaraan::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('kendaraan.index', compact('kendaraan', 'merks', 'tahuns'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(KendaraanRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kendaraan', 'public');
        }

        Kendaraan::create($data);

        return redirect()->route('kendaraan.index')
            ->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function show(Kendaraan $kendaraan)
    {
        $kendaraan->load(['servis' => fn ($q) => $q->latest()->limit(5),
            'penggunaan' => fn ($q) => $q->latest()->limit(5)]);

        return view('kendaraan.show', compact('kendaraan'));
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(KendaraanRequest $request, Kendaraan $kendaraan)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($kendaraan->foto) {
                Storage::disk('public')->delete($kendaraan->foto);
            }
            $data['foto'] = $request->file('foto')->store('kendaraan', 'public');
        }

        $kendaraan->update($data);

        return redirect()->route('kendaraan.index')
            ->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        if ($kendaraan->foto) {
            Storage::disk('public')->delete($kendaraan->foto);
        }

        $kendaraan->delete();

        return redirect()->route('kendaraan.index')
            ->with('success', 'Kendaraan berhasil dihapus.');
    }

    public function exportExcel()
    {
        return redirect()->route('kendaraan.index')
            ->with('info', 'Fitur export Excel akan segera tersedia.');
    }

    public function exportPdf()
    {
        return redirect()->route('kendaraan.index')
            ->with('info', 'Fitur export PDF akan segera tersedia.');
    }

    public function importExcel(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls|max:2048']);

        return redirect()->route('kendaraan.index')
            ->with('info', 'Fitur import Excel akan segera tersedia.');
    }
}
