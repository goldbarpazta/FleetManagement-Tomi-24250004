<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data KIR</h5>
            <a href="{{ route('kir.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah KIR</a>
        </div>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari no plat, merk..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="berlaku" {{ request('status') == 'berlaku' ? 'selected' : '' }}>Berlaku</option>
                        <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
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
                            <th>No. Plat</th>
                            <th>Tanggal Berlaku</th>
                            <th>Tanggal Habis</th>
                            <th>Sisa Masa Berlaku</th>
                            <th>Status</th>
                            <th>Dokumen</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kir as $k)
                        <tr>
                            <td><strong>{{ $k->kendaraan->no_plat }}</strong></td>
                            <td>{{ $k->tanggal_berlaku?->format('d/m/Y') }}</td>
                            <td>{{ $k->tanggal_habis?->format('d/m/Y') }}</td>
                            <td>
                                @php
                                    $diff = now()->diffInDays($k->tanggal_habis, false);
                                @endphp
                                @if($diff > 0)
                                    <span class="text-success">{{ floor($diff) }} hari</span>
                                @elseif($diff == 0)
                                    <span class="text-warning">Habis hari ini</span>
                                @else
                                    <span class="text-danger">{{ abs(floor($diff)) }} hari lewat</span>
                                @endif
                            </td>
                            <td><span class="badge {{ $k->status_badge }}">{{ $k->status_label }}</span></td>
                            <td>
                                @if($k->dokumen)
                                    <a href="{{ asset('storage/' . $k->dokumen) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="bi bi-file-earmark"></i></a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('kir.show', $k) }}" class="btn btn-info" title="Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('kir.edit', $k) }}" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-danger" title="Hapus"
                                        onclick="confirmDelete({{ $k->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $k->id }}" method="POST" action="{{ route('kir.destroy', $k) }}" class="d-none">
                                    @csrf @method('delete')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-inbox fs-2 d-block text-muted"></i>
                                <small class="text-muted">Belum ada data KIR.</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $kir->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function confirmDelete(id) {
    if (confirm('Yakin ingin menghapus data KIR ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
