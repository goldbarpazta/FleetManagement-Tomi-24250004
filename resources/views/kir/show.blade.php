<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail KIR: {{ $kir->kendaraan->no_plat }}</h5>
            <a href="{{ route('kir.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Informasi KIR</h6></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr><td class="fw-medium" width="180">Kendaraan</td><td>{{ $kir->kendaraan->no_plat }} - {{ $kir->kendaraan->merk }} {{ $kir->kendaraan->model }}</td></tr>
                        <tr><td class="fw-medium">Tanggal Berlaku</td><td>{{ $kir->tanggal_berlaku?->format('d/m/Y') }}</td></tr>
                        <tr><td class="fw-medium">Tanggal Habis</td><td>{{ $kir->tanggal_habis?->format('d/m/Y') }}</td></tr>
                        <tr><td class="fw-medium">Sisa Masa Berlaku</td>
                            <td>
                                @php
                                    $diff = now()->diffInDays($kir->tanggal_habis, false);
                                @endphp
                                @if($diff > 0)
                                    <span class="text-success">{{ floor($diff) }} hari</span>
                                @elseif($diff == 0)
                                    <span class="text-warning">Habis hari ini</span>
                                @else
                                    <span class="text-danger">{{ abs(floor($diff)) }} hari lewat</span>
                                @endif
                            </td>
                        </tr>
                        <tr><td class="fw-medium">Status</td><td><span class="badge {{ $kir->status_badge }}">{{ $kir->status_label }}</span></td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Dokumen</h6></div>
                <div class="card-body text-center">
                    @if($kir->dokumen)
                        @php
                            $ext = pathinfo($kir->dokumen, PATHINFO_EXTENSION);
                        @endphp
                        @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                            <img src="{{ asset('storage/' . $kir->dokumen) }}" class="img-fluid rounded" style="max-height:300px">
                        @else
                            <a href="{{ asset('storage/' . $kir->dokumen) }}" target="_blank" class="btn btn-outline-info">
                                <i class="bi bi-file-earmark-pdf fs-1 d-block"></i>
                                Lihat Dokumen PDF
                            </a>
                        @endif
                    @else
                        <p class="text-muted py-3 mb-0"><small>Tidak ada dokumen.</small></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
