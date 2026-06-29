<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0">{{ __('Dashboard') }}</h5>
    </x-slot>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card stat-card shadow-sm bg-primary text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon bg-white bg-opacity-25 me-3">
                        <i class="bi bi-truck fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">0</h6>
                        <small>Total Kendaraan</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card shadow-sm bg-success text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon bg-white bg-opacity-25 me-3">
                        <i class="bi bi-person-badge fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">0</h6>
                        <small>Total Pengemudi</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card shadow-sm bg-warning text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon bg-white bg-opacity-25 me-3">
                        <i class="bi bi-wrench fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">0</h6>
                        <small>Servis Bulan Ini</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card shadow-sm bg-info text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon bg-white bg-opacity-25 me-3">
                        <i class="bi bi-arrow-left-right fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">0</h6>
                        <small>Pemakaian Aktif</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title fw-bold">Selamat Datang, {{ Auth::user()->name }}</h6>
                    <p class="text-muted small mb-0">Fleet Management System. Mulai dengan menambahkan data kendaraan dan pengemudi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Aktivitas Terbaru</h6>
                </div>
                <div class="card-body text-center text-muted py-4">
                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                    <small>Belum ada aktivitas</small>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
