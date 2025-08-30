<!DOCTYPE html>
<html lang="en" x-data="sidebarState()" x-init="init()" x-cloak class="bg-gray-50">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Admin')</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- Alpine.js -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.7/dist/cdn.min.js" defer></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- jQuery & DataTables -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    [x-cloak] { display: none !important; }
    .modal-open { overflow: hidden; }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.3s ease-out; }
  </style>
</head>
<body>

  <!-- SIDEBAR -->
  <aside
    class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-xl transition-transform duration-300 ease-in-out"
    :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
    id="sidebar"
  >
    <div class="px-6 py-6">
      <!-- Logo -->
      <a href="/admin" class="flex items-center gap-3 mb-4">
        <div class="bg-blue-600 p-2 rounded-lg shadow-sm">
          <i class="fas fa-user-shield text-white text-lg"></i>
        </div>
        <span class="text-xl font-extrabold text-gray-800 tracking-wide">Admin</span>
      </a>
      <hr class="border-t border-gray-200 mb-4">

      <!-- Profile Info -->
      <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
  <img
    class="h-10 w-10 rounded-full object-cover"
    src="{{ Auth::user()->profile_photo_path 
      ? asset('storage/profile-photos/' . Auth::user()->profile_photo_path) 
      : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
    alt="{{ Auth::user()->name }}"
  />
  <div>
    <div class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</div>
  </div>
</div>

    <hr class="my-2 mx-4 border-t border-gray-200" />

    <div class="overflow-y-auto h-[calc(100vh-120px)] scrollbar-hide">
      <ul class="flex flex-col px-3 py-2 space-y-1 text-sm">
        <li>
          <a href="/admin" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150 {{ request()->is('admin') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-tachometer-alt text-base"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150 {{ request()->is('admin/users*') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-users text-base"></i>
            <span>Kelola User</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.file-manager.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150 {{ request()->is('admin/file-manager*') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-folder-open text-base"></i>
            <span>File Manager</span>
          </a>
        </li>
        <li>
          <a href="{{ route('roles.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-150 {{ request()->is('admin/roles*') ? 'bg-purple-50 text-purple-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-user-shield text-base"></i>
            <span>Kelola Role</span>
          </a>
        </li>
        <li>
          <form method="POST" action="{{ route('logout') }}" x-data>
  @csrf
  <button type="submit" 
          @click.prevent="Swal.fire({
            title: 'Yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              $el.closest('form').submit()
            }
          })"
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
      <button @click="sidebarOpen = !sidebarOpen" class="text-blue-700 text-2xl">
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
      <!-- Tombol Edit Profile -->
      <button @click="openEditModal = true" class="ml-3 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        <img
          class="h-10 w-10 rounded-full object-cover"
          src="{{ Auth::user()->profile_photo_path 
            ? asset('storage/profile-photos/' . Auth::user()->profile_photo_path) 
            : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
          alt="{{ Auth::user()->name }}"
        />
      </button>
    </div>
  </header>

  <!-- MAIN -->
  <main class="pt-24 pb-10 px-6 transition-[margin] duration-300 ease-in-out"
    :class="{ 'xl:ml-64': sidebarOpen, 'ml-0': !sidebarOpen }">
    @yield('content')
  </main>

  <!-- Modal Edit Profil -->
  <div 
    x-show="openEditModal" 
    x-cloak
    x-init="$watch('openEditModal', value => {
        if (value) document.body.classList.add('modal-open');
        else document.body.classList.remove('modal-open');
    })"
    class="fixed inset-0 z-[1000] flex items-center justify-center bg-black/40 backdrop-blur-sm"
  >
    <div 
      @click.away="openEditModal = false" 
      class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto overflow-hidden animate-fade-in-up"
    >
      <!-- Header -->
      <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
        <h2 class="text-lg font-semibold">Edit Profile</h2>
        <button @click="openEditModal = false" class="text-white hover:text-gray-200">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <!-- Form -->
      <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="px-6 py-5 space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" 
                   name="name" 
                   value="{{ Auth::user()->name }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
            @error('name')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Profile Photo</label>
            <input type="file" 
                   name="profile_photo" 
                   accept="image/*"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('profile_photo')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">New Password (Optional)</label>
            <input type="password" 
                   name="password"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input type="password" 
                   name="password_confirmation"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex justify-end gap-2 pt-4 border-t">
            <button type="button" 
                    @click="openEditModal = false"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                Cancel
            </button>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-save mr-2"></i> Save Changes
            </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Notifikasi Sukses -->
  @if (session('success'))
  <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div class="bg-gradient-to-br from-teal-400 to-cyan-500 text-white rounded-2xl shadow-2xl px-12 py-10 w-full max-w-xl text-center">
      <svg class="mx-auto h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
      <h2 class="text-3xl font-bold mb-2">Success!</h2>
      <p class="text-lg">{{ session('success') }}</p>
    </div>
  </div>
  @endif

  <!-- Notifikasi Error -->
  @if (session('error'))
  <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div class="bg-gradient-to-br from-red-500 to-orange-500 text-white rounded-2xl shadow-2xl px-12 py-10 w-full max-w-xl text-center">
      <svg class="mx-auto h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 5a7 7 0 110 14a7 7 0 010-14z" />
      </svg>
      <h2 class="text-3xl font-bold mb-2">Whoops!</h2>
      <p class="text-lg">{{ session('error') }}</p>
    </div>
  </div>
  @endif

  <!-- Error Messages -->
  @if ($errors->any())
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
         class="fixed top-4 right-4 z-50 max-w-lg w-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
        <strong class="font-bold">Whoops!</strong>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button @click="show = false" class="absolute top-0 right-0 mt-3 mr-4">
            <i class="fas fa-times"></i>
        </button>
    </div>
  @endif

  <!-- Alpine.js State -->
  <script>
    function sidebarState() {
      return {
        sidebarOpen: true,
        openEditModal: false,
        name: "{{ Auth::user()->name }}",
        init() {
          const saved = localStorage.getItem('sidebarOpen');
          this.sidebarOpen = saved ? JSON.parse(saved) : true;
          this.$watch('sidebarOpen', val => localStorage.setItem('sidebarOpen', val));
        }
      };
    }

    // Konfirmasi Update Profile
    document.querySelector('form[action="{{ route("admin.profile.update") }}"]').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        
        Swal.fire({
            title: 'Update Profile?',
            text: "Are you sure want to update your profile?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
  </script>

  @stack('scripts')
</body>
</html>