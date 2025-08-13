<?php

namespace App\Http\Controllers\Admin;


use Carbon\Carbon;

use Illuminate\Support\Str;
use App\Models\FileManager2;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminFile2Controller extends Controller
{
    public function index(Request $request)
        {
            $query = FileManager2::query();

            if ($request->has('search')) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            }

            $files = $query->orderBy('id', 'asc')->paginate(10);
            return view('admin.file2', compact('files'));
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

   FileManager2::create([
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
   $file = FileManager2::findOrFail($id);
    Storage::delete($file->slug_path);
    $file->delete();

    return response()->json([
        'success' => true,
        'message' => 'File deleted successfully.'
    ]);
}
}
