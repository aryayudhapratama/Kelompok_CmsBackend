<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">
    <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
      <img src="https://ppid-demo.jatimprov.go.id/images/logo-ppid-dark.png" class="l-light" alt="Logo PPID" width="300">
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li>
          <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
        </li>

        <li class="dropdown {{ request()->is('profile*') ? 'active' : '' }}">
          <a href="#"><span>Profile</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="#">Seputar PPID</a></li>
            <li><a href="#">Tugas dan Fungsi</a></li>
            <li><a href="#">Struktur Organisasi</a></li>
            <li><a href="#">Visi dan Misi</a></li>
            <li><a href="#">Maklumat Pelayanan</a></li>
          </ul>
        </li>

        <li class="dropdown {{ request()->is('regulasi*') ? 'active' : '' }}">
          <a href="#"><span>Regulasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="#">Undang-Undang</a></li>
            <li><a href="#">Peraturan Pemerintah</a></li>
            <li><a href="#">Peraturan Menteri Dalam Negeri</a></li>
            <li><a href="#">Peraturan Komisi Informasi</a></li>
            <li><a href="#">Peraturan Gubernur Jawa Timur</a></li>
          </ul>
        </li>

        <li class="dropdown {{ request()->is('dokumen*') ? 'active' : '' }}">
          <a href="#"><span>Dokumen</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="#">Standar Operasional Prosedur</a></li>
            <li><a href="#">Surat Keputusan</a></li>
            <li><a href="#">Laporan Layanan Informasi Publik</a></li>
            <li><a href="#">Laporan Akses Layanan Publik</a></li>
          </ul>
        </li>

        <li class="dropdown {{ request()->is('informasi*') ? 'active' : '' }}">
          <a href="#"><span>Daftar Informasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="#">Informasi Berkala</a></li>
            <li><a href="#">Informasi Serta Merta</a></li>
            <li><a href="#">Informasi Setiap Saat</a></li>
            <li><a href="#">Informasi Yang Dikecualikan</a></li>
          </ul>
        </li>

        <li class="dropdown {{ request()->is('berita*') ? 'active' : '' }}">
          <a href="#"><span>Publikasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="#">Agenda</a></li>
            <li>
              <a href="{{ route('berita.index') }}" class="{{ request()->is('berita*') ? 'active' : '' }}">Berita</a>
            </li>
          </ul>
        </li>

        <li><a href="#" class="{{ request()->is('data-publik*') ? 'active' : '' }}">Data Publik</a></li>
      </ul>

      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>
</header>
