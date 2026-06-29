<?php

namespace App\Http\Controllers;

use App\Http\Requests\KirRequest;
use App\Models\Kendaraan;
use App\Models\Kir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KirController extends Controller
{
    public function index(Request $request)
    {
        $query = Kir::with('kendaraan');

        if ($search = $request->input('search')) {
            $query->whereHas('kendaraan', function ($q) use ($search) {
                $q->where('no_plat', 'like', "%{$search}%")
                  ->orWhere('merk', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $query->orderBy('created_at', 'desc');

        $kir = $query->paginate(10)->withQueryString();

        return view('kir.index', compact('kir'));
    }

    public function create()
    {
        $kendaraan = Kendaraan::orderBy('no_plat')->get();

        return view('kir.create', compact('kendaraan'));
    }

    public function store(KirRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('dokumen')) {
            $data['dokumen'] = $request->file('dokumen')->store('kir', 'public');
        }

        Kir::create($data);

        return redirect()->route('kir.index')
            ->with('success', 'KIR berhasil ditambahkan.');
    }

    public function show(Kir $kir)
    {
        $kir->load('kendaraan');

        return view('kir.show', compact('kir'));
    }

    public function edit(Kir $kir)
    {
        $kendaraan = Kendaraan::orderBy('no_plat')->get();

        return view('kir.edit', compact('kir', 'kendaraan'));
    }

    public function update(KirRequest $request, Kir $kir)
    {
        $data = $request->validated();

        if ($request->hasFile('dokumen')) {
            if ($kir->dokumen) {
                Storage::disk('public')->delete($kir->dokumen);
            }
            $data['dokumen'] = $request->file('dokumen')->store('kir', 'public');
        }

        $kir->update($data);

        return redirect()->route('kir.index')
            ->with('success', 'KIR berhasil diperbarui.');
    }

    public function destroy(Kir $kir)
    {
        if ($kir->dokumen) {
            Storage::disk('public')->delete($kir->dokumen);
        }

        $kir->delete();

        return redirect()->route('kir.index')
            ->with('success', 'KIR berhasil dihapus.');
    }
}
