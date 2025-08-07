@extends('layouts.redaktur')

@section('content')
<div x-data="{ openEditModal: false }">
    <!-- Tombol untuk buka modal -->
    <button @click="openEditModal = true"
        class="ml-3 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        <img class="h-10 w-10 rounded-full object-cover"
            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
    </button>

    <!-- Modal Edit Profil -->
    <div x-show="openEditModal" x-cloak
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div @click.away="openEditModal = false"
            class="bg-white p-6 rounded-lg shadow-md w-full max-w-md relative">
            <h2 class="text-lg font-semibold mb-4 text-blue-700">Edit Profil</h2>
            <form id="editProfileForm" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Foto Profil</label>
                    <input type="file" name="profile_photo_path"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="openEditModal = false"
                        class="mr-2 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editProfileForm');
    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(form);

        try {
            const response = await fetch("{{ route('redaktur.settings.update') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: formData
            });

            if (!response.ok) throw new Error('Gagal menyimpan');
            const result = await response.json();

            document.querySelector('[x-data]').__x.$data.openEditModal = false;

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: result.message || 'Profil berhasil diperbarui',
            }).then(() => {
                location.reload(); // reload agar foto profil di navbar/side juga update
            });

        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: error.message || 'Terjadi kesalahan saat menyimpan data',
            });
        }
    });
});
</script>
@endsection
