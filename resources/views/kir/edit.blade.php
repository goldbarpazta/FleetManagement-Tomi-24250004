<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0">Edit KIR</h5>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('kir.update', $kir) }}" enctype="multipart/form-data">
                @csrf @method('put')

                <div class="row g-3">
                    <div class="col-md-6">
                        <x-input-label for="kendaraan_id" value="Kendaraan *" />
                        <select id="kendaraan_id" name="kendaraan_id" class="form-select">
                            <option value="">Pilih Kendaraan</option>
                            @foreach($kendaraan as $k)
                                <option value="{{ $k->id }}" {{ old('kendaraan_id', $kir->kendaraan_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->no_plat }} - {{ $k->merk }} {{ $k->model }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('kendaraan_id')" />
                    </div>
                    <div class="col-md-3">
                        <x-input-label for="status" value="Status *" />
                        <select id="status" name="status" class="form-select">
                            <option value="menunggu" {{ old('status', $kir->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="berlaku" {{ old('status', $kir->status) == 'berlaku' ? 'selected' : '' }}>Berlaku</option>
                            <option value="habis" {{ old('status', $kir->status) == 'habis' ? 'selected' : '' }}>Habis</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="tanggal_berlaku" value="Tanggal Berlaku *" />
                        <input id="tanggal_berlaku" name="tanggal_berlaku" type="date" class="form-control" value="{{ old('tanggal_berlaku', $kir->tanggal_berlaku?->format('Y-m-d')) }}">
                        <x-input-error :messages="$errors->get('tanggal_berlaku')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="tanggal_habis" value="Tanggal Habis *" />
                        <input id="tanggal_habis" name="tanggal_habis" type="date" class="form-control" value="{{ old('tanggal_habis', $kir->tanggal_habis?->format('Y-m-d')) }}">
                        <x-input-error :messages="$errors->get('tanggal_habis')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="dokumen" value="Dokumen (PDF/JPG/PNG)" />
                        @if($kir->dokumen)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $kir->dokumen) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-file-earmark"></i> Lihat Dokumen
                                </a>
                            </div>
                        @endif
                        <input id="dokumen" name="dokumen" type="file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        <x-input-error :messages="$errors->get('dokumen')" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-primary-button><i class="bi bi-save me-1"></i> Update</x-primary-button>
                    <a href="{{ route('kir.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
