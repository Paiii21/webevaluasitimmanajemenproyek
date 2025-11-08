<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\ProfileController;

// Halaman welcome (belum login)
Route::get('/', function () {
    return view('welcome');
});

// === Halaman Dashboard & Fitur Evaluasi ===
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard (default membawa user ke daftar evaluasi)
    Route::get('/dashboard', [EvaluasiController::class, 'index'])
        ->name('evaluasi.index');

    // Form tambah evaluasi
    Route::get('/evaluasi/tambah', [EvaluasiController::class, 'create'])
        ->name('evaluasi.create');

    // Simpan hasil evaluasi
    Route::post('/evaluasi/simpan', [EvaluasiController::class, 'store'])
        ->name('evaluasi.store');

    // Detail tim → tampilkan grafik & catatan tambahan
    Route::get('/evaluasi/{id}', [EvaluasiController::class, 'show'])
        ->name('evaluasi.show');
});

// === Profil User (bawaan Breeze, opsional) ===
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// === Rute autentikasi (login, register, forgot password, dsb.) ===
require __DIR__ . '/auth.php';
