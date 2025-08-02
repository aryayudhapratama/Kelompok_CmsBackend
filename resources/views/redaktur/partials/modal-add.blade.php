<!-- Modal Tambah Berita -->
<div id="addModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg w-full max-w-xl">
    <h3 class="text-lg font-semibold text-blue-700 mb-4">Tambah Berita</h3>
    
    <form id="formAddNews" method="POST" action="{{ route('redaktur.berita.store') }}" enctype="multipart/form-data">

      @csrf
      
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Judul</label>
        <input type="text" name="judul" required class="w-full px-4 py-2 border rounded text-gray-800" />
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium mb-1">Gambar Berita</label>
        <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2 border rounded text-gray-800 bg-white file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Konten</label>
        <textarea name="konten" rows="5" required class="w-full px-4 py-2 border rounded text-gray-800"></textarea>
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Nama Reporter</label>
        <input type="text" name="nama_reporter" required class="w-full px-4 py-2 border rounded text-gray-800" />
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Email Reporter</label>
        <input type="email" name="email_reporter" required class="w-full px-4 py-2 border rounded text-gray-800" />
      </div>    
      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Batal</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
      </div>
    </form>
  </div>
</div>
