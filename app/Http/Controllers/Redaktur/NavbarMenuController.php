<?php

namespace App\Http\Controllers\Redaktur; // Namespace untuk controller Anda

use App\Http\Controllers\Controller; // <-- Tambahkan baris ini
use App\Models\NavbarMenu;
use Illuminate\Http\Request;

class NavbarMenuController extends Controller
{
    /**
     * Menampilkan semua menu yang diurutkan.
     */
    public function index()
{
    // Mengambil data dari database yang sudah diurutkan
    $menus = NavbarMenu::with('children')
                        ->whereNull('parent_id')
                        ->orderBy('order', 'asc') 
                        ->get();

    // Hitung nilai urutan tertinggi untuk menu utama (parent_id = null)
    $maxOrderParent = NavbarMenu::whereNull('parent_id')->max('order');

    // Kirim kedua variabel ke view
    return view('redaktur.menu', compact('menus', 'maxOrderParent'));
}

    /**
     * Menyimpan menu baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:navbar_menu,id',
            'order' => 'required|integer',
            'status_aktif' => 'required|boolean',
        ]);

        NavbarMenu::create([
            'title' => $request->title,
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'order' => $request->order,
            'status_aktif' => $request->status_aktif,
        ]);

        return redirect()->route('redaktur.navbar_menu.index')->with('success', 'Menu baru berhasil ditambahkan!');
    }

    /**
     * Memperbarui menu yang sudah ada.
     */
    public function update(Request $request, NavbarMenu $menu)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:navbar_menu,id',
            'order' => 'required|integer',
            'status_aktif' => 'required|boolean',
        ]);

        $menu->update([
            'title' => $request->title,
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'order' => $request->order,
            'status_aktif' => $request->status_aktif,
        ]);

        return redirect()->route('redaktur.navbar_menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Menghapus menu dari database.
     * Menggunakan model binding, Laravel akan otomatis mencari menu berdasarkan ID.
     */
    public function destroy(NavbarMenu $menu)
    {
        $menu->delete();

        return redirect()->route('redaktur.navbar_menu.index')->with('success', 'Menu berhasil dihapus!');
    }

    /**
     * Mengubah urutan menu (up/down).
     */
     public function updateOrder(Request $request, NavbarMenu $menu)
{
    // Logika untuk menemukan menu yang akan ditukar posisinya
    $direction = $request->input('direction');
    $siblings = NavbarMenu::where('parent_id', $menu->parent_id)->orderBy('order')->get();
    $currentOrder = $menu->order;
    $targetMenu = null;

    if ($direction === 'up') {
        $targetMenu = $siblings->where('order', '<', $currentOrder)->sortByDesc('order')->first();
    } elseif ($direction === 'down') {
        $targetMenu = $siblings->where('order', '>', $currentOrder)->sortBy('order')->first();
    }

    if ($targetMenu) {
        // Menukar nilai 'order' di database
        $menu->order = $targetMenu->order;
        $targetMenu->order = $currentOrder;
        $menu->save();
        $targetMenu->save();
    }

    // Redirect untuk memuat ulang halaman
    return response()->json(['success' => true]);
}

}