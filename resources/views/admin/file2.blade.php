@extends('layouts.admin')

@section('title', 'File Manager - Admin')
@section('page-title', 'File Manager')

@section('content')
<div class="bg-white p-6 rounded-lg shadow relative z-10">
    <div class="flex justify-between items-center mb-4 border-b pb-2 flex-wrap gap-2">
        <h2 class="text-lg font-semibold text-gray-800">Directory listing</h2>
        <div class="flex items-center gap-2">
            <button id="btnUploadFile" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                + Upload File
            </button>
        </div>
    </div>

    <table id="fileTable" class="w-full text-sm text-left table-fixed">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Date Added</th>
                <th class="px-4 py-2">File Name</th>
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
                <td class="px-4 py-2 max-w-[180px] truncate whitespace-nowrap overflow-hidden">{{ $file->nama }}</td>
                <td class="px-4 py-2 max-w-[260px] truncate whitespace-nowrap overflow-hidden text-blue-600 underline">
                    <a href="{{ url($file->slug_path) }}" target="_blank" class="text-blue-600 underline">
                        {{ url($file->slug_path) }}
                    </a>
                </td>
                <td class="px-4 py-2">{{ $file->user }}</td>
                <td class="px-4 py-2">
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-detail w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition" title="Lihat Detail"
                            data-nama="{{ $file->nama }}"
                            data-url="{{ url($file->slug_path) }}"
                            data-user="{{ $file->user }}"
                            data-created="{{ $file->created_at }}"
                            data-updated="{{ $file->updated_at }}">
                            <i class="fas fa-eye text-base"></i>
                        </button>
                        <button type="button" class="btn-copy w-10 h-10 bg-green-100 text-green-700 hover:bg-green-200 rounded-md flex items-center justify-center transition" title="Copy Link" data-url="{{ url($file->slug_path) }}">
                            <i class="fas fa-copy text-base"></i>
                        </button>
                        <button type="button" class="btn-hapus w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition" title="Hapus File" data-id="{{ $file->id }}">
                            <i class="fas fa-trash text-base"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-4 text-center text-gray-400 italic">Belum ada file</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

