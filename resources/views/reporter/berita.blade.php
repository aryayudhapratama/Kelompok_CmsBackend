@extends('layouts.reporter')

@section('title', 'Reporter - Manage News')
@section('page-title', 'Manage News')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow relative z-10">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-lg font-semibold text-gray-800">News List</h2>
            <button id="btnAddNews"
                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-plus-circle mr-1"></i> Add News
            </button>
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
                    <th class="px-4 py-2">Actions</th>
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
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}"
                                    class="w-24 h-16 object-cover rounded shadow border" />
                            @else
                                <span class="text-gray-400 italic">Image not available</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            @if ($berita->berita_date)
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
                                    title="Lihat Detail" data-id="{{ $berita->id }}" data-judul="{{ $berita->judul }}"
                                    data-konten="{{ $berita->konten }}" data-nama="{{ $berita->nama_reporter }}"
                                    data-email="{{ $berita->email_reporter }}"
                                    data-tanggal="{{ $berita->created_at ? $berita->created_at->format('d F Y H:i') : '' }}"
                                    data-status="{{ $berita->status }}"
                                    data-gambar="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : '' }}"
                                    data-date="{{ $berita->berita_date ? \Carbon\Carbon::parse($berita->berita_date)->format('d F Y H:i') : '' }}">
                                    <i class="fas fa-eye text-base"></i>
                                </button>
                                <form method="POST" action="{{ route('reporter.berita.destroy', $berita->id) }}"
                                    class="form-hapus">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="button"
                                        class="w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition"
                                        title="Hapus Berita">
                                        <i class="fas fa-trash text-base"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <!-- Status: Always Pending -->
                        <td class="px-4 py-2">
                            <span class="text-sm font-semibold px-4 py-2 rounded-lg bg-yellow-100 text-yellow-700">
                                Pending
                            </span>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('reporter.modal-add')
    @include('reporter.modal-detail')
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
                    searchInput.addClass(
                        'w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500'
                    );

                    // Styling untuk elemen dropdown "Tampilkan data"
                    const lengthSelect = $('#beritaTable_length select');
                    lengthSelect.addClass('border rounded-lg p-2 mr-2');

                    // Styling untuk tombol paginasi
                    const paginateContainer = $('#beritaTable_paginate');
                    paginateContainer.addClass('flex items-center gap-2');

                    // Tambahkan kelas untuk setiap tombol paginasi
                    $('#beritaTable_paginate .paginate_button').each(function() {
                        $(this).addClass(
                            'px-3 py-1 border rounded-lg hover:bg-gray-200 transition');
                    });
                    // Hapus kelas 'current' dari tombol aktif untuk styling yang lebih bersih
                    $('#beritaTable_paginate .paginate_button.current').addClass(
                        'bg-blue-600 text-white hover:bg-blue-700').removeClass('bg-gray-100');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Logika untuk SweetAlert
            const setupSwalConfirm = (button, form, title, text, icon, confirmText) => {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // Mencegah form terkirim secara langsung
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        showCancelButton: true,
                        confirmButtonColor: icon === 'success' ? '#3085d6' : '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: confirmText,
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            };

            // Konfirmasi Approve
            document.querySelectorAll('form[action*="/approve"] button[type="submit"]').forEach(button => {
                const form = button.closest('form');
                setupSwalConfirm(
                    button,
                    form,
                    'Are you sure you want to approve?',
                    'This article will be published immediately.',
                    'success',
                    'Yes, Approve!'

                );
            });

            // Konfirmasi Reject dari Dropdown (sekarang dinamis)
            document.querySelectorAll('.reject-form-template button[type="submit"]').forEach(button => {
                const form = button.closest('form');
                const alasan = form.querySelector('input[name="alasan"]').value;
                setupSwalConfirm(
                    button,
                    form,
                    'Are you sure you want to reject?',
                    `This article will be rejected for the following reason: "${alasan}".`,
                    'warning',
                    'Yes, Reject!'

                );
            });

            // Modal detail
            document.querySelectorAll('.btn-detail').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    document.getElementById('editId').value = id;
                    document.getElementById('formUpdateDetail').action = `/reporter/berita/${id}`;
                    // isi data form
                    document.getElementById('editJudul').value = btn.dataset.judul;
                    document.getElementById('editKonten').value = btn.dataset.konten;

                    if (btn.dataset.date) {
                        const dateVal = new Date(btn.dataset.date);
                        document.getElementById('editBeritaDate').value = dateVal.toISOString()
                            .split('T')[0];
                    }

                    if (btn.dataset.gambar) {
                        const img = document.getElementById('editGambar');
                        img.src = btn.dataset.gambar;
                        img.classList.remove('hidden');
                    }

                    // buka modal
                    document.getElementById('editModal').classList.remove('hidden');
                    document.getElementById('editModal').classList.add('flex');
                    document.body.classList.add('overflow-hidden');
                });
            });

            window.closeEditModal = function() {
                const modal = document.getElementById('editModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            };


            // Modal tambah
            document.getElementById('btnAddNews')?.addEventListener('click', function() {
                const modal = document.getElementById('addModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            });

            window.closeAddModal = function() {
                const modal = document.getElementById('addModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
                document.getElementById('formAddNews').reset();
            };

            // --- Logika Baru untuk Dropdown Reject Dinamis ---
            const dynamicDropdown = document.getElementById('dynamic-dropdown-menu');

            document.querySelectorAll('.btn-reject').forEach(btn => {
                btn.addEventListener('click', function(event) {
                    event.stopPropagation(); // Mencegah event dari menutup dropdown
                    const rect = btn.getBoundingClientRect();
                    const beritaId = this.dataset.id;

                    // Tutup dropdown lain yang terbuka
                    dynamicDropdown.classList.add('hidden');

                    // Atur posisi dropdown agar muncul di bawah tombol
                    dynamicDropdown.style.top = `${rect.bottom + window.scrollY}px`;
                    dynamicDropdown.style.right =
                        `${window.innerWidth - (rect.right + window.scrollX)}px`;
                    dynamicDropdown.style.left =
                        'auto'; // Pastikan left tidak diatur agar `right` berfungsidynamicDropdown.style.left = `${rect.right + window.scrollX - dynamicDropdown.offsetWidth}px`;
                    dynamicDropdown.classList.remove('hidden');

                    // Update form action di dalam dropdown
                    const forms = dynamicDropdown.querySelectorAll('.reject-form-template');
                    forms.forEach(form => {
                        form.action = `/redaktur/berita/${beritaId}/reject`;
                    });
                });
            });

            // Tutup dropdown saat klik di luar
            window.addEventListener('click', function(event) {
                if (!dynamicDropdown.contains(event.target) && !event.target.closest('.btn-reject')) {
                    dynamicDropdown.classList.add('hidden');
                }
            });

            // Konfirmasi hapus
            document.querySelectorAll('.form-hapus button').forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "The article will be permanently deleted and cannot be recovered!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete!',
                        cancelButtonText: 'Cancel',
                        // Lifecycle hooks untuk menambahkan dan menghapus kelas
                        didOpen: () => {
                            document.body.classList.add('swal-open-body');
                        },
                        willClose: () => {
                            document.body.classList.remove('swal-open-body');
                        }
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
