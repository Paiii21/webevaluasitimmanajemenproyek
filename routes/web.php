<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectMemberController;
use App\Http\Controllers\ProjectEvaluationController;

// Halaman welcome (belum login)
Route::get('/', function () {
    return view('welcome');
});

// === Halaman Dashboard & Fitur Proyek (utama untuk sistem baru) ===
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [EvaluasiController::class, 'index'])
        ->name('dashboard');

    // Rute untuk manajemen proyek
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');

        // Rute untuk manajemen anggota proyek
        Route::prefix('{project}/members')->name('members.')->group(function () {
            Route::get('/', [ProjectMemberController::class, 'index'])->name('index');
            Route::get('/invite', [ProjectMemberController::class, 'invite'])->name('invite');
            Route::post('/invite', [ProjectMemberController::class, 'store'])->name('store');
            Route::put('/{projectMember}', [ProjectMemberController::class, 'updateRole'])->name('update-role');
            Route::delete('/{projectMember}', [ProjectMemberController::class, 'remove'])->name('remove');
        });

        // Rute untuk manajemen evaluasi proyek
        Route::prefix('{project}/evaluations')->name('evaluations.')->group(function () {
            Route::get('/', [ProjectEvaluationController::class, 'index'])->name('index');
            Route::get('/create', [ProjectEvaluationController::class, 'create'])->name('create');
            Route::post('/', [ProjectEvaluationController::class, 'store'])->name('store');
            Route::get('/{projectEvaluation}', [ProjectEvaluationController::class, 'show'])->name('show');
        });
    });
});

// === Profil User (bawaan Breeze, opsional) ===
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// === Rute autentikasi (login, register, forgot password, dsb.) ===
require __DIR__ . '/auth.php';
