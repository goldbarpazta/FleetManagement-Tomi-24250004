<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">User Management</h5>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah User</a>
        </div>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary btn-sm w-100"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Verifikasi</th>
                            <th>Bergabung</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $u)
                        <tr>
                            <td><strong>{{ $u->name }}</strong></td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <span class="badge {{ $u->role === 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                    {{ ucfirst($u->role) }}
                                </span>
                            </td>
                            <td>
                                @if($u->hasVerifiedEmail())
                                    <span class="text-success"><i class="bi bi-check-circle"></i> Terverifikasi</span>
                                @else
                                    <span class="text-warning"><i class="bi bi-exclamation-circle"></i> Belum</span>
                                @endif
                            </td>
                            <td>{{ $u->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('users.edit', $u) }}" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    @if($u->id !== Auth::id())
                                    <button type="button" class="btn btn-danger" title="Hapus"
                                        onclick="if(confirm('Yakin ingin menghapus {{ $u->name }}?')){document.getElementById('delete-{{ $u->id }}').submit();}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    @endif
                                </div>
                                <form id="delete-{{ $u->id }}" method="POST" action="{{ route('users.destroy', $u) }}" class="d-none">@csrf @method('delete')</form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="bi bi-inbox fs-2 d-block text-muted"></i>
                                <small class="text-muted">Belum ada data user.</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
