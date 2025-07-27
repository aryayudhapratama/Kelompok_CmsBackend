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

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
    <!-- sidenav  -->
    <aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
        <div class="h-19">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
                sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700" href="javascript:;">
                <img src="./assets2/img/logo-ct-dark.png"
                    class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8"
                    alt="main_logo" />
                <img src="./assets2/img/logo-ct.png"
                    class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-8"
                    alt="main_logo" />
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Dashboard Admin</span>
            </a>
        </div>

        <hr
            class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

        <!-- Wrap menu dengan overflow-y-auto TAPI tanpa scrollbar terlihat -->
        <div class="items-center block w-auto h-[calc(100vh-120px)] overflow-y-auto h-sidenav grow basis-full"
            style="scrollbar-width: none; -ms-overflow-style: none;">
            <!-- Hide scrollbar for Webkit browsers -->
            <style>
                .h-sidenav::-webkit-scrollbar {
                    display: none;
                }
            </style>
            <ul class="flex flex-col pl-0 mb-0">
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="/admin">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="/admin/users">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-single-02"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Kelola User</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('admin.landing.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-single-02"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Kelola Halaman</span>
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
                <button onclick="openModal('modalTambah')" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:shadow-xs hover:-translate-y-px bg-150 bg-x-25 leading-pro text-xs ease-in tracking-tight-rem shadow-md bg-clip-padding bg-gradient-to-tl from-blue-500 to-violet-500">
                    + Tambah Section
                </button>
            </div>

            <!-- Table -->
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mt-0 mb-6">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6 class="dark:text-white">Daftar Section</h6>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Section</th>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Judul</th>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Gambar</th>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sections as $section)
                                        <tr>
                                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $section->section_name }}</p>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $section->title }}</p>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                @if($section->image)
                                                    <img src="{{ asset('storage/' . $section->image) }}" class="h-10 w-auto" alt="Image">
                                                @endif
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <a href="javascript:;" onclick="editSection({{ $section->id }})" class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400"> Edit </a>
                                                <form action="{{ route('admin.landing.destroy', $section->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-red-500 ml-2" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                                </form>
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
    <div id="modalTambah" class="hidden fixed top-0 left-0 w-full h-screen flex items-center justify-center bg-black/50 z-[1000]">
        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 w-11/12 md:w-1/2 shadow-2xl">
            <h5 class="text-lg font-bold mb-4 dark:text-white">Tambah Section Baru</h5>
            <form action="{{ route('admin.landing.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Nama Section</label>
                        <input type="text" name="section_name" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Judul</label>
                        <input type="text" name="title" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Link</label>
                        <input type="url" name="link" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Teks Tombol</label>
                        <input type="text" name="button_text" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Urutan</label>
                        <input type="number" name="order" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Gambar</label>
                        <input type="file" name="image" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm dark:text-white">Konten</label>
                    <textarea name="content" rows="4" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 mr-2 text-sm bg-gray-300 rounded-lg dark:bg-slate-600 dark:text-white">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modalEdit" class="hidden fixed inset-0 z-[1000] flex items-center justify-center bg-black/50">
        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 w-11/12 md:w-1/2 shadow-2xl">
            <h5 class="text-lg font-bold mb-4 dark:text-white">Edit Section</h5>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editId">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Nama Section</label>
                        <input type="text" name="section_name" id="editSectionName" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Judul</label>
                        <input type="text" name="title" id="editTitle" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Link</label>
                        <input type="url" name="link" id="editLink" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Teks Tombol</label>
                        <input type="text" name="button_text" id="editButtonText" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Urutan</label>
                        <input type="number" name="order" id="editOrder" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm dark:text-white">Gambar (Kosongkan jika tidak diubah)</label>
                        <input type="file" name="image" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm dark:text-white">Konten</label>
                    <textarea name="content" id="editContent" rows="4" class="w-full px-3 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 mr-2 text-sm bg-gray-300 rounded-lg dark:bg-slate-600 dark:text-white">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
<!-- Scripts -->
    <script src="{{ asset('assets2/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets2/js/argon-dashboard-tailwind.js') }}"></script>

    <!-- JavaScript untuk Modal -->
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
                modal.style.display = 'flex';
            }
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }
        }

        // Tutup modal saat klik luar
        document.querySelectorAll('.fixed.inset-0').forEach(modal => {
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    closeModal(modal.id);
                }
            });
        });

        // Isi form edit dengan data dari server
        function editSection(id) {
            fetch(`/admin/landing/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editId').value = data.id;
                    document.getElementById('editSectionName').value = data.section_name;
                    document.getElementById('editTitle').value = data.title;
                    document.getElementById('editContent').value = data.content;
                    document.getElementById('editLink').value = data.link || '';
                    document.getElementById('editButtonText').value = data.button_text || '';
                    document.getElementById('editOrder').value = data.order;

                    const form = document.getElementById('editForm');
                    form.action = `/admin/landing/${id}`;
                    openModal('modalEdit');
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</html>
