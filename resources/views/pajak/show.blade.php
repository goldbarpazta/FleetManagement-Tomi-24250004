<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Pajak</h5>
            <a href="{{ route('pajak.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Informasi Pajak</h6></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr><td class="fw-medium" width="180">Kendaraan</td><td><strong>{{ $pajak->kendaraan->no_plat }}</strong> - {{ $pajak->kendaraan->merk }} {{ $pajak->kendaraan->model }}</td></tr>
                        <tr><td class="fw-medium">Tanggal Jatuh Tempo</td><td>{{ $pajak->tanggal_jatuh_tempo?->format('d/m/Y') }}</td></tr>
                        <tr><td class="fw-medium">Biaya</td><td>Rp {{ number_format($pajak->biaya, 2) }}</td></tr>
                        <tr><td class="fw-medium">Status</td><td><span class="badge {{ $pajak->status_badge }}">{{ $pajak->status_label }}</span></td></tr>
                        <tr><td class="fw-medium">Bukti Bayar</td>
                            <td>
                                @if($pajak->bukti_bayar)
                                    <a href="{{ asset('storage/' . $pajak->bukti_bayar) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="bi bi-paperclip"></i> Lihat File</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr><td class="fw-medium">Dibuat</td><td>{{ $pajak->created_at?->format('d/m/Y H:i') }}</td></tr>
                        <tr><td class="fw-medium">Diperbarui</td><td>{{ $pajak->updated_at?->format('d/m/Y H:i') }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Info Kendaraan</h6></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr><td class="fw-medium" width="150">No. Plat</td><td>{{ $pajak->kendaraan->no_plat }}</td></tr>
                        <tr><td class="fw-medium">Merk / Model</td><td>{{ $pajak->kendaraan->merk }} {{ $pajak->kendaraan->model }}</td></tr>
                        <tr><td class="fw-medium">Tahun</td><td>{{ $pajak->kendaraan->tahun }}</td></tr>
                        <tr><td class="fw-medium">Jenis</td><td>{{ $pajak->kendaraan->jenis_label }}</td></tr>
                        <tr><td class="fw-medium">Status</td><td><span class="badge {{ $pajak->kendaraan->status_badge }}">{{ $pajak->kendaraan->status_label }}</span></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
