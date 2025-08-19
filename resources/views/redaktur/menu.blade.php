@extends('layouts.redaktur')

@section('title', 'Navbar Menu - Redaktur')
@section('page-title', 'Navbar Menu')

@section('content')
<div class="bg-white p-6 rounded-lg shadow relative z-10">
    <div class="flex justify-between items-center mb-4 border-b pb-2">
        <h2 class="text-lg font-semibold text-gray-800">Approval Queue</h2>
        <button id="btnAddMenu"
            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-plus-circle mr-1"></i> New Article
        </button>
    </div>
    <table id="menuTable" class="w-full text-sm text-left table-fixed">
    <thead class="bg-gray-100 text-gray-600">
        <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Date Added</th>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Url</th>
            <th class="px-4 py-2">Order</th>
            <th class="px-4 py-2">Pid</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
    @forelse($menus as $menu)
        <tr class="border-t hover:bg-gray-50 parent-row cursor-pointer" data-parent-id="{{ $menu->id }}">
            <td class="px-4 py-2 flex items-center gap-2">
                <span class="toggle-icon transition-transform transform">
                    <i class="fas fa-caret-right text-gray-500"></i>
                </span>
                {{ $menu->id }}
            </td>
            <td class="px-4 py-2">{{ $menu->created_at->format('d F Y') }}</td>
            <td class="px-4 py-2">{{ $menu->title }}</td>
            <td class="px-4 py-2 max-w-[260px] truncate whitespace-nowrap overflow-hidden text-blue-600 underline">
                <a href="{{ url($menu->url) }}" target="_blank" class="text-blue-600 underline">
                    {{ url($menu->url) }}
                </a>
            </td>
            <td class="px-4 py-2">
                <div class="flex items-center space-x-2">
                    <!-- Tombol Naik -->
                    <button class="order-up p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-full shadow transition"
                        data-id="{{ $menu->id }}" title="Naikkan Urutan">
                        <i class="fas fa-chevron-up"></i>
                    </button>

                    <!-- Tombol Turun -->
                    <button class="order-down p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-full shadow transition"
                        data-id="{{ $menu->id }}" title="Turunkan Urutan">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </td>

            <td class="px-4 py-2">{{ $menu->parent_id ?? '-' }}</td>
            <td class="px-4 py-2">
                <span class="px-2 py-1 text-xs rounded-lg {{ $menu->status_aktif ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $menu->status_aktif ? 'Active' : 'Inactive' }}
                </span>
            </td>
            <td class="px-4 py-2">
                <div class="flex items-center gap-2">
                    <button type="button" class="btn-detail w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition" title="Lihat Detail" data-id="{{ $menu->id }}" data-title="{{ $menu->title }}" data-url="{{ $menu->url }}" data-parent="{{ $menu->parent_id }}" data-order="{{ $menu->order }}" data-status="{{ $menu->status_aktif ? 'Aktif' : 'Nonaktif' }}" data-tanggal="{{ $menu->created_at ? $menu->created_at->format('d F Y H:i') : '' }}">
                        <i class="fas fa-eye text-base"></i>
                    </button>
                    <button type="button" class="w-10 h-10 bg-green-100 text-green-700 hover:bg-green-200 rounded-md flex items-center justify-center transition btn-copy" title="Copy Link" data-url="{{ url($menu->url) }}">
                        <i class="fas fa-copy text-base"></i>
                    </button>
                    <form method="POST" action="{{ route('redaktur.navbar_menu.destroy', $menu->id) }}" class="form-hapus inline-block m-0 p-0">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition btn-hapus" title="Hapus Menu" data-id="{{ $menu->id }}">
                            <i class="fas fa-trash text-base"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>

        @if($menu->children->isNotEmpty())
            @foreach($menu->children->sortBy('order') as $child)
                <tr class="border-t hover:bg-gray-50 bg-gray-50 child-row parent-{{ $menu->id }}" style="display: none;" data-child-id="{{ $child->id }}">
                    <td class="px-4 py-2 pl-8">{{ $child->id }}</td>
                    <td class="px-4 py-2">{{ $child->created_at->format('d F Y') }}</td>
                    <td class="px-4 py-2">{{ $child->title }}</td>
                    <td class="px-4 py-2 max-w-[260px] truncate whitespace-nowrap overflow-hidden text-blue-600 underline">
                        <a href="{{ url($child->url) }}" target="_blank" class="text-blue-600 underline">
                            {{ url($child->url) }}
                        </a>
                    </td>
                    <td class="px-4 py-2">
                <div class="flex items-center space-x-2">
                    <!-- Tombol Naik -->
                    <button class="order-up p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-full shadow transition"
                        data-id="{{ $menu->id }}" title="Naikkan Urutan">
                        <i class="fas fa-chevron-up"></i>
                    </button>

                    <!-- Tombol Turun -->
                    <button class="order-down p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-full shadow transition"
                        data-id="{{ $menu->id }}" title="Turunkan Urutan">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </td>
                    <td class="px-4 py-2">{{ $child->parent_id }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded-lg {{ $child->status_aktif ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $child->status_aktif ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-detail w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition" title="Lihat Detail" data-id="{{ $child->id }}" data-title="{{ $child->title }}" data-url="{{ $child->url }}" data-parent="{{ $child->parent_id }}" data-order="{{ $child->order }}" data-status="{{ $child->status_aktif ? 'Aktif' : 'Nonaktif' }}" data-tanggal="{{ $child->created_at ? $child->created_at->format('d F Y H:i') : '' }}">
                                <i class="fas fa-eye text-base"></i>
                            </button>
                            <button type="button" class="w-10 h-10 bg-green-100 text-green-700 hover:bg-green-200 rounded-md flex items-center justify-center transition btn-copy" title="Copy Link" data-url="{{ url($child->url) }}">
                                <i class="fas fa-copy text-base"></i>
                            </button>
                            <form method="POST" action="{{ route('redaktur.navbar_menu.destroy', $child->id) }}" class="form-hapus inline-block m-0 p-0">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition btn-hapus" title="Hapus Menu" data-id="{{ $child->id }}">
                                    <i class="fas fa-trash text-base"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    @empty
        <tr>
            <td colspan="8" class="text-center text-gray-500 py-4">No menus found</td>
        </tr>
    @endforelse
</tbody>
</table>
</div>
@include('redaktur.partials.modal-menu')
@include('redaktur.partials.menu-detail')
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi DataTables
    const dataTable = $('#menuTable').DataTable({
        pageLength: 10,
        ordering: false, // Penting: Matikan ordering bawaan
        responsive: true,
        dom: '<"top flex flex-col md:flex-row md:items-center justify-between mb-4"lf><"table-responsive"t><"bottom flex flex-col md:flex-row md:items-center justify-between mt-4"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: {
                next: "<i class='fas fa-chevron-right'></i>",
                previous: "<i class='fas fa-chevron-left'></i>"
            }

        },
        initComplete: function() {
            const searchInput = $('#menuTable_filter input');
            searchInput.addClass('w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500');

            const lengthSelect = $('#menuTable_length select');
            lengthSelect.addClass('border rounded-lg p-2 mr-2');

            const paginateContainer = $('#menuTable_paginate');
            paginateContainer.addClass('flex items-center gap-2');

            $('#menuTable_paginate .paginate_button').each(function() {
                $(this).addClass('px-3 py-1 border rounded-lg hover:bg-gray-200 transition');
            });

            $('#menuTable_paginate .paginate_button.current')
                .addClass('bg-blue-600 text-white hover:bg-blue-700')
                .removeClass('bg-gray-100');
        }
    });

    // Event listener untuk klik pada tabel
    $('#menuTable tbody').on('click', 'tr.parent-row', function(event) {
        if (!$(event.target).closest('.order-up, .order-down, .btn-detail, .btn-copy, .btn-hapus').length) {
            const parentId = $(this).data('parent-id');
            const childrenRows = $(`.child-row.parent-${parentId}`);
            const icon = $(this).find('.toggle-icon');

            childrenRows.slideToggle(200);
            icon.toggleClass('rotate-90');
        }
    });

    // Logika untuk tombol up/down
    $('#menuTable tbody').on('click', '.order-up, .order-down', function(event) {
        event.stopPropagation();
        const button = $(this);
        const currentRow = button.closest('tr');
        const direction = button.hasClass('order-up') ? 'up' : 'down';
        let id;

        if (currentRow.hasClass('parent-row')) {
            id = currentRow.data('parent-id');
        } else if (currentRow.hasClass('child-row')) {
            id = currentRow.data('child-id');
        } else {
            return;
        }

        // PERBAIKAN LOGIKA PENCARIAN SIBLING ROW
        let siblingRow;
        if (currentRow.hasClass('parent-row')) {
            // Jika baris adalah menu utama, cari menu utama di atas/bawahnya
            siblingRow = direction === 'up' ? currentRow.prevAll('.parent-row').first() : currentRow.nextAll('.parent-row').first();
        } else {
            // Jika baris adalah sub-menu, cari sub-menu lain yang satu induk
            const parentIdMatch = currentRow.attr('class').match(/parent-(\d+)/);
            if (parentIdMatch) {
                const parentId = parentIdMatch[1];
                siblingRow = direction === 'up' ? currentRow.prevAll(`.child-row.parent-${parentId}`).first() : currentRow.nextAll(`.child-row.parent-${parentId}`).first();
            } else {
                return; // Berhenti jika parentId tidak ditemukan
            }
        }

        // Pastikan baris tetangga ada sebelum melanjutkan
        if (siblingRow.length > 0) {
            const currentOrderSpan = currentRow.find('.order-number');
            const siblingOrderSpan = siblingRow.find('.order-number');

            const currentOrder = parseInt(currentOrderSpan.text());
            const siblingOrder = parseInt(siblingOrderSpan.text());

            // Kirim permintaan AJAX untuk memperbarui database
            $.ajax({
                url: `/redaktur/navbar-menu/${id}/update-order`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    direction: direction
                },
                success: function(response) {
                    if (response.success) {
                        // Kumpulkan semua baris yang perlu dipindahkan (baris utama + sub-menu)
                        const rowsToMove = currentRow.add(currentRow.nextUntil('.parent-row'));
                        const siblingRowsToMove = siblingRow.add(siblingRow.nextUntil('.parent-row'));

                        // Lakukan tukar posisi
                        if (direction === 'up') {
                            rowsToMove.insertBefore(siblingRow);
                        } else {
                            rowsToMove.insertAfter(siblingRowsToMove.last());
                        }

                        // Tukar angka urutan secara visual
                        currentOrderSpan.text(siblingOrder);
                        siblingOrderSpan.text(currentOrder);
                    }
                },
                error: function(xhr) {
                    console.error('Failed to update order:', xhr.responseText);
                    alert('Gagal memperbarui urutan. Silakan coba lagi.');
                }
            });
        }
    });
});

    // Modal tambah
    document.getElementById('btnAddMenu')?.addEventListener('click', function () {
        const modal = document.getElementById('menuModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    });

    window.closeAddModal = function () {
        const modal = document.getElementById('menuModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
        document.getElementById('formAddMenu').reset();
    };

    document.querySelectorAll('.btn-detail').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const parentId = btn.dataset.parent;
        const order = btn.dataset.order;
        const status = btn.dataset.status;

        // Set action form sesuai route Laravel
        document.getElementById('formUpdateDetail').action = `/redaktur/navbar-menu/${id}`;

        // Mengisi data yang akan dikirim melalui form (input type hidden/text)
        document.getElementById('editId').value = id;
        document.getElementById('editTitle').value = btn.dataset.title;
        document.getElementById('editUrl').value = btn.dataset.url;
        document.getElementById('editParentId').value = parentId;
        document.getElementById('editOrderInput').value = order;
        
        // Mengisi checkbox berdasarkan data-status
        document.getElementById('statusCheckbox').checked = (status === 'Aktif');

        // Mengisi data readonly (untuk tampilan saja)
        document.getElementById('editTanggal').value = btn.dataset.tanggal;

        // Buka modal
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
        document.body.classList.add('overflow-hidden');
    });
});

    window.closeEditModal = function () {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    };

    document.querySelectorAll('.btn-copy').forEach(button => {
        button.addEventListener('click', function () {
            const url = this.dataset.url;

            navigator.clipboard.writeText(url)
                .then(() => {
                    showUploadSuccessToast("URL copied successfully!");
                })
                .catch(() => {
                    showUploadErrorToast("Failed to copy URL.");
                });
        });
    });

    function showUploadSuccessToast(message) {
        const toast = document.createElement("div");
        toast.setAttribute("x-data", "{ show: true }");
        toast.setAttribute("x-init", "setTimeout(() => show = false, 3000)");
        toast.setAttribute("x-show", "show");
        toast.setAttribute("x-transition.opacity", "");
        toast.className = "fixed inset-0 z-50 flex items-center justify-center bg-black/40";

        toast.innerHTML = `
            <div class="bg-gradient-to-br from-teal-400 to-cyan-500 text-white rounded-2xl shadow-2xl px-12 py-10 w-full max-w-xl text-center relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <h2 class="text-3xl font-bold mb-2">Success!</h2>
                <p class="text-lg">${message}</p>
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
            <div class="bg-gradient-to-br from-red-500 to-orange-500 text-white rounded-2xl shadow-2xl px-12 py-10 w-full max-w-xl text-center relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 5a7 7 0 110 14a7 7 0 010-14z" />
                </svg>
                <h2 class="text-3xl font-bold mb-2">Whoops!</h2>
                <p class="text-lg">${message}</p>
            </div>
        `;

        document.body.appendChild(toast);
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-hapus').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "The file will be permanently deleted and cannot be recovered!",
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
