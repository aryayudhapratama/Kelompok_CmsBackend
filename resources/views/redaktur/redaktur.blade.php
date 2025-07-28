<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Redaktur - Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #f0f4f8;
    }

    #sidebar {
      transition: transform 0.3s ease-in-out;
    }

    #sidebar.hidden {
      transform: translateX(-100%);
    }

    main.with-sidebar {
      margin-left: 16rem;
    }

    @media (max-width: 768px) {
      main.with-sidebar {
        margin-left: 0;
      }
    }
  </style>
</head>

<body class="font-inter text-gray-700">

  <!-- Navbar -->
  <nav class="fixed top-0 left-0 right-0 z-30 bg-white shadow flex items-center justify-between px-6 py-4">
    <div class="flex items-center space-x-4">
      <button id="menu-button" class="text-blue-600 text-2xl focus:outline-none">
        <i class="fas fa-bars"></i>
      </button>
      <h1 class="text-xl font-semibold text-blue-700">Dashboard</h1>
    </div>
    <div class="flex items-center space-x-4">
      <i class="fas fa-bell text-blue-500 relative">
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-1 py-0.5 rounded-full">0</span>
      </i>
      <img src="https://flagcdn.com/gb.svg" alt="EN" class="w-6 h-4" />
      <img src="https://via.placeholder.com/32" class="w-8 h-8 rounded-full border-2 border-blue-500" alt="User" />
    </div>
  </nav>

  <!-- Sidebar -->
  <aside id="sidebar"
    class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg border-r transform translate-x-0 z-40 pt-16">
    <div class="px-6 py-5 border-b">
      <a href="/redaktur" class="flex items-center space-x-3">
        <img src="{{ asset('assets2/img/logo-ct-dark.png') }}" class="h-8" alt="Logo" />
        <span class="text-lg font-semibold text-blue-700">I AM REDAKTUR</span>
      </a>
    </div>
    <nav class="mt-6">
      <ul class="space-y-1">
        <li>
          <a href="/redaktur"
            class="flex items-center px-6 py-3 text-sm font-medium text-blue-600 bg-blue-50 rounded hover:bg-blue-100">
            <i class="ni ni-tv-2 mr-3 text-blue-500"></i> Dashboard
          </a>
        </li>
        <li>
          <a href="/redaktur/berita"
            class="flex items-center px-6 py-3 text-sm text-gray-600 hover:bg-gray-100 rounded">
            <i class="ni ni-collection mr-3 text-green-500"></i> Kelola Berita
          </a>
        </li>
        <li>
          <form method="POST" action="/logout">
            @csrf
            <button type="submit"
              class="w-full text-left flex items-center px-6 py-3 text-sm text-red-500 hover:bg-red-50 rounded">
              <i class="ni ni-button-power mr-3"></i> Logout
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
  <main id="main-content" class="pt-24 px-6 pb-10 with-sidebar transition-all duration-300">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div
        class="bg-white p-5 rounded-xl shadow border-l-4 border-green-500 hover:scale-[1.02] hover:shadow-md transition duration-200 cursor-pointer">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-2xl font-semibold text-gray-800">1</p>
            <p class="text-sm text-gray-500">Approved</p>
          </div>
          <i class="fas fa-user-check text-green-500 text-3xl"></i>
        </div>
      </div>

      <div
        class="bg-white p-5 rounded-xl shadow border-l-4 border-yellow-400 hover:scale-[1.02] hover:shadow-md transition duration-200 cursor-pointer">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-2xl font-semibold text-gray-800">0</p>
            <p class="text-sm text-gray-500">Waiting</p>
          </div>
          <i class="fas fa-user-clock text-yellow-400 text-3xl"></i>
        </div>
      </div>

      <div
        class="bg-white p-5 rounded-xl shadow border-l-4 border-red-500 hover:scale-[1.02] hover:shadow-md transition duration-200 cursor-pointer">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-2xl font-semibold text-gray-800">0</p>
            <p class="text-sm text-gray-500">Reject</p>
          </div>
          <i class="fas fa-user-times text-red-500 text-3xl"></i>
        </div>
      </div>

      <div class="bg-white p-5 rounded-xl shadow border-l-4 border-blue-500">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-sm text-gray-500">User Guide</p>
            <a href="#" class="text-sm text-blue-600 font-medium hover:underline">Download</a>
          </div>
          <i class="fas fa-file-pdf text-blue-600 text-3xl"></i>
        </div>
      </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white p-5 rounded-xl shadow">
      <input type="text" placeholder="What letter would you want to create today?"
        class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-400 bg-blue-50 placeholder-blue-500" />
    </div>
  </main>

  <!-- Script -->
  <script>
    const menuBtn = document.getElementById('menu-button');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    menuBtn.addEventListener('click', () => {
      sidebar.classList.toggle('hidden');
      mainContent.classList.toggle('with-sidebar');
    });
  </script>

</body>

</html>