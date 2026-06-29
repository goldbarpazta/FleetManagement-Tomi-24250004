<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Kendaraan</h5>
            <div>
                <a href="{{ route('kendaraan.export-excel') }}" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-excel"></i> Export Excel</a>
                <a href="{{ route('kendaraan.export-pdf') }}" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i> Export PDF</a>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#importModal"><i class="bi bi-upload"></i> Import Excel</button>
                <a href="{{ route('kendaraan.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah Kendaraan</a>
            </div>
        </div>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari no plat, merk, model..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
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
                    <select name="merk" class="form-select form-select-sm">
                        <option value="">Semua Merk</option>
                        @foreach($merks as $m)
                            <option value="{{ $m }}" {{ request('merk') == $m ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="tahun" class="form-select form-select-sm">
                        <option value="">Semua Tahun</option>
                        @foreach($tahuns as $t)
                            <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary btn-sm w-100"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'no_plat', 'direction' => request('sort') == 'no_plat' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">No. Plat</a></th>
                            <th>Merk / Model</th>
                            <th>Jenis</th>
                            <th>Tahun</th>
                            <th>Kilometer</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kendaraan as $k)
                        <tr>
                            <td><strong>{{ $k->no_plat }}</strong></td>
                            <td>{{ $k->merk }} {{ $k->model }}</td>
                            <td>{{ $k->jenis_label }}</td>
                            <td>{{ $k->tahun }}</td>
                            <td>{{ number_format($k->kilometer) }} km</td>
                            <td><span class="badge {{ $k->status_badge }}">{{ $k->status_label }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('kendaraan.show', $k) }}" class="btn btn-info" title="Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('kendaraan.edit', $k) }}" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-danger" title="Hapus"
                                        onclick="confirmDelete({{ $k->id }}, '{{ $k->no_plat }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $k->id }}" method="POST" action="{{ route('kendaraan.destroy', $k) }}" class="d-none">
                                    @csrf @method('delete')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-inbox fs-2 d-block text-muted"></i>
                                <small class="text-muted">Belum ada data kendaraan.</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $kendaraan->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('kendaraan.import-excel') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Import Excel Kendaraan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">File Excel</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function confirmDelete(id, plat) {
    if (confirm('Yakin ingin menghapus kendaraan ' + plat + '?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
