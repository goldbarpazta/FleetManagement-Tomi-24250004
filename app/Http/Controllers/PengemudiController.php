<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengemudiRequest;
use App\Models\Pengemudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengemudiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengemudi::query();

        if ($search = $request->input('search')) {
            $query->search($search);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $sortField = $request->input('sort', 'created_at');
        $sortDir = $request->input('direction', 'desc');
        $query->orderBy($sortField, $sortDir);

        $pengemudi = $query->paginate(10)->withQueryString();

        return view('pengemudi.index', compact('pengemudi'));
    }

    public function create()
    {
        return view('pengemudi.create');
    }

    public function store(PengemudiRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengemudi', 'public');
        }

        Pengemudi::create($data);

        return redirect()->route('pengemudi.index')
            ->with('success', 'Pengemudi berhasil ditambahkan.');
    }

    public function show(Pengemudi $pengemudi)
    {
        $pengemudi->load(['penggunaan' => fn ($q) => $q->with('kendaraan')->latest()->limit(10)]);

        return view('pengemudi.show', compact('pengemudi'));
    }

    public function edit(Pengemudi $pengemudi)
    {
        return view('pengemudi.edit', compact('pengemudi'));
    }

    public function update(PengemudiRequest $request, Pengemudi $pengemudi)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($pengemudi->foto) {
                Storage::disk('public')->delete($pengemudi->foto);
            }
            $data['foto'] = $request->file('foto')->store('pengemudi', 'public');
        }

        $pengemudi->update($data);

        return redirect()->route('pengemudi.index')
            ->with('success', 'Pengemudi berhasil diperbarui.');
    }

    public function destroy(Pengemudi $pengemudi)
    {
        if ($pengemudi->foto) {
            Storage::disk('public')->delete($pengemudi->foto);
        }

        $pengemudi->delete();

        return redirect()->route('pengemudi.index')
            ->with('success', 'Pengemudi berhasil dihapus.');
    }
}
