<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PengemudiController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\KirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('pengemudi', PengemudiController::class);
    Route::resource('servis', ServisController::class);
    Route::resource('penggunaan', PenggunaanController::class);
    Route::resource('kir', KirController::class);
    Route::resource('pajak', PajakController::class);
    Route::get('/kendaraan/export/excel', [KendaraanController::class, 'exportExcel'])->name('kendaraan.export-excel');
    Route::get('/kendaraan/export/pdf', [KendaraanController::class, 'exportPdf'])->name('kendaraan.export-pdf');
    Route::post('/kendaraan/import/excel', [KendaraanController::class, 'importExcel'])->name('kendaraan.import-excel');

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/kendaraan', [LaporanController::class, 'kendaraan'])->name('laporan.kendaraan');
    Route::get('laporan/servis', [LaporanController::class, 'servis'])->name('laporan.servis');
    Route::get('laporan/pajak', [LaporanController::class, 'pajak'])->name('laporan.pajak');
    Route::get('laporan/penggunaan', [LaporanController::class, 'penggunaan'])->name('laporan.penggunaan');
    Route::get('laporan/pengemudi', [LaporanController::class, 'pengemudi'])->name('laporan.pengemudi');

    Route::middleware('can:admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
