<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Servis</h5>
            <a href="{{ route('servis.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah Servis</a>
        </div>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kendaraan, bengkel, jenis servis..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="jadwal" {{ request('status') == 'jadwal' ? 'selected' : '' }}>Terjadwal</option>
                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="kendaraan_id" class="form-select form-select-sm">
                        <option value="">Semua Kendaraan</option>
                        @foreach($kendaraans as $k)
                            <option value="{{ $k->id }}" {{ request('kendaraan_id') == $k->id ? 'selected' : '' }}>{{ $k->no_plat }} - {{ $k->merk }} {{ $k->model }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary btn-sm w-100"><i class="bi bi-search"></i></button>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('servis.index') }}" class="btn btn-secondary btn-sm w-100"><i class="bi bi-x-lg"></i></a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Kendaraan</th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'tanggal', 'direction' => request('sort') == 'tanggal' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">Tanggal</a></th>
                            <th>Bengkel</th>
                            <th>Jenis Servis</th>
                            <th>Odometer</th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'biaya', 'direction' => request('sort') == 'biaya' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">Biaya</a></th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($servis as $s)
                        <tr>
                            <td>
                                <a href="{{ route('kendaraan.show', $s->kendaraan_id) }}" class="text-decoration-none">
                                    <strong>{{ $s->kendaraan->no_plat }}</strong>
                                    <br><small class="text-muted">{{ $s->kendaraan->merk }} {{ $s->kendaraan->model }}</small>
                                </a>
                            </td>
                            <td>{{ $s->tanggal?->format('d/m/Y') }}</td>
                            <td>{{ $s->bengkel }}</td>
                            <td>{{ $s->jenis_servis }}</td>
                            <td>{{ number_format($s->odometer) }} km</td>
                            <td>Rp {{ number_format($s->biaya, 2) }}</td>
                            <td><span class="badge {{ $s->status_badge }}">{{ $s->status_label }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('servis.show', $s) }}" class="btn btn-info" title="Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('servis.edit', $s) }}" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-danger" title="Hapus"
                                        onclick="confirmDelete({{ $s->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $s->id }}" method="POST" action="{{ route('servis.destroy', $s) }}" class="d-none">
                                    @csrf @method('delete')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="bi bi-inbox fs-2 d-block text-muted"></i>
                                <small class="text-muted">Belum ada data servis.</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $servis->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function confirmDelete(id) {
    if (confirm('Yakin ingin menghapus data servis ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
