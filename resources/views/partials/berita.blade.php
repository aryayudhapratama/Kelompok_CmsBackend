<section class="section pt-5" id="blogdetail">

  <div class="container py-5">
    <div class="row">
      @forelse($beritas as $berita)
        <div class="col-lg-6 col-md-6 mb-4">
          <div class="card shadow-sm border-0 h-100">
            <div class="position-relative">
              <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="Gambar Berita" style="height: 250px; object-fit: cover;">
              <span class="badge bg-primary position-absolute top-0 start-0 m-3">Berita</span>
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <small class="text-muted d-block mb-2">{{ $berita->created_at->format('d F Y') }}</small>
                <h5 class="card-title mb-3 fw-semibold">
                  <a href="{{ route('berita.show', $berita->id) }}" class="text-dark text-decoration-none">
                    {{ $berita->judul }}
                  </a>
                </h5>
              </div>
              <div class="mt-auto">
                <a href="{{ route('berita.show', $berita->id) }}" class="text-primary text-decoration-none fw-medium">
                  Baca Selengkapnya <i class="bi bi-chevron-right align-middle"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <p class="text-center text-muted">Belum ada berita yang tersedia.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>