<?php

namespace App\Http\Controllers\Redaktur;

use App\Http\Controllers\Controller; // ✅ Tambahkan baris ini
use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('redaktur.kelola', compact('beritas'));
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'judul' => 'required|string|max:255',
        'konten' => 'required|string',
        'nama_reporter' => 'required|string|max:100',
        'email_reporter' => 'required|email',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('berita', 'public');
    }

    $data['status'] = 'pending';
    Berita::create($data);

    return redirect()->back()->with('success', 'Berita berhasil ditambahkan.');
}


    public function approve($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->status = 'approved';
        $berita->save();

        return redirect()->back()->with('success', 'Berita "' . $berita->judul . '" disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $berita->status = 'rejected';
        $berita->save();

        // Bisa juga simpan alasan penolakan ke kolom baru, misalnya: $berita->alasan = $request->alasan;
        return redirect()->back()->with('success', 'Berita "' . $berita->judul . '" ditolak karena: ' . $request->alasan);
    }

    public function dashboard()
    {
        $approvedCount = Berita::where('status', 'approved')->count();
        $waitingCount = Berita::where('status', 'pending')->count();
        $rejectedCount = Berita::where('status', 'rejected')->count();

        return view('redaktur.dashboard', compact('approvedCount', 'waitingCount', 'rejectedCount'));
    }

   public function publish($id)
{
    $berita = Berita::findOrFail($id);

    if ($berita->status !== 'approved') {
        return redirect()->back()->with('error', 'Berita harus disetujui sebelum dipublikasikan.');
    }

    $berita->is_published = true;
    $berita->save();

    return redirect()->back()->with('success', 'Berita berhasil dipublikasikan.');
}

public function unpublish($id)
{
    $berita = Berita::findOrFail($id);
    $berita->is_published = false;
    $berita->save();

    return redirect()->back()->with('success', 'Berita berhasil dihentikan tayangnya.');
}


public function daftarPublish()
{
    $beritas = Berita::where('status', 'approved')->get();
    return view('redaktur.publish', compact('beritas'));
}

public function update(Request $request, $id)
{
    $berita = Berita::findOrFail($id);

    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'konten' => 'required|string',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Jika upload gambar baru
    if ($request->hasFile('gambar')) {
        $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
    }

    $berita->update($validated);

    return redirect()->back()->with('success', 'Berita berhasil diperbarui.');
}


}
