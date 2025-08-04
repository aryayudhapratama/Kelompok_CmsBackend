<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Redaktur')</title>

    {{-- TailwindCSS & FontAwesome --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        @keyframes fade-in-up {
  from {
    transform: translateY(20px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.animate-fade-in-up {
  animation: fade-in-up 0.3s ease-out;
}

    </style>

</head>

<body class="bg-gray-100 text-gray-800">

    {{-- === NAVBAR === --}}
    <header class="fixed top-0 left-0 right-0 z-30 bg-white shadow px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            {{-- Hamburger Button: Always visible --}}
            <button id="menu-button" class="text-blue-700 text-2xl">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="text-xl font-semibold text-blue-700">@yield('page-title', 'Dashboard')</h1>
        </div>

        <div class="flex items-center space-x-6">
            {{-- Notification --}}
            <div class="relative">
                <button class="relative text-blue-600 text-xl focus:outline-none">
                    <i class="fas fa-bell"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">3</span>
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
   <aside id="sidebar"
  class="fixed inset-y-0 left-0 z-40 my-4 ml-6 w-64 rounded-2xl bg-white shadow-xl transition-all duration-300 ease-in-out -translate-x-full xl:translate-x-0">

        <div class="h-19">
            <a href="/redaktur" class="flex items-center px-6 py-5">
                <img src="{{ asset('assets2/img/logo-ct-dark.png') }}" class="h-8" alt="Logo" />
                <span class="ml-3 font-semibold text-blue-700 text-lg">Redaktur</span>
            </a>
        </div>

        <hr class="my-2 mx-4 border-t border-gray-200" />

        <div class="overflow-y-auto h-[calc(100vh-120px)] scrollbar-hide">
            <ul class="flex flex-col px-3 py-2 space-y-1 text-sm">
  <li>
    <a href="/redaktur"
      class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150
      {{ request()->is('redaktur') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
      <i class="fas fa-tachometer-alt text-base"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <li>
    <a href="/redaktur/kelola"
      class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150
      {{ request()->is('redaktur/kelola*') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
      <i class="fas fa-newspaper text-base"></i>
      <span>Kelola Berita</span>
    </a>
  </li>

  <li>
    <a href="/redaktur/publish"
      class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150
      {{ request()->is('redaktur/publish*') ? 'bg-red-100 text-red-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
      <i class="fas fa-check-circle text-base"></i>
      <span>Publish</span>
    </a>
  </li>

  <li>
    <a href="{{ route('redaktur.landing.index') }}"
      class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150
      {{ request()->is('redaktur/landing*') ? 'bg-yellow-100 text-yellow-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
      <i class="fas fa-images text-base"></i>
      <span>Carousel</span>
    </a>
  </li>

  <li>
    <a href="{{ route('redaktur.file.index') }}"
      class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150
      {{ request()->routeIs('redaktur.file.index') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
      <i class="fas fa-folder-open text-base"></i>
      <span>File Manager</span>
    </a>
  </li>

  <li>
    <form method="POST" action="/logout">
      @csrf
      <button type="submit"
        class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-red-600 hover:bg-red-50 transition-all duration-150">
        <i class="fas fa-sign-out-alt text-base"></i>
        <span>Logout</span>
      </button>
    </form>
  </li>
</ul>

        </div>
    </aside>

    {{-- === MAIN CONTENT === --}}
    <main class="pt-24 pb-10 px-6 transition-all duration-200 xl:ml-[280px]" id="main-content">
        @yield('content')
    </main>

    {{-- === PAGE-SPECIFIC SCRIPTS === --}}
    @stack('scripts')

    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
            <div
                class="bg-gradient-to-br from-teal-400 to-cyan-500 text-white rounded-xl shadow-xl p-8 w-[90%] max-w-md text-center relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-14 w-14 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <h2 class="text-2xl font-bold mb-1">Success!</h2>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
            <div
                class="bg-gradient-to-br from-red-500 to-orange-500 text-white rounded-xl shadow-xl p-8 w-[90%] max-w-md text-center relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-14 w-14 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14a7 7 0 010-14z" />
                </svg>
                <h2 class="text-2xl font-bold mb-1">Whoops!</h2>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif



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

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('langDropdown');
            const langBtn = document.getElementById('langButton');
            if (!dropdown.contains(event.target) && !langBtn.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Toggle sidebar
        document.getElementById('menu-button')?.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
