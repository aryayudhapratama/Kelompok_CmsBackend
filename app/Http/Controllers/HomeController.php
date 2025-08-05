<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\LandingSection;

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

    return view('home2', compact('hero', 'kabarBerita', 'galeriBerita'));
}


}
