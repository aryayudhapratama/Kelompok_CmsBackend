<!-- Modal Detail -->
<div id="editModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
    <h3 class="text-lg font-semibold text-blue-700 mb-4">Detail Berita</h3>
    <form method="POST" action="" id="formUpdateDetail" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="hidden" id="editId" name="id" />

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Judul</label>
        <input type="text" id="editJudul" name="judul" class="w-full px-4 py-2 border rounded text-gray-800" />
      </div>

      <div class="mb-4" id="gambarContainer">
        <label class="block text-sm font-medium mb-1">Gambar Berita</label>
        <img id="editGambar" src="" alt="Gambar Berita" class="w-64 h-40 object-cover rounded border shadow mb-2 hidden" />
        <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2 border rounded text-gray-800" />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Konten</label>
        <textarea id="editKonten" name="konten" rows="6" class="w-full px-4 py-2 border rounded text-gray-800"></textarea>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Nama Reporter</label>
        <input type="text" id="editNama" class="w-full px-4 py-2 border rounded text-gray-800" readonly />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Email Reporter</label>
        <input type="text" id="editEmail" class="w-full px-4 py-2 border rounded text-gray-800" readonly />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Tanggal Dibuat</label>
        <input type="text" id="editTanggal" class="w-full px-4 py-2 border rounded text-gray-800" readonly />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Status</label>
        <input type="text" id="editStatus" class="w-full px-4 py-2 border rounded text-gray-800" readonly />
      </div>

      <div class="flex justify-end space-x-2">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Tutup</button>
      </div>
    </form>
  </div>
</div>
