<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0">Edit Pajak</h5>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('pajak.update', $pajak) }}" enctype="multipart/form-data">
                @csrf @method('put')

                <div class="row g-3">
                    <div class="col-md-6">
                        <x-input-label for="kendaraan_id" value="Kendaraan *" />
                        <select id="kendaraan_id" name="kendaraan_id" class="form-select">
                            <option value="">Pilih Kendaraan</option>
                            @foreach($kendaraans as $k)
                                <option value="{{ $k->id }}" {{ old('kendaraan_id', $pajak->kendaraan_id) == $k->id ? 'selected' : '' }}>{{ $k->no_plat }} - {{ $k->merk }} {{ $k->model }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('kendaraan_id')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="status" value="Status *" />
                        <select id="status" name="status" class="form-select">
                            <option value="belum_dibayar" {{ old('status', $pajak->status) == 'belum_dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                            <option value="lunas" {{ old('status', $pajak->status) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="denda" {{ old('status', $pajak->status) == 'denda' ? 'selected' : '' }}>Denda</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="tanggal_jatuh_tempo" value="Tanggal Jatuh Tempo *" />
                        <input id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" type="date" class="form-control" value="{{ old('tanggal_jatuh_tempo', $pajak->tanggal_jatuh_tempo?->format('Y-m-d')) }}">
                        <x-input-error :messages="$errors->get('tanggal_jatuh_tempo')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="biaya" value="Biaya *" />
                        <input id="biaya" name="biaya" type="number" step="0.01" class="form-control" value="{{ old('biaya', $pajak->biaya) }}" placeholder="0.00">
                        <x-input-error :messages="$errors->get('biaya')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="bukti_bayar" value="Bukti Bayar" />
                        @if($pajak->bukti_bayar)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $pajak->bukti_bayar) }}" target="_blank" class="btn btn-sm btn-outline-info">Lihat File</a>
                            </div>
                        @endif
                        <input id="bukti_bayar" name="bukti_bayar" type="file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        <x-input-error :messages="$errors->get('bukti_bayar')" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-primary-button><i class="bi bi-save me-1"></i> Update</x-primary-button>
                    <a href="{{ route('pajak.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
