<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Laporan Penggunaan Kendaraan</h5>
            <div>
                <a href="{{ route('laporan.penggunaan', ['export' => 'pdf'] + request()->query()) }}" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i> Export PDF</a>
                <a href="{{ route('laporan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
        </div>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="berlangsung" {{ request('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="table-light">
                        <tr><th>Kendaraan</th><th>Pengemudi</th><th>Tujuan</th><th>Berangkat</th><th>Kembali</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($penggunaan as $p)
                        <tr>
                            <td>{{ $p->kendaraan->no_plat ?? '-' }}</td>
                            <td>{{ $p->pengemudi->nama ?? '-' }}</td>
                            <td>{{ $p->tujuan }}</td>
                            <td>{{ $p->tanggal_berangkat?->format('d/m/Y') }}</td>
                            <td>{{ $p->tanggal_kembali?->format('d/m/Y') ?? '-' }}</td>
                            <td><span class="badge {{ $p->status_badge }}">{{ $p->status_label }}</span></td>
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
