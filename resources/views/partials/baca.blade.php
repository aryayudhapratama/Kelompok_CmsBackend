<section class="section mt-5 pt-5" id="berita-detail">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <h2 class="mb-3">{{ $berita->judul }}</h2>
        <p class="text-muted mb-3">
          {{ $berita->created_at->format('d F Y') }} • Oleh <strong>{{ $berita->nama_reporter }}</strong>
        </p>

        @if ($berita->gambar)
          <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="img-fluid rounded mb-4 shadow-sm">
        @endif

        <div class="content" style="line-height: 1.8; font-size: 1.05rem;">
          {!! nl2br(e($berita->konten)) !!}
        </div>

        <div class="mt-5">
          <a href="{{ route('berita.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Daftar Berita
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
