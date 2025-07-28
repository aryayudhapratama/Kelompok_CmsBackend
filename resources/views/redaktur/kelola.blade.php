@extends('layouts.redaktur')

@section('title', 'Approval Berita - Redaktur')
@section('page-title', 'Kelola Berita')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
  <!-- Heading + Search -->
  <div class="flex justify-between items-center mb-4 border-b pb-2">
    <h2 class="text-lg font-semibold text-gray-800">Approval Queue</h2>
    <div class="relative">
      <input
        type="text"
        placeholder="Cari berita..."
        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        id="searchInput"
      />
      <span class="absolute left-3 top-2.5 text-gray-400">
        <i class="fas fa-search"></i>
      </span>
    </div>
  </div>

  <!-- Card Container -->
  <div id="cardContainer" class="space-y-6">
    @for ($i = 1; $i <= 2; $i++)
    <div class="card border rounded-lg overflow-hidden shadow" data-title="berita sosial kampus">
      <div class="bg-gray-50 px-4 py-3 flex justify-between items-center">
        <p class="font-semibold text-red-600 cursor-pointer hover:underline">Berita Sosial Kampus {{ $i }}</p>
        <div class="flex items-center space-x-2 relative">
          <button class="flex items-center gap-1 px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700 transition">
            <i class="fas fa-check-circle"></i> Approve
          </button>
          <div class="relative">
            <button onclick="toggleRejectDropdown(this)"
              class="flex items-center gap-1 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg shadow hover:bg-red-700 transition">
              <i class="fas fa-times-circle"></i> Reject
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div class="absolute right-0 mt-2 w-60 bg-white border rounded-md shadow-lg z-20 hidden dropdown-reject">
              <ul class="text-sm text-gray-700 divide-y divide-gray-100">
                <li><button class="w-full text-left px-4 py-2 hover:bg-gray-50">Konten tidak sesuai</button></li>
                <li><button class="w-full text-left px-4 py-2 hover:bg-gray-50">Judul kurang informatif</button></li>
                <li><button class="w-full text-left px-4 py-2 hover:bg-gray-50">Tata bahasa tidak baku</button></li>
                <li><button class="w-full text-left px-4 py-2 hover:bg-gray-50">Berita duplikat</button></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <table class="w-full text-sm text-left">
        <thead class="bg-gray-100 text-gray-600">
          <tr>
            <th class="px-4 py-2">Date Added</th>
            <th class="px-4 py-2">Full Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-t hover:bg-gray-50">
            <td class="px-4 py-2">1 January 2025</td>
            <td class="px-4 py-2">Cheasario</td>
            <td class="px-4 py-2">ekl@reporter.com</td>
            <td class="px-4 py-2">TEL-U SURABAYA</td>
            <td class="px-4 py-2">
              <button onclick="openEditModal('Pameran Kampus 2025', 'Isi lengkap berita')" class="text-blue-600 hover:underline">
                Detail
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    @endfor
  </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg w-full max-w-2xl">
    <h3 class="text-lg font-semibold text-blue-700 mb-4">Detail Berita</h3>
    <form>
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Judul</label>
        <input type="text" id="editJudul" class="w-full px-4 py-2 border rounded text-gray-800" readonly />
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Konten</label>
        <textarea id="editKonten" rows="6" class="w-full px-4 py-2 border rounded text-gray-800" readonly></textarea>
      </div>
      <div class="flex justify-end space-x-2">
        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Tutup</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function toggleRejectDropdown(button) {
    const dropdown = button.parentElement.querySelector('.dropdown-reject');
    const allDropdowns = document.querySelectorAll('.dropdown-reject');
    allDropdowns.forEach(d => {
      if (d !== dropdown) d.classList.add('hidden');
    });
    dropdown.classList.toggle('hidden');
    document.addEventListener('click', function handler(e) {
      if (!button.parentElement.contains(e.target)) {
        dropdown.classList.add('hidden');
        document.removeEventListener('click', handler);
      }
    });
  }

  function openEditModal(judul, konten) {
    document.getElementById('editJudul').value = judul;
    document.getElementById('editKonten').value = konten;
    const modal = document.getElementById('editModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  document.getElementById('searchInput').addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();
    document.querySelectorAll('#cardContainer .card').forEach(card => {
      const title = card.getAttribute('data-title').toLowerCase();
      card.style.display = title.includes(keyword) ? '' : 'none';
    });
  });
</script>
@endsection
