@extends('layouts.redaktur')

@section('title', 'File Manager - Redaktur')
@section('page-title', 'File Manager')

@section('content')
<!-- Wrapper untuk seluruh konten file manager -->
<div class="bg-white p-6 rounded-lg shadow relative z-10">

  <!-- Header: Judul + Search + Button -->
  <div class="flex justify-between items-center mb-4 border-b pb-2 flex-wrap gap-2">
    <h2 class="text-lg font-semibold text-gray-800">Daftar File</h2>
    
    <div class="flex items-center gap-2">
      <!-- Search Input -->
      <input type="text" id="searchInput" name="search"
       value="{{ request('search') }}"
       placeholder="Cari nama file..."
       class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">


      <!-- Upload Button -->
      <button id="btnUploadFile" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
        + Upload File
      </button>
    </div>
  </div>


  <table class="w-full table-auto text-sm text-left border-collapse">
    <thead class="bg-gray-100 text-gray-600">
      <tr>
        <th class="px-4 py-2">ID</th>
        <th class="px-4 py-2">Date Added</th>
        <th class="px-4 py-2">Nama File</th>
        <th class="px-4 py-2">Slug Path</th>
        <th class="px-4 py-2">User</th>
        <th class="px-4 py-2">Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($files as $file)
      <tr class="border-t hover:bg-gray-50">
        <td class="px-4 py-2">{{ $file->id }}</td>
        <td class="px-4 py-2">{{ $file->created_at->format('d F Y') }}</td>
        <td class="px-4 py-2 max-w-[180px] truncate whitespace-nowrap overflow-hidden">
  {{ $file->nama }}
</td>

<td class="px-4 py-2 max-w-[260px] truncate whitespace-nowrap overflow-hidden text-blue-600 underline">
  <a href="{{ url($file->slug_path) }}" target="_blank" class="text-blue-600 underline">
    {{ url($file->slug_path) }}
  </a>
</td>

        <td class="px-4 py-2">{{ $file->user }}</td>
       <td class="px-4 py-2">
  <div class="flex items-center gap-2">

    <!-- Tombol Detail -->
    <button 
      type="button"
      class="w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition btn-detail"
      title="Lihat Detail"
      data-nama="{{ $file->nama }}"
      data-url="{{ $file->slug_path }}"
      data-user="{{ $file->user }}"
      data-created="{{ $file->created_at }}"
      data-updated="{{ $file->updated_at }}"
    >
      <i class="fas fa-eye text-base"></i>
    </button>
    <!-- Tombol Copy -->
<button 
  type="button"
  class="w-10 h-10 bg-green-100 text-green-700 hover:bg-green-200 rounded-md flex items-center justify-center transition btn-copy"
  title="Copy Link"
  data-url="{{ url($file->slug_path) }}"
>
  <i class="fas fa-copy text-base"></i>
</button>


    <!-- Tombol Hapus -->
    <form method="POST" action="{{ route('redaktur.file.delete', $file->id) }}" class="form-hapus inline-block m-0 p-0">
  @csrf
  @method('DELETE')
  <button 
    type="button"
    class="w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition btn-hapus"
    title="Hapus File"
    data-id="{{ $file->id }}"
  >
    <i class="fas fa-trash text-base"></i>
  </button>
</form>

  </div>
</td>
      </tr>
      @empty
      <tr>
        <td colspan="7" class="px-4 py-4 text-center text-gray-400 italic">Belum ada file</td>
      </tr>
      @endforelse
    </tbody>
  </table>
  <div class="mt-4">
    {{ $files->appends(request()->query())->links() }}

</div>

</div>
@endsection

