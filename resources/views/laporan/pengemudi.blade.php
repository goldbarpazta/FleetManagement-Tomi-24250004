<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Laporan Pengemudi</h5>
            <a href="{{ route('laporan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="table-light">
                        <tr><th>Nama</th><th>NIK</th><th>No. HP</th><th>SIM</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($pengemudi as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->nik }}</td>
                            <td>{{ $p->no_hp ?? '-' }}</td>
                            <td>{{ $p->jenis_sim ?? '-' }}</td>
                            <td><span class="badge {{ $p->status_badge }}">{{ $p->status_label }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-3 text-muted">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
