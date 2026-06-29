<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pengemudi;
use App\Models\Penggunaan;
use App\Models\Servis;
use App\Models\Pajak;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function kendaraan(Request $request)
    {
        $query = Kendaraan::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $kendaraan = $query->orderBy('merk')->get();

        if ($request->input('export') === 'pdf') {
            $pdf = Pdf::loadView('laporan.export-kendaraan', compact('kendaraan'));
            return $pdf->download('laporan-kendaraan-' . date('Y-m-d') . '.pdf');
        }

        return view('laporan.kendaraan', compact('kendaraan'));
    }

    public function servis(Request $request)
    {
        $query = Servis::with('kendaraan');

        if ($request->filled('dari')) {
            $query->whereDate('tanggal', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('tanggal', '<=', $request->sampai);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $servis = $query->orderBy('tanggal', 'desc')->get();

        if ($request->input('export') === 'pdf') {
            $pdf = Pdf::loadView('laporan.export-servis', compact('servis'));
            return $pdf->download('laporan-servis-' . date('Y-m-d') . '.pdf');
        }

        return view('laporan.servis', compact('servis'));
    }

    public function pajak(Request $request)
    {
        $query = Pajak::with('kendaraan');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pajak = $query->orderBy('tanggal_jatuh_tempo', 'desc')->get();

        if ($request->input('export') === 'pdf') {
            $pdf = Pdf::loadView('laporan.export-pajak', compact('pajak'));
            return $pdf->download('laporan-pajak-' . date('Y-m-d') . '.pdf');
        }

        return view('laporan.pajak', compact('pajak'));
    }

    public function penggunaan(Request $request)
    {
        $query = Penggunaan::with('kendaraan', 'pengemudi');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $penggunaan = $query->orderBy('created_at', 'desc')->get();

        if ($request->input('export') === 'pdf') {
            $pdf = Pdf::loadView('laporan.export-penggunaan', compact('penggunaan'));
            return $pdf->download('laporan-penggunaan-' . date('Y-m-d') . '.pdf');
        }

        return view('laporan.penggunaan', compact('penggunaan'));
    }

    public function pengemudi(Request $request)
    {
        $query = Pengemudi::query();

        $pengemudi = $query->orderBy('nama')->get();

        return view('laporan.pengemudi', compact('pengemudi'));
    }
}
