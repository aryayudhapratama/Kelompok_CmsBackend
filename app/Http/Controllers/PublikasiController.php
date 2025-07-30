<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\LandingSection;

class PublikasiController extends Controller
{
    public function index()
{
    $beritas = Berita::where('status', 'approved')
                    ->where('is_published', true)
                    ->latest()
                    ->get();

    $hero = LandingSection::where('section_name', 'hero')->first();

    return view('publikasi.publikasi', compact('beritas', 'hero'));
}


    public function show($id)
{
    $berita = Berita::findOrFail($id);
    return view('publikasi.detail', compact('berita'));
}

}

