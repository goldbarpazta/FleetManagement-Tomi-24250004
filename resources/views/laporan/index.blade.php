<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0">Laporan</h5>
    </x-slot>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center py-4">
                    <i class="bi bi-truck fs-1 text-primary"></i>
                    <h6 class="mt-2">Laporan Kendaraan</h6>
                    <p class="text-muted small">Data seluruh kendaraan</p>
                    <a href="{{ route('laporan.kendaraan') }}" class="btn btn-outline-primary btn-sm">Buka</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center py-4">
                    <i class="bi bi-wrench fs-1 text-success"></i>
                    <h6 class="mt-2">Laporan Servis</h6>
                    <p class="text-muted small">Riwayat servis kendaraan</p>
                    <a href="{{ route('laporan.servis') }}" class="btn btn-outline-success btn-sm">Buka</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center py-4">
                    <i class="bi bi-cash-coin fs-1 text-warning"></i>
                    <h6 class="mt-2">Laporan Pajak</h6>
                    <p class="text-muted small">Data pembayaran pajak</p>
                    <a href="{{ route('laporan.pajak') }}" class="btn btn-outline-warning btn-sm">Buka</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center py-4">
                    <i class="bi bi-arrow-left-right fs-1 text-info"></i>
                    <h6 class="mt-2">Laporan Penggunaan</h6>
                    <p class="text-muted small">Riwayat pemakaian kendaraan</p>
                    <a href="{{ route('laporan.penggunaan') }}" class="btn btn-outline-info btn-sm">Buka</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center py-4">
                    <i class="bi bi-person-badge fs-1 text-danger"></i>
                    <h6 class="mt-2">Laporan Pengemudi</h6>
                    <p class="text-muted small">Data seluruh pengemudi</p>
                    <a href="{{ route('laporan.pengemudi') }}" class="btn btn-outline-danger btn-sm">Buka</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
