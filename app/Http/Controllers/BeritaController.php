<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
   public function index()
{
    $beritas = Berita::latest()->get(); // tampilkan semua berita
    return view('redaktur.kelola', compact('beritas'));
}

    public function store(Request $request)
    {
        Berita::create([
    'judul' => $request->judul,
    'konten' => $request->konten,
    'nama_reporter' => $request->nama_reporter,
    'email_reporter' => $request->email_reporter,
]);


        return redirect()->back()->with('success', 'Berita berhasil ditambahkan.');
    }

    public function approve($id)
{
    $berita = Berita::findOrFail($id);
    $berita->status = 'approved';
    $berita->save();

    return redirect()->back()->with('success', 'Berita disetujui.');
}

public function reject(Request $request, $id)
{
    $berita = Berita::findOrFail($id);
    $berita->status = 'rejected';
    $berita->save();

    return redirect()->back()->with('success', 'Berita ditolak.');
}

}
