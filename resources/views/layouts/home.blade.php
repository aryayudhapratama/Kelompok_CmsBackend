<!DOCTYPE html>
<html lang="en">
@include('partials.head')
@include('partials.style')
<body class="index-page">
  @include('partials.header')
  <main class="main">
    @yield('content') <!-- ini penting agar bisa inject dari home2.blade.php -->
  </main>
  @include('partials.footer')
  @include('partials.scripts')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>
</body>
</html>
