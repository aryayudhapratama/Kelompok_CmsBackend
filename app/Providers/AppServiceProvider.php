<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import Facade View
use App\Models\NavbarMenu; // Import Model NavbarMenu

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View Composer untuk partials header Anda
        // Setiap kali 'partials.header' di-render, kode ini akan dijalankan
        // dan variabel $menus akan tersedia di sana.
        View::composer('partials.header', function ($view) {
            $menus = NavbarMenu::with('children') // Menggunakan eager loading untuk sub-menu
                ->whereNull('parent_id')           // Ambil hanya menu utama
                ->where('status_aktif', 1)         // Hanya tampilkan menu yang aktif
                ->orderBy('order')                 // Urutkan berdasarkan kolom 'order'
                ->get();

            $view->with('menus', $menus); // Masukkan variabel $menus ke dalam view
        });
    }
}