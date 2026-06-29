<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Penggunaan Kendaraan</h5>
            <a href="{{ route('penggunaan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Informasi Penggunaan</h6></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr><td class="fw-medium" width="160">Kendaraan</td><td>{{ $penggunaan->kendaraan->no_plat }} - {{ $penggunaan->kendaraan->merk }} {{ $penggunaan->kendaraan->model }}</td></tr>
                        <tr><td class="fw-medium">Pengemudi</td><td>{{ $penggunaan->pengemudi->nama }} ({{ $penggunaan->pengemudi->nik }})</td></tr>
                        <tr><td class="fw-medium">Tujuan</td><td>{{ $penggunaan->tujuan }}</td></tr>
                        <tr><td class="fw-medium">Tanggal Berangkat</td><td>{{ $penggunaan->tanggal_berangkat?->format('d/m/Y') }}</td></tr>
                        <tr><td class="fw-medium">Tanggal Kembali</td><td>{{ $penggunaan->tanggal_kembali?->format('d/m/Y') ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">Odometer Awal</td><td>{{ number_format($penggunaan->odometer_awal) }} km</td></tr>
                        <tr><td class="fw-medium">Odometer Akhir</td><td>{{ $penggunaan->odometer_akhir ? number_format($penggunaan->odometer_akhir) . ' km' : '-' }}</td></tr>
                        <tr><td class="fw-medium">Jarak Tempuh</td>
                            <td>
                                @if($penggunaan->odometer_akhir)
                                    {{ number_format($penggunaan->odometer_akhir - $penggunaan->odometer_awal) }} km
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr><td class="fw-medium">Status</td><td><span class="badge {{ $penggunaan->status_badge }}">{{ $penggunaan->status_label }}</span></td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Status Timeline</h6></div>
                <div class="card-body">
                    <ul class="timeline" style="list-style:none;padding-left:0;position:relative;">
                        <li class="mb-3" style="padding-left:30px;position:relative;">
                            <div style="position:absolute;left:0;top:4px;width:16px;height:16px;border-radius:50%;background:#ffc107;border:2px solid #fff;box-shadow:0 0 0 2px #ffc107;"></div>
                            <strong>Berangkat</strong><br>
                            <small class="text-muted">{{ $penggunaan->tanggal_berangkat?->format('d/m/Y H:i') }}</small>
                        </li>
                        @if($penggunaan->tanggal_kembali)
                        <li class="mb-3" style="padding-left:30px;position:relative;">
                            <div style="position:absolute;left:0;top:4px;width:16px;height:16px;border-radius:50%;background:#198754;border:2px solid #fff;box-shadow:0 0 0 2px #198754;"></div>
                            <strong>Kembali</strong><br>
                            <small class="text-muted">{{ $penggunaan->tanggal_kembali?->format('d/m/Y') }}</small>
                        </li>
                        @endif
                        <li class="mb-3" style="padding-left:30px;position:relative;">
                            @php
                                $dotColor = $penggunaan->status === 'selesai' ? '#198754' : ($penggunaan->status === 'dibatalkan' ? '#dc3545' : '#ffc107');
                                $lineColor = $penggunaan->status === 'selesai' ? '#198754' : ($penggunaan->status === 'dibatalkan' ? '#dc3545' : '#ffc107');
                            @endphp
                            <div style="position:absolute;left:0;top:4px;width:16px;height:16px;border-radius:50%;background:{{ $dotColor }};border:2px solid #fff;box-shadow:0 0 0 2px {{ $lineColor }};"></div>
                            <strong>Status: {{ $penggunaan->status_label }}</strong><br>
                            <small class="text-muted">{{ $penggunaan->updated_at?->format('d/m/Y H:i') }}</small>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Informasi Kendaraan</h6></div>
                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <tr><td class="fw-medium" width="140">No. Plat</td><td>{{ $penggunaan->kendaraan->no_plat }}</td></tr>
                        <tr><td class="fw-medium">Merk</td><td>{{ $penggunaan->kendaraan->merk }}</td></tr>
                        <tr><td class="fw-medium">Model</td><td>{{ $penggunaan->kendaraan->model }}</td></tr>
                        <tr><td class="fw-medium">Status</td><td><span class="badge {{ $penggunaan->kendaraan->status_badge }}">{{ $penggunaan->kendaraan->status_label }}</span></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
