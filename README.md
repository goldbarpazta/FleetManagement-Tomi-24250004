# Fleet Management System

Fleet Management System adalah aplikasi berbasis web yang dikembangkan menggunakan **Laravel 12** untuk membantu proses pengelolaan aset kendaraan operasional secara terpusat. Sistem ini dirancang agar administrasi kendaraan menjadi lebih efisien, terdokumentasi, dan mudah dipantau melalui antarmuka yang modern serta responsif.

Aplikasi ini menyediakan berbagai fitur mulai dari pengelolaan data kendaraan, data pengemudi, riwayat servis, penggunaan kendaraan, hingga manajemen pengguna. Dengan sistem ini, administrator dapat memantau status kendaraan secara real-time, mengelola jadwal perawatan, serta menghasilkan laporan yang mendukung pengambilan keputusan.

Email: admin@fleet.com
Password: password

---

## Fitur Utama

### Dashboard
- Ringkasan jumlah kendaraan.
- Statistik kendaraan berdasarkan status.
- Informasi kendaraan tersedia, dipakai, dan servis.
- Aktivitas terbaru sistem.

### Manajemen Kendaraan
- Tambah, ubah, hapus, dan lihat data kendaraan.
- Penyimpanan informasi kendaraan secara lengkap.
- Status kendaraan (Tersedia, Dipakai, Servis, Nonaktif).
- Detail spesifikasi kendaraan.

### Manajemen Pengemudi
- Pengelolaan data pengemudi.
- Informasi SIM dan masa berlaku.
- Riwayat penggunaan kendaraan.

### Manajemen Servis
- Pencatatan riwayat servis kendaraan.
- Informasi bengkel, biaya, dan tanggal servis.
- Dokumentasi perawatan kendaraan.

### Penggunaan Kendaraan
- Pencatatan penggunaan kendaraan oleh pengemudi.
- Riwayat perjalanan kendaraan.
- Monitoring kendaraan yang sedang digunakan.

### Manajemen Pengguna
- Sistem autentikasi Login dan Logout.
- Hak akses berdasarkan peran (Admin dan Staff).
- Pengelolaan akun pengguna.

### Laporan
- Laporan data kendaraan.
- Laporan riwayat servis.
- Laporan penggunaan kendaraan.
- Filter data sesuai kebutuhan.

---

## Teknologi yang Digunakan

- Laravel 12
- PHP 8.3+
- MySQL
- Blade Template Engine
- Bootstrap 5
- Vite
- Laravel Breeze Authentication
- Eloquent ORM

---

## Struktur Fitur

- Dashboard
- Kendaraan
- Pengemudi
- Servis
- Penggunaan Kendaraan
- User Management
- Profil Pengguna
- Laporan

---

## Instalasi

1. Clone repository

```bash
git clone https://github.com/username/fleet-management.git
```

2. Masuk ke folder project

```bash
cd fleet-management
```

3. Install dependency PHP

```bash
composer install
```

4. Install dependency JavaScript

```bash
npm install
```

5. Salin file environment

```bash
cp .env.example .env
```

Windows:

```bash
copy .env.example .env
```

6. Generate application key

```bash
php artisan key:generate
```

7. Atur konfigurasi database pada file `.env`.

8. Jalankan migrasi database

```bash
php artisan migrate
```

atau jika tersedia seeder

```bash
php artisan migrate --seed
```

9. Jalankan Vite

```bash
npm run dev
```

10. Jalankan server Laravel

```bash
php artisan serve
```

Buka aplikasi melalui browser:

```
http://127.0.0.1:8000
```

---

## Tujuan Pengembangan

Aplikasi ini dibuat sebagai implementasi sistem informasi berbasis web untuk mendukung pengelolaan armada kendaraan secara efektif, meningkatkan efisiensi operasional, mempermudah proses administrasi, serta menyediakan informasi yang akurat bagi pihak pengelola.

---

## Lisensi

Repository ini dikembangkan untuk keperluan pembelajaran, penelitian, dan pengembangan sistem informasi menggunakan framework Laravel.
