<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets2/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets2/img/favicon.png') }}" />
    <title>Admin - Kelola User</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src=" https://kit.fontawesome.com/42d5adcbca.js " crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets2/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets2/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Main CSS -->
    <link href="{{ asset('assets2/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
    <!-- sidenav  -->
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
                    <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="/reporter">
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

    <!-- end sidenav -->

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
            navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="text-white opacity-50" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                            aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="mb-0 font-bold text-white capitalize">Dashboard</h6>
                </nav>
            </div>
        </nav>

        <div class="w-full px-6 py-6 mx-auto">
            <!-- Button Tambah -->
            <div class="flex justify-end mb-4">
                <button id="btnAddNews"
                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:shadow-xs hover:-translate-y-px bg-150 bg-x-25 leading-pro text-xs ease-in tracking-tight-rem shadow-md bg-clip-padding bg-gradient-to-tl from-blue-500 to-violet-500">
                    + Tambah Berita
                </button>
            </div>

            <!-- Table -->
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mt-0 mb-6">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6 class="dark:text-white">Daftar Berita</h6>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table
                                    class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Judul</th>
                                            <th
                                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Nama Reporter</th>
                                            <th
                                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Email</th>
                                            <th
                                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Tanggal</th>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Gambar</th>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($beritas as $berita)
                                            <tr>
                                                <td
                                                    class="p-1 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                        {{ $berita->judul }}</p>
                                                </td>
                                                <td
                                                    class="p-1 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                        {{ $berita->nama_reporter }}</p>
                                                </td>
                                                <td
                                                    class="p-1 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                        {{ $berita->email_reporter }}</p>
                                                </td>
                                                <td
                                                    class="p-1 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                        {{ $berita->created_at->format('d M Y') }}</p>
                                                </td>
                                                <td
                                                    class="p-1 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <span
                                                        class="text-xs font-semibold px-2 py-2 rounded-lg
                                                        {{ $berita->status == 'approved' ? 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200' : ($berita->status == 'rejected' ? 'bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-200' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-800 dark:text-yellow-200') }}">
                                                        {{ ucfirst($berita->status) }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="p-1 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    @if ($berita->gambar)
                                                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="rounded" width="120" alt="Gambar">
                                                    @else
                                                        <span class="text-xs text-gray-500">Tidak ada</span>
                                                    @endif
                                                </td>
                                                <td
                                                    class="p-1 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <a href="javascript:;"
                                                        class="btn-detail text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400"
                                                        data-judul="{{ $berita->judul }}"
                                                        data-konten="{{ $berita->konten }}"
                                                        data-nama="{{ $berita->nama_reporter }}"
                                                        data-email="{{ $berita->email_reporter }}"
                                                        data-tanggal="{{ $berita->created_at->format('d F Y H:i') }}"
                                                        data-gambar="{{ $berita->gambar }}"
                                                        data-status="{{ $berita->status }}">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
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
        class="hidden fixed top-0 left-0 w-full h-screen flex items-center justify-center bg-black/50 z-[1000]">
        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 w-11/12 md:w-1/2 shadow-2xl">
            <h5 class="text-lg font-bold mb-4 dark:text-white">Tambah Berita Baru</h5>
            <form id="formAddNews" action="{{ route('reporter.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1 text-sm dark:text-white">Nama Lengkap</label>
                    <input type="text" name="nama_reporter" value="{{ auth()->user()->name }}"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" readonly>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm dark:text-white">Email</label>
                    <input type="email" name="email_reporter" value="{{ auth()->user()->email }}"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" readonly>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm dark:text-white">Judul Berita</label>
                    <input type="text" name="judul"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm dark:text-white">Konten Berita</label>
                    <textarea name="konten" rows="6" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white"
                        required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm dark:text-white">Gambar (Opsional)</label>
                    <input type="file" name="gambar" accept="image/*"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeAddModal()"
                        class="px-4 py-2 mr-2 text-sm bg-gray-300 rounded-lg dark:bg-slate-600 dark:text-white">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div id="editModal"
        class="hidden fixed top-0 left-0 w-full h-screen flex items-center justify-center bg-black/50 z-[1000]">
        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 w-11/12 md:w-1/2 shadow-2xl">
            <h5 class="text-lg font-bold mb-4 dark:text-white">Detail Berita</h5>
            <div class="space-y-4">
                <div>
                    <label class="block mb-1 text-sm dark:text-white">Judul</label>
                    <input type="text" id="editJudul"
                        class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-slate-700 dark:text-white"
                        readonly>
                </div>
                <div>
                    <label class="block mb-1 text-sm dark:text-white">Konten</label>
                    <textarea id="editKonten" rows="6"
                        class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-slate-700 dark:text-white" readonly></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-sm dark:text-white">Nama Reporter</label>
                        <input type="text" id="editNama"
                            class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-slate-700 dark:text-white"
                            readonly>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm dark:text-white">Email</label>
                        <input type="text" id="editEmail"
                            class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-slate-700 dark:text-white"
                            readonly>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-sm dark:text-white">Tanggal Dibuat</label>
                        <input type="text" id="editTanggal"
                            class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-slate-700 dark:text-white"
                            readonly>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm dark:text-white">Status</label>
                        <input type="text" id="editStatus"
                            class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-slate-700 dark:text-white"
                            readonly>
                    </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 text-sm bg-gray-300 rounded-lg dark:bg-slate-600 dark:text-white">Tutup</button>
            </div>
        </div>
    </div>



</body>
<!-- Scripts -->
<script src="{{ asset('assets2/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets2/js/argon-dashboard-tailwind.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal detail
        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('editJudul').value = this.dataset.judul;
                document.getElementById('editKonten').value = this.dataset.konten;
                document.getElementById('editNama').value = this.dataset.nama;
                document.getElementById('editEmail').value = this.dataset.email;
                document.getElementById('editTanggal').value = this.dataset.tanggal;
                document.getElementById('editStatus').value = this.dataset.status;

                document.getElementById('editModal').classList.remove('hidden');
                document.getElementById('editModal').classList.add('flex');
            });
        });

        window.closeEditModal = function() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        };

        // Modal tambah
        document.getElementById('btnAddNews')?.addEventListener('click', function() {
            document.getElementById('addModal').classList.remove('hidden');
            document.getElementById('addModal').classList.add('flex');
        });

        window.closeAddModal = function() {
            document.getElementById('addModal').classList.add('hidden');
            document.getElementById('addModal').classList.remove('flex');
            document.getElementById('formAddNews')?.reset();
        };
    });
</script>

</html>
