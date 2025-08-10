@extends('layouts.redaktur')

@section('title', 'Publish Articles - Redaktur')
@section('page-title', 'Publish Articles')

@section('content')
<div class="bg-white p-6 rounded-lg shadow relative z-10">
    <div class="flex justify-between items-center mb-4 border-b pb-2">
        <h2 class="text-lg font-semibold text-gray-800">Publish Queue</h2>
    </div>

    <table id="beritaTable" class="w-full text-sm text-left table-fixed">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Date Added</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Article Date</th>
                <th class="px-4 py-2">Full Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Action</th>
                <th class="px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beritas as $berita)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ $berita->id }}</td>
                <td class="px-4 py-2">{{ $berita->created_at->format('d F Y') }}</td>
                <td class="px-4 py-2">{{ $berita->judul }}</td>
                <td class="px-4 py-2">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-24 h-16 object-cover rounded shadow border"/>
                    @else
                        <span class="text-gray-400 italic"> Image not available</span>
                    @endif
                </td>
                <td class="px-4 py-2">
                    @if($berita->berita_date)
                        {{ \Carbon\Carbon::parse($berita->berita_date)->format('d F Y') }}
                    @else
                        <span class="text-gray-400 italic">Date not available</span>
                    @endif
                </td>
                <td class="px-4 py-2">{{ $berita->nama_reporter }}</td>
                <td class="px-4 py-2">{{ $berita->email_reporter }}</td>
                <td class="px-4 py-2">
                    <div class="flex items-center gap-2">
                        <button type="button"
                            class="btn-detail w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition"
                            title="Lihat Detail"
                            data-id="{{ $berita->id }}"
                            data-judul="{{ $berita->judul }}"
                            data-konten="{{ $berita->konten }}"
                            data-nama="{{ $berita->nama_reporter }}"
                            data-email="{{ $berita->email_reporter }}"
                            data-tanggal="{{ $berita->created_at ? $berita->created_at->format('d F Y H:i') : '' }}"
                            data-status="{{ $berita->status }}"
                            data-gambar="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : '' }}"
                            data-date="{{ $berita->berita_date ? \Carbon\Carbon::parse($berita->berita_date)->format('Y-m-d') : '' }}"
                            data-published="{{ $berita->is_published ? '1' : '0' }}">
                            <i class="fas fa-eye text-base"></i>
                        </button>
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
                <td class="px-4 py-2">
    @if($berita->status === 'approved')
        @if($berita->is_published)
            <form method="POST" action="{{ route('redaktur.berita.unpublish', $berita->id) }}">
                @csrf
                <button type="submit" class="btn-unpublish flex items-center justify-center gap-1 w-[110px] px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition">
                    <i class="fas fa-eye-slash"></i> Unpublish
                </button>
            </form>
        @else
            <form method="POST" action="{{ route('redaktur.berita.publish', $berita->id) }}">
                @csrf
                <button type="submit" class="btn-publish flex items-center justify-center gap-1 w-[110px] px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-upload"></i> Publish
                </button>
            </form>
        @endif
    @elseif($berita->status === 'pending')
        <span class="px-4 py-2 text-sm font-semibold rounded-lg bg-gray-100 text-gray-700">Pending</span>
    @else
        <span class="px-4 py-2 text-sm font-semibold rounded-lg bg-red-100 text-red-700">Rejected</span>
    @endif
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('redaktur.partials.modal-add')
@include('redaktur.partials.modal-detail')
@endsection


@push('scripts')
<script>
  // Inisialisasi DataTable (tetap di luar DOMContentLoaded)
    $(document).ready(function() {
    $('#beritaTable').DataTable({
        pageLength: 10,
        ordering: true,
        responsive: true,
        // Konfigurasi DOM untuk memodernisasi tata letak
        dom: '<"top flex flex-col md:flex-row md:items-center justify-between mb-4"lf><"table-responsive"t><"bottom flex flex-col md:flex-row md:items-center justify-between mt-4"ip>',
        language: {
            search: "_INPUT_", // Mengatur input pencarian tanpa label bawaan
            searchPlaceholder: "Search...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    first: "First",
                    last: "Last",
                next: "<i class='fas fa-chevron-right'></i>",
                previous: "<i class='fas fa-chevron-left'></i>"
            }
        },
        // Fungsi ini akan dijalankan setelah tabel selesai diinisialisasi
        initComplete: function() {
            // Styling untuk elemen pencarian
            const searchInput = $('#beritaTable_filter input');
            searchInput.addClass('w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500');

            // Styling untuk elemen dropdown "Tampilkan data"
            const lengthSelect = $('#beritaTable_length select');
            lengthSelect.addClass('border rounded-lg p-2 mr-2');

            // Styling untuk tombol paginasi
            const paginateContainer = $('#beritaTable_paginate');
            paginateContainer.addClass('flex items-center gap-2');
            
            // Tambahkan kelas untuk setiap tombol paginasi
            $('#beritaTable_paginate .paginate_button').each(function() {
                $(this).addClass('px-3 py-1 border rounded-lg hover:bg-gray-200 transition');
            });
            // Hapus kelas 'current' dari tombol aktif untuk styling yang lebih bersih
            $('#beritaTable_paginate .paginate_button.current').addClass('bg-blue-600 text-white hover:bg-blue-700').removeClass('bg-gray-100');

            // Wrap the table in a div for better responsiveness
            $('#beritaTable').wrap('<div class="overflow-x-auto"></div>');
        }
    });
});

  document.addEventListener('DOMContentLoaded', function () {
    // Modal detail
   document.querySelectorAll('.btn-detail').forEach(btn => {
  btn.addEventListener('click', function () {
    const id = this.dataset.id;
    const isPublished = this.dataset.published === '1';

    document.getElementById('editId').value = id;
    document.getElementById('editJudul').value = this.dataset.judul;
    document.getElementById('editKonten').value = this.dataset.konten;
    document.getElementById('editNama').value = this.dataset.nama;
    document.getElementById('editEmail').value = this.dataset.email;
    document.getElementById('editTanggal').value = this.dataset.tanggal;
    document.getElementById('editStatus').value = this.dataset.status;

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

    // Editable hanya jika belum dipublish
    document.getElementById('editJudul').readOnly = isPublished;
    document.getElementById('editKonten').readOnly = isPublished;

    // Set form action (harus disesuaikan dengan route update)
    document.getElementById('formUpdateDetail').action = `/redaktur/berita/${id}/update`;

    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
    document.body.classList.add('overflow-hidden');
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

// 🔽 Tambahkan ini
window.closeEditModal = function () {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
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

    // Dropdown toggle
    document.querySelectorAll('[id^="dropdownBtn-"]').forEach(btn => {
      const id = btn.id.split('-')[1];
      btn.addEventListener('click', function () {
        document.getElementById(`dropdownMenu-${id}`).classList.toggle('hidden');
      });
    });

  });

  document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.btn-hapus').forEach(button => {
    button.addEventListener('click', function () {
      const form = this.closest('form');

      Swal.fire({
        title: 'Are you sure?',
text: "The article will be permanently deleted and cannot be recovered!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#e3342f',
cancelButtonColor: '#6c757d',
confirmButtonText: 'Yes, delete!',
cancelButtonText: 'Cancel'
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
