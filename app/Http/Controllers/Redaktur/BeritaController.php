<?php

namespace App\Http\Controllers\Redaktur;

use App\Http\Controllers\Controller; // ✅ Tambahkan baris ini
use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index(Request $request)
{
    $query = Berita::query();

    // ✅ Cek apakah ada parameter 'search'
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;

        // Filter berdasarkan judul, nama reporter, atau email reporter
        $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', '%' . $search . '%')
              ->orWhere('nama_reporter', 'like', '%' . $search . '%')
              ->orWhere('email_reporter', 'like', '%' . $search . '%');
        });
    }

    // ✅ Pagination dan tetap mempertahankan query string (search)
    $beritas = $query->orderBy('id', 'asc')->paginate(10)->appends($request->only('search'));

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


public function daftarPublish(Request $request)
{
    $query = Berita::where('status', 'approved'); // ✅ mulai dari berita yang status-nya approved saja
    
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', '%' . $search . '%')
              ->orWhere('nama_reporter', 'like', '%' . $search . '%')
              ->orWhere('email_reporter', 'like', '%' . $search . '%');
        });
    }

    $beritas = $query->orderBy('id', 'asc')->paginate(10)->appends($request->only('search'));

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

public function destroy($id)
{
    $berita = Berita::findOrFail($id);

    // Hapus gambar dari storage jika ada
    if ($berita->gambar && \Storage::exists('public/' . $berita->gambar)) {
        \Storage::delete('public/' . $berita->gambar);
    }

    $berita->delete();

    return redirect()->back()->with('success', 'Berita berhasil dihapus.');
}


}
