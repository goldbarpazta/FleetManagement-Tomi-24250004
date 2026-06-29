<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Servis</h5>
            <a href="{{ route('servis.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="row g-3">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Informasi Servis</h6></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr><td class="fw-medium" width="160">Kendaraan</td><td>
                            <a href="{{ route('kendaraan.show', $servi->kendaraan_id) }}" class="text-decoration-none">
                                <strong>{{ $servi->kendaraan->no_plat }}</strong> - {{ $servi->kendaraan->merk }} {{ $servi->kendaraan->model }}
                            </a>
                        </td></tr>
                        <tr><td class="fw-medium">Tanggal</td><td>{{ $servi->tanggal?->format('d/m/Y') }}</td></tr>
                        <tr><td class="fw-medium">Bengkel</td><td>{{ $servi->bengkel }}</td></tr>
                        <tr><td class="fw-medium">Jenis Servis</td><td>{{ $servi->jenis_servis }}</td></tr>
                        <tr><td class="fw-medium">Odometer</td><td>{{ number_format($servi->odometer) }} km</td></tr>
                        <tr><td class="fw-medium">Biaya</td><td>Rp {{ number_format($servi->biaya, 2) }}</td></tr>
                        <tr><td class="fw-medium">Status</td><td><span class="badge {{ $servi->status_badge }}">{{ $servi->status_label }}</span></td></tr>
                    </table>
                    @if($servi->catatan)
                        <div class="mt-2">
                            <strong>Catatan:</strong>
                            <p class="mb-0">{{ $servi->catatan }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @if($servi->file_invoice)
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Invoice</h6></div>
                <div class="card-body text-center">
                    <a href="{{ asset('storage/' . $servi->file_invoice) }}" target="_blank" class="btn btn-primary">
                        <i class="bi bi-download me-1"></i> Download Invoice
                    </a>
                </div>
            </div>
            @endif

            @if($servi->file_foto)
            <div class="card shadow-sm">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Foto</h6></div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $servi->file_foto) }}" class="img-fluid rounded" style="max-height:300px">
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
