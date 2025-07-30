<?php

namespace App\Http\Controllers\Reporter;

use App\Http\Controllers\Controller;
use App\Models\BeritaReporter; // ✅ Gunakan model baru
use Illuminate\Http\Request;

class ReporterController extends Controller
{
    public function index()
    {
        // Model BeritaReporter akan otomatis menggunakan tabel 'beritas'
        $beritas = BeritaReporter::where('email_reporter', auth()->user()->email)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reporter.dashboard', compact('beritas'));
    }
}