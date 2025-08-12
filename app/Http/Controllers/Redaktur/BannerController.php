<?php

namespace App\Http\Controllers\Redaktur;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('redaktur.banner', compact('banners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|url',
            'role' => 'required|in:admin,redaktur,reporter',
        ]);

        $banner = Banner::create($validated);

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
            'role' => 'required|in:admin,redaktur,reporter',
        ]);

        $banner->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Banner berhasil diperbarui!',
            'banner' => $banner
        ]);
    }

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