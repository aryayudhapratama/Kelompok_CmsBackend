<section class="section pt-5" id="blogdetail">
  <div class="container py-5">
    <div class="row g-4">
      @if ($beritas->count())
        <!-- Featured Berita Utama (horizontal layout) -->
@php $featured = $beritas->first(); @endphp
<div class="col-12 mb-5">
  <div class="row g-4 align-items-center">
    <div class="col-md-5">
      <img src="{{ asset('storage/' . $featured->gambar) }}" class="img-fluid rounded-4 shadow-sm w-100" style="object-fit: cover; height: 260px;" />
    </div>
    <div class="col-md-7">
      <div>
        <div class="d-flex align-items-center text-muted small mb-2">
          
          <span>{{ $featured->created_at->diffForHumans() }}</span>
        </div>
        <h3 class="fw-bold mb-2">
          <a href="{{ route('berita.show', $featured->id) }}" class="text-dark text-decoration-none">
            {{ $featured->judul }}
          </a>
        </h3>
        <p class="text-muted mb-2">
          {{ \Illuminate\Support\Str::limit(strip_tags($featured->konten), 130) }}
        </p>
        <p class="text-muted small mb-3">
          <span class="text-danger">Berita</span> &bull; 4 min read
        </p>
        <a href="{{ route('berita.show', $featured->id) }}" class="text-primary fw-medium text-decoration-none">
          Baca Selengkapnya <i class="bi bi-chevron-right align-middle"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="fw-bold">Latest News</h4>
  <a href="{{ route('berita.index') }}" class="text-primary fw-medium">
    See All <i class="bi bi-arrow-right"></i>
  </a>
</div>

        <!-- Latest Berita Kecil -->
        <div class="col-lg-5">
          <div class="row row-cols-1 row-cols-md-2 g-3">
            @foreach ($beritas->skip(1)->take(4) as $berita)
              <div class="col">
                <div class="card card-berita border-0 shadow-sm rounded-4 overflow-hidden h-100">
                  <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" style="height: 120px; object-fit: cover;">
                  <div class="p-3">
                    <small class="text-muted d-block mb-1">
                      {{ $berita->created_at->diffForHumans() }} &bull; {{ $berita->nama_reporter }}
                    </small>
                    <h6 class="fw-semibold mb-2">
                      <a href="{{ route('berita.show', $berita->id) }}" class="text-dark text-decoration-none">
                        {{ \Illuminate\Support\Str::limit($berita->judul, 60) }}
                      </a>
                    </h6>
                    <small class="text-muted d-block">
                      {{ \Illuminate\Support\Str::limit(strip_tags($berita->konten), 60) }}
                    </small>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @else
        <p class="text-muted text-center">Belum ada berita tersedia.</p>
      @endif
    </div>
  </div>
</section>
