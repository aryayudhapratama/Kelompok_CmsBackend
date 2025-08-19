<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\LandingSection;
use App\Models\Banner;
use App\Models\NavbarMenu;

class HomeController extends Controller
{
    public function index()
    {
        $hero = LandingSection::where('section_name', 'hero')->first();
        
        $kabarBerita = Berita::where('status', 'approved')
                            ->where('is_published', true)
                            ->latest()
                            ->take(3)
                            ->get();

        $galeriBerita = Berita::whereNotNull('gambar')
                            ->where('status', 'approved')
                            ->where('is_published', true)
                            ->latest()
                            ->take(6)
                            ->get();

        // ✅ Ambil SEMUA banner, tanpa filter role
        $banners = Banner::all();

        // Jika tidak ada banner sama sekali, tampilkan data default
        if ($banners->isEmpty()) {
            $banners = collect([
                (object) [
                    'name' => 'Informasi Berkala',
                    'description' => 'Informasi yang wajib diperbaharui kemudian disediakan dan diumumkan kepada publik secara rutin atau berkala sekurang-kurangnya setiap 6 bulan sekali.'
                ],
                (object) [
                    'name' => 'Informasi Serta Merta',
                    'description' => 'Informasi yang disediakan berkaitan dengan hajat hidup orang banyak dan ketertiban umum, serta wajib diumumkan secara serta merta tanpa penundaan.'
                ],
                (object) [
                    'name' => 'Informasi Setiap Saat',
                    'description' => 'Informasi yang harus disediakan oleh Badan Publik dan siap tersedia untuk diberikan kepada Pemohon Informasi Publik ketika diminta.'
                ],
                (object) [
                    'name' => 'Informasi Yang Dikecualikan',
                    'description' => 'Informasi yang tidak dapat diakses oleh Pemohon Informasi Publik karena alasan tertentu sesuai peraturan perundang-undangan.'
                ],
                (object) [
                    'name' => 'Maklumat Pelayanan Informasi Publik',
                    'description' => 'Pejabat PPID menyatakan semaksimal mungkin menjalankan Standar Pelayanan terhadap permohonan informasi publik di wilayahnya.'
                ]
            ]);
        }

        $menus = NavbarMenu::with('children') // Menggunakan 'with' untuk eager loading, lebih efisien
            ->whereNull('parent_id')
            ->where('status_aktif', 1)
            ->orderBy('order')
            ->get();

        return view('home2', compact('hero', 'kabarBerita', 'galeriBerita', 'banners'));
    }
}