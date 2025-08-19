<?php

use App\Models\LandingSection;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminFile2Controller;
use App\Http\Controllers\Reporter\ReporterController;
use App\Http\Controllers\Redaktur\RedakturFileController;
use App\Http\Controllers\Reporter\ReporterFileController;
use App\Http\Controllers\Redaktur\LandingSectionController;
use App\Http\Controllers\Redaktur\BeritaController as RedakturBeritaController;
use App\Http\Controllers\Reporter\Berita2Controller as ReporterBeritaController;
use App\Http\Controllers\Redaktur\ProfileController;
use App\Http\Controllers\Redaktur\BannerController;
use App\Http\Controllers\Redaktur\NavbarMenuController;





// ======================= LANDING PAGE =======================
// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);

// ======================= ADMIN =======================
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Perbaiki: arahkan ke AdminController@index, bukan closure
    Route::get('/admin', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.admin');

    // Route Untuk User
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Route Untuk File Manager
    Route::get('/admin/file-manager', [AdminFile2Controller::class, 'index'])->name('admin.file-manager.index');
    Route::post('/admin/file-manager/upload', [AdminFile2Controller::class, 'upload'])->name('admin.file-manager.upload');
    Route::delete('/admin/file-manager/{id}', [AdminFile2Controller::class, 'destroy'])->name('admin.file-manager.destroy');

    // Route Edit Profile
    Route::put('/settings', [ProfileController::class, 'update'])->name('settings.update');
});

// ======================= REDAKTUR =======================
Route::middleware(['auth', 'role:redaktur'])
    ->prefix('redaktur')
    ->name('redaktur.')
    ->group(function () {
        Route::get('/', [RedakturBeritaController::class, 'dashboard'])->name('dashboard');
        Route::get('/kelola', [RedakturBeritaController::class, 'index'])->name('kelola');

        Route::get('/publish', [RedakturBeritaController::class, 'daftarPublish'])->name('publish');
        Route::put('/berita/{id}/update', [RedakturBeritaController::class, 'update'])->name('berita.update');
        Route::post('/berita', [RedakturBeritaController::class, 'store'])->name('berita.store');
        Route::post('/berita/{id}/approve', [RedakturBeritaController::class, 'approve'])->name('berita.approve');
        Route::post('/berita/{id}/reject', [RedakturBeritaController::class, 'reject'])->name('berita.reject');
        Route::post('/berita/{id}/publish', [RedakturBeritaController::class, 'publish'])->name('berita.publish');
        Route::post('/berita/{id}/unpublish', [RedakturBeritaController::class, 'unpublish'])->name('berita.unpublish');
        Route::delete('/berita/{id}', [RedakturBeritaController::class, 'destroy'])->name('berita.delete');

        Route::post('/upload-file', [RedakturFileController::class, 'upload'])->name('upload.file');
        Route::get('/file', [RedakturFileController::class, 'index'])->name('file.index');
        Route::delete('/file/{id}', [RedakturFileController::class, 'destroy'])->name('file.delete');
        Route::put('/settings', [ProfileController::class, 'update'])->name('settings.update');

        // ✅ Carousel
        Route::get('/landing', [LandingSectionController::class, 'index'])->name('landing.index');
        Route::post('/landing', [LandingSectionController::class, 'store'])->name('landing.store');
        Route::get('/landing/{id}/edit', [LandingSectionController::class, 'editJson'])->name('landing.edit.json');
        Route::put('/landing/{id}', [LandingSectionController::class, 'update'])->name('landing.update');
        Route::delete('/landing/{id}', [LandingSectionController::class, 'destroy'])->name('landing.destroy');

        // ✅ Banner (Fixed)
        Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
        Route::post('/banner', [BannerController::class, 'store'])->name('banner.store');
        Route::put('/banner/{id}', [BannerController::class, 'update'])->name('banner.update');
        Route::delete('/banner/{id}', [BannerController::class, 'destroy'])->name('banner.delete');

        // ✅ Fitur Kelola Navbar Menu
        Route::get('/navbar-menu', [NavbarMenuController::class, 'index'])->name('navbar_menu.index');
        Route::post('/navbar-menu', [NavbarMenuController::class, 'store'])->name('navbar_menu.store');
        Route::put('/navbar-menu/{menu}', [NavbarMenuController::class, 'update'])->name('navbar_menu.update');
        Route::delete('/navbar-menu/{menu}', [NavbarMenuController::class, 'destroy'])->name('navbar_menu.destroy');
        Route::post('/navbar-menu/{menu}/update-order', [NavbarMenuController::class, 'updateOrder'])->name('navbar_menu.update_order');
        
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

// Grup untuk Reporter
Route::middleware(['auth', 'role.reporter'])->group(
    function () {
        // Dashboard Reporter
        Route::get('/reporter', [ReporterController::class, 'dashboard'])->name('reporter.dashboard');

        // Kelola Berita (untuk sidebar)
        Route::get('/reporter/berita', [ReporterController::class, 'index'])->name('reporter.berita');

        // Kelola Files (untuk sidebar)
        Route::get('/reporter/file', [ReporterFileController::class, 'index'])->name('reporter.file');

        // Tambah Berita
        Route::post('/berita', [ReporterBeritaController::class, 'store'])->name('berita.store');

        // Update Berita Reporter
        Route::put('/reporter/berita/{id}', [ReporterBeritaController::class, 'update'])->name('reporter.berita.update');

        Route::delete('/reporter/berita/{id}', [ReporterBeritaController::class, 'destroy'])->name('reporter.berita.destroy');

        Route::post('/upload-file', [ReporterFileController::class, 'upload'])->name('upload.file');
        Route::get('/file', [ReporterFileController::class, 'index'])->name('file.index');
        Route::delete('/file/{id}', [ReporterFileController::class, 'destroy'])->name('file.delete');
        // Route Edit Profile
        Route::put('/settings', [ProfileController::class, 'update'])->name('settings.update');
    }
);
