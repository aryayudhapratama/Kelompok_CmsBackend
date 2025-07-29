<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Reporter</title>
    <!-- Memuat Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Menggunakan font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Mencegah scroll horizontal */
        }
        /* Styling untuk editor teks (contoh sederhana) */
        .text-editor-container {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            overflow: hidden;
            background-color: #ffffff;
        }
        .text-editor-toolbar {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem;
            display: flex;
            flex-wrap: wrap; /* Memungkinkan item toolbar wrap ke baris berikutnya */
            gap: 0.5rem;
        }
        .text-editor-content {
            min-height: 300px;
            padding: 1rem;
            outline: none;
            overflow-y: auto;
        }
        /* Styling untuk scrollbar kustom */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="bg-gray-100 flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg rounded-r-lg p-4 flex flex-col justify-between custom-scrollbar overflow-y-auto">
        <div>
            <div class="text-2xl font-bold text-gray-800 mb-8 p-2">REPORTER</div>
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="#" class="flex items-center p-3 text-gray-700 hover:bg-blue-100 hover:text-blue-700 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2 2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span>Indeks</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="flex items-center p-3 bg-blue-500 text-white rounded-lg shadow-md">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            <span>Report</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="p-2">
            <a href="#" class="flex items-center p-3 text-gray-700 hover:bg-red-100 hover:text-red-700 rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 flex flex-col bg-gray-100 p-6 custom-scrollbar overflow-y-auto">
        <!-- Header -->
        <header class="bg-white shadow-md rounded-lg p-4 flex items-center justify-between mb-6">
            <div class="flex items-center">
                <h1 class="text-xl font-semibold text-gray-800 mr-4">Reporter</h1>
                <span class="text-gray-500">Edit</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Home / Reporter / Edit</span>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    <span>New</span>
                </button>
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-600 transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    <span>Save</span>
                </button>
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600 transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    <span>Delete</span>
                </button>
            </div>
        </header>

        <!-- Form Konten Berita -->
        <!-- Memulai form untuk pengiriman data ke backend Laravel -->
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Laravel CSRF protection -->

            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-semibold mb-2">Judul</label>
                    <input type="text" id="title" name="title" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan judul berita">
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="block text-gray-700 text-sm font-semibold mb-2">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="text-editor" class="block text-gray-700 text-sm font-semibold mb-2">Isi Berita</label>
                    <div class="text-editor-container">
                        <div class="text-editor-toolbar">
                            <!-- Tombol-tombol toolbar editor (contoh) -->
                            <button type="button" class="p-2 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors duration-200" onclick="formatDoc('bold')"><b>B</b></button>
                            <button type="button" class="p-2 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors duration-200" onclick="formatDoc('italic')"><i>I</i></button>
                            <button type="button" class="p-2 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors duration-200" onclick="formatDoc('underline')"><u>U</u></button>
                            <button type="button" class="p-2 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors duration-200" onclick="formatDoc('insertOrderedList')">OL</button>
                            <button type="button" class="p-2 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors duration-200" onclick="formatDoc('insertUnorderedList')">UL</button>
                            <button type="button" class="p-2 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors duration-200" onclick="formatDoc('justifyLeft')">Left</button>
                            <button type="button" class="p-2 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors duration-200" onclick="formatDoc('justifyCenter')">Center</button>
                            <button type="button" class="p-2 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors duration-200" onclick="formatDoc('justifyRight')">Right</button>
                            <button type="button" class="p-2 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors duration-200" onclick="formatDoc('createLink', prompt('Enter URL:'))">Link</button>
                            <!-- Tambahkan tombol toolbar lainnya sesuai kebutuhan -->
                        </div>
                        <div id="text-editor" contenteditable="true" class="text-editor-content p-4 focus:outline-none">
                            <!-- Konten editor akan muncul di sini -->
                            <p></p> <!-- Kosongkan konten awal atau sesuaikan dengan data yang ada -->
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Gambar</label>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            <span>New File</span>
                        </button>
                        <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-600 transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            <span>Upload</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bagian Kategori dan Status -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="kategori" class="block text-gray-700 text-sm font-semibold mb-2">Kategori</label>
                    <select id="kategori" name="kategori" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Kategori</option>
                        <option value="berita">Berita</option>
                        <option value="artikel">Artikel</option>
                        <option value="opini">Opini</option>
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-gray-700 text-sm font-semibold mb-2">Status</label>
                    <select id="status" name="status" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>

            <!-- Bagian Tanggal Publikasi -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <label for="tanggal-publikasi" class="block text-gray-700 text-sm font-semibold mb-2">Tanggal Publikasi</label>
                <input type="date" id="tanggal-publikasi" name="tanggal_publikasi" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Bagian Created At dan Updated At -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Created At</label>
                    <input type="text" value="2025-07-28 09:55:53" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed" readonly>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Updated At</label>
                    <input type="text" value="2025-07-28 09:55:53" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed" readonly>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end mt-auto">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition-colors duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Submit</span>
                </button>
            </div>
        </form>
    </main>

    <script>
        // Fungsi sederhana untuk editor teks (hanya untuk demo)
        function formatDoc(cmd, value = null) {
            document.execCommand(cmd, false, value);
        }

        // Mengatur tanggal hari ini secara default pada input tanggal
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
            const day = String(today.getDate()).padStart(2, '0');
            const formattedDate = `${year}-${month}-${day}`;

            const tanggalInput = document.getElementById('tanggal');
            if (tanggalInput) {
                tanggalInput.value = formattedDate;
            }

            const tanggalPublikasiInput = document.getElementById('tanggal-publikasi');
            if (tanggalPublikasiInput) {
                tanggalPublikasiInput.value = formattedDate;
            }

            // Ambil form dan tambahkan event listener untuk submit
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(event) {
                    // Ambil konten dari div contenteditable
                    const editorContent = document.getElementById('text-editor').innerHTML;

                    // Buat input hidden untuk menyimpan konten editor
                    let hiddenInput = document.getElementById('editor-content-hidden');
                    if (!hiddenInput) {
                        hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.id = 'editor-content-hidden';
                        hiddenInput.name = 'content'; // Nama ini akan digunakan di Laravel Request
                        form.appendChild(hiddenInput);
                    }
                    hiddenInput.value = editorContent;
                });
            }
        });
    </script>
</body>
</html>
