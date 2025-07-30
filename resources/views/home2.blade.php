<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PPID Provinsi Jawa Timur</title>
    <meta name="description" content="Portal PPID Provinsi Jawa Timur">
    <meta name="keywords" content="PPID, Jawa Timur, informasi publik">

    <!-- Favicons -->
    <link href="{{ asset('assets4/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets4/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets4/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets4/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets4/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets4/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets4/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets4/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="/" class="logo d-flex align-items-center me-auto">
                <img src="https://ppid-demo.jatimprov.go.id/images/logo-ppid-dark.png" class="l-light" alt="" width="300">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Seputar PPID</a></li>
                            <li><a href="#">Tugas dan Fungsi</a></li>
                            <li><a href="#">Struktur Organisasi</a></li>
                            <li><a href="#">Visi dan Misi</a></li>
                            <li><a href="#">Maklumat Pelayanan</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Regulasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Undang-Undang</a></li>
                            <li><a href="#">Peraturan Pemerintah</a></li>
                            <li><a href="#">Peraturan Mentri Dalan Negeri</a></li>
                            <li><a href="#">Peraturan Komisi Informasi</a></li>
                            <li><a href="#">Peraturan Gubernur Jawa Timur</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Dokumen</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Standar Operasional Prosedur</a></li>
                            <li><a href="#">Surat Keputusan</a></li>
                            <li><a href="#">Laporan Layanan Informasi Publik</a></li>
                            <li><a href="#">Laporan Akses Layanan Publik</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Daftar Informasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Informasi Berkala</a></li>
                            <li><a href="#">Informasi Serta Merta</a></li>
                            <li><a href="#">Informasi Setiap Saat</a></li>
                            <li><a href="#">Informasi Yang Dikecualikan</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Publikasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Agenda</a></li>
                            <li><a href="#">Berita</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Data Publik</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <!-- Ganti dengan data dari database -->
            @if($hero)
    <img src="{{ asset('storage/' . $hero->image) }}" alt="Hero Background" data-aos="fade-in">
    @else
    <img src="{{ asset('assets4/img/image.png') }}" alt="Hero Background" data-aos="fade-in">
    @endif
            <div class="container d-flex flex-column">
                <h3 data-aos="fade-up" data-aos-delay="100">
                    <b>{{ $hero->title ?? 'Kementerian Komunikasi dan Informatika' }}</b>
                </h3>
                <p data-aos="fade-up" data-aos-delay="200">
                    {{ $hero->content ?? 'Dinas Komunikasi dan Informatika Kota Surabaya yang bertugas mengelola informasi publik, layanan teknologi informasi, serta komunikasi pemerintahan di lingkungan Pemerintah Kota Surabaya. 
                        Sebagai penghubung antara pemerintah dan masyarakat, 
                        KOMINFO Surabaya menghadirkan layanan digital yang transparan, cepat, dan terintegrasi untuk mendukung tata
                         kelola pemerintahan yang modern, partisipatif, serta meningkatkan pelayanan publik melalui pemanfaatan teknologi informasi.' }}
                </p>
                <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                    @if($hero && $hero->link)
                        <a href="{{ $hero->link }}" class="btn-get-started">{{ $hero->button_text ?? 'Selengkapnya' }}</a>
                    @else
                        <a href="#about" class="btn-get-started">Lihat Selengkapnya</a>
                    @endif
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Pencarian Informasi -->
       <section class="py-5" style="background-color: #f8f9fa;">
  <div class="container text-center">
    <h2 class="fw-bold">Pencarian Informasi</h2>
    <p class="text-muted">Temukan Informasi Publik Jawa Timur</p>

    <form class="d-flex justify-content-center mt-4" method="POST" action="https://ppid-demo.jatimprov.go.id/kategori/blog/search#blogdetail">
      <input type="hidden" name="_token" value="3guPEYlXiBhlneCJYCDQPNAmayeNBW6yJRXZppkT">
      <div class="input-group shadow rounded-pill" style="max-width: 600px; width: 100%;">
        <input type="text" class="form-control border-0 rounded-start-pill px-4 py-2" name="keywords" placeholder="Masukkan kata kunci..." required>
        <button class="btn btn-info text-white rounded-end-pill px-4" type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </button>
      </div>
    </form>
  </div>
</section>

<!-- Layanan Informasi -->
<section id="layanan-informasi" class="py-5" style="background-color: #ffffff;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="layanan-title">Layanan Informasi</h2>
      <p class="layanan-subtitle">Layanan informasi dapat dilakukan baik melalui daring atau luring</p>
    </div>

    <div class="row g-4 justify-content-center">
      <!-- C1-->
      <div class="col-md-4">
        <div class="card-info text-center h-100">
          <div class="icon-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
              <line x1="16" y1="13" x2="8" y2="13"/>
              <line x1="16" y1="17" x2="8" y2="17"/>
              <polyline points="10 9 9 9 8 9"/>
            </svg>
          </div>
          <div>
            <h5 class="card-title">Informasi Berkala</h5>
            <p class="card-desc">Informasi yang wajib diperbaharui kemudian disediakan dan diumumkan kepada publik secara rutin atau berkala sekurang-kurangnya setiap 6 bulan sekali.</p>
          </div>
        </div>
      </div>

       <!-- C2--->
      <div class="col-md-4">
        <div class="card-info text-center h-100">
          <div class="icon-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
              <line x1="16" y1="13" x2="8" y2="13"/>
              <line x1="16" y1="17" x2="8" y2="17"/>
              <polyline points="10 9 9 9 8 9"/>
            </svg>
          </div>
          <div>
            <h5 class="card-title">Informasi Serta Merta</h5>
            <p class="card-desc">Informasi yang disediakan berkaitan dengan hajat hidup orang banyak dan ketertiban umum, serta wajib diumumkan secara serta merta tanpa penundaan.</p>
          </div>
        </div>
      </div>

      <!-- c3-->
      <div class="col-md-4">
        <div class="card-info text-center h-100">
          <div class="icon-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
              <line x1="16" y1="13" x2="8" y2="13"/>
              <line x1="16" y1="17" x2="8" y2="17"/>
              <polyline points="10 9 9 9 8 9"/>
            </svg>
          </div>
          <div>
            <h5 class="card-title">Informasi Setiap Saat</h5>
            <p class="card-desc">Informasi yang harus disediakan oleh Badan Publik dan siap tersedia untuk diberikan kepada Pemohon Informasi Publik ketika diminta.</p>
          </div>
        </div>
      </div>

      <!-- C4-->
      <div class="col-md-4">
        <div class="card-info text-center h-100">
          <div class="icon-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
              <line x1="16" y1="13" x2="8" y2="13"/>
              <line x1="16" y1="17" x2="8" y2="17"/>
              <polyline points="10 9 9 9 8 9"/>
            </svg>
          </div>
          <div>
            <h5 class="card-title">Informasi Yang Dikecualikan</h5>
            <p class="card-desc">Informasi yang tidak dapat diakses oleh Pemohon Informasi Publik karena alasan tertentu sesuai peraturan perundang-undangan.</p>
          </div>
        </div>
      </div>

       <!--c5-->
      <div class="col-md-4">
        <div class="card-info text-center h-100">
          <div class="icon-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
              <line x1="16" y1="13" x2="8" y2="13"/>
              <line x1="16" y1="17" x2="8" y2="17"/>
              <polyline points="10 9 9 9 8 9"/>
            </svg>
          </div>
          <div>
            <h5 class="card-title">Maklumat Pelayanan Informasi Publik</h5>
            <p class="card-desc">Pejabat PPID menyatakan semaksimal mungkin menjalankan Standar Pelayanan terhadap permohonan informasi publik di wilayahnya.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 <!-- gambar berita-->
<section style="background-color: #f8f9fa; padding: 50px 0;">

  <div class="container">
    <div class="section-title text-center mb-5 pb-2">
      <h4 class="title mb-3">Galeri Berita PPID</h4>
     <p class="text-muted para-desc mb-0 mx-auto">Galeri Foto kegiatan PPID Pemerintah Provinsi Jawa Timur</p>
    </div>

    <div class="row g-4">
      <!-- Card Galeri -->
      <div class="col-lg-4 col-md-6">
        <div class="gallery-card">
          <img src="https://ppid-demo.jatimprov.go.id/storage/images/93e0872b2e96d193020b81b856b2a25b.png" alt="Gambar 1">
          <div class="overlay-button">
            <button class="btn view-image" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="https://ppid-demo.jatimprov.go.id/storage/images/93e0872b2e96d193020b81b856b2a25b.png" data-title="Judul Gambar"> 
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg>
            </button>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="gallery-card">
          <img src="https://ppid-demo.jatimprov.go.id/storage/images/1000163103.jpg" alt="Gambar 2">
          <div class="overlay-button">
            <button class="btn view-image" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="https://ppid-demo.jatimprov.go.id/storage/images/1000163103.jpg" data-title="Judul Gambar">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg>
            </button>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="gallery-card">
          <img src="https://ppid-demo.jatimprov.go.id/storage/images/WhatsApp Image 2025-07-16 at 15.19.52 - Copy (6).jpeg" alt="Gambar 3">
          <div class="overlay-button">
            <button class="btn view-image" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="https://ppid-demo.jatimprov.go.id/storage/images/WhatsApp Image 2025-07-16 at 15.19.52 - Copy (6).jpeg" data-title="Judul Gambar">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg>
            </button>
          </div>
        </div>
      </div>

      <div class="col-12 mt-4 text-center">
        <a href="https://ppid-demo.jatimprov.go.id/galeri#blogdetail" class="btn btn-primary btn-pills">Galeri Lainnya</a>
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

<script>
  // Script buka gambar
  document.querySelectorAll('.view-image').forEach(button => {
    button.addEventListener('click', function () {
      const image = this.getAttribute('data-image');
      const title = this.getAttribute('data-title');
      document.getElementById('modalImage').src = image;
      document.getElementById('modalTitle').textContent = title;
    });
  });
</script>

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

<div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
  <div class="service-item">
    <div class="img">
      <img src="https://ppid-demo.jatimprov.go.id/storage/images/93e0872b2e96d193020b81b856b2a25b.png" class="img-fluid" alt="Pembekalan Mentor PKA 2025">
    </div>
    <div class="details position-relative">
      <div class="icon">
        <i class="bi bi-person-video2"></i>
      </div>
      <a href="https://ppid-demo.jatimprov.go.id/berita/bpsdm-jatim-kembali-gelar-pembekalan-mentor-peserta-pka-angkatan-vi-dan-vii-tahun-2025-68785829e2a53#blogdetail" class="stretched-link" target="_blank">
        <h3>Pembekalan Mentor PKA 2025</h3>
      </a>
      <p>BPSDM Jatim kembali menyelenggarakan pembekalan bagi mentor PKA Angkatan VI dan VII Tahun 2025.</p>
    </div>
  </div>
</div>

<div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
  <div class="service-item">
    <div class="img">
      <img src="https://ppid-demo.jatimprov.go.id/storage/images/1000163103.jpg" class="img-fluid" alt="Pemutihan Pajak Kendaraan Jatim 2025">
    </div>
    <div class="details position-relative">
      <div class="icon">
        <i class="bi bi-cash-coin"></i>
      </div>
      <a href="https://ppid-demo.jatimprov.go.id/berita/pemutihan-pajak-kendaraan-jatim-2025-dibuka-ojol-terdepan-nikmati-manfaatnya-687857fb93c41#blogdetail" class="stretched-link" target="_blank">
        <h3>Pemutihan Pajak Kendaraan Jatim 2025 Dibuka</h3>
      </a>
      <p>Ojol dan masyarakat Jatim kini dapat menikmati manfaat pemutihan pajak kendaraan mulai tahun 2025.</p>
    </div>
  </div>
</div>

<div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
  <div class="service-item">
    <div class="img">
      <img src="https://ppid-demo.jatimprov.go.id/storage/images/WhatsApp Image 2025-07-16 at 15.19.52 - Copy (6).jpeg" class="img-fluid" alt="Jatim Perkuat Sinergi Digitalisasi">
    </div>
    <div class="details position-relative">
      <div class="icon">
        <i class="bi bi-diagram-3"></i>
      </div>
      <a href="https://ppid-demo.jatimprov.go.id/berita/jatim-perkuat-sinergi-digitalisasi-layanan-publik-lewat-government-roadshow-dishub-dan-diskominfo-68785879f2557#blogdetail" class="stretched-link" target="_blank">
        <h3>Jatim Perkuat Sinergi Digitalisasi Layanan Publik</h3>
      </a>
      <p>Pemprov Jatim memperkuat layanan publik digital lewat Government Roadshow bersama Dishub & Diskominfo.</p>
    </div>
  </div>
</div>

<div class="col-12 mt-4 pt-2">
    <div class="text-center">
        <a href="https://ppid-demo.jatimprov.go.id/berita/blog/list#blogdetail" class="btn btn-pills btn-primary">Lihat Semua Berita <i class="mdi mdi-arrow-right"></i></a>
    </div>
 </div>
</section>

<section class="bg-building-pic d-table w-100" style="background: url('https://ppid-demo.jatimprov.go.id/assets/images/building.png') bottom no-repeat;"></section>
    </main>
    
<footer class="footer-light py-5">
  <div class="container">
    <div class="row gy-4">

      <!-- Logo + Sosmed -->
      <div class="col-lg-4">
        <div class="d-flex align-items-center mb-3">
          <img src="https://ppid-demo.jatimprov.go.id/images/logo-ppid-dark.png" alt="Logo" style="height: 48px;">
        </div>
        <div class="d-flex mt-3">
          <a href="#" class="footer-icon"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="footer-icon"><i class="fab fa-youtube"></i></a>
          <a href="#" class="footer-icon"><i class="fab fa-instagram"></i></a>
          <a href="#" class="footer-icon"><i class="fab fa-twitter"></i></a>
        </div>
      </div>

      <!-- Kontak -->
      <div class="col-lg-4">
        <h6 class="text-white fw-semibold mb-3">Hubungi Kami</h6>
        <p class="footer-text mb-2"><i class="fas fa-map-marker-alt me-2"></i>Jl. A Yani No 242-244 Surabaya</p>
        <p class="footer-text mb-2"><i class="fas fa-envelope me-2"></i><a href="mailto:bkd@jatimprov.go.id">bkd@jatimprov.go.id</a></p>
        <p class="footer-text"><i class="fas fa-phone me-2"></i><a href="tel:0318477551">031 8477551</a></p>
      </div>

      <!-- Link Terkait -->
      <div class="col-lg-4">
        <h6 class="text-white fw-semibold mb-3">Link Terkait</h6>
        <ul class="list-unstyled footer-text">
          <li class="mb-2"><a href="https://jatimprov.go.id">Pemerintah Provinsi Jawa Timur</a></li>
          <li class="mb-2"><a href="https://kominfo.jatimprov.go.id">Dinas Komunikasi dan Informatika Provinsi Jawa Timur</a></li>
          <li><a href="https://www.lapor.go.id/">SP4N LAPOR</a></li>
        </ul>
      </div>

    </div>

    <!-- Copyright -->
    <div class="text-center footer-border-top mt-5 pt-3 text-muted small">
      © <script>document.write(new Date().getFullYear())</script> PPID Pemerintah Provinsi Jawa Timur
    </div>
  </div>
</footer>

<style>
    .gallery-card {
      position: relative;
      overflow: hidden;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
    }

    .gallery-card:hover {
      transform: translateY(-5px);
    }

    .gallery-card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      display: block;
      border-radius: 12px;
    }

    .overlay-button {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      opacity: 0;
      transition: all 0.3s ease;
      z-index: 2;
    }

    .gallery-card:hover .overlay-button {
      opacity: 1;
    }

    .overlay-button .btn {
      padding: 12px;
      border-radius: 50%;
      background-color: #2fc3ff;
      color: white;
      border: none;
    }

    .overlay-button .btn:hover {
      background-color: #1aaed8;
    }

    .section-title h4 {
      font-size: 26px;
      font-weight: 600;
    }

    .section-title p {
      font-size: 14px;
      color: #7B8AAB;
    }
  .service-item .img {
    height: 220px; /* Sesuaikan tinggi card gambar */
    overflow: hidden;
    border-radius: 8px;
  }

  .service-item .img img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Crop otomatis */
    display: block;
  }
  
 .layanan-title {
      font-size: 28px;
      font-weight: 700;
    }

    .layanan-subtitle {
      color: #7B8AAB;
      font-size: 15px;
      margin-top: 0.5rem;
    }

    .card-info {
      border: 1px solid #2FC3FF;
      padding: 2rem;
      border-radius: 12px;
      background-color: #ffffff;
      transition: all 0.3s ease;
      min-height: 340px; /* Tinggi card agar terlihat panjang */
    }

    .card-info:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
      border-color: #2FC3FF;
    }

    .icon-box {
      background-color: #EAF8FF;
      width: 64px;
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 16px;
      margin: 0 auto 16px auto;
    }

    .icon-box svg {
      stroke: #2FC3FF;
    }

    .card-title {
      font-weight: 600;
      font-size: 16px;
    }

    .card-desc {
      color: #7B8AAB;
      font-size: 14px;
      margin-top: 12px;
    }

.footer-light {
    background-color: #1c2230; /* Biru gelap elegan */
    color: #d1d5db;
  }

  .footer-light a {
    color: #d1d5db;
    transition: color 0.3s ease;
  }

  .footer-light a:hover {
    color: #ffffff;
    text-decoration: underline;
  }

  .footer-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    margin-right: 10px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    color: #d1d5db;
    font-size: 16px;
    transition: all 0.3s ease;
  }

  .footer-icon:hover {
    background-color: #00b4ff;
    color: #fff;
    border-color: #00b4ff;
  }

  .footer-text {
    font-size: 15px;
  }

  .footer-logo {
    font-weight: 600;
    font-size: 18px;
    margin-left: 12px;
    color: #fff;
  }

  .footer-border-top {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
  }

</style>
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets4/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets4/vendor/php-email-form/validate.js"></script>
    <script src="assets4/vendor/aos/aos.js"></script>
    <script src="assets4/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets4/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets4/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets4/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets4/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="assets4/js/main.js"></script>

</body>

</html>

