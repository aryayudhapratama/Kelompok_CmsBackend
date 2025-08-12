<!-- Modal Detail Berita -->
<div id="editModal"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center z-50 transition-all duration-300">

    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto animate-fade-in-up">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Article Properties</h2>
            <button onclick="closeEditModal()" class="text-white hover:text-gray-200 text-sm">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Body -->
        <form method="POST" action="" id="formUpdateDetail" enctype="multipart/form-data"
            class="px-6 py-5 text-sm text-gray-700 space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" id="editId" name="id" />

            <div>
                <label class="block font-medium mb-1">Title</label>
                <input type="text" id="editJudul" name="judul"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
            </div>

            <div id="gambarContainer">
                <label class="block font-medium mb-1">Article Image</label>
                <img id="editGambar" src="" alt="Gambar Berita"
                    class="w-64 h-40 object-cover rounded shadow border mb-2 hidden" />
                <input type="file" name="gambar" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
            </div>

            <div>
                <label class="block font-medium mb-1">Content</label>
                <textarea id="editKonten" name="konten" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Article Date</label>
                <input type="date" name="berita_date" id="editBeritaDate" class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-1"></i> Save
                </button>

            </div>
        </form>
    </div>
</div>
