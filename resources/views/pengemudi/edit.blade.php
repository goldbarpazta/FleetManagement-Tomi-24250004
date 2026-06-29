<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0">Edit Pengemudi: {{ $pengemudi->nama }}</h5>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('pengemudi.update', $pengemudi) }}" enctype="multipart/form-data">
                @csrf @method('put')
                <div class="row g-3">
                    <div class="col-md-6">
                        <x-input-label for="nama" value="Nama *" />
                        <x-text-input id="nama" name="nama" :value="old('nama', $pengemudi->nama)" required />
                        <x-input-error :messages="$errors->get('nama')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="nik" value="NIK *" />
                        <x-text-input id="nik" name="nik" :value="old('nik', $pengemudi->nik)" required maxlength="16" />
                        <x-input-error :messages="$errors->get('nik')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="no_hp" value="No. HP" />
                        <x-text-input id="no_hp" name="no_hp" :value="old('no_hp', $pengemudi->no_hp)" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" :value="old('email', $pengemudi->email)" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="status" value="Status *" />
                        <select id="status" name="status" class="form-select">
                            <option value="aktif" {{ old('status', $pengemudi->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ old('status', $pengemudi->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <x-input-label for="alamat" value="Alamat" />
                        <textarea id="alamat" name="alamat" class="form-control" rows="2">{{ old('alamat', $pengemudi->alamat) }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="nomor_sim" value="Nomor SIM" />
                        <x-text-input id="nomor_sim" name="nomor_sim" :value="old('nomor_sim', $pengemudi->nomor_sim)" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="jenis_sim" value="Jenis SIM" />
                        <select id="jenis_sim" name="jenis_sim" class="form-select">
                            <option value="">Pilih</option>
                            @foreach(App\Models\Pengemudi::jenisSimList() as $s)
                                <option value="{{ $s }}" {{ old('jenis_sim', $pengemudi->jenis_sim) == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="tanggal_berlaku_sim" value="Tanggal Berlaku SIM" />
                        <input id="tanggal_berlaku_sim" name="tanggal_berlaku_sim" type="date" class="form-control" value="{{ old('tanggal_berlaku_sim', $pengemudi->tanggal_berlaku_sim?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="foto" value="Foto" />
                        @if($pengemudi->foto)
                            <div class="mb-2"><img src="{{ asset('storage/'.$pengemudi->foto) }}" class="img-thumbnail" style="max-height:80px"></div>
                        @endif
                        <input id="foto" name="foto" type="file" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="mt-4">
                    <x-primary-button><i class="bi bi-save me-1"></i> Update</x-primary-button>
                    <a href="{{ route('pengemudi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
