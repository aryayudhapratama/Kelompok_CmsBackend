<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Tamplate Bootstrap
Route::get('/', function () {
    return view('home2');
})->name('home2');

// // Halaman statis
// Route::get('/about', function () {
//     return view('frontend.about');
// })->name('about');

// Route::get('/careers', function () {
//     return view('frontend.careers');
// })->name('careers');

// Route::get('/case-studies', function () {
//     return view('frontend.case_studies');
// })->name('case-studies');

// Route::get('/terms', function () {
//     return view('frontend.terms');
// })->name('terms-conditions');

// Route::get('/privacy-policy', function () {
//     return view('frontend.privacy_policy');
// })->name('privacy-policy');

// Route::get('/404', function () {
//     return view('frontend.404');
// })->name('404');

// Route::get('/signup', function () {
//     return view('frontend.signup');
// })->name('signup');

// Route::get('/signin', function () {
//     return view('frontend.signin');
// })->name('signin');

// Route::get('/forgot-password', function () {
//     return view('frontend.forgot_password');
// })->name('forgot-password');

// Route::get('/coming-soon', function () {
//     return view('frontend.coming_soon');
// })->name('coming-soon');

// Route::get('/portfolio-masonry', function () {
//     return view('frontend.portfolio_masonry');
// })->name('portfolio-masonry');

// Jetstream
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
    
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('admin');
//     })->name('admin');
// });

// // Route untuk admin
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin', function () {
//         return view('admin.admin');
//     })->name('admin.admin');
// });

// // Route untuk redaktur
// Route::middleware(['auth', 'role:redaktur'])->group(function () {
//     Route::get('/redaktur', function () {
//         return view('redaktur.dashboard');
//     })->name('redaktur.dashboard');
// });

// // Route untuk reporter
// Route::middleware(['auth', 'role:reporter'])->group(function () {
//     Route::get('/reporter', function () {
//         return view('reporter.dashboard');
//     })->name('reporter.dashboard');
// });

// Untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.admin');
    })->name('admin.admin');
});

Route::middleware(['auth', 'role.admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Untuk redaktur
Route::middleware(['auth', 'role:redaktur'])->group(function () {
    Route::get('/redaktur', function () {
        return view('redaktur.redaktur');
    })->name('redaktur.redaktur');
});

// Untuk reporter
Route::middleware(['auth', 'role:reporter'])->group(function () {
    Route::get('/reporter', function () {
        return view('reporter.reporter');
    })->name('reporter.reporter');
});