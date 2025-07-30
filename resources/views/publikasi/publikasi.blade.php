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
        <!-- Kabar Berita -->
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
    body {
    scroll-padding-top: 90px;
}

main {
    padding-top: 100px;
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