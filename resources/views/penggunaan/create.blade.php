<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0">Tambah Penggunaan Kendaraan</h5>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('penggunaan.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <x-input-label for="kendaraan_id" value="Kendaraan *" />
                        <select id="kendaraan_id" name="kendaraan_id" class="form-select">
                            <option value="">Pilih Kendaraan</option>
                            @foreach($kendaraan as $k)
                                <option value="{{ $k->id }}" {{ old('kendaraan_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->no_plat }} - {{ $k->merk }} {{ $k->model }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('kendaraan_id')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="pengemudi_id" value="Pengemudi *" />
                        <select id="pengemudi_id" name="pengemudi_id" class="form-select">
                            <option value="">Pilih Pengemudi</option>
                            @foreach($pengemudi as $p)
                                <option value="{{ $p->id }}" {{ old('pengemudi_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }} ({{ $p->nik }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('pengemudi_id')" />
                    </div>
                    <div class="col-12">
                        <x-input-label for="tujuan" value="Tujuan *" />
                        <textarea id="tujuan" name="tujuan" class="form-control" rows="2" required>{{ old('tujuan') }}</textarea>
                        <x-input-error :messages="$errors->get('tujuan')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="tanggal_berangkat" value="Tanggal Berangkat *" />
                        <input id="tanggal_berangkat" name="tanggal_berangkat" type="date" class="form-control" value="{{ old('tanggal_berangkat') }}" required>
                        <x-input-error :messages="$errors->get('tanggal_berangkat')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="tanggal_kembali" value="Tanggal Kembali" />
                        <input id="tanggal_kembali" name="tanggal_kembali" type="date" class="form-control" value="{{ old('tanggal_kembali') }}">
                        <x-input-error :messages="$errors->get('tanggal_kembali')" />
                    </div>
                    <div class="col-md-2">
                        <x-input-label for="odometer_awal" value="Odometer Awal *" />
                        <x-text-input id="odometer_awal" name="odometer_awal" type="number" :value="old('odometer_awal')" required />
                        <x-input-error :messages="$errors->get('odometer_awal')" />
                    </div>
                    <div class="col-md-2">
                        <x-input-label for="odometer_akhir" value="Odometer Akhir" />
                        <x-text-input id="odometer_akhir" name="odometer_akhir" type="number" :value="old('odometer_akhir')" />
                        <x-input-error :messages="$errors->get('odometer_akhir')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="status" value="Status *" />
                        <select id="status" name="status" class="form-select">
                            <option value="berlangsung" {{ old('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-primary-button><i class="bi bi-save me-1"></i> Simpan</x-primary-button>
                    <a href="{{ route('penggunaan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
