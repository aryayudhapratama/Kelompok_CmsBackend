<?php

namespace App\Http\Controllers\Reporter;

use App\Http\Controllers\Controller;
use App\Models\BeritaReporter;
use Illuminate\Http\Request;

class ReporterController extends Controller
{
    public function index()
    {
        $beritas = BeritaReporter::where('email_reporter', auth()->user()->email)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reporter.berita', compact('beritas'));
    }

    public function dashboard()
    {
        $email = auth()->user()->email;

        $approvedCount = BeritaReporter::where('status', 'approved')->where('email_reporter', $email)->count();
        $waitingCount = BeritaReporter::where('status', 'pending')->where('email_reporter', $email)->count();
        $rejectedCount = BeritaReporter::where('status', 'rejected')->where('email_reporter', $email)->count();

        return view('reporter.dashboard', compact('approvedCount', 'waitingCount', 'rejectedCount'));
    }
}
