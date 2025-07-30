<?php

namespace App\Http\Controllers;

use App\Models\BeritaReporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    /**
     * Menyimpan berita baru yang dikirim oleh reporter.
     */
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'konten' => 'required',
        'nama_reporter' => 'required|string',
        'email_reporter' => 'required|email',
        'gambar' => 'nullable|image|max:2048', // Maks 2MB
    ]);

    $data = $request->only(['judul', 'konten', 'nama_reporter', 'email_reporter']);

    // Upload gambar jika ada
    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('berita', 'public');
    }

    $data['status'] = 'pending';
    $data['user_id'] = Auth::id();

    BeritaReporter::create($data);

    return redirect()->back()->with('success', 'Berita berhasil dikirim untuk approval.');
}
}