<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Redaktur')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  <style>
    body { font-family: 'Inter', sans-serif; }
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    @keyframes fade-in-up {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
    .animate-fade-in-up { animation: fade-in-up 0.3s ease-out; }
    [x-cloak] { display: none !important; }
    
    .swal2-container.swal2-backdrop-show::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(5px);
    z-index: -1;
    }

    .modal-open {
  overflow: hidden;
}
  </style>
</head>

<body x-data="sidebarState()" x-init="init()" x-cloak>


  <!-- SIDEBAR -->
  <aside
    class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-xl transition-transform duration-300 ease-in-out translate-x-0"
    :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
    id="sidebar"
  >
    <div class="px-6 py-6">
  <!-- Logo / Title -->
  <a href="/redaktur" class="flex items-center gap-3 mb-4">
    <div class="bg-blue-600 p-2 rounded-lg shadow-sm">
      <i class="fas fa-pen-nib text-white text-lg"></i>
    </div>
    <span class="text-xl font-extrabold text-gray-800 tracking-wide">Redaktur</span>
  </a>

  <!-- Divider -->
  <hr class="border-t border-gray-200 mb-4">

  <!-- Profile Info -->
  <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
    <!-- Foto Profil -->
    <img class="h-10 w-10 rounded-full object-cover"
     src="{{ Auth::user()->profile_photo_path ? asset('storage/profile-photos/' . Auth::user()->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
     alt="{{ Auth::user()->name }}" />
    <!-- Nama + Role -->
    <div>
      <div class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</div>
      <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role ?? 'User' }}</div>
    </div>
  </div>
