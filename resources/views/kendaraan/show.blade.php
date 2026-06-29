<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Kendaraan: {{ $kendaraan->no_plat }}</h5>
            <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Informasi Kendaraan</h6></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr><td class="fw-medium" width="150">No. Plat</td><td>{{ $kendaraan->no_plat }}</td></tr>
                        <tr><td class="fw-medium">No. Polisi</td><td>{{ $kendaraan->no_polisi ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">Merk</td><td>{{ $kendaraan->merk }}</td></tr>
                        <tr><td class="fw-medium">Model</td><td>{{ $kendaraan->model }}</td></tr>
                        <tr><td class="fw-medium">Jenis</td><td>{{ $kendaraan->jenis_label }}</td></tr>
                        <tr><td class="fw-medium">Kategori</td><td>{{ $kendaraan->kategori }}</td></tr>
                        <tr><td class="fw-medium">Tahun</td><td>{{ $kendaraan->tahun }}</td></tr>
                        <tr><td class="fw-medium">Warna</td><td>{{ $kendaraan->warna ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">No. Mesin</td><td>{{ $kendaraan->no_mesin ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">No. Rangka</td><td>{{ $kendaraan->no_rangka ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">VIN</td><td>{{ $kendaraan->vin ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">Kapasitas Mesin</td><td>{{ $kendaraan->kapasitas_mesin ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">Bahan Bakar</td><td>{{ $kendaraan->bahan_bakar ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">Transmisi</td><td>{{ $kendaraan->transmisi ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">Kilometer</td><td>{{ number_format($kendaraan->kilometer) }} km</td></tr>
                        <tr><td class="fw-medium">Status</td><td><span class="badge {{ $kendaraan->status_badge }}">{{ $kendaraan->status_label }}</span></td></tr>
                        <tr><td class="fw-medium">Pajak</td><td>{{ $kendaraan->tanggal_pajak?->format('d/m/Y') ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">STNK</td><td>{{ $kendaraan->tanggal_stnk?->format('d/m/Y') ?? '-' }}</td></tr>
                        <tr><td class="fw-medium">KIR</td><td>{{ $kendaraan->tanggal_kir?->format('d/m/Y') ?? '-' }}</td></tr>
                    </table>
                    @if($kendaraan->catatan)
                        <div class="mt-2">
                            <strong>Catatan:</strong>
                            <p class="mb-0">{{ $kendaraan->catatan }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @if($kendaraan->foto)
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-white"><h6 class="mb-0 fw-bold">Foto</h6></div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $kendaraan->foto) }}" class="img-fluid rounded" style="max-height:300px">
                </div>
            </div>
            @endif

            <div class="card shadow-sm mb-3">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">Riwayat Servis</h6>
                    @if(Route::has('servis.create'))
                    <a href="{{ route('servis.create', ['kendaraan_id' => $kendaraan->id]) }}" class="btn btn-sm btn-outline-primary">Tambah Servis</a>
                    @endif
                </div>
                <div class="card-body p-0">
                    @if($kendaraan->servis->count())
                    <table class="table table-sm mb-0">
                        <thead><tr><th>Tanggal</th><th>Jenis</th><th>Biaya</th></tr></thead>
                        <tbody>
                            @foreach($kendaraan->servis as $s)
                            <tr>
                                <td>{{ $s->tanggal?->format('d/m/Y') }}</td>
                                <td>{{ $s->jenis_servis }}</td>
                                <td class="text-end">{{ number_format($s->biaya) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted text-center py-3 mb-0"><small>Belum ada riwayat servis.</small></p>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">Riwayat Penggunaan</h6>
                    @if(Route::has('penggunaan.create'))
                    <a href="{{ route('penggunaan.create', ['kendaraan_id' => $kendaraan->id]) }}" class="btn btn-sm btn-outline-primary">Tambah Penggunaan</a>
                    @endif
                </div>
                <div class="card-body p-0">
                    @if($kendaraan->penggunaan->count())
                    <table class="table table-sm mb-0">
                        <thead><tr><th>Tujuan</th><th>Berangkat</th><th>Kembali</th></tr></thead>
                        <tbody>
                            @foreach($kendaraan->penggunaan as $p)
                            <tr>
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