<!-- Modal Upload -->
<div id="uploadModal"
     class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-[1000] transition-all duration-300">

  <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto overflow-hidden animate-fade-in-up">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
      <h2 class="text-lg font-semibold">Upload File</h2>
      <button type="button" onclick="closeUploadModal()" class="text-white hover:text-gray-200 text-sm">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <!-- Body -->
    <div class="px-6 py-5">
      <form id="uploadForm" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
          <label for="uploadFile" class="block text-sm font-medium text-gray-700 mb-1">Pilih File</label>
          <input type="file" name="file" id="uploadFile"
                 class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                 required>
        </div>
      </form>
    </div>

    <!-- Footer -->
    <div class="bg-gray-100 px-6 py-3 text-right space-x-2">
      
      <button type="submit" form="uploadForm"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold transition">
        Upload
      </button>
    </div>
  </div>
</div>


<!-- Modal Detail -->
<div id="detailModal"
     class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-[1000] transition-all duration-300">


  <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto overflow-hidden animate-fade-in-up">
    <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
      <h2 class="text-lg font-semibold">Detail File</h2>
      <button onclick="closeDetailModal()" class="text-white hover:text-gray-200 text-sm">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="px-6 py-5 text-sm text-gray-700 space-y-3">
      <div class="flex items-center gap-3"><i class="fas fa-file-alt text-blue-500"></i>
        <p><strong>Nama:</strong> <span id="detailNama"></span></p></div>
      <div class="mt-4" id="previewContainer">
  <p class="font-semibold mb-1">Preview:</p>
  <div id="filePreview" class="w-full h-64 border rounded overflow-hidden bg-white flex items-center justify-center">
    <span class="text-gray-400 italic">Tidak ada preview tersedia</span>
  </div>
</div>
      <div class="flex items-center gap-3"><i class="fas fa-link text-blue-500"></i>
        <p><strong>URL:</strong> <a id="detailUrl" href="#" target="_blank" class="text-blue-600 underline break-all"></a></p></div>
      <div class="flex items-center gap-3"><i class="fas fa-user text-blue-500"></i>
        <p><strong>User/Role:</strong> <span id="detailUser"></span></p></div>
      <div class="flex items-center gap-3"><i class="fas fa-calendar-plus text-blue-500"></i>
        <p><strong>Dibuat:</strong> <span id="detailCreated"></span></p></div>
      <div class="flex items-center gap-3"><i class="fas fa-calendar-check text-blue-500"></i>
        <p><strong>Diupdate:</strong> <span id="detailUpdated"></span></p></div>
    </div>
    <div class="bg-gray-100 px-6 py-3 text-right">
      <button onclick="closeDetailModal()" class="text-sm text-blue-600 hover:text-blue-800 transition font-semibold">
        <i class="fas fa-arrow-left mr-1"></i> Tutup
      </button>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // Buka Modal Upload
  document.getElementById('btnUploadFile').addEventListener('click', function () {
    document.getElementById('uploadModal').classList.remove('hidden');
    document.getElementById('uploadModal').classList.add('flex');
  });

  function closeUploadModal() {
    document.getElementById('uploadModal').classList.add('hidden');
    document.getElementById('uploadModal').classList.remove('flex');
    document.getElementById('uploadForm').reset();
   
  }

  // Upload File
  document.getElementById('uploadForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch("{{ route('redaktur.upload.file') }}", {
      method: "POST",
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        closeUploadModal();
        showUploadSuccessToast("File berhasil diupload!");
        setTimeout(() => window.location.reload(), 2000);
      } else {
        showUploadErrorToast("Upload gagal.");
      }
    })
    .catch(err => {
      console.error(err);
      showUploadErrorToast("Terjadi kesalahan saat upload.");
    });
  });

  // Modal Detail
  document.querySelectorAll('.btn-detail').forEach(btn => {
    btn.addEventListener('click', function () {
  document.getElementById('detailNama').innerText = this.dataset.nama;
  document.getElementById('detailUrl').innerText = this.dataset.url;
  document.getElementById('detailUrl').href = this.dataset.url;
  document.getElementById('detailUser').innerText = this.dataset.user;
  document.getElementById('detailCreated').innerText = this.dataset.created;
  document.getElementById('detailUpdated').innerText = this.dataset.updated;

  // Preview file
  const previewContainer = document.getElementById('filePreview');
  const fileUrl = this.dataset.url.toLowerCase();
  previewContainer.innerHTML = ""; // Kosongkan

  if (fileUrl.endsWith(".pdf")) {
    previewContainer.innerHTML = `
      <iframe src="${this.dataset.url}" class="w-full h-full" frameborder="0"></iframe>
    `;
  } else if (fileUrl.match(/\.(jpeg|jpg|png|gif|webp)$/)) {
    previewContainer.innerHTML = `
      <img src="${this.dataset.url}" alt="Preview Gambar" class="max-h-full max-w-full object-contain">
    `;
  } else {
    previewContainer.innerHTML = `<span class="text-gray-400 italic">Preview tidak tersedia untuk jenis file ini</span>`;
  }

  document.getElementById('detailModal').classList.remove('hidden');
  document.getElementById('detailModal').classList.add('flex');
});

  });