</div>
    <hr class="my-2 mx-4 border-t border-gray-200" />
    <div class="overflow-y-auto h-[calc(100vh-120px)] scrollbar-hide">
      <ul class="flex flex-col px-3 py-2 space-y-1 text-sm">
  <!-- Articles dengan submenu -->
  <li 
    x-data="{ open: {{ request()->is('redaktur') || request()->is('redaktur/kelola*') || request()->is('redaktur/publish*') ? 'true' : 'false' }} }"
  >
    <button @click="open = !open"
      class="w-full flex items-center justify-between px-4 py-2 rounded-lg transition-all duration-150 
      {{ request()->is('redaktur') || request()->is('redaktur/kelola*') || request()->is('redaktur/publish*') 
        ? 'bg-blue-100 text-blue-700 font-semibold' 
        : 'text-gray-700 hover:bg-gray-100' }}">
      <div class="flex items-center gap-3">
        <i class="fas fa-newspaper text-base"></i>
        <span>Articles</span>
      </div>
      <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-xs"></i>
    </button>

    <!-- Submenu -->
    <ul x-show="open" x-transition class="pl-10 space-y-1 mt-1">
      <li>
        <a href="/redaktur"
          class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150 
          {{ request()->is('redaktur') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
          <i class="fas fa-tachometer-alt text-base"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="/redaktur/kelola"
          class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150 
          {{ request()->is('redaktur/kelola*') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
          <i class="fas fa-tasks text-base"></i>
          <span>Manage Articles</span>
        </a>
      </li>
      <li>
        <a href="/redaktur/publish"
          class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150 
          {{ request()->is('redaktur/publish*') ? 'bg-red-50 text-red-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
          <i class="fas fa-check-circle text-base"></i>
          <span>Publish Articles</span>
        </a>
      </li>
    </ul>
  </li>

  <!-- Menu lain -->
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
      <i class="fas fa-bullhorn text-base"></i>
      <span>Banner</span>
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

  <!-- Logout -->
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

  <!-- Overlay -->
  <div x-show="sidebarOpen" class="fixed inset-0 bg-black/40 z-30 xl:hidden" @click="sidebarOpen = false"></div>

  <!-- NAVBAR -->
  <header class="fixed top-0 left-0 right-0 z-50 bg-white shadow px-6 py-4 flex justify-between items-center transition-[margin] duration-300 ease-in-out"
    :class="{ 'xl:ml-64': sidebarOpen, 'ml-0': !sidebarOpen }">
    <div class="flex items-center space-x-4">
      <button @click="sidebarOpen = !sidebarOpen" class="text-blue-700 text-2xl block">
        <i class="fas fa-bars"></i>
      </button>
    </div>

    <div class="flex items-center space-x-6">
      <div class="relative">
        <button class="relative text-blue-600 text-xl focus:outline-none">
          <i class="fas fa-bell"></i>
          <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">3</span>
        </button>
      </div>
      
  <!-- Trigger Modal Langsung -->
<button @click="openEditModal = true" class="ml-3 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
    <img class="h-10 w-10 rounded-full object-cover"
     src="{{ Auth::user()->profile_photo_path ? asset('storage/profile-photos/' . Auth::user()->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
     alt="{{ Auth::user()->name }}" />

</button>

    </div>
  </header>

  <!-- MAIN -->
  <main class="pt-24 pb-10 px-6 transition-[margin] duration-300 ease-in-out"
    :class="{ 'xl:ml-64': sidebarOpen, 'ml-0': !sidebarOpen }">
    @yield('content')
  </main>
<!-- Modal Edit Profil -->
<!-- Modal Edit Profil -->
<div 
    x-show="openEditModal" 
    x-cloak
    x-init="$watch('openEditModal', value => {
        if (value) {
            document.body.classList.add('modal-open');
        } else {
            document.body.classList.remove('modal-open');
        }
    })"
    class="fixed inset-0 z-[1000] flex items-center justify-center bg-black/40 backdrop-blur-sm"
>
    <!-- Konten Modal -->
    <div 
        @click.away="openEditModal = false" 
        class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto overflow-hidden animate-fade-in-up"
    >
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Edit Profile</h2>
            <button @click="openEditModal = false" class="text-white hover:text-gray-200 text-sm">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Body -->
        <form method="POST" action="{{ route('redaktur.settings.update') }}" enctype="multipart/form-data" class="px-6 py-5 space-y-4 text-sm text-gray-700">
            @csrf
            @method('PUT')
            <input type="hidden" name="redirect_to" value="{{ url()->current() }}">

            <div>
                <label class="block font-medium mb-1">Name</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" />
            </div>

            <div>
                <label class="block font-medium mb-1">Profile Photo</label>
                <input type="file" name="profile_photo"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300 bg-white" />
            </div>

            <div>
                <label class="block font-medium mb-1">New Password (Optional)</label>
                <input type="password" name="password"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" />
            </div>

            <div>
                <label class="block font-medium mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" />
            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-2 pt-2 border-t mt-4">
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-semibold">
                    <i class="fas fa-save mr-1"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>


  @if (session('success'))
<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity
  class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
  {{-- Gunakan lebar spesifik dan padding yang lebih besar --}}
  <div class="bg-gradient-to-br from-teal-400 to-cyan-500 text-white rounded-2xl shadow-2xl px-12 py-10 w-full max-w-xl text-center relative">
    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    <h2 class="text-3xl font-bold mb-2">Success!</h2>
    <p class="text-lg">{{ session('success') }}</p>
  </div>
</div>
@endif

@if (session('error'))
<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity
  class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
  {{-- Gunakan lebar spesifik dan padding yang lebih besar --}}
  <div class="bg-gradient-to-br from-red-500 to-orange-500 text-white rounded-2xl shadow-2xl px-12 py-10 w-full max-w-xl text-center relative">
    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 5a7 7 0 110 14a7 7 0 010-14z" />
    </svg>
    <h2 class="text-3xl font-bold mb-2">Whoops!</h2>
    <p class="text-lg">{{ session('error') }}</p>
  </div>
</div>
@endif

  <!-- Language Script -->
  <script>  
  function sidebarState() {
  return {
    sidebarOpen: true,
    openEditModal: false, // ← Tambahkan ini
    init() {
      this.sidebarOpen = JSON.parse(localStorage.getItem('sidebarOpen')) ?? true;
      this.$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', value));
    }
  }
}
  </script>
  @stack('scripts')
</body>
</html>
