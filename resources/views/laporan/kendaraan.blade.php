<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Laporan Kendaraan</h5>
            <div>
                <a href="{{ route('laporan.kendaraan', ['export' => 'pdf'] + request()->query()) }}" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i> Export PDF</a>
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
                        <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="dipakai" {{ request('status') == 'dipakai' ? 'selected' : '' }}>Dipakai</option>
                        <option value="servis" {{ request('status') == 'servis' ? 'selected' : '' }}>Servis</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="jenis" class="form-select form-select-sm">
                        <option value="">Semua Jenis</option>
                        <option value="mobil" {{ request('jenis') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                        <option value="motor" {{ request('jenis') == 'motor' ? 'selected' : '' }}>Motor</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="table-light">
                        <tr><th>No. Plat</th><th>Merk/Model</th><th>Jenis</th><th>Tahun</th><th>Kilometer</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($kendaraan as $k)
                        <tr>
                            <td>{{ $k->no_plat }}</td>
                            <td>{{ $k->merk }} {{ $k->model }}</td>
                            <td>{{ $k->jenis_label }}</td>
                            <td>{{ $k->tahun }}</td>
                            <td>{{ number_format($k->kilometer) }} km</td>
                            <td><span class="badge {{ $k->status_badge }}">{{ $k->status_label }}</span></td>
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
