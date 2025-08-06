<?php

namespace App\Http\Controllers\Reporter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\FileManager;

class ReporterFileController extends Controller
{
    public function index(Request $request)
    {
        $query = FileManager::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $files = $query->orderBy('id', 'asc')->paginate(10);
        return view('reporter.file', compact('files'));
    }


    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,png,jpg,jpeg|max:20480',
        ]);

        $file = $request->file('file');
        $datePath = Carbon::now()->format('mY');
        $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs("public/dokumen/$datePath", $fileName);

        $url = Storage::url("dokumen/$datePath/$fileName"); // Hasil: /storage/dokumen/082025/nama.pdf

        FileManager::create([
            'nama' => $file->getClientOriginalName(),
            'slug_path' => $url,
            'user' => auth()->user()->role, // ✅ cukup ini
        ]);

        return response()->json([
            'success' => true,
            'url' => asset($url), // Public full URL: http://localhost:8000/storage/...
        ]);
    }

    public function destroy($id)
    {
        $file = FileManager::findOrFail($id);

        // Opsional: cek ownership
        // if ($file->user !== auth()->user()->role) {
        //     return response()->json(['success' => false, 'message' => 'Akses ditolak.'], 403);
        // }

        // Hapus file dari storage
        // $relativePath = str_replace('/storage/', '', $file->slug_path);
        // if (Storage::exists('public/' . $relativePath)) {
        //     Storage::delete('public/' . $relativePath);
        // }

        $file->delete();

        return response()->json([
            'success' => true,
            'message' => 'File berhasil dihapus.'
        ]);
    }
}
