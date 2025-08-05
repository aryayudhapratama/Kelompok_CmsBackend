<!-- Kabar Berita -->
<section id="services" class="services section">
  <div class="row justify-content-center">
    <div class="col">
      <div class="section-title text-center mb-4 pb-2">
        <h4 class="title mb-3">Kabar Berita</h4>
        <p class="text-muted para-desc mb-0 mx-auto">Berita Kegiatan PPID Pemerintah Provinsi Jawa Timur</p>
      </div>
    </div>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-5">
      @foreach ($kabarBerita as $berita)
        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
          <div class="service-item">
            <div class="img">
              <img src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid" alt="{{ $berita->judul }}">
            </div>
            <div class="details position-relative">
              <div class="icon">
                <i class="bi bi-newspaper"></i>
              </div>
              <a href="{{ route('berita.show', $berita->id) }}" class="stretched-link">
                <h3>{{ \Illuminate\Support\Str::limit($berita->judul, 60) }}</h3>
              </a>
              <p>{{ \Illuminate\Support\Str::limit(strip_tags($berita->konten), 100) }}</p>
            </div>
          </div>
        </div>
      @endforeach

      <div class="col-12 mt-4 pt-2">
        <div class="text-center">
          <a href="{{ route('berita.index') }}" class="btn btn-pills btn-primary">
            Lihat Semua Berita <i class="mdi mdi-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
