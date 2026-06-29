<div class="sidebar bg-dark text-white">
    <div class="d-flex align-items-center px-3 py-3 border-bottom border-secondary">
        <x-application-logo class="me-2 text-primary" />
        <span class="fw-bold fs-6">{{ config('app.name') }}</span>
    </div>
    <ul class="nav flex-column pt-2">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        @can('admin')
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> User Management
            </a>
        </li>
        @endcan

        @if (Route::has('kendaraan.index'))
        <li class="nav-item">
            <a href="{{ route('kendaraan.index') }}" class="nav-link {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}">
                <i class="bi bi-truck me-2"></i> Kendaraan
            </a>
        </li>
        @endif
        @if (Route::has('pengemudi.index'))
        <li class="nav-item">
            <a href="{{ route('pengemudi.index') }}" class="nav-link {{ request()->routeIs('pengemudi.*') ? 'active' : '' }}">
                <i class="bi bi-person-badge me-2"></i> Pengemudi
            </a>
        </li>
        @endif
        @if (Route::has('penggunaan.index'))
        <li class="nav-item">
            <a href="{{ route('penggunaan.index') }}" class="nav-link {{ request()->routeIs('penggunaan.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right me-2"></i> Penggunaan
            </a>
        </li>
        @endif
        @if (Route::has('servis.index'))
        <li class="nav-item">
            <a href="{{ route('servis.index') }}" class="nav-link {{ request()->routeIs('servis.*') ? 'active' : '' }}">
                <i class="bi bi-wrench me-2"></i> Servis
            </a>
        </li>
        @endif
        @if (Route::has('pajak.index'))
        <li class="nav-item">
            <a href="{{ route('pajak.index') }}" class="nav-link {{ request()->routeIs('pajak.*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin me-2"></i> Pajak
            </a>
        </li>
        @endif
        @if (Route::has('kir.index'))
        <li class="nav-item">
            <a href="{{ route('kir.index') }}" class="nav-link {{ request()->routeIs('kir.*') ? 'active' : '' }}">
                <i class="bi bi-file-check me-2"></i> KIR
            </a>
        </li>
        @endif

        @if (Route::has('laporan.index'))
        <li class="nav-item mt-2">
            <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan
            </a>
        </li>
        @endif
    </ul>
</div>
