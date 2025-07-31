 <script src="assets4/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets4/vendor/php-email-form/validate.js"></script>
    <script src="assets4/vendor/aos/aos.js"></script>
    <script src="assets4/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets4/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets4/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets4/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets4/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets4/js/main.js"></script>
<script>
  // AOS Init
  AOS.init();

  // Modal galeri berita
  document.querySelectorAll('.view-image').forEach(button => {
    button.addEventListener('click', function () {
      const image = this.getAttribute('data-image');
      const title = this.getAttribute('data-title');
      document.getElementById('modalImage').src = image;
      document.getElementById('modalTitle').textContent = title;
    });
  });
</script>
