@extends('layouts.redaktur')
@section('title', 'Carousel - Redaktur')
@section('page-title', 'Carousel')
@section('content')
   <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
            navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="text-black opacity-50" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-black before:float-left before:pr-2 before:text-black before:content-['/']"
                            aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="mb-0 font-bold text-black capitalize">Dashboard</h6>
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
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6 class="text-black">Daftar Section</h6>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-collapse text-slate-700">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-500 opacity-70">Section</th>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-500 opacity-70">Judul</th>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-500 opacity-70">Gambar</th>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-500 opacity-70">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sections as $section)
                                        <tr>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-black">{{ $section->section_name }}</p>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-black">{{ $section->title }}</p>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                @if($section->image)
                                                    <img src="{{ asset('storage/' . $section->image) }}" class="h-10 w-auto" alt="Image">
                                                @endif
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <a href="javascript:;" onclick="editSection({{ $section->id }})" class="text-xs font-semibold leading-tight text-slate-700"> Edit </a>
                                                <form action="{{ route('redaktur.landing.destroy', $section->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xs font-semibold leading-tight text-red-500 ml-2" onclick="return confirm('Yakin hapus?')">Hapus</button>
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
    <div id="modalTambah" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-11/12 md:w-1/2 shadow-2xl">
            <h5 class="text-lg font-bold mb-4 text-black">Tambah Section Baru</h5>
            <form action="{{ route('redaktur.landing.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Nama Section</label>
                        <input type="text" name="section_name" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Judul</label>
                        <input type="text" name="title" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Link</label>
                        <input type="url" name="link" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Teks Tombol</label>
                        <input type="text" name="button_text" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Urutan</label>
                        <input type="number" name="order" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Gambar</label>
                        <input type="file" name="image" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Konten</label>
                    <textarea name="content" rows="4" class="w-full px-3 py-2 border rounded-lg" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 mr-2 text-sm bg-gray-300 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modalEdit" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-11/12 md:w-1/2 shadow-2xl">
            <h5 class="text-lg font-bold mb-4 text-black">Edit Section</h5>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editId">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Nama Section</label>
                        <input type="text" name="section_name" id="editSectionName" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Judul</label>
                        <input type="text" name="title" id="editTitle" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Link</label>
                        <input type="url" name="link" id="editLink" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Teks Tombol</label>
                        <input type="text" name="button_text" id="editButtonText" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Urutan</label>
                        <input type="number" name="order" id="editOrder" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-black">Gambar (Kosongkan jika tidak diubah)</label>
                        <input type="file" name="image" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-black">Konten</label>
                    <textarea name="content" id="editContent" rows="4" class="w-full px-3 py-2 border rounded-lg" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 mr-2 text-sm bg-gray-300 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
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
        document.querySelectorAll('.fixed.inset-0').forEach(modal => {
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    closeModal(modal.id);
                }
            });
        });

        // Perbaiki URL dari /admin/ ke /redaktur/
        function editSection(id) {
            fetch(`/redaktur/landing/${id}/edit`) // ✅ Ganti dari /admin/ ke /redaktur/
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
                    form.action = `/redaktur/landing/${id}`; // ✅ Ganti ke /redaktur/

                    openModal('modalEdit');
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endpush