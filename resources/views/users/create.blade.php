<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0">Tambah User</h5>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <x-input-label for="name" value="Nama *" />
                        <x-text-input id="name" name="name" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="email" value="Email *" />
                        <x-text-input id="email" name="email" type="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="password" value="Password *" />
                        <x-text-input id="password" name="password" type="password" required />
                        <x-input-error :messages="$errors->get('password')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="password_confirmation" value="Konfirmasi Password *" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" required />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="role" value="Role *" />
                        <select id="role" name="role" class="form-select">
                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" />
                    </div>
                </div>
                <div class="mt-4">
                    <x-primary-button><i class="bi bi-save me-1"></i> Simpan</x-primary-button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
