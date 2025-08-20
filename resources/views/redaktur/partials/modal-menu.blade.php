<div id="menuModal"
     class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-[1000] transition-all duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-auto overflow-hidden animate-fade-in-up">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold">New Menu</h2>
            <button type="button" onclick="closeAddModal()" class="text-white hover:text-gray-200 text-sm">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="px-6 py-5">
            <form id="formAddMenu" method="POST" action="{{ route('redaktur.navbar_menu.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Menu</label>
                    <input type="text" name="title" id="title"
                           class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Masukkan judul menu" required>
                </div>

                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                    <input type="text" name="url" id="url"
                           class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="/dashboard atau /profile">
                </div>

                <div>
                    <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-1">Parent Menu</label>
                    <select name="parent_id" id="parent_id" 
                            class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="" data-max-order="{{ $maxOrderParent }}" selected>-- Tidak ada (menu utama) --</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}" data-max-order="{{ $menu->children->max('order') }}">{{ $menu->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="order" id="order" value="0"
                           class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="status_aktif" value="0">
                    <input type="checkbox" name="status_aktif" id="status_aktif" class="mr-2" value="1" checked>
                    <label for="status_aktif" class="text-sm text-gray-700">Aktif</label>
                </div>
            </form>
        </div>

        <div class="bg-gray-100 px-6 py-3 text-right">
            <button type="submit" form="formAddMenu"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                <i class="fas fa-save mr-1"></i> Submit
            </button>
        </div>
    </div>
</div>