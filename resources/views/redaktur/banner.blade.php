@extends('layouts.redaktur')

@section('title', 'Banner Manager - Redaktur')
@section('page-title', 'Banner Manager')

@section('content')
<div class="bg-white p-6 rounded-lg shadow relative z-10">
    <div class="flex justify-between items-center mb-4 border-b pb-2 flex-wrap gap-2">
        <h2 class="text-lg font-semibold text-gray-800">Banner Management</h2>
        <div class="flex items-center gap-2">
            <button id="btnAddBanner" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                + Add Banner
            </button>
        </div>
    </div>

    <table id="bannerTable" class="w-full text-sm text-left table-fixed">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Link</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($banners as $banner)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ $banner->id }}</td>
                <td class="px-4 py-2 max-w-[150px] truncate whitespace-nowrap overflow-hidden">{{ $banner->name }}</td>
                <td class="px-4 py-2 max-w-[200px] truncate whitespace-nowrap overflow-hidden">{{ $banner->description }}</td>
                <td class="px-4 py-2 max-w-[150px] truncate whitespace-nowrap overflow-hidden">
                    <a href="{{ $banner->link }}" target="_blank" class="text-blue-600 underline">
                        {{ $banner->link }}
                    </a>
                </td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 text-xs rounded-full 
                        {{ $banner->role == 'admin' ? 'bg-red-100 text-red-800' : 
                           ($banner->role == 'redaktur' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                        {{ ucfirst($banner->role) }}
                    </span>
                </td>
                <td class="px-4 py-2">
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-detail w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition" title="Lihat Detail"
                            data-id="{{ $banner->id }}"
                            data-name="{{ $banner->name }}"
                            data-description="{{ $banner->description }}"
                            data-link="{{ $banner->link }}"
                            data-role="{{ $banner->role }}"
                            data-created="{{ $banner->created_at->format('d F Y H:i') }}"
                            data-updated="{{ $banner->updated_at->format('d F Y H:i') }}">
                            <i class="fas fa-eye text-base"></i>
                        </button>
                        <button type="button" class="btn-edit w-10 h-10 bg-yellow-100 text-yellow-700 hover:bg-yellow-200 rounded-md flex items-center justify-center transition" title="Edit Banner"
                            data-id="{{ $banner->id }}"
                            data-name="{{ $banner->name }}"
                            data-description="{{ $banner->description }}"
                            data-link="{{ $banner->link }}"
                            data-role="{{ $banner->role }}">
                            <i class="fas fa-edit text-base"></i>
                        </button>
                        <!-- Hapus pakai AJAX, bukan form -->
                        <button type="button" class="btn-hapus w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition" title="Hapus Banner" data-id="{{ $banner->id }}">
                            <i class="fas fa-trash text-base"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-4 text-center text-gray-400 italic">Belum ada banner</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

<!-- Modal Tambah -->
<div id="uploadModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-[1000] transition-all duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto overflow-hidden animate-fade-in-up">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Add New Banner</h2>
            <button type="button" onclick="closeUploadModal()" class="text-white hover:text-gray-200 text-sm">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="px-6 py-5">
            <form id="uploadForm" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="namaBanner" class="block text-sm font-medium text-gray-700 mb-1">Banner Name</label>
                    <input type="text" name="name" id="namaBanner"
                           class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Enter banner name" required>
                </div>
                <div>
                    <label for="deskripsiBanner" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="deskripsiBanner" rows="3"
                              class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                              placeholder="Enter banner description" required></textarea>
                </div>
                <div>
                    <label for="linkBanner" class="block text-sm font-medium text-gray-700 mb-1">Link</label>
                    <input type="url" name="link" id="linkBanner"
                           class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="https://example.com" required>
                </div>
                <div>
                    <label for="roleBanner" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" id="roleBanner" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="admin">Admin</option>
                        <option value="redaktur">Redaktur</option>
                        <option value="reporter">Reporter</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="bg-gray-100 px-6 py-3 text-right space-x-2">
            <button type="submit" form="uploadForm"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold transition">
                Add Banner
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-[1000] transition-all duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto overflow-hidden animate-fade-in-up">
        <div class="bg-gradient-to-r from-yellow-600 to-yellow-400 text-white px-6 py-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Edit Banner</h2>
            <button type="button" onclick="closeEditModal()" class="text-white hover:text-gray-200 text-sm">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="px-6 py-5">
            <form id="editForm" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editId">
                <div>
                    <label for="editName" class="block text-sm font-medium text-gray-700 mb-1">Banner Name</label>
                    <input type="text" name="name" id="editName"
                           class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                </div>
                <div>
                    <label for="editDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="editDescription" rows="3"
                              class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                              required></textarea>
                </div>
                <div>
                    <label for="editLink" class="block text-sm font-medium text-gray-700 mb-1">Link</label>
                    <input type="url" name="link" id="editLink"
                           class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                </div>
                <div>
                    <label for="editRole" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" id="editRole" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="admin">Admin</option>
                        <option value="redaktur">Redaktur</option>
                        <option value="reporter">Reporter</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="bg-gray-100 px-6 py-3 text-right space-x-2">
            <button type="submit" form="editForm"
                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded text-sm font-semibold transition">
                Update
            </button>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-[1000] transition-all duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto overflow-hidden animate-fade-in-up">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Banner Properties</h2>
            <button onclick="closeDetailModal()" class="text-white hover:text-gray-200 text-sm">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="px-6 py-5 text-sm text-gray-700 space-y-3">
            <div class="flex items-center gap-3"><i class="fas fa-hashtag text-blue-500"></i>
                <p><strong>ID:</strong> <span id="detailId"></span></p></div>
            <div class="flex items-center gap-3"><i class="fas fa-file-alt text-blue-500"></i>
                <p><strong>Name:</strong> <span id="detailName"></span></p></div>
            <div class="flex items-center gap-3"><i class="fas fa-align-left text-blue-500"></i>
                <p><strong>Description:</strong> <span id="detailDescription"></span></p></div>
            <div class="flex items-center gap-3"><i class="fas fa-link text-blue-500"></i>
                <p><strong>Link:</strong> <a id="detailLink" href="#" target="_blank" class="text-blue-600 underline break-all"></a></p></div>
            <div class="flex items-center gap-3"><i class="fas fa-user-tag text-blue-500"></i>
                <p><strong>Role:</strong> <span id="detailRole"></span></p></div>
            <div class="flex items-center gap-3"><i class="fas fa-calendar-plus text-blue-500"></i>
                <p><strong>Created at:</strong> <span id="detailCreated"></span></p></div>
            <div class="flex items-center gap-3"><i class="fas fa-calendar-check text-blue-500"></i>
                <p><strong>Updated at:</strong> <span id="detailUpdated"></span></p></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Buka Modal Tambah
    document.getElementById('btnAddBanner').addEventListener('click', function () {
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

    // Tambah Banner
    document.getElementById('uploadForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch("{{ route('redaktur.banner.store') }}", {
            method: "POST",
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeUploadModal();
                showSuccessToast("Banner berhasil ditambahkan!");
                setTimeout(() => window.location.reload(), 2000);
            } else {
                showErrorToast("Gagal menambahkan banner.");
            }
        })
        .catch(err => {
            console.error(err);
            showErrorToast("Terjadi kesalahan saat upload.");
        });
    });

    // Buka Modal Edit
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('editId').value = this.dataset.id;
            document.getElementById('editName').value = this.dataset.name;
            document.getElementById('editDescription').value = this.dataset.description;
            document.getElementById('editLink').value = this.dataset.link;
            document.getElementById('editRole').value = this.dataset.role;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
            document.body.classList.add('overflow-hidden');
        });
    });

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
        document.getElementById('editForm').reset();
        document.body.classList.remove('overflow-hidden');
    }

    // Update Banner
    document.getElementById('editForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const id = document.getElementById('editId').value;
        fetch(`/redaktur/banner/${id}`, {
            method: "POST",
            headers: { 
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-HTTP-Method-Override': 'PUT'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeEditModal();
                showSuccessToast("Banner berhasil diperbarui!");
                setTimeout(() => window.location.reload(), 2000);
            } else {
                showErrorToast("Gagal memperbarui banner.");
            }
        })
        .catch(err => {
            console.error(err);
            showErrorToast("Terjadi kesalahan saat update.");
        });
    });

    // Buka Modal Detail
    document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('detailId').innerText = this.dataset.id;
            document.getElementById('detailName').innerText = this.dataset.name;
            document.getElementById('detailDescription').innerText = this.dataset.description;
            document.getElementById('detailLink').innerText = this.dataset.link;
            document.getElementById('detailLink').href = this.dataset.link;
            document.getElementById('detailRole').innerText = this.dataset.role;
            document.getElementById('detailCreated').innerText = this.dataset.created;
            document.getElementById('detailUpdated').innerText = this.dataset.updated;
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

    // Konfirmasi Hapus dengan SweetAlert (AJAX)
    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function () {
            const bannerId = this.dataset.id;

            Swal.fire({
                title: 'Are you sure?',
                text: "The banner will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/redaktur/banner/${bannerId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showSuccessToast("Banner berhasil dihapus!");
                            setTimeout(() => window.location.reload(), 2000);
                        } else {
                            showErrorToast("Gagal menghapus banner.");
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showErrorToast("Terjadi kesalahan saat menghapus.");
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