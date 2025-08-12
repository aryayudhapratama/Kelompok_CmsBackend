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

        $files = $query->orderBy('id', 'asc')->get();
        return view('reporter.file', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,png,jpg,jpeg|max:20480',
        ]);

        $file = $request->file('file');

        // Cek apakah ada input nama_file
        $fileNameInput = $request->input('nama_file');

        // Tentukan nama file yang akan disimpan di database
        // Jika nama file diinput, gunakan itu. Jika tidak, gunakan nama asli dari file yang diunggah.
        $finalFileName = $fileNameInput ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $datePath = Carbon::now()->format('mY');
        $fileName = Str::slug($finalFileName) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs("public/dokumen/$datePath", $fileName);

        $url = Storage::url("dokumen/$datePath/$fileName");

        FileManager::create([
            'nama' => $finalFileName . '.' . $file->getClientOriginalExtension(), // Simpan nama file lengkap dengan ekstensi
            'slug_path' => $url,
            'user' => auth()->user()->role,
        ]);

        return response()->json([
            'success' => true,
            'url' => asset($url),
        ]);
    }

    public function destroy($id)
    {
        $file = FileManager::findOrFail($id);

        // Hapus file fisik dari storage (jika ada)
        $relativePath = str_replace('/storage/', '', $file->slug_path);
        Storage::delete('public/' . $relativePath);

        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }
}
