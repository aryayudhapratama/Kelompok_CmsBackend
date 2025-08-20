<!-- Layanan Informasi -->
<section id="layanan-informasi" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Layanan Informasi</h2>
            <p>Layanan informasi dapat dilakukan baik melalui daring atau luring</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($banners as $banner)
                <div class="col-md-4">
                    <div class="card-info text-center h-100 d-flex flex-column">
                        <div class="icon-box mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <polyline points="10 9 9 9 8 9"/>
                            </svg>
                        </div>
                        <div class="flex-grow-1 d-flex flex-column">
                            <h5 class="card-title">{{ $banner->name }}</h5>
                            <p class="card-desc">{{ $banner->description }}</p>
                        </div>
                        <!-- Tombol Aksi -->
                        <div class="mt-auto">
                            <a href="{{ $banner->link }}" target="_blank" class="btn btn-primary btn-sm px-4 py-2 rounded-pill shadow-sm hover:shadow-md transition">
                                {{ $banner->button_text ?? 'Selengkapnya' }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>