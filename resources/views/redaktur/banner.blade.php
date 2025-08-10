@extends('layouts.redaktur')

@section('title', 'Banner - Redaktur')
@section('page-title', 'Banner')

@section('content')
<div class="bg-white p-6 rounded-lg shadow relative z-10">
    <div class="flex justify-between items-center mb-4 border-b pb-2">
        <h2 class="text-lg font-semibold text-gray-800">Banner List</h2>
        <button id="btnAddNews"
            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-plus-circle mr-1"></i> New Banner
        </button>
    </div>

    <table class="w-full text-sm text-left table-fixed">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Date Added</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Content</th>
                <th class="px-4 py-2">Link</th>
                <th class="px-4 py-2">User</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
</div>
@endsection

@push('scripts')
<script>
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
                searchInput.addClass('w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500');

                // Styling untuk elemen dropdown "Tampilkan data"
                const lengthSelect = $('#beritaTable_length select');
                lengthSelect.addClass('border rounded-lg p-2 mr-2');

                // Styling untuk tombol paginasi
                const paginateContainer = $('#beritaTable_paginate');
                paginateContainer.addClass('flex items-center gap-2');
                
                // Tambahkan kelas untuk setiap tombol paginasi
                $('#beritaTable_paginate .paginate_button').each(function() {
                    $(this).addClass('px-3 py-1 border rounded-lg hover:bg-gray-200 transition');
                });
                // Hapus kelas 'current' dari tombol aktif untuk styling yang lebih bersih
                $('#beritaTable_paginate .paginate_button.current').addClass('bg-blue-600 text-white hover:bg-blue-700').removeClass('bg-gray-100');
            }
        });
    });
</script>
@endpush