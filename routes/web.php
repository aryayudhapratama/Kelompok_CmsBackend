<?php

use Illuminate\Support\Facades\Route;
use App\Models\LandingSection;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LandingSectionController;
use App\Http\Controllers\Redaktur\BeritaController as RedakturBeritaController;
use App\Http\Controllers\Reporter\Berita2Controller as ReporterBeritaController;
use App\Http\Controllers\Reporter\ReporterController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\HomeController;

// ======================= LANDING PAGE =======================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ======================= ADMIN =======================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn() => view('admin.admin'))->name('admin.admin');

    Route::prefix('admin')->name('admin.')->group(function () {
        // User Management
        Route::resource('users', UserController::class)->except(['create', 'edit', 'show']);

        // Landing Section
        Route::get('/landing', [LandingSectionController::class, 'index'])->name('landing.index');
        Route::post('/landing', [LandingSectionController::class, 'store'])->name('landing.store');
        Route::get('/landing/{id}/edit', [LandingSectionController::class, 'editJson'])->name('landing.edit.json');
        Route::put('/landing/{id}', [LandingSectionController::class, 'update'])->name('landing.update');
        Route::delete('/landing/{id}', [LandingSectionController::class, 'destroy'])->name('landing.destroy');
    });
});


// ======================= REDAKTUR =======================
Route::middleware(['auth', 'role:redaktur'])->prefix('redaktur')->name('redaktur.')->group(function () {
    Route::get('/', [RedakturBeritaController::class, 'dashboard'])->name('dashboard');
    Route::get('/kelola', [RedakturBeritaController::class, 'index'])->name('kelola');
    Route::get('/publish', [RedakturBeritaController::class, 'daftarPublish'])->name('publish');

    Route::post('/berita', [RedakturBeritaController::class, 'store'])->name('berita.store');
    Route::post('/berita/{id}/approve', [RedakturBeritaController::class, 'approve'])->name('berita.approve');
    Route::post('/berita/{id}/reject', [RedakturBeritaController::class, 'reject'])->name('berita.reject');
    Route::post('/berita/{id}/publish', [RedakturBeritaController::class, 'publish'])->name('berita.publish');
    Route::post('/berita/{id}/unpublish', [RedakturBeritaController::class, 'unpublish'])->name('berita.unpublish');
});

// ======================= REPORTER =======================
Route::middleware(['auth', 'role:reporter'])->prefix('reporter')->name('reporter.')->group(function () {
    Route::get('/', [ReporterController::class, 'index'])->name('dashboard');
    Route::get('/berita', [ReporterController::class, 'index'])->name('berita');
    Route::post('/berita', [ReporterBeritaController::class, 'store'])->name('berita.store');
});

// ======================= PUBLIKASI =======================
Route::get('/berita', [PublikasiController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [PublikasiController::class, 'show'])->name('berita.show');
