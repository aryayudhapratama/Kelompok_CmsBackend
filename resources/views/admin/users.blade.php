@extends('layouts.admin')

@section('title', 'Kelola User')
@section('content')
    <div class="bg-white p-6 rounded-lg shadow relative z-10">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-xl font-bold">Kelola User</h2>
            <button id="btnAddUser" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold">
                + Tambah User
            </button>
        </div>

        <div class="overflow-x-auto">
            <table id="usersTable" class="w-full text-sm text-left table-fixed">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2 capitalize">
                                <!-- ✅ Aman: gunakan relasi langsung, null-safe -->
                                {{ $user->role?->name ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex items-center gap-2">
                                    <button type="button"
                                            class="btn-edit w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition"
                                            title="Edit User"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-role="{{ $user->role ?? '' }}">
                                        <i class="fas fa-pencil text-base"></i>
                                    </button>
                                    <button type="button"
                                            class="btn-delete w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition"
                                            title="Hapus User"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}">
                                        <i class="fas fa-trash text-base"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah User -->
    <div id="modalAddUser" class="hidden fixed inset-0 z-[1000] flex items-center justify-center bg-black/40">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl">
            <h3 class="text-lg font-bold mb-4">Tambah User Baru</h3>
            <form id="formAddUser">
                @csrf
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Nama</label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Password</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Role</label>
                    <select name="role_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalAddUser')"
                        class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div id="modalEditUser" class="hidden fixed inset-0 z-[1000] flex items-center justify-center bg-black/40">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl">
            <h3 class="text-lg font-bold mb-4">Edit User</h3>
            <form id="formEditUser">
                @csrf
                <input type="hidden" name="id" id="editUserId">
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Nama</label>
                    <input type="text" name="name" id="editUserName" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" id="editUserEmail" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Role</label>
                    <select name="role_id" id="editUserRole" class="w-full border rounded px-3 py-2" required>
                        <option value="">Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalEditUser')"
                        class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <!-- CDN: tanpa spasi -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#usersTable').DataTable({
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
                        const searchInput = $('#usersTable_filter input');
                        searchInput.addClass('w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500');

                        const lengthSelect = $('#usersTable_length select');
                        lengthSelect.addClass('border rounded-lg p-2 mr-2');

                        const paginateContainer = $('#usersTable_paginate');
                        paginateContainer.addClass('flex items-center gap-2');
                        
                        $('#usersTable_paginate .paginate_button').each(function() {
                            $(this).addClass('px-3 py-1 border rounded-lg hover:bg-gray-200 transition');
                        });
                        
                        $('#usersTable_paginate .paginate_button.current').addClass('bg-blue-600 text-white hover:bg-blue-700').removeClass('bg-gray-100');
                    }
                });
            });

            // Buka Modal Tambah
            document.getElementById('btnAddUser').addEventListener('click', function() {
                document.getElementById('modalAddUser').classList.remove('hidden');
            });

            // Tutup Modal
            function closeModal(id) {
                document.getElementById(id).classList.add('hidden');
                if (id === 'modalAddUser') document.getElementById('formAddUser').reset();
                if (id === 'modalEditUser') document.getElementById('formEditUser').reset();
            }

            // Isi dan Buka Modal Edit
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.getElementById('editUserId').value = this.dataset.id;
                    document.getElementById('editUserName').value = this.dataset.name;
                    document.getElementById('editUserEmail').value = this.dataset.email;
                    document.getElementById('editUserRole').value = this.dataset.role || '';
                    document.getElementById('modalEditUser').classList.remove('hidden');
                });
            });

            // Submit Tambah User
            document.getElementById('formAddUser').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                fetch("{{ route('admin.users.store') }}", {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        closeModal('modalAddUser');
                        Swal.fire('Berhasil!', data.message, 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        Swal.fire('Gagal!', data.message || 'Gagal menambahkan user.', 'error');
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                    Swal.fire('Error!', 'Terjadi kesalahan jaringan atau server.', 'error');
                });
            });

            // Submit Edit User
            document.getElementById('formEditUser').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('_method', 'PUT');
                const id = formData.get('id');

                fetch(`/admin/users/${id}`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        closeModal('modalEditUser');
                        Swal.fire('Berhasil!', data.message, 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        Swal.fire('Gagal!', data.message || 'Gagal memperbarui user.', 'error');
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                    Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
                });
            });

            // Hapus User
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    Swal.fire({
                        title: 'Yakin hapus user ini?',
                        text: `User "${name}" akan dihapus permanen!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/admin/users/${id}`, {
                                method: 'DELETE',
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Berhasil!', data.message, 'success');
                                    setTimeout(() => location.reload(), 1500);
                                } else {
                                    Swal.fire('Gagal!', data.message || 'Gagal menghapus.', 'error');
                                }
                            })
                            .catch(err => {
                                console.error('Error:', err);
                                Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection