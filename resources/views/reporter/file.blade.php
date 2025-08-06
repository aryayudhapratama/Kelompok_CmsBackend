<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- 🔐 Penting untuk AJAX -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets2/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets2/img/favicon.png') }}" />
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-uMu7F1...etc" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>REPORTER - FILE MANAGER</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets2/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets2/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets2/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
    <aside
        class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
        aria-expanded="false">
        <div class="h-19">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
                sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700" href="javascript:;">
                <img src="{{ asset('assets2/img/logo-ct-dark.png') }}"
                    class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8"
                    alt="main_logo" />
                <img src="{{ asset('assets2/img/logo-ct.png') }}"
                    class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-8"
                    alt="main_logo" />
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">REPORTER PANEL</span>
            </a>
        </div>
        <hr
            class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">
                <li class="mt-0.5 w-full">
                    <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('reporter.dashboard') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('reporter.berita') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Kelola Berita</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('reporter.file') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-green-500 ni ni-single-copy-04"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">File Manager</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <form action="/logout" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit"
                            class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors w-full text-left">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                <i class="relative top-0 text-sm leading-normal text-red-500 ni ni-button-power"></i>
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
            navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="text-white opacity-50" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                            aria-current="page">File Manager</li>
                    </ol>
                    <h6 class="mb-0 font-bold text-white capitalize">File Manager</h6>
                </nav>
            </div>
        </nav>

        <div class="w-full px-6 py-6 mx-auto">
            <div class="flex flex-wrap items-center justify-between mb-4 -mx-3">
                <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
                </div>
                <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                    <div class="flex items-center justify-end gap-2">
                        <button id="btnAddNew"
                            class="inline-block px-6 py-2.5 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:shadow-lg hover:-translate-y-px text-xs leading-pro ease-in tracking-tight-rem shadow-md">
                            <i class="fas fa-plus mr-1"></i> Tambah Baru
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mt-0 mb-6">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table
                                    class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                ID</th>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Date Added</th>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Nama File</th>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Slug Path</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                User</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="file-table-body">
                                        @forelse($files as $file)
                                            <tr class="border-t hover:bg-gray-50">
                                                <td class="px-4 py-2">{{ $file->id }}</td>
                                                <td class="px-4 py-2">{{ $file->created_at->format('d F Y') }}</td>
                                                <td class="px-4 py-2">{{ $file->nama }}</td>
                                                <td class="px-4 py-2 text-blue-600 underline">
                                                    <a href="{{ $file->slug_path }}"
                                                        target="_blank">{{ Str::limit($file->slug_path, 50) }}</a>
                                                </td>
                                                <td class="px-4 py-2">{{ $file->user }}</td>
                                                <td class="px-4 py-2">
                                                    <div class="flex items-center gap-2">
                                                        <!-- Tombol Lihat Detail -->
                                                        <button type="button"
                                                            class="w-10 h-10 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md flex items-center justify-center transition btn-detail"
                                                            title="Lihat Detail" data-judul="{{ $file->nama }}"
                                                            data-konten="{{ $file->konten ?? 'Tidak tersedia' }}"
                                                            data-path="{{ $file->slug_path }}">
                                                            <i class="fas fa-eye text-base"></i>
                                                        </button>

                                                        <!-- Tombol Hapus (AJAX) -->
                                                        <button type="button"
                                                            class="w-10 h-10 bg-red-100 text-red-700 hover:bg-red-200 rounded-md flex items-center justify-center transition btn-hapus"
                                                            title="Hapus File" data-id="{{ $file->id }}"
                                                            data-url="{{ route('file.delete', $file->id) }}">
                                                            <i class="fas fa-trash text-base"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6"
                                                    class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                                    Tidak ada file ditemukan.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah -->
    <div id="addModal"
        class="hidden fixed top-0 left-0 w-full h-screen flex items-center justify-center bg-black/50 z-[1000] p-4">
        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 w-11/12 md:w-2/3 lg:w-1/2 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-lg font-bold dark:text-white">Tambah Konten Baru</h5>
                <button onclick="closeAddModal()"
                    class="text-gray-500 hover:text-gray-800 dark:text-gray-400">&times;</button>
            </div>
            <form id="formAddNew" action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block mb-1 text-sm font-medium dark:text-white">Judul</label>
                        <input type="text" name="judul"
                            class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium dark:text-white">Isi Konten</label>
                        <textarea name="konten" rows="6"
                            class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload File
                            PDF</label>
                        <input type="file" name="file" accept=".pdf" required
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <p class="mt-1 text-sm text-gray-500">Hanya file PDF yang diizinkan (max 20MB).</p>
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="closeAddModal()"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-slate-600 dark:text-white">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal"
        class="hidden fixed top-0 left-0 w-full h-screen flex items-center justify-center bg-black/50 z-[1000] p-4">
        <div
            class="bg-white dark:bg-slate-800 rounded-lg p-6 w-11/12 md:w-3/4 lg:w-2/3 shadow-2xl flex flex-col max-h-[90vh]">
            <div class="flex justify-between items-center mb-4">
                <h5 id="detailJudul" class="text-xl font-bold dark:text-white">Detail File</h5>
                <button onclick="closeDetailModal()"
                    class="text-gray-500 hover:text-gray-800 dark:text-gray-400">&times;</button>
            </div>
            <div class="flex-grow overflow-y-auto pr-2 space-y-4">
                <div>
                    <h6 class="text-sm font-bold text-slate-500 dark:text-slate-400">Konten</h6>
                    <p id="detailKonten" class="text-sm dark:text-white whitespace-pre-wrap"></p>
                </div>
                <hr class="dark:border-slate-600">
                <div>
                    <h6 class="text-sm font-bold text-slate-500 dark:text-slate-400 mb-2">Pratinjau PDF</h6>
                    <div class="w-full h-[50vh] bg-gray-200 dark:bg-slate-700 rounded">
                        <iframe id="detailPdfPreview" class="w-full h-full" src=""></iframe>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="button" onclick="closeDetailModal()"
                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-slate-600 dark:text-white">Tutup</button>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://demos.creative-tim.com/argon-dashboard-tailwind/assets/js/plugins/perfect-scrollbar.min.js">
    </script>
    <script src="https://demos.creative-tim.com/argon-dashboard-tailwind/assets/js/argon-dashboard-tailwind.js?v=1.0.1">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addModal = document.getElementById('addModal');
            const detailModal = document.getElementById('detailModal');
            const formAddNew = document.getElementById('formAddNew');

            // --- Modal Tambah ---
            document.getElementById('btnAddNew')?.addEventListener('click', () => {
                addModal.classList.remove('hidden');
                addModal.classList.add('flex');
            });

            window.closeAddModal = () => {
                addModal.classList.add('hidden');
                addModal.classList.remove('flex');
                formAddNew?.reset();
            };

            // --- Upload File (AJAX) ---
            formAddNew?.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const btn = this.querySelector('button[type="submit"]');
                const original = btn.innerHTML;
                btn.innerHTML = 'Mengunggah...';
                btn.disabled = true;

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert('Berhasil diunggah!');
                            closeAddModal();
                            location.reload();
                        } else {
                            alert(data.message || 'Gagal!');
                        }
                    })
                    .catch(() => alert('Kesalahan jaringan.'))
                    .finally(() => {
                        btn.innerHTML = original;
                        btn.disabled = false;
                    });
            });

            // --- Modal Detail ---
            document.getElementById('file-table-body').addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-detail');
                if (btn) {
                    document.getElementById('detailJudul').textContent = btn.dataset.judul;
                    document.getElementById('detailKonten').textContent = btn.dataset.konten;
                    document.getElementById('detailPdfPreview').src = btn.dataset.path;
                    detailModal.classList.remove('hidden');
                    detailModal.classList.add('flex');
                }
            });

            window.closeDetailModal = () => {
                detailModal.classList.add('hidden');
                detailModal.classList.remove('flex');
                document.getElementById('detailPdfPreview').src = '';
            };

            // --- Hapus File (AJAX) ---
document.getElementById('file-table-body').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-hapus');
    if (btn) {
        const url = btn.dataset.url;
        if (confirm('Yakin ingin hapus file ini?')) {
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('File dihapus!');
                    // Hapus baris dari tabel
                    btn.closest('tr').remove();
                } else {
                    alert(data.message || 'Gagal hapus.');
                }
            })
            .catch(() => alert('Kesalahan jaringan.'));
        }
    }
});


            // Tutup modal dengan Escape
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    closeAddModal();
                    closeDetailModal();
                }
            });
        });
    </script>
</body>

</html>
