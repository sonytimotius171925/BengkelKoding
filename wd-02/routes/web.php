<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dokter\ProfileController;
use App\Http\Controllers\dokter\ObatController;
use App\Http\Controllers\dokter\JadwalPeriksaController;
use App\Http\Controllers\dokter\MemeriksaController;
use App\Http\Controllers\pasien\JanjiPeriksaController;
use App\Http\Controllers\pasien\RiwayatPeriksaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    Route::prefix('profile')->group(function (){
        Route::get('/', [ProfileController::class, 'edit'])->name('dokter.profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('dokter.profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('dokter.profile.destroy');
    });

    Route::prefix('jadwal-periksa')->group(function () {
        Route::get('/jadwal-periksa', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal-periksa.index');
        Route::get('/jadwal-periksa/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwal-periksa.create');
        Route::post('/jadwal-periksa', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal-periksa.store');
        Route::patch('/jadwal-periksa{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal-periksa.update');
        Route::delete('/jadwal-periksa/{id}', [JadwalPeriksaController::class, 'destroy'])->name('dokter.jadwal-periksa.destroy');
    });

    Route::prefix('memeriksa')->group(function(){
        Route::get('/', [MemeriksaController::class, 'index'])->name('dokter.memeriksa.index');
        Route::post('/{id}', [MemeriksaController::class, 'store'])->name('dokter.memeriksa.store');
        Route::get('/{id}/periksa', [MemeriksaController::class, 'periksa'])->name('dokter.memeriksa.periksa');
        Route::get('/{id}/edit', [MemeriksaController::class, 'edit'])->name('dokter.memeriksa.edit');
        Route::patch('/{id}', [MemeriksaController::class, 'update'])->name('dokter.memeriksa.update');
    });

    Route::prefix('obat')->group(function(){
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
        Route::get('/create', [ObatController::class, 'create'])->name('dokter.obat.create');
        Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::get('/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::patch('/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
        Route::get('/trashed', [ObatController::class, 'trashed'])->name('dokter.obat.trashed');
        Route::patch('restore/{id}', [ObatController::class, 'restore'])->name('dokter.obat.restore');
    });
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');
     Route::prefix('janji-periksa')->group(function(){
        Route::get('/', [JanjiPeriksaController::class, 'index'])->name('pasien.janji-periksa.index');
        Route::post('/', [JanjiPeriksaController::class, 'store'])->name('pasien.janji-periksa.store');
    });
    Route::prefix('riwayat-periksa')->group(function(){
        Route::get('/', [RiwayatPeriksaController::class, 'index'])->name('pasien.riwayat-periksa.index');
        Route::get('/{id}/detail', [RiwayatPeriksaController::class, 'detail'])->name('pasien.riwayat-periksa.detail');
        Route::get('/{id}/riwayat', [RiwayatPeriksaController::class, 'riwayat'])->name('pasien.riwayat-periksa.riwayat');
    });
});

require __DIR__.'/auth.php';
