<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServisRequest;
use App\Models\Kendaraan;
use App\Models\Servis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServisController extends Controller
{
    public function index(Request $request)
    {
        $query = Servis::with('kendaraan');

        if ($search = $request->input('search')) {
            $query->whereHas('kendaraan', function ($q) use ($search) {
                $q->where('no_plat', 'like', "%{$search}%")
                  ->orWhere('merk', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            })->orWhere('bengkel', 'like', "%{$search}%")
              ->orWhere('jenis_servis', 'like', "%{$search}%");
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($kendaraanId = $request->input('kendaraan_id')) {
            $query->where('kendaraan_id', $kendaraanId);
        }

        $sortField = $request->input('sort', 'tanggal');
        $sortDir = $request->input('direction', 'desc');
        $query->orderBy($sortField, $sortDir);

        $servis = $query->paginate(10)->withQueryString();
        $kendaraans = Kendaraan::select('id', 'no_plat', 'merk', 'model')->orderBy('no_plat')->get();

        return view('servis.index', compact('servis', 'kendaraans'));
    }

    public function create()
    {
        $kendaraans = Kendaraan::orderBy('no_plat')->get();
        return view('servis.create', compact('kendaraans'));
    }

    public function store(ServisRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file_invoice')) {
            $data['file_invoice'] = $request->file('file_invoice')->store('servis/invoice', 'public');
        }

        if ($request->hasFile('file_foto')) {
            $data['file_foto'] = $request->file('file_foto')->store('servis/foto', 'public');
        }

        Servis::create($data);

        return redirect()->route('servis.index')
            ->with('success', 'Servis berhasil ditambahkan.');
    }

    public function show(Servis $servi)
    {
        $servi->load('kendaraan');
        return view('servis.show', compact('servi'));
    }

    public function edit(Servis $servi)
    {
        $kendaraans = Kendaraan::orderBy('no_plat')->get();
        return view('servis.edit', compact('servi', 'kendaraans'));
    }

    public function update(ServisRequest $request, Servis $servi)
    {
        $data = $request->validated();

        if ($request->hasFile('file_invoice')) {
            if ($servi->file_invoice) {
                Storage::disk('public')->delete($servi->file_invoice);
            }
            $data['file_invoice'] = $request->file('file_invoice')->store('servis/invoice', 'public');
        }

        if ($request->hasFile('file_foto')) {
            if ($servi->file_foto) {
                Storage::disk('public')->delete($servi->file_foto);
            }
            $data['file_foto'] = $request->file('file_foto')->store('servis/foto', 'public');
        }

        $servi->update($data);

        return redirect()->route('servis.index')
            ->with('success', 'Servis berhasil diperbarui.');
    }

    public function destroy(Servis $servi)
    {
        if ($servi->file_invoice) {
            Storage::disk('public')->delete($servi->file_invoice);
        }

        if ($servi->file_foto) {
            Storage::disk('public')->delete($servi->file_foto);
        }

        $servi->delete();

        return redirect()->route('servis.index')
            ->with('success', 'Servis berhasil dihapus.');
    }
}
