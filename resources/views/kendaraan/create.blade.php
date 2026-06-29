<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0">Tambah Kendaraan</h5>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('kendaraan.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <x-input-label for="no_plat" value="Nomor Plat *" />
                        <x-text-input id="no_plat" name="no_plat" :value="old('no_plat')" required />
                        <x-input-error :messages="$errors->get('no_plat')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="no_polisi" value="Nomor Polisi" />
                        <x-text-input id="no_polisi" name="no_polisi" :value="old('no_polisi')" />
                        <x-input-error :messages="$errors->get('no_polisi')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="status" value="Status *" />
                        <select id="status" name="status" class="form-select">
                            @foreach(App\Models\Kendaraan::statusList() as $s)
                                <option value="{{ $s }}" {{ old('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('status')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="merk" value="Merk *" />
                        <x-text-input id="merk" name="merk" :value="old('merk')" required />
                        <x-input-error :messages="$errors->get('merk')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="model" value="Model *" />
                        <x-text-input id="model" name="model" :value="old('model')" required />
                        <x-input-error :messages="$errors->get('model')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="jenis" value="Jenis *" />
                        <select id="jenis" name="jenis" class="form-select" onchange="updateKategori()">
                            <option value="mobil" {{ old('jenis') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                            <option value="motor" {{ old('jenis') == 'motor' ? 'selected' : '' }}>Motor</option>
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
                                <option value="{{ $y }}" {{ old('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                        <x-input-error :messages="$errors->get('tahun')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="warna" value="Warna" />
                        <x-text-input id="warna" name="warna" :value="old('warna')" />
                        <x-input-error :messages="$errors->get('warna')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="no_mesin" value="Nomor Mesin" />
                        <x-text-input id="no_mesin" name="no_mesin" :value="old('no_mesin')" />
                        <x-input-error :messages="$errors->get('no_mesin')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="no_rangka" value="Nomor Rangka" />
                        <x-text-input id="no_rangka" name="no_rangka" :value="old('no_rangka')" />
                        <x-input-error :messages="$errors->get('no_rangka')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="vin" value="VIN" />
                        <x-text-input id="vin" name="vin" :value="old('vin')" />
                        <x-input-error :messages="$errors->get('vin')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="kapasitas_mesin" value="Kapasitas Mesin" />
                        <x-text-input id="kapasitas_mesin" name="kapasitas_mesin" :value="old('kapasitas_mesin')" placeholder="Contoh: 1500 cc" />
                        <x-input-error :messages="$errors->get('kapasitas_mesin')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="bahan_bakar" value="Bahan Bakar" />
                        <x-text-input id="bahan_bakar" name="bahan_bakar" :value="old('bahan_bakar')" placeholder="Bensin/Solar/Listrik" />
                        <x-input-error :messages="$errors->get('bahan_bakar')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="transmisi" value="Transmisi" />
                        <x-text-input id="transmisi" name="transmisi" :value="old('transmisi')" placeholder="Manual/Matic" />
                        <x-input-error :messages="$errors->get('transmisi')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="kilometer" value="Kilometer" />
                        <x-text-input id="kilometer" name="kilometer" type="number" :value="old('kilometer', 0)" />
                        <x-input-error :messages="$errors->get('kilometer')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="tanggal_pajak" value="Tanggal Pajak" />
                        <input id="tanggal_pajak" name="tanggal_pajak" type="date" class="form-control" value="{{ old('tanggal_pajak') }}">
                        <x-input-error :messages="$errors->get('tanggal_pajak')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="tanggal_stnk" value="Tanggal STNK" />
                        <input id="tanggal_stnk" name="tanggal_stnk" type="date" class="form-control" value="{{ old('tanggal_stnk') }}">
                        <x-input-error :messages="$errors->get('tanggal_stnk')" />
                    </div>
                    <div class="col-md-4">
                        <x-input-label for="tanggal_kir" value="Tanggal KIR" />
                        <input id="tanggal_kir" name="tanggal_kir" type="date" class="form-control" value="{{ old('tanggal_kir') }}">
                        <x-input-error :messages="$errors->get('tanggal_kir')" />
                    </div>
                    <div class="col-md-6">
                        <x-input-label for="foto" value="Foto Kendaraan" />
                        <input id="foto" name="foto" type="file" class="form-control" accept="image/*">
                        <x-input-error :messages="$errors->get('foto')" />
                    </div>
                    <div class="col-12">
                        <x-input-label for="catatan" value="Catatan" />
                        <textarea id="catatan" name="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
                        <x-input-error :messages="$errors->get('catatan')" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-primary-button><i class="bi bi-save me-1"></i> Simpan</x-primary-button>
                    <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
const kategoriMobil = {!! json_encode(App\Models\Kendaraan::kategoriMobil()) !!};
const kategoriMotor = {!! json_encode(App\Models\Kendaraan::kategoriMotor()) !!};
const oldKategori = '{{ old("kategori") }}';

function updateKategori() {
    const jenis = document.getElementById('jenis').value;
    const select = document.getElementById('kategori');
    const list = jenis === 'mobil' ? kategoriMobil : kategoriMotor;
    select.innerHTML = '<option value="">Pilih Kategori</option>' +
        list.map(k => `<option value="${k}" ${k === oldKategori ? 'selected' : ''}>${k}</option>`).join('');
}
updateKategori();
</script>
