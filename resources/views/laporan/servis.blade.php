<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Laporan Servis</h5>
            <div>
                <a href="{{ route('laporan.servis', ['export' => 'pdf'] + request()->query()) }}" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i> Export PDF</a>
                <a href="{{ route('laporan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
        </div>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-3">
                    <input type="date" name="dari" class="form-control form-control-sm" value="{{ request('dari') }}" placeholder="Dari">
                </div>
                <div class="col-md-3">
                    <input type="date" name="sampai" class="form-control form-control-sm" value="{{ request('sampai') }}" placeholder="Sampai">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="jadwal" {{ request('status') == 'jadwal' ? 'selected' : '' }}>Jadwal</option>
                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="table-light">
                        <tr><th>Tanggal</th><th>Kendaraan</th><th>Bengkel</th><th>Jenis</th><th>Biaya</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($servis as $s)
                        <tr>
                            <td>{{ $s->tanggal?->format('d/m/Y') }}</td>
                            <td>{{ $s->kendaraan->no_plat ?? '-' }}</td>
                            <td>{{ $s->bengkel }}</td>
                            <td>{{ $s->jenis_servis }}</td>
                            <td class="text-end">Rp {{ number_format($s->biaya, 0, ',', '.') }}</td>
                            <td><span class="badge {{ $s->status_badge }}">{{ $s->status_label }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-3 text-muted">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
