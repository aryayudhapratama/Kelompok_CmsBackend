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
                            <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                            <td class="px-4 py-2">
                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="openModal('modalEdit{{ $user->id }}')"
                                        class="w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition"
                                        title="Lihat/Edit User">
                                        <i class="fas fa-pencil text-base"></i>
                                    </button>
                                    <form id="deleteForm{{ $user->id }}"
                                        action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        class="form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition btn-hapus"
                                            title="Hapus User">
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
    </div>

    <!-- Modal Tambah User -->
    <div id="modalAddUser" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl">
            <h3 class="text-lg font-bold mb-4">Tambah User Baru</h3>
            <form action="{{ route('admin.users.store') }}" method="POST">
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
                    <select name="role" class="w-full border rounded px-3 py-2">
                        <option value="admin">Admin</option>
                        <option value="redaktur">Redaktur</option>
                        <option value="reporter">Reporter</option>
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
    @foreach ($users as $user)
        <div id="modalEdit{{ $user->id }}"
            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl">
                <h3 class="text-lg font-bold mb-4">Edit User</h3>
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="block mb-1 font-medium">Nama</label>
                        <input type="text" name="name" value="{{ $user->name }}"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 font-medium">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 font-medium">Password (Kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 font-medium">Role</label>
                        <select name="role" class="w-full border rounded px-3 py-2">
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="redaktur" {{ $user->role == 'redaktur' ? 'selected' : '' }}>Redaktur</option>
                            <option value="reporter" {{ $user->role == 'reporter' ? 'selected' : '' }}>Reporter</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal('modalEdit{{ $user->id }}')"
                            class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    @push('scripts')
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
                        searchInput.addClass(
                            'w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500'
                        );
                        const lengthSelect = $('#usersTable_length select');
                        lengthSelect.addClass('border rounded-lg p-2 mr-2');
                        const paginateContainer = $('#usersTable_paginate');
                        paginateContainer.addClass('flex items-center gap-2');
                        $('#usersTable_paginate .paginate_button').each(function() {
                            $(this).addClass(
                                'px-3 py-1 border rounded-lg hover:bg-gray-200 transition');
                        });
                        $('#usersTable_paginate .paginate_button.current').addClass(
                            'bg-blue-600 text-white hover:bg-blue-700').removeClass('bg-gray-100');
                    }
                });
            });

            function openModal(id) {
                document.getElementById(id).classList.remove('hidden');
            }

            function closeModal(id) {
                document.getElementById(id).classList.add('hidden');
            }
            document.getElementById('btnAddUser').addEventListener('click', function() {
                openModal('modalAddUser');
            });
            // Tutup modal saat klik di luar modal
            document.querySelectorAll('.fixed.inset-0').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeModal(modal.id);
                    }
                });
            });
        </script>
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function() {
                // ... DataTable code tetap ...
                // Event hapus user
                $('.btn-hapus').on('click', function(e) {
                    e.preventDefault();
                    let form = $(this).closest('form');
                    Swal.fire({
                        title: 'Yakin hapus user ini?',
                        text: "Data user akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
