<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Penggunaan Kendaraan</h5>
            <a href="{{ route('penggunaan.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah Penggunaan</a>
        </div>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari tujuan, no plat, pengemudi..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="berlangsung" {{ request('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
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
                            <th>Kendaraan</th>
                            <th>Pengemudi</th>
                            <th>Tujuan</th>
                            <th>Berangkat</th>
                            <th>Kembali</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penggunaan as $p)
                        <tr>
                            <td><strong>{{ $p->kendaraan->no_plat }}</strong></td>
                            <td>{{ $p->pengemudi->nama }}</td>
                            <td>{{ $p->tujuan }}</td>
                            <td>{{ $p->tanggal_berangkat?->format('d/m/Y') }}</td>
                            <td>{{ $p->tanggal_kembali?->format('d/m/Y') ?? '-' }}</td>
                            <td><span class="badge {{ $p->status_badge }}">{{ $p->status_label }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('penggunaan.show', $p) }}" class="btn btn-info" title="Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('penggunaan.edit', $p) }}" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-danger" title="Hapus"
                                        onclick="confirmDelete({{ $p->id }}, '{{ $p->tujuan }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $p->id }}" method="POST" action="{{ route('penggunaan.destroy', $p) }}" class="d-none">
                                    @csrf @method('delete')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-inbox fs-2 d-block text-muted"></i>
                                <small class="text-muted">Belum ada data penggunaan.</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $penggunaan->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function confirmDelete(id, tujuan) {
    if (confirm('Yakin ingin menghapus penggunaan kendaraan untuk ' + tujuan + '?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
