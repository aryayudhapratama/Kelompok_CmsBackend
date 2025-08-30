@extends('layouts.admin')

@section('title', 'Kelola Role')
@section('content')
    <div class="bg-white p-6 rounded-lg shadow relative z-10">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-xl font-bold">Kelola Role</h2>
            <button id="btnAddRole"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold">
                + Tambah Role
            </button>
        </div>

        <div class="overflow-x-auto">
            <table id="rolesTable" class="w-full text-sm text-left table-fixed">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Nama Role</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="border-b">
                            <td class="px-4 py-2 capitalize">{{ $role->name }}</td>
                            <td class="px-4 py-2">{{ $role->description }}</td>
                            <td class="px-4 py-2">
                                <div class="flex items-center gap-2">
                                    <!-- Edit -->
                                    <button type="button" onclick="openModal('modalEdit{{ $role->id }}')"
                                        class="w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition"
                                        title="Edit Role">
                                        <i class="fas fa-pencil text-base"></i>
                                    </button>
                                    <!-- Delete -->
                                    <form id="deleteForm{{ $role->id }}"
                                       action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                        class="form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition btn-hapus"
                                            title="Hapus Role">
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

    <!-- Modal Tambah Role -->
    <div id="modalAddRole" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl">
            <h3 class="text-lg font-bold mb-4">Tambah Role Baru</h3>
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Nama Role</label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Deskripsi</label>
                    <input type="text" name="description" class="w-full border rounded px-3 py-2">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalAddRole')"
                        class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Role -->
    @foreach ($roles as $role)
        <div id="modalEdit{{ $role->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl">
                <h3 class="text-lg font-bold mb-4">Edit Role</h3>
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="block mb-1 font-medium">Nama Role</label>
                        <input type="text" name="name" value="{{ $role->name }}"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 font-medium">Deskripsi</label>
                        <input type="text" name="description" value="{{ $role->description }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal('modalEdit{{ $role->id }}')"
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
                $('#rolesTable').DataTable({
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
                    }
                });

                // Handle form submission untuk tambah dan edit
                $('form').on('submit', function(e) {
                    e.preventDefault();
                    const form = $(this);
                    const url = form.attr('action');
                    const method = form.attr('method');
                    const data = form.serialize();

                    $.ajax({
                        url: url,
                        type: method,
                        data: data,
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = 'Terjadi kesalahan';
                            
                            if (errors) {
                                errorMessage = Object.values(errors)[0][0];
                            }
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: errorMessage
                            });
                        }
                    });
                });
            });

            function openModal(id) {
                document.getElementById(id).classList.remove('hidden');
            }

            function closeModal(id) {
                document.getElementById(id).classList.add('hidden');
            }

            document.getElementById('btnAddRole').addEventListener('click', function() {
                openModal('modalAddRole');
            });

            // Tutup modal saat klik di luar modal
            document.querySelectorAll('.fixed.inset-0').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeModal(modal.id);
                    }
                });
            });

            // Konfirmasi hapus
            $('.btn-hapus').on('click', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Yakin hapus role ini?',
                    text: "Data role akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: form.attr('action'),
                            type: 'DELETE',
                            data: form.serialize(),
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        location.reload();
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Gagal menghapus role'
                                });
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
