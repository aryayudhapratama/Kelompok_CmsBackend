<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingSectionController extends Controller
{
    // Tampilkan semua section
    public function index()
    {
        $sections = LandingSection::orderBy('order')->get();
        return view('admin.landing.index', compact('sections'));
    }

    // Simpan section baru
    public function store(Request $request)
    {
        $request->validate([
            'section_name' => 'required|unique:landing_sections',
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'button_text' => 'nullable|string',
            'order' => 'required|integer',
        ]);

        $data = $request->only(['section_name', 'title', 'content', 'link', 'button_text', 'order']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('landing', 'public');
        }

        LandingSection::create($data);

        return redirect()->route('admin.landing.index')->with('success', 'Section berhasil ditambahkan');
    }

    // Kembalikan data section untuk modal edit (JSON)
    public function editJson($id)
    {
        $section = LandingSection::findOrFail($id);
        return response()->json($section);
    }

    // Update section
    public function update(Request $request, $id)
    {
        $section = LandingSection::findOrFail($id);

        $request->validate([
            'section_name' => 'required|unique:landing_sections,section_name,' . $id,
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'button_text' => 'nullable|string',
            'order' => 'required|integer',
        ]);

        $data = $request->only(['section_name', 'title', 'content', 'link', 'button_text', 'order']);

        if ($request->hasFile('image')) {
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }
            $data['image'] = $request->file('image')->store('landing', 'public');
        }

        $section->update($data);

        return redirect()->route('admin.landing.index')->with('success', 'Section berhasil diperbarui');
    }

    // Hapus section
    public function destroy($id)
    {
        $section = LandingSection::findOrFail($id);

        if ($section->image) {
            Storage::disk('public')->delete($section->image);
        }

        $section->delete();

        return redirect()->route('admin.landing.index')->with('success', 'Section berhasil dihapus');
    }
}