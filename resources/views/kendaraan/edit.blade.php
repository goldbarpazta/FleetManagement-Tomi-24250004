<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0">Edit Kendaraan: {{ $kendaraan->no_plat }}</h5>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('kendaraan.update', $kendaraan) }}" enctype="multipart/form-data">
                @csrf @method('put')

                <div class="row g-3">
                    <div class="col-md-4">
                        <x-input-label for="no_plat" value="Nomor Plat *" />
                        <x-text-input id="no_plat" name="no_plat" :value="old('no_plat', $kendaraan->no_plat)" required />
                        <x-input-error :messages="$errors->get('no_plat')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="no_polisi" value="Nomor Polisi" />
                        <x-text-input id="no_polisi" name="no_polisi" :value="old('no_polisi', $kendaraan->no_polisi)" />
                        <x-input-error :messages="$errors->get('no_polisi')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="status" value="Status *" />
                        <select id="status" name="status" class="form-select">
                            @foreach(App\Models\Kendaraan::statusList() as $s)
                                <option value="{{ $s }}" {{ old('status', $kendaraan->status) == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('status')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="merk" value="Merk *" />
                        <x-text-input id="merk" name="merk" :value="old('merk', $kendaraan->merk)" required />
                        <x-input-error :messages="$errors->get('merk')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="model" value="Model *" />
                        <x-text-input id="model" name="model" :value="old('model', $kendaraan->model)" required />
                        <x-input-error :messages="$errors->get('model')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="jenis" value="Jenis *" />
                        <select id="jenis" name="jenis" class="form-select" onchange="updateKategori()">
                            @foreach(App\Models\Kendaraan::jenisList() as $j)
                                <option value="{{ $j }}" {{ old('jenis', $kendaraan->jenis) == $j ? 'selected' : '' }}>{{ ucfirst($j) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('jenis')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="kategori" value="Kategori *" />
                        <select id="kategori" name="kategori" class="form-select">
                            <option value="">Pilih Kategori</option>
                        </select>
                        <x-input-error :messages="$errors->get('kategori')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="tahun" value="Tahun *" />
                        <select id="tahun" name="tahun" class="form-select">
                            @for($y = date('Y') + 1; $y >= 2000; $y--)
                                <option value="{{ $y }}" {{ old('tahun', $kendaraan->tahun) == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                        <x-input-error :messages="$errors->get('tahun')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="warna" value="Warna" />
                        <x-text-input id="warna" name="warna" :value="old('warna', $kendaraan->warna)" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="no_mesin" value="Nomor Mesin" />
                        <x-text-input id="no_mesin" name="no_mesin" :value="old('no_mesin', $kendaraan->no_mesin)" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="no_rangka" value="Nomor Rangka" />
                        <x-text-input id="no_rangka" name="no_rangka" :value="old('no_rangka', $kendaraan->no_rangka)" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="vin" value="VIN" />
                        <x-text-input id="vin" name="vin" :value="old('vin', $kendaraan->vin)" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="kapasitas_mesin" value="Kapasitas Mesin" />
                        <x-text-input id="kapasitas_mesin" name="kapasitas_mesin" :value="old('kapasitas_mesin', $kendaraan->kapasitas_mesin)" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="bahan_bakar" value="Bahan Bakar" />
                        <x-text-input id="bahan_bakar" name="bahan_bakar" :value="old('bahan_bakar', $kendaraan->bahan_bakar)" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="transmisi" value="Transmisi" />
                        <x-text-input id="transmisi" name="transmisi" :value="old('transmisi', $kendaraan->transmisi)" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="kilometer" value="Kilometer" />
                        <x-text-input id="kilometer" name="kilometer" type="number" :value="old('kilometer', $kendaraan->kilometer)" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="tanggal_pajak" value="Tanggal Pajak" />
                        <input id="tanggal_pajak" name="tanggal_pajak" type="date" class="form-control" value="{{ old('tanggal_pajak', $kendaraan->tanggal_pajak?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="tanggal_stnk" value="Tanggal STNK" />
                        <input id="tanggal_stnk" name="tanggal_stnk" type="date" class="form-control" value="{{ old('tanggal_stnk', $kendaraan->tanggal_stnk?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="tanggal_kir" value="Tanggal KIR" />
                        <input id="tanggal_kir" name="tanggal_kir" type="date" class="form-control" value="{{ old('tanggal_kir', $kendaraan->tanggal_kir?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="foto" value="Foto Kendaraan" />
                        @if($kendaraan->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $kendaraan->foto) }}" class="img-thumbnail" style="max-height:100px">
                            </div>
                        @endif
                        <input id="foto" name="foto" type="file" class="form-control" accept="image/*">
                        <x-input-error :messages="$errors->get('foto')" />
                    </div>
                    <div class="col-12">
                        <x-input-label for="catatan" value="Catatan" />
                        <textarea id="catatan" name="catatan" class="form-control" rows="3">{{ old('catatan', $kendaraan->catatan) }}</textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <x-primary-button><i class="bi bi-save me-1"></i> Update</x-primary-button>
                    <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
const kategoriMobil = {!! json_encode(App\Models\Kendaraan::kategoriMobil()) !!};
const kategoriMotor = {!! json_encode(App\Models\Kendaraan::kategoriMotor()) !!};
const oldKategori = '{{ old("kategori", $kendaraan->kategori) }}';

function updateKategori() {
    const jenis = document.getElementById('jenis').value;
    const select = document.getElementById('kategori');
    const list = jenis === 'mobil' ? kategoriMobil : kategoriMotor;
    select.innerHTML = '<option value="">Pilih Kategori</option>' +
        list.map(k => `<option value="${k}" ${k === oldKategori ? 'selected' : ''}>${k}</option>`).join('');
}
updateKategori();
</script>