// Filter file berdasarkan nama

let searchTimeout;

document.getElementById('searchInput').addEventListener('input', function () {
    clearTimeout(searchTimeout); // reset timeout sebelumnya

    searchTimeout = setTimeout(() => {
        const keyword = this.value.trim();
        const url = new URL(window.location.href);

        if (keyword.length > 0) {
            url.searchParams.set('search', keyword);
        } else {
            url.searchParams.delete('search');
        }

        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }, 500); // delay 500ms (bisa diubah ke 300ms kalau mau lebih cepat)
});

  function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
    document.getElementById('detailModal').classList.remove('flex');
  }

  function showUploadSuccessToast(message) {
    const toast = document.createElement("div");
    toast.setAttribute("x-data", "{ show: true }");
    toast.setAttribute("x-init", "setTimeout(() => show = false, 3000)");
    toast.setAttribute("x-show", "show");
    toast.setAttribute("x-transition.opacity", "");
    toast.className = "fixed inset-0 z-50 flex items-center justify-center bg-black/40";

    toast.innerHTML = `
      <div class="bg-gradient-to-br from-teal-400 to-cyan-500 text-white rounded-xl shadow-xl p-8 w-[90%] max-w-md text-center relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-14 w-14 mb-4" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <h2 class="text-2xl font-bold mb-1">Success!</h2>
        <p class="text-sm">${message}</p>
      </div>
    `;

    document.body.appendChild(toast);
  }

  function showUploadErrorToast(message) {
    const toast = document.createElement("div");
    toast.setAttribute("x-data", "{ show: true }");
    toast.setAttribute("x-init", "setTimeout(() => show = false, 3000)");
    toast.setAttribute("x-show", "show");
    toast.setAttribute("x-transition.opacity", "");
    toast.className = "fixed inset-0 z-50 flex items-center justify-center bg-black/40";

    toast.innerHTML = `
      <div class="bg-gradient-to-br from-red-500 to-orange-500 text-white rounded-xl shadow-xl p-8 w-[90%] max-w-md text-center relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-14 w-14 mb-4" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 5a7 7 0 110 14a7 7 0 010-14z" />
        </svg>
        <h2 class="text-2xl font-bold mb-1">Error!</h2>
        <p class="text-sm">${message}</p>
      </div>
    `;

    document.body.appendChild(toast);
  }

   document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.btn-hapus').forEach(button => {
    button.addEventListener('click', function () {
      const form = this.closest('form');

      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Berita yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });
});

document.querySelectorAll('.btn-copy').forEach(button => {
    button.addEventListener('click', function () {
      const url = this.dataset.url;

      navigator.clipboard.writeText(url)
        .then(() => {
          showUploadSuccessToast("URL berhasil disalin!");
        })
        .catch(() => {
          showUploadErrorToast("Gagal menyalin URL.");
        });
    });
  });
  
</script>
@endpush
