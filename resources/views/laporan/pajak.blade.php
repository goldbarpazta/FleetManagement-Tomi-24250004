<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Laporan Pajak</h5>
            <div>
                <a href="{{ route('laporan.pajak', ['export' => 'pdf'] + request()->query()) }}" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i> Export PDF</a>
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
                        <option value="belum_dibayar" {{ request('status') == 'belum_dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                        <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="denda" {{ request('status') == 'denda' ? 'selected' : '' }}>Denda</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="table-light">
                        <tr><th>Kendaraan</th><th>Jatuh Tempo</th><th>Biaya</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($pajak as $p)
                        <tr>
                            <td>{{ $p->kendaraan->no_plat ?? '-' }}</td>
                            <td>{{ $p->tanggal_jatuh_tempo?->format('d/m/Y') }}</td>
                            <td class="text-end">Rp {{ number_format($p->biaya, 0, ',', '.') }}</td>
                            <td><span class="badge {{ $p->status_badge }}">{{ $p->status_label }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-3 text-muted">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
