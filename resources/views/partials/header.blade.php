<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">
    <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
      <img src="https://ppid-demo.jatimprov.go.id/images/logo-ppid-dark.png" class="l-light" alt="Logo PPID" width="300">
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        {{-- Loop untuk menu utama --}}
        @foreach($menus as $menu)
          {{-- TAMBAHKAN PENGECEKAN status_aktif UNTUK MENU PARENT --}}
          @if($menu->status_aktif)
            {{-- Periksa apakah menu ini memiliki anak (sub-menu) --}}
            @if($menu->children->isNotEmpty())
              <li class="dropdown">
                <a href="#"><span>{{ $menu->title }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  {{-- Loop untuk sub-menu --}}
                  @foreach($menu->children->sortBy('order') as $child)
                    {{-- TAMBAHKAN PENGECEKAN status_aktif UNTUK SUBMENU --}}
                    @if($child->status_aktif)
                      <li>
                        <a href="{{ url($child->url) }}"
                           class="{{ request()->is($child->url . '*') ? 'active' : '' }}">
                          {{ $child->title }}
                        </a>
                      </li>
                    @endif
                  @endforeach
                </ul>
              </li>
            @else
              {{-- Jika tidak punya anak, tampilkan sebagai menu tunggal --}}
              <li>
                <a href="{{ url($menu->url) }}"
                   class="{{ request()->is($menu->url . '*') ? 'active' : '' }}">
                    {{ $menu->title }}
                </a>
              </li>
            @endif
          @endif
        @endforeach
      </ul>

      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>
</header>