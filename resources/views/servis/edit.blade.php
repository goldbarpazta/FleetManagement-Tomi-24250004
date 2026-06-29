<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0">Edit Servis</h5>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('servis.update', $servi) }}" enctype="multipart/form-data">
                @csrf @method('put')

                <div class="row g-3">
                    <div class="col-md-6">
                        <x-input-label for="kendaraan_id" value="Kendaraan *" />
                        <select id="kendaraan_id" name="kendaraan_id" class="form-select" required>
                            <option value="">Pilih Kendaraan</option>
                            @foreach($kendaraans as $k)
                                <option value="{{ $k->id }}" {{ old('kendaraan_id', $servi->kendaraan_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->no_plat }} - {{ $k->merk }} {{ $k->model }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('kendaraan_id')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="tanggal" value="Tanggal *" />
                        <input id="tanggal" name="tanggal" type="date" class="form-control" value="{{ old('tanggal', $servi->tanggal?->format('Y-m-d')) }}" required>
                        <x-input-error :messages="$errors->get('tanggal')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="bengkel" value="Bengkel *" />
                        <x-text-input id="bengkel" name="bengkel" :value="old('bengkel', $servi->bengkel)" required />
                        <x-input-error :messages="$errors->get('bengkel')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="jenis_servis" value="Jenis Servis *" />
                        <x-text-input id="jenis_servis" name="jenis_servis" :value="old('jenis_servis', $servi->jenis_servis)" required />
                        <x-input-error :messages="$errors->get('jenis_servis')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="odometer" value="Odometer *" />
                        <x-text-input id="odometer" name="odometer" type="number" :value="old('odometer', $servi->odometer)" required />
                        <x-input-error :messages="$errors->get('odometer')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="biaya" value="Biaya *" />
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input id="biaya" name="biaya" type="number" step="0.01" class="form-control" value="{{ old('biaya', $servi->biaya) }}" required>
                        </div>
                        <x-input-error :messages="$errors->get('biaya')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="status" value="Status *" />
                        <select id="status" name="status" class="form-select">
                            <option value="jadwal" {{ old('status', $servi->status) == 'jadwal' ? 'selected' : '' }}>Terjadwal</option>
                            <option value="proses" {{ old('status', $servi->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ old('status', $servi->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="file_invoice" value="File Invoice" />
                        @if($servi->file_invoice)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $servi->file_invoice) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-file-earmark"></i> Lihat Invoice
                                </a>
                            </div>
                        @endif
                        <input id="file_invoice" name="file_invoice" type="file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        <x-input-error :messages="$errors->get('file_invoice')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="file_foto" value="Foto" />
                        @if($servi->file_foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $servi->file_foto) }}" class="img-thumbnail" style="max-height:100px">
                            </div>
                        @endif
                        <input id="file_foto" name="file_foto" type="file" class="form-control" accept="image/*">
                        <x-input-error :messages="$errors->get('file_foto')" />
                    </div>
                    <div class="col-12">
                        <x-input-label for="catatan" value="Catatan" />
                        <textarea id="catatan" name="catatan" class="form-control" rows="3">{{ old('catatan', $servi->catatan) }}</textarea>
                        <x-input-error :messages="$errors->get('catatan')" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-primary-button><i class="bi bi-save me-1"></i> Update</x-primary-button>
                    <a href="{{ route('servis.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
