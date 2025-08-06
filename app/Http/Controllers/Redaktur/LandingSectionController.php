<?php

namespace App\Http\Controllers\Redaktur;

use Illuminate\Http\Request;
use App\Models\LandingSection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LandingSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = LandingSection::orderBy('order')->get();
        return view('redaktur.landing.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect()->route('redaktur.landing.index')->with('success', 'Section berhasil ditambahkan');
    }

    // Kembalikan data section untuk modal edit (JSON)
    public function editJson($id)
    {
        $section = LandingSection::findOrFail($id);
        return response()->json($section);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        return redirect()->route('redaktur.landing.index')->with('success', 'Section berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = LandingSection::findOrFail($id);

        if ($section->image) {
            Storage::disk('public')->delete($section->image);
        }

        $section->delete();

        return redirect()->route('redaktur.landing.index')->with('success', 'Section berhasil dihapus');
    }
}
