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
        <input type="text" placeholder="Cari berita..."
          class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="searchInput" />
        <span class="absolute left-3 top-2.5 text-gray-400">
          <i class="fas fa-search"></i>
        </span>
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
          <form method="POST" action="{{ route('berita.approve', $berita->id) }}">
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
              <form method="POST" action="{{ route('berita.reject', $berita->id) }}">
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

      <table class="w-full text-sm text-left table-fixed">
        <colgroup>
          <col style="width: 20%;">
          <col style="width: 20%;">
          <col style="width: 20%;">
          <col style="width: 25%;">
          <col style="width: 15%;">
        </colgroup>
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
            <td class="px-4 py-2">{{ $berita->created_at->format('d F Y') }}</td>
            <td class="px-4 py-2">{{ $berita->nama_reporter }}</td>
            <td class="px-4 py-2">{{ $berita->email_reporter }}</td>
            <td class="px-4 py-2">{{ $berita->judul }}</td>
            <td class="px-4 py-2">
              <button type="button" class="btn-detail text-blue-600 hover:underline"
                data-judul="{{ $berita->judul }}" data-konten="{{ $berita->konten }}">Detail</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    @endforeach
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
    document.getElementById('searchInput').addEventListener('keyup', function () {
      const keyword = this.value.toLowerCase();
      document.querySelectorAll('#cardContainer .card').forEach(card => {
        const title = card.getAttribute('data-title').toLowerCase();
        card.style.display = title.includes(keyword) ? '' : 'none';
      });
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
</script>
@endpush
