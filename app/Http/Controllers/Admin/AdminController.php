<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FileManager2; // Ganti sesuai nama model file manager kamu

class AdminController extends Controller
{
    // public function index()
    // {
    //     $totalAdmin = User::where('role', 'admin')->count();
    //     $totalRedaktur = User::where('role', 'redaktur')->count();
    //     $totalReporter = User::where('role', 'reporter')->count();
    //     $totalFile = FileManager2::count(); // Ganti sesuai model file manager kamu

    //     return view('admin.admin', compact('totalAdmin', 'totalRedaktur', 'totalReporter', 'totalFile'));
    // }

    public function index()
    {
        // Pastikan role_id valid dan relasi bekerja
        $totalAdmin    = User::whereHas('role', fn($q) => $q->where('name', 'admin'))->count();
        $totalRedaktur = User::whereHas('role', fn($q) => $q->where('name', 'redaktur'))->count();
        $totalReporter = User::whereHas('role', fn($q) => $q->where('name', 'reporter'))->count();
        $totalFile     = FileManager2::count();

        return view('admin.admin', compact('totalAdmin', 'totalRedaktur', 'totalReporter', 'totalFile'));
    }
}