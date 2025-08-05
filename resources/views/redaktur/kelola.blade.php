@extends('layouts.redaktur')

@section('title', 'Approval Berita - Redaktur')
@section('page-title', 'Kelola Berita')

@section('content')
<div class="bg-white p-6 rounded-lg shadow relative z-10">
  <!-- Header -->
  <div class="flex justify-between items-center mb-4 border-b pb-2">
    <h2 class="text-lg font-semibold text-gray-800">Approval Queue</h2>
    <div class="flex items-center gap-2">
      <div class="relative">
        <input type="text" id="searchInput" name="search"
       value="{{ request('search') }}"
       placeholder="Cari nama berita..."
       class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

      </div>
      <button id="btnAddNews"
        class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus-circle mr-1"></i> Tambah Berita
      </button>
    </div>
  </div>

  <!-- Card List -->
  <div id="cardContainer" class="space-y-6">
    @foreach ($beritas as $berita)
    <div class="card border rounded-lg overflow-hidden shadow bg-white" data-title="{{ strtolower($berita->judul) }}">
      <div class="bg-gray-50 px-4 py-3 flex justify-between items-center">
        <p class="font-semibold text-red-600">{{ $berita->judul }}</p>
        <div class="flex items-center space-x-2 relative">
          @if($berita->status === 'pending')
          <!-- Approve -->
<form method="POST" action="{{ route('redaktur.berita.approve', $berita->id) }}">

            @csrf
            <button type="submit"
              class="btn-approve flex items-center gap-1 px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">
              <i class="fas fa-check-circle"></i> Approve
            </button>
          </form>

          <div class="relative inline-block text-left">
            <button id="dropdownBtn-{{ $berita->id }}" type="button"
              class="flex items-center gap-1 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
              <i class="fas fa-times-circle"></i> Reject
              <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div id="dropdownMenu-{{ $berita->id }}"
              class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
              @foreach (['Kurang Lengkap', 'Judul tidak sesuai', 'Konten tidak layak'] as $alasan)
              <form method="POST" action="{{ route('redaktur.berita.reject', $berita->id) }}">
                @csrf
                <input type="hidden" name="alasan" value="{{ $alasan }}">
                <button type="submit"
                  class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">{{ $alasan }}</button>
              </form>
              @endforeach
            </div>
          </div>
          @else
          <span class="text-sm font-semibold px-4 py-2 rounded-lg
            {{ $berita->status == 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            {{ ucfirst($berita->status) }}
          </span>
          @endif
        </div>
      </div>

      <!-- Tabel Berita -->
      <table class="w-full text-sm text-left table-fixed">
        <thead class="bg-gray-100 text-gray-600">
         <tr>
          <th class="px-4 py-2">ID</th>
    <th class="px-4 py-2">Date Added</th>
    <th class="px-4 py-2">Full Name</th>
    <th class="px-4 py-2">Email</th>
    <th class="px-4 py-2">Title</th>
    <th class="px-4 py-2">Image</th> {{-- Kolom gambar --}}
    <th class="px-4 py-2">Action</th>
  </tr>
</thead>

        <tbody>
  <tr class="border-t hover:bg-gray-50">
    <td class="px-4 py-2">{{ $berita->id }}</td>
    <td class="px-4 py-2">{{ $berita->created_at->format('d F Y') }}</td>
    <td class="px-4 py-2">{{ $berita->nama_reporter }}</td>
    <td class="px-4 py-2">{{ $berita->email_reporter }}</td>
    <td class="px-4 py-2">{{ $berita->judul }}</td>

    <td class="px-4 py-2">
      @if($berita->gambar)
        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar"
             class="w-24 h-16 object-cover rounded shadow border" />
      @else
        <span class="text-gray-400 italic">Tidak ada gambar</span>
      @endif
    </td>

    <td class="px-4 py-2">
  <div class="flex items-center gap-2">
    <!-- Tombol Detail -->
    <button type="button"
      class="btn-detail w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition"
      title="Lihat Detail"
      data-judul="{{ $berita->judul }}"
      data-konten="{{ $berita->konten }}"
      data-nama="{{ $berita->nama_reporter }}"
      data-email="{{ $berita->email_reporter }}"
      data-tanggal="{{ $berita->created_at->format('d F Y H:i') }}"
      data-status="{{ $berita->status }}"
      data-gambar="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : '' }}"
    >
      <i class="fas fa-eye text-base"></i>
    </button>

    <!-- Tombol Hapus -->
    <!-- Tombol Hapus (pakai SweetAlert) -->
<form method="POST" action="{{ route('redaktur.berita.delete', $berita->id) }}" class="form-hapus">
  @csrf
  @method('DELETE')
  <button 
    type="button"
    class="w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition btn-hapus"
    title="Hapus Berita"
    data-id="{{ $berita->id }}"
  >
    <i class="fas fa-trash text-base"></i>
  </button>
</form>

  </div>
</td>

  </tr>
</tbody>

      </table>
    </div>
    @endforeach
    <!-- Pagination -->
<div class="mt-6">
    {{ $beritas->links('vendor.pagination.tailwind') }}
</div>

  </div>
</div>

@include('redaktur.partials.modal-add')
@include('redaktur.partials.modal-detail')
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Modal detail
    document.querySelectorAll('.btn-detail').forEach(btn => {
      btn.addEventListener('click', function () {
        document.getElementById('editJudul').value = this.dataset.judul;
        document.getElementById('editKonten').value = this.dataset.konten;
        document.getElementById('editNama').value = this.dataset.nama;
        document.getElementById('editEmail').value = this.dataset.email;
        document.getElementById('editTanggal').value = this.dataset.tanggal;
        document.getElementById('editStatus').value = this.dataset.status;
        // Set gambar jika ada
const gambarElement = document.getElementById('editGambar');
const gambarContainer = document.getElementById('gambarContainer');
if (this.dataset.gambar) {
  gambarElement.src = this.dataset.gambar;
  gambarElement.classList.remove('hidden');
  gambarContainer.classList.remove('hidden');
} else {
  gambarElement.src = '';
  gambarElement.classList.add('hidden');
  gambarContainer.classList.add('hidden');
}

        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
      });
    });

    window.closeEditModal = function () {
      document.getElementById('editModal').classList.add('hidden');
      document.getElementById('editModal').classList.remove('flex');
    };

    // Modal tambah
    document.getElementById('btnAddNews')?.addEventListener('click', function () {
      document.getElementById('addModal').classList.remove('hidden');
      document.getElementById('addModal').classList.add('flex');
    });

    window.closeAddModal = function () {
      document.getElementById('addModal').classList.add('hidden');
      document.getElementById('addModal').classList.remove('flex');
      document.getElementById('formAddNews').reset();
    };

    

    // Search
    let searchTimeout;

document.getElementById('searchInput').addEventListener('input', function () {
    clearTimeout(searchTimeout); // Reset debounce

    searchTimeout = setTimeout(() => {
        const keyword = this.value.trim();
        const url = new URL(window.location.href);

        if (keyword.length > 0) {
            url.searchParams.set('search', keyword);
        } else {
            url.searchParams.delete('search');
        }

        url.searchParams.set('page', 1); // Reset ke halaman pertama
        window.location.href = url.toString();
    }, 500); // Delay 500ms, bisa diubah
});


    // Dropdown toggle
    document.querySelectorAll('[id^="dropdownBtn-"]').forEach(btn => {
      const id = btn.id.split('-')[1];
      btn.addEventListener('click', function () {
        document.getElementById(`dropdownMenu-${id}`).classList.toggle('hidden');
      });
    });

    // Close dropdown on outside click
    window.addEventListener('click', function (e) {
      document.querySelectorAll('[id^="dropdownMenu-"]').forEach(menu => {
        if (!menu.contains(e.target) && !e.target.closest('[id^="dropdownBtn-"]')) {
          menu.classList.add('hidden');
        }
      });
    });
  });

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
</script>
@endpush
