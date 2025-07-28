<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Redaktur')</title>

  {{-- TailwindCSS & FontAwesome --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">

  {{-- === NAVBAR === --}}
  <header class="fixed top-0 left-0 right-0 z-30 bg-white shadow px-6 py-4 flex justify-between items-center">
    <div class="flex items-center space-x-4">
      <button id="menu-button" class="text-blue-700 text-2xl md:hidden">
        <i class="fas fa-bars"></i>
      </button>
      <h1 class="text-xl font-semibold text-blue-700">@yield('page-title', 'Dashboard')</h1>
    </div>

    <div class="flex items-center space-x-6">

      {{-- Notification --}}
      <div class="relative">
        <button class="relative text-blue-600 text-xl focus:outline-none">
          <i class="fas fa-bell"></i>
          <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">3</span>
        </button>
      </div>

      {{-- Language Dropdown --}}
      <div class="relative">
        <button onclick="toggleLangDropdown()" class="focus:outline-none" id="langButton">
          <img src="https://flagcdn.com/us.svg" alt="Lang" class="w-6 h-4 rounded" id="flag-icon">
        </button>
        <div id="langDropdown"
             class="hidden absolute right-0 mt-2 w-32 bg-white border rounded shadow z-50 text-sm">
          <button onclick="setLanguage('en')" class="flex items-center px-3 py-2 hover:bg-gray-100 w-full">
            <img src="https://flagcdn.com/us.svg" class="w-5 h-3 mr-2"> English
          </button>
          <button onclick="setLanguage('id')" class="flex items-center px-3 py-2 hover:bg-gray-100 w-full">
            <img src="https://flagcdn.com/id.svg" class="w-5 h-3 mr-2"> Bahasa
          </button>
        </div>
      </div>

      {{-- Profile --}}
      <div>
        <button class="text-blue-600 text-xl">
          <i class="fas fa-user-circle"></i>
        </button>
      </div>
    </div>
  </header>

  {{-- === SIDEBAR === --}}
  <aside class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg border-r z-40 pt-16">
    <div class="px-6 py-5 border-b">
      <a href="/redaktur" class="flex items-center space-x-3">
        <img src="{{ asset('assets2/img/logo-ct-dark.png') }}" class="h-8" alt="Logo" />
        <span class="text-xl font-bold text-blue-700 tracking-wide">REDAKTUR</span>
      </a>
    </div>

    <nav class="mt-6">
      <ul class="space-y-1 text-sm">
        <li>
          <a href="/redaktur"
             class="flex items-center px-6 py-3 rounded-lg transition-all
                    {{ request()->is('redaktur') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
            <i class="fas fa-tachometer-alt mr-3 w-5 text-blue-500"></i>
            Dashboard
          </a>
        </li>
        <li>
          <a href="/redaktur/kelola"
             class="flex items-center px-6 py-3 rounded-lg transition-all
                    {{ request()->is('redaktur/kelola*') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
            <i class="fas fa-newspaper mr-3 w-5 text-green-500"></i>
            Kelola Berita
          </a>
        </li>
        <li>
          <form method="POST" action="/logout">
            @csrf
            <button type="submit"
                    class="w-full text-left flex items-center px-6 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-all">
              <i class="fas fa-sign-out-alt mr-3 w-5"></i>
              Logout
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </aside>

  {{-- === MAIN CONTENT === --}}
  <main class="pt-24 pb-10 px-6 md:ml-64">
    @yield('content')
  </main>

  {{-- === PAGE-SPECIFIC SCRIPTS === --}}
  @stack('scripts')

  <script>
    function toggleLangDropdown() {
      document.getElementById('langDropdown').classList.toggle('hidden');
    }

    function setLanguage(lang) {
      if (lang === 'id') {
        document.getElementById('flag-icon').src = 'https://flagcdn.com/id.svg';
        document.querySelector('h1').innerText = 'Beranda';
      } else {
        document.getElementById('flag-icon').src = 'https://flagcdn.com/us.svg';
        document.querySelector('h1').innerText = 'Dashboard';
      }
      document.getElementById('langDropdown').classList.add('hidden');
    }

    document.addEventListener('click', function (event) {
      const dropdown = document.getElementById('langDropdown');
      const langBtn = document.getElementById('langButton');
      if (!dropdown.contains(event.target) && !langBtn.contains(event.target)) {
        dropdown.classList.add('hidden');
      }
    });
  </script>
</body>
</html>
