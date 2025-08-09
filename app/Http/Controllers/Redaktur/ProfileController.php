<?php

namespace App\Http\Controllers\Redaktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;

        // ✅ Upload foto profil
        if ($request->hasFile('profile_photo')) {
            $filename = time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->storeAs('public/profile-photos', $filename);
            $user->profile_photo_path = $filename;
        }

        // ✅ Ganti password kalau diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile Berhasil Diperbarui.');
    }
}
