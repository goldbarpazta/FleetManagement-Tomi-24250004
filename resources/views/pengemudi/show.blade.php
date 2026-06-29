<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Pengemudi: {{ $pengemudi->nama }}</h5>
            <a href="{{ route('pengemudi.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="row g-3">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    @if($pengemudi->foto)
                        <img src="{{ asset('storage/'.$pengemudi->foto) }}" class="img-fluid rounded mb-3" style="max-height:200px">
                    @else
                        <i class="bi bi-person-circle fs-1 d-block mb-3 text-muted"></i>
                    @endif
                    <h5>{{ $pengemudi->nama }}</h5>
                    <span class="badge {{ $pengemudi->status_badge }}">{{ $pengemudi->status_label }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Informasi Pengemudi</h6></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr><td class="fw-medium" width="150">NIK</td><td>{{ $pengemudi->nik }}</td></tr>
                        <tr><td class="fw-medium">No. HP</td><td>{{ $pengemudi->no_hp ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">Email</td><td>{{ $pengemudi->email ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">Alamat</td><td>{{ $pengemudi->alamat ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">Nomor SIM</td><td>{{ $pengemudi->nomor_sim ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">Jenis SIM</td><td>{{ $pengemudi->jenis_sim ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">Berlaku SIM</td><td>{{ $pengemudi->tanggal_berlaku_sim?->format('d/m/Y') ?? '-' }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Riwayat Penggunaan Kendaraan</h6></div>
                <div class="card-body p-0">
                    @if($pengemudi->penggunaan->count())
                    <table class="table table-sm mb-0">
                        <thead><tr><th>Kendaraan</th><th>Tujuan</th><th>Berangkat</th><th>Kembali</th></tr></thead>
                        <tbody>
                            @foreach($pengemudi->penggunaan as $p)
                            <tr>
                                <td>{{ $p->kendaraan->no_plat ?? '-' }}</td>
                                <td>{{ $p->tujuan }}</td>
                                <td>{{ $p->tanggal_berangkat?->format('d/m/Y') }}</td>
                                <td>{{ $p->tanggal_kembali?->format('d/m/Y') ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted text-center py-3 mb-0"><small>Belum ada riwayat penggunaan.</small></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
