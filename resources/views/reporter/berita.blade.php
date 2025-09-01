{{-- @extends('layouts.reporter')

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
    <!-- jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Quill.js CSS & JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Inisialisasi DataTable
        $(document).ready(function() {
            $('#beritaTable').DataTable({
                pageLength: 10,
                ordering: true,
                responsive: true,
                dom: '<"top flex flex-col md:flex-row md:items-center justify-between mb-4"lf><"table-responsive"t><"bottom flex flex-col md:flex-row md:items-center justify-between mt-4"ip>',
                language: {
                    search: "_INPUT_",
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
                initComplete: function() {
                    const searchInput = $('#beritaTable_filter input');
                    searchInput.addClass(
                        'w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500'
                    );

                    const lengthSelect = $('#beritaTable_length select');
                    lengthSelect.addClass('border rounded-lg p-2 mr-2');

                    const paginateContainer = $('#beritaTable_paginate');
                    paginateContainer.addClass('flex items-center gap-2');

                    $('#beritaTable_paginate .paginate_button').each(function() {
                        $(this).addClass(
                            'px-3 py-1 border rounded-lg hover:bg-gray-200 transition');
                    });

                    $('#beritaTable_paginate .paginate_button.current').addClass(
                        'bg-blue-600 text-white hover:bg-blue-700').removeClass('bg-gray-100');
                }
            });
        });

        // DOMContentLoaded
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Quill
            const quill = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        ['image', 'link'],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        ['clean']
                    ]
                },
                placeholder: 'Write your article here...'
            });

            // Submit form: simpan isi ke hidden input
            document.getElementById('formAddNews').addEventListener('submit', function(e) {
                const content = quill.root.innerHTML;
                document.getElementById('konten_hidden').value = content;
            });

            // =============== LOGIKA MODAL & SWAL ===============
            const setupSwalConfirm = (button, form, title, text, icon, confirmText) => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
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

            // Approve
            document.querySelectorAll('form[action*="/approve"] button[type="submit"]').forEach(button => {
                const form = button.closest('form');
                setupSwalConfirm(button, form, 'Are you sure you want to approve?',
                    'This article will be published immediately.', 'success', 'Yes, Approve!');
            });

            // Reject
            document.querySelectorAll('.reject-form-template button[type="submit"]').forEach(button => {
                const form = button.closest('form');
                const alasan = form.querySelector('input[name="alasan"]').value;
                setupSwalConfirm(button, form, 'Are you sure you want to reject?',
                    `This article will be rejected for: "${alasan}".`, 'warning', 'Yes, Reject!');
            });

            // Modal Detail
            document.querySelectorAll('.btn-detail').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    document.getElementById('editId').value = id;
                    document.getElementById('formUpdateDetail').action = `/reporter/berita/${id}`;

                    document.getElementById('editJudul').value = btn.dataset.judul;

                    // --- ISI CONTENT KE QUILL ---
                    const quillEditor = document.getElementById('quill-editorr');
                    if (quillEditor) {
                        quillEditor.innerHTML = btn.dataset.konten;
                    }

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

            // Modal Tambah
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
                // Reset TinyMCE
                if (tinymce.get('konten')) {
                    tinymce.get('konten').setContent('');
                }
            };

            // Dropdown Reject
            const dynamicDropdown = document.getElementById('dynamic-dropdown-menu');
            document.querySelectorAll('.btn-reject').forEach(btn => {
                btn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const rect = btn.getBoundingClientRect();
                    const beritaId = this.dataset.id;

                    dynamicDropdown.classList.add('hidden');
                    dynamicDropdown.style.top = `${rect.bottom + window.scrollY}px`;
                    dynamicDropdown.style.right =
                        `${window.innerWidth - (rect.right + window.scrollX)}px`;
                    dynamicDropdown.classList.remove('hidden');

                    const forms = dynamicDropdown.querySelectorAll('.reject-form-template');
                    forms.forEach(form => {
                        form.action = `/redaktur/berita/${beritaId}/reject`;
                    });
                });
            });

            window.addEventListener('click', function(event) {
                if (!dynamicDropdown.contains(event.target) && !event.target.closest('.btn-reject')) {
                    dynamicDropdown.classList.add('hidden');
                }
            });

            // Konfirmasi Hapus
            document.querySelectorAll('.form-hapus button').forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "The article will be permanently deleted!",
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
@endpush --}}

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
    <!-- jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Quill.js -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#beritaTable').DataTable({
                pageLength: 10,
                ordering: true,
                responsive: true,
                dom: '<"top flex flex-col md:flex-row md:items-center justify-between mb-4"lf><"table-responsive"t><"bottom flex flex-col md:flex-row md:items-center justify-between mt-4"ip>',
                language: {
                    search: "_INPUT_",
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
                initComplete: function() {
                    const searchInput = $('#beritaTable_filter input');
                    searchInput.addClass(
                        'w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500'
                        );

                    const lengthSelect = $('#beritaTable_length select');
                    lengthSelect.addClass('border rounded-lg p-2 mr-2');

                    $('#beritaTable_paginate .paginate_button').addClass(
                        'px-3 py-1 border rounded-lg hover:bg-gray-200 transition');
                    $('#beritaTable_paginate .paginate_button.current').addClass(
                        'bg-blue-600 text-white hover:bg-blue-700').removeClass('bg-gray-100');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            let quillAdd = null;
            let quillEdit = null;

            // === INISIALISASI QUILL UNTUK MODAL TAMBAH ===
            if (document.getElementById('quill-add-editor')) {
                quillAdd = new Quill('#quill-add-editor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'],
                            ['link', 'image'],
                            [{
                                list: 'ordered'
                            }, {
                                list: 'bullet'
                            }],
                            ['clean']
                        ]
                    }
                });

                // Submit form tambah
                document.getElementById('formAddNews').addEventListener('submit', function(e) {
                    const content = quillAdd.root.innerHTML;
                    document.getElementById('konten_hidden').value = content;
                });
            }

            // === MODAL DETAIL (EDIT) ===
            document.querySelectorAll('.btn-detail').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    document.getElementById('editId').value = id;
                    document.getElementById('formUpdateDetail').action = `/reporter/berita/${id}`;
                    document.getElementById('editJudul').value = this.dataset.judul;

                    // --- INISIALISASI QUILL EDIT (hanya sekali) ---
                    const editorElement = document.getElementById('quill-edit-editor');
                    if (editorElement && !quillEdit) {
                        quillEdit = new Quill('#quill-edit-editor', {
                            theme: 'snow',
                            modules: {
                                toolbar: [
                                    ['bold', 'italic', 'underline'],
                                    ['link', 'image'],
                                    [{
                                        list: 'ordered'
                                    }, {
                                        list: 'bullet'
                                    }],
                                    ['clean']
                                ]
                            }
                        });
                    }

                    // Isi konten ke Quill
                    if (quillEdit && this.dataset.konten) {
                        quillEdit.clipboard.dangerouslyPasteHTML(this.dataset.konten);
                    }

                    // Isi tanggal
                    if (this.dataset.date) {
                        const dateVal = new Date(this.dataset.date);
                        document.getElementById('editBeritaDate').value = dateVal.toISOString()
                            .split('T')[0];
                    }

                    // Gambar
                    if (this.dataset.gambar) {
                        const img = document.getElementById('editGambar');
                        img.src = this.dataset.gambar;
                        img.classList.remove('hidden');
                    }

                    // Buka modal
                    document.getElementById('editModal').classList.remove('hidden');
                    document.getElementById('editModal').classList.add('flex');
                    document.body.classList.add('overflow-hidden');
                });
            });

            // Submit form edit
            if (document.getElementById('formUpdateDetail')) {
                document.getElementById('formUpdateDetail').addEventListener('submit', function(e) {
                    if (quillEdit) {
                        const content = quillEdit.root.innerHTML;
                        document.getElementById('konten_hidden_edit').value = content;
                    }
                });
            }

            // Close modal edit
            window.closeEditModal = function() {
                document.getElementById('editModal').classList.add('hidden');
                document.getElementById('editModal').classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            };

            // Modal tambah
            document.getElementById('btnAddNews')?.addEventListener('click', function() {
                document.getElementById('addModal').classList.remove('hidden');
                document.getElementById('addModal').classList.add('flex');
                document.body.classList.add('overflow-hidden');

                // Reset Quill Add
                if (quillAdd) {
                    quillAdd.setText('');
                }
            });

            window.closeAddModal = function() {
                document.getElementById('addModal').classList.add('hidden');
                document.getElementById('addModal').classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
                document.getElementById('formAddNews').reset();
            };

            // Konfirmasi hapus
            document.querySelectorAll('.form-hapus button').forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "The article will be permanently deleted!",
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
