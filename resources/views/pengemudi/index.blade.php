<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Pengemudi</h5>
            <a href="{{ route('pengemudi.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah Pengemudi</a>
        </div>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama, NIK, no HP..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
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
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>No. HP</th>
                            <th>SIM</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengemudi as $p)
                        <tr>
                            <td><strong>{{ $p->nama }}</strong></td>
                            <td>{{ $p->nik }}</td>
                            <td>{{ $p->no_hp ?? '-' }}</td>
                            <td>{{ $p->jenis_sim ?? '-' }}</td>
                            <td><span class="badge {{ $p->status_badge }}">{{ $p->status_label }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('pengemudi.show', $p) }}" class="btn btn-info" title="Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('pengemudi.edit', $p) }}" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-danger" title="Hapus"
                                        onclick="if(confirm('Yakin ingin menghapus {{ $p->nama }}?')){document.getElementById('delete-{{ $p->id }}').submit();}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-{{ $p->id }}" method="POST" action="{{ route('pengemudi.destroy', $p) }}" class="d-none">@csrf @method('delete')</form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="bi bi-inbox fs-2 d-block text-muted"></i>
                                <small class="text-muted">Belum ada data pengemudi.</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $pengemudi->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
