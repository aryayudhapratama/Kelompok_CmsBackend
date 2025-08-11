@extends('layouts.redaktur')
@section('title', 'Carousel - Redaktur')
@section('page-title', 'Carousel')
@section('content')
<div class="bg-white p-6 rounded-lg shadow relative z-10">
    <div class="flex justify-between items-center mb-4 border-b pb-2">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Section</h2>
        <button onclick="openModal('modalTambah')"
            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-plus-circle mr-1"></i> Tambah Section
        </button>
    </div>

    <table id="sectionsTable" class="w-full text-sm text-left table-fixed">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-4 py-2">Section</th>
                <th class="px-4 py-2">Judul</th>
                <th class="px-4 py-2">Gambar</th>
                <th class="px-4 py-2">Urutan</th>
                <th class="px-4 py-2">Link</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sections as $section)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ $section->section_name }}</td>
                <td class="px-4 py-2">{{ $section->title }}</td>
                <td class="px-4 py-2">
                    @if($section->image)
                        <img src="{{ asset('storage/' . $section->image) }}" class="w-24 h-16 object-cover rounded shadow border"/>
                    @else
                        <span class="text-gray-400 italic">No image</span>
                    @endif
                </td>
                <td class="px-4 py-2">{{ $section->order }}</td>
                <td class="px-4 py-2">
                    @if($section->link)
                        <a href="{{ $section->link }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ Str::limit($section->link, 20) }}
                        </a>
                    @else
                        <span class="text-gray-400 italic">No link</span>
                    @endif
                </td>
                <td class="px-4 py-2">
                    <div class="flex items-center gap-2">
                        <button type="button"
                            class="btn-edit w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition"
                            title="Edit Section"
                            data-id="{{ $section->id }}"
                            data-section-name="{{ $section->section_name }}"
                            data-title="{{ $section->title }}"
                            data-content="{{ $section->content }}"
                            data-link="{{ $section->link }}"
                            data-button-text="{{ $section->button_text }}"
                            data-order="{{ $section->order }}"
                            data-image="{{ $section->image ? asset('storage/' . $section->image) : '' }}">
                            <i class="fas fa-edit text-base"></i>
                        </button>
                        <form method="POST" action="{{ route('redaktur.landing.destroy', $section->id) }}" class="form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                class="w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition btn-hapus"
                                title="Hapus Section"
                                data-id="{{ $section->id }}">
                                <i class="fas fa-trash text-base"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div id="modalTambah" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-11/12 md:w-1/2 shadow-2xl">
        <h5 class="text-lg font-bold mb-4 text-black">Tambah Section Baru</h5>
        <form action="{{ route('redaktur.landing.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Nama Section</label>
                    <input type="text" name="section_name" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Judul</label>
                    <input type="text" name="title" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Link</label>
                    <input type="url" name="link" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Teks Tombol</label>
                    <input type="text" name="button_text" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Urutan</label>
                    <input type="number" name="order" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Gambar</label>
                    <input type="file" name="image" class="w-full px-3 py-2 border rounded-lg">
                </div>
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm text-black">Konten</label>
                <textarea name="content" rows="4" class="w-full px-3 py-2 border rounded-lg" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 mr-2 text-sm bg-gray-300 rounded-lg">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-11/12 md:w-1/2 shadow-2xl">
        <h5 class="text-lg font-bold mb-4 text-black">Edit Section</h5>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editId">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Nama Section</label>
                    <input type="text" name="section_name" id="editSectionName" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Judul</label>
                    <input type="text" name="title" id="editTitle" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Link</label>
                    <input type="url" name="link" id="editLink" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Teks Tombol</label>
                    <input type="text" name="button_text" id="editButtonText" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Urutan</label>
                    <input type="number" name="order" id="editOrder" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Gambar (Kosongkan jika tidak diubah)</label>
                    <input type="file" name="image" class="w-full px-3 py-2 border rounded-lg">
                </div>
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm text-black">Konten</label>
                <textarea name="content" id="editContent" rows="4" class="w-full px-3 py-2 border rounded-lg" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 mr-2 text-sm bg-gray-300 rounded-lg">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Inisialisasi DataTable
    $(document).ready(function() {
        $('#sectionsTable').DataTable({
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
                const searchInput = $('#sectionsTable_filter input');
                searchInput.addClass('w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500');

                const lengthSelect = $('#sectionsTable_length select');
                lengthSelect.addClass('border rounded-lg p-2 mr-2');

                const paginateContainer = $('#sectionsTable_paginate');
                paginateContainer.addClass('flex items-center gap-2');
                
                $('#sectionsTable_paginate .paginate_button').each(function() {
                    $(this).addClass('px-3 py-1 border rounded-lg hover:bg-gray-200 transition');
                });
                $('#sectionsTable_paginate .paginate_button.current').addClass('bg-blue-600 text-white hover:bg-blue-700').removeClass('bg-gray-100');
            }
        });
    });

    // SweetAlert untuk konfirmasi hapus
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.form-hapus button').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "The section will be permanently deleted and cannot be recovered!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'Cancel',
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

        // Modal Edit dengan SweetAlert
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                document.getElementById('editId').value = id;
                document.getElementById('editSectionName').value = btn.dataset.sectionName;
                document.getElementById('editTitle').value = btn.dataset.title;
                document.getElementById('editContent').value = btn.dataset.content;
                document.getElementById('editLink').value = btn.dataset.link || '';
                document.getElementById('editButtonText').value = btn.dataset.buttonText || '';
                document.getElementById('editOrder').value = btn.dataset.order;

                const form = document.getElementById('editForm');
                form.action = `/redaktur/landing/${id}`;

                openModal('modalEdit');
            });
        });

        // Modal functions
        window.openModal = function(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
                modal.style.display = 'flex';
            }
        }

        window.closeModal = function(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }
        }

        // Close modal on backdrop click
        document.querySelectorAll('.fixed.inset-0').forEach(modal => {
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    closeModal(modal.id);
                }
            });
        });
    });
</script>
@endpush
