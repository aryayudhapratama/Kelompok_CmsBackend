<?php

namespace App\Http\Controllers\Reporter;

use App\Http\Controllers\Controller;
use App\Models\BeritaReporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Berita2Controller extends Controller
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $berita = BeritaReporter::findOrFail($id);

        // Opsional: pastikan user yang sedang login hanya bisa update miliknya
        if (auth()->id() !== $berita->user_id) {
            abort(403);
        }

        $berita->judul = $request->judul;
        $berita->konten = $request->konten;
        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            $berita->gambar = $request->file('gambar')->store('berita', 'public');
        }
        $berita->save();

        return redirect()->route('reporter.berita')->with('success', 'Berita berhasil diperbarui.');
    }
}
