<!-- Modal Tambah Berita -->
<div id="addModal"
     class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-[1000] transition-all duration-300">
  <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-auto overflow-hidden animate-fade-in-up">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
      <h2 class="text-lg font-semibold">New Article</h2>
      <button type="button" onclick="closeAddModal()" class="text-white hover:text-gray-200 text-sm">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <!-- Body -->
    <div class="px-6 py-5 text-sm text-gray-700 space-y-4">
      <form id="formAddNews" method="POST" action="{{ route('redaktur.berita.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
          <label class="block text-sm font-medium mb-1">Title</label>
          <input type="text" name="judul" required class="w-full px-4 py-2 border rounded text-gray-800" />
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Article Image</label>
          <input type="file" name="gambar" accept="image/*"
                 class="w-full px-4 py-2 border rounded text-gray-800 bg-white 
                        file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 
                        file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Content</label>
          <textarea name="konten" rows="5" required class="w-full px-4 py-2 border rounded text-gray-800"></textarea>
        </div>

        <div>
  <label class="block text-sm font-medium mb-1">Article Date</label>
  <input type="date" 
         name="berita_date" 
         required 
         class="w-full px-4 py-2 border rounded text-gray-800 bg-white" />
</div>


        <div>
          <label class="block text-sm font-medium mb-1">Reporter Name</label>
          <input type="text" name="nama_reporter" required class="w-full px-4 py-2 border rounded text-gray-800" />
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Reporter Email</label>
          <input type="email" name="email_reporter" required class="w-full px-4 py-2 border rounded text-gray-800" />
        </div>
      </form>
    </div>

    <!-- Footer -->
    <div class="bg-gray-100 px-6 py-3 text-right">
      
      <button type="submit" form="formAddNews"
              class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        <i class="fas fa-save mr-1"></i> Submit
      </button>
    </div>
  </div>
</div>
