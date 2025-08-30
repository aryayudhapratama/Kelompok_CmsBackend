<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    // Tampilkan semua role
    public function index()
    {
        $roles = Role::all();
        return view('admin.role', compact('roles'));
    }

    // Simpan role baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string'
        ]);

        Role::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil ditambahkan'
        ]);
    }

    // Update role
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string'
        ]);

        $role->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil diupdate'
        ]);
    }

    // Hapus role
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            'success' => true,
            'message' => 'Role berhasil dihapus'
        ]);
    }
}
