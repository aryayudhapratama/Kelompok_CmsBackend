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

        </section>