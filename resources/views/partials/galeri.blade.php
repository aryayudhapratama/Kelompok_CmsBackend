<!-- galeri.blade.php -->
<section style="background-color: #f8f9fa; padding: 50px 0;">
  <div class="container">
    <div class="section-title text-center mb-5 pb-2">
      <h4 class="title mb-3">Galeri Berita PPID</h4>
      <p class="text-muted para-desc mb-0 mx-auto">Galeri Foto kegiatan PPID Pemerintah Provinsi Jawa Timur</p>
    </div>

    <div class="row g-4">
      @forelse ($galeriBerita as $item)
        <div class="col-lg-4 col-md-6">
          <div class="gallery-card">
            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
            <div class="overlay-button">
              <button class="btn view-image" data-bs-toggle="modal" data-bs-target="#imageModal"
                data-image="{{ asset('storage/' . $item->gambar) }}"
                data-title="{{ $item->judul }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="feather feather-maximize">
                  <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
          <p class="text-muted">Belum ada galeri berita yang tersedia.</p>
        </div>
      @endforelse

      <div class="col-12 mt-4 text-center">
        <a href="{{ route('berita.index') }}#galeri" class="btn btn-primary btn-pills">Galeri Lainnya</a>
      </div>
    </div>
  </div>
</section>

<!-- Modal Gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body p-0">
        <img id="modalImage" src="" class="img-fluid w-100 rounded" alt="">
      </div>
      <div class="modal-footer justify-content-center">
        <h6 id="modalTitle" class="text-center mb-0"></h6>
      </div>
    </div>
  </div>
</div>