<!-- Modal Upload -->
<div id="uploadModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-[1000] transition-all duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto overflow-hidden animate-fade-in-up">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Upload File</h2>
            <button type="button" onclick="closeUploadModal()" class="text-white hover:text-gray-200 text-sm">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="px-6 py-5">
            <form id="uploadForm" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="namaFile" class="block text-sm font-medium text-gray-700 mb-1">File Name</label>
                    <input type="text" name="nama_file" id="namaFile"
                           class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Enter file name">
                </div>
                <div>
                    <label for="uploadFile" class="block text-sm font-medium text-gray-700 mb-1">Choose File</label>
                    <input type="file" name="file" id="uploadFile"
                           class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                </div>
            </form>
        </div>
        <div class="bg-gray-100 px-6 py-3 text-right space-x-2">
            <button type="submit" form="uploadForm"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold transition">
                Upload
            </button>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-[1000] transition-all duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto overflow-hidden animate-fade-in-up">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold">File Properties</h2>
            <button onclick="closeDetailModal()" class="text-white hover:text-gray-200 text-sm">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="px-6 py-5 text-sm text-gray-700 space-y-3">
            <div class="flex items-center gap-3"><i class="fas fa-file-alt text-blue-500"></i>
                <p><strong>File Name:</strong> <span id="detailNama"></span></p></div>
            <div class="mt-4" id="previewContainer">
                <p class="font-semibold mb-1">Preview:</p>
                <div id="filePreview" class="w-full h-64 border rounded overflow-hidden bg-white flex items-center justify-center">
                    <span class="text-gray-400 italic">Preview not available</span>
                </div>
            </div>
            <div class="flex items-center gap-3"><i class="fas fa-link text-blue-500"></i>
                <p><strong>URL:</strong> <a id="detailUrl" href="#" target="_blank" class="text-blue-600 underline break-all"></a></p></div>
            <div class="flex items-center gap-3"><i class="fas fa-user text-blue-500"></i>
                <p><strong>User/Role:</strong> <span id="detailUser"></span></p></div>
            <div class="flex items-center gap-3"><i class="fas fa-calendar-plus text-blue-500"></i>
                <p><strong>Created at:</strong> <span id="detailCreated"></span></p></div>
            <div class="flex items-center gap-3"><i class="fas fa-calendar-check text-blue-500"></i>
                <p><strong>Updated at:</strong> <span id="detailUpdated"></span></p></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Inisialisasi DataTable
    $(document).ready(function() {
        $('#fileTable').DataTable({
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
                const searchInput = $('#fileTable_filter input');
                searchInput.addClass('w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500');

                const lengthSelect = $('#fileTable_length select');
                lengthSelect.addClass('border rounded-lg p-2 mr-2');

                const paginateContainer = $('#fileTable_paginate');
                paginateContainer.addClass('flex items-center gap-2');
                
                $('#fileTable_paginate .paginate_button').each(function() {
                    $(this).addClass('px-3 py-1 border rounded-lg hover:bg-gray-200 transition');
                });
                
                $('#fileTable_paginate .paginate_button.current').addClass('bg-blue-600 text-white hover:bg-blue-700').removeClass('bg-gray-100');

                $('#fileTable').wrap('<div class="overflow-x-auto"></div>');
            }
        });
    });

    // Buka Modal Upload
    document.getElementById('btnUploadFile').addEventListener('click', function () {
        document.getElementById('uploadModal').classList.remove('hidden');
        document.getElementById('uploadModal').classList.add('flex');
        document.body.classList.add('overflow-hidden');
    });

    function closeUploadModal() {
        document.getElementById('uploadModal').classList.add('hidden');
        document.getElementById('uploadModal').classList.remove('flex');
        document.getElementById('uploadForm').reset();
        document.body.classList.remove('overflow-hidden');
    }

    // Upload File
    document.getElementById('uploadForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch("{{ route('admin.file-manager.upload') }}", {
            method: "POST",
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeUploadModal();
                showSuccessToast("File uploaded successfully!");
                setTimeout(() => window.location.reload(), 2000);
            } else {
                showErrorToast("Upload failed: " + (data.message || "Unknown error"));
            }
        })
        .catch(err => {
            console.error(err);
            showErrorToast("Network error. Check console.");
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

            const previewContainer = document.getElementById('filePreview');
            const fileUrl = this.dataset.url.toLowerCase();
            previewContainer.innerHTML = "";

            if (fileUrl.endsWith(".pdf")) {
                previewContainer.innerHTML = `<iframe src="${this.dataset.url}" class="w-full h-full" frameborder="0"></iframe>`;
            } else if (fileUrl.match(/\.(jpeg|jpg|png|gif|webp)$/)) {
                previewContainer.innerHTML = `<img src="${this.dataset.url}" alt="Preview Gambar" class="max-h-full max-w-full object-contain">`;
            } else {
                previewContainer.innerHTML = `<span class="text-gray-400 italic">Preview not available for this file type</span>`;
            }

            document.getElementById('detailModal').classList.remove('hidden');
            document.getElementById('detailModal').classList.add('flex');
            document.body.classList.add('overflow-hidden');
        });
    });

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.getElementById('detailModal').classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    // Copy URL
    document.querySelectorAll('.btn-copy').forEach(button => {
        button.addEventListener('click', function () {
            const url = this.dataset.url;
            navigator.clipboard.writeText(url)
                .then(() => showSuccessToast("URL copied!"))
                .catch(() => showErrorToast("Failed to copy."));
        });
    });

    // Hapus File (AJAX)
    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function () {
            const fileId = this.dataset.id;

            Swal.fire({
                title: 'Are you sure?',
                text: "The file will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/file-manager/${fileId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            showSuccessToast("File berhasil dihapus!");
                            setTimeout(() => window.location.reload(), 1500);
                        } else {
                            showErrorToast("Gagal: " + (data.message || "Unknown error"));
                        }
                    })
                    .catch(err => {
                        console.error("Delete error:", err);
                        showErrorToast("Error: " + err.message);
                    });
                }
            });
        });
    });

    // Toast Sukses
    function showSuccessToast(message) {
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

    // Toast Error
    function showErrorToast(message) {
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
</script>
@endpush