<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Pajak Kendaraan</h5>
            <a href="{{ route('pajak.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah Pajak</a>
        </div>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari no plat..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="belum_dibayar" {{ request('status') == 'belum_dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                        <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="denda" {{ request('status') == 'denda' ? 'selected' : '' }}>Denda</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm w-100"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'kendaraan_id', 'direction' => request('sort') == 'kendaraan_id' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">Kendaraan</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'tanggal_jatuh_tempo', 'direction' => request('sort') == 'tanggal_jatuh_tempo' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">Jatuh Tempo</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'biaya', 'direction' => request('sort') == 'biaya' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">Biaya</a></th>
                            <th>Status</th>
                            <th>Bukti</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pajak as $p)
                        <tr>
                            <td><strong>{{ $p->kendaraan->no_plat }}</strong><br><small class="text-muted">{{ $p->kendaraan->merk }} {{ $p->kendaraan->model }}</small></td>
                            <td>{{ $p->tanggal_jatuh_tempo?->format('d/m/Y') }}</td>
                            <td class="text-end">Rp {{ number_format($p->biaya, 2) }}</td>
                            <td><span class="badge {{ $p->status_badge }}">{{ $p->status_label }}</span></td>
                            <td>
                                @if($p->bukti_bayar)
                                    <a href="{{ asset('storage/' . $p->bukti_bayar) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="bi bi-paperclip"></i></a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('pajak.show', $p) }}" class="btn btn-info" title="Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('pajak.edit', $p) }}" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-danger" title="Hapus"
                                        onclick="confirmDelete({{ $p->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $p->id }}" method="POST" action="{{ route('pajak.destroy', $p) }}" class="d-none">
                                    @csrf @method('delete')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="bi bi-inbox fs-2 d-block text-muted"></i>
                                <small class="text-muted">Belum ada data pajak.</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $pajak->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function confirmDelete(id) {
    if (confirm('Yakin ingin menghapus data pajak ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
