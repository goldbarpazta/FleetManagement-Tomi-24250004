<?php

namespace App\Http\Controllers;

use App\Http\Requests\PajakRequest;
use App\Models\Kendaraan;
use App\Models\Pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PajakController extends Controller
{
    public function index(Request $request)
    {
        $query = Pajak::with('kendaraan');

        if ($search = $request->input('search')) {
            $query->whereHas('kendaraan', function ($q) use ($search) {
                $q->where('no_plat', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $sortField = $request->input('sort', 'tanggal_jatuh_tempo');
        $sortDir = $request->input('direction', 'desc');
        $query->orderBy($sortField, $sortDir);

        $pajak = $query->paginate(10)->withQueryString();

        return view('pajak.index', compact('pajak'));
    }

    public function create()
    {
        $kendaraans = Kendaraan::orderBy('no_plat')->get();
        return view('pajak.create', compact('kendaraans'));
    }

    public function store(PajakRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('bukti_bayar')) {
            $data['bukti_bayar'] = $request->file('bukti_bayar')->store('pajak', 'public');
        }

        Pajak::create($data);

        return redirect()->route('pajak.index')
            ->with('success', 'Pajak berhasil ditambahkan.');
    }

    public function show(Pajak $pajak)
    {
        $pajak->load('kendaraan');
        return view('pajak.show', compact('pajak'));
    }

    public function edit(Pajak $pajak)
    {
        $kendaraans = Kendaraan::orderBy('no_plat')->get();
        return view('pajak.edit', compact('pajak', 'kendaraans'));
    }

    public function update(PajakRequest $request, Pajak $pajak)
    {
        $data = $request->validated();

        if ($request->hasFile('bukti_bayar')) {
            if ($pajak->bukti_bayar) {
                Storage::disk('public')->delete($pajak->bukti_bayar);
            }
            $data['bukti_bayar'] = $request->file('bukti_bayar')->store('pajak', 'public');
        }

        $pajak->update($data);

        return redirect()->route('pajak.index')
            ->with('success', 'Pajak berhasil diperbarui.');
    }

    public function destroy(Pajak $pajak)
    {
        if ($pajak->bukti_bayar) {
            Storage::disk('public')->delete($pajak->bukti_bayar);
        }

        $pajak->delete();

        return redirect()->route('pajak.index')
            ->with('success', 'Pajak berhasil dihapus.');
    }
}
