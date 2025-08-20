<?php

namespace App\Http\Controllers\Admin;

use App\Models\FileManager2;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminFile2Controller extends Controller
{
    public function index()
    {
        $files = FileManager2::with('user')->get(); // ✅ OK jika relasi ada
        return view('admin.file2', compact('files')); // ✅ Sesuai nama view
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
            'nama_file' => 'nullable|string|max:255',
        ]);

        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('dokumen', 'public');

        FileManager2::create([
            'nama' => $request->nama_file ?? $uploadedFile->getClientOriginalName(),
            'slug_path' => $path,
            'user_id' => auth()->id(), // ✅ Simpan user yang login
        ]);

        return response()->json([
            'success' => true,
            'url' => Storage::url($path),
        ]);
    }

    public function destroy($id)
    {
        $file = FileManager2::findOrFail($id);
        Storage::disk('public')->delete($file->slug_path);
        $file->delete();
        // $file = FileManager2::findOrFail($id);
        // $file->delete();

        return response()->json([
            'success' => true,
            'message' => 'File berhasil dihapus!'
        ]);
    }
}