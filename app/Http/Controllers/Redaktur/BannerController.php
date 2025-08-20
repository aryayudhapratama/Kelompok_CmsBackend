<?php

namespace App\Http\Controllers\Redaktur;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Tampilkan semua banner
     */
    public function index()
    {
        $banners = Banner::all();
        return view('redaktur.banner', compact('banners'));
    }

    /**
     * Tambahkan banner baru
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'link' => 'required|url',
        'button_text' => 'nullable|string|max:50',
        // 'role' dihapus dari validasi karena diisi otomatis
    ]);

    $banner = Banner::create([
        'name' => $validated['name'],
        'description' => $validated['description'],
        'link' => $validated['link'],
        'button_text' => $validated['button_text'],
        'role' => 'redaktur', // Otomatis isi redaktur
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Banner berhasil ditambahkan!',
        'banner' => $banner
    ]);
}

public function update(Request $request, $id)
{
    $banner = Banner::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'link' => 'required|url',
        'button_text' => 'nullable|string|max:50',
    ]);

    $banner->update([
        'name' => $validated['name'],
        'description' => $validated['description'],
        'link' => $validated['link'],
        'button_text' => $validated['button_text'],
        'role' => 'redaktur', // Tetap redaktur
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Banner berhasil diperbarui!',
        'banner' => $banner
    ]);
}

    /**
     * Hapus banner
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return response()->json([
            'success' => true,
            'message' => 'Banner berhasil dihapus!'
        ]);
    }
}