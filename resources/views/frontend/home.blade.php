@extends('layouts.app2')

@section('content')

<!-- Hero Section -->
<section class="hero__v6 section" id="home">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="row">
                    <div class="col-lg-11">
                        <span class="hero-subtitle text-uppercase" data-aos="fade-up" data-aos-delay="0">
                            Innovative Fintech Solutions
                        </span>
                        <h1 class="hero-title mb-3" data-aos="fade-up" data-aos-delay="100">
                            Secure, Efficient, and User-Friendly Financial Services
                        </h1>
                        <p class="hero-description mb-4 mb-lg-5" data-aos="fade-up" data-aos-delay="200">
                            Experience the future of finance with our secure, efficient, and user-friendly financial services.
                        </p>
                        <div class="cta d-flex gap-2 mb-4 mb-lg-5" data-aos="fade-up" data-aos-delay="300">
                            <a class="btn" href="#">Get Started Now</a>
                            <a class="btn btn-white-outline" href="#">Learn More 
                                <svg class="lucide lucide-arrow-up-right" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 7h10v10"></path>
                                    <path d="M7 17 17 7"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="logos mb-4" data-aos="fade-up" data-aos-delay="400">
                            <span class="logos-title text-uppercase mb-4 d-block">
                                Trusted by major companies worldwide
                            </span>
                            <div class="logos-images d-flex gap-4 align-items-center">
                                <img class="img-fluid js-img-to-inline-svg" src="{{ asset('assets/images/logo/actual-size/logo-air-bnb__black.svg') }}" alt="Company 1" style="width: 110px;">
                                <img class="img-fluid js-img-to-inline-svg" src="{{ asset('assets/images/logo/actual-size/logo-ibm__black.svg') }}" alt="Company 2" style="width: 80px;">
                                <img class="img-fluid js-img-to-inline-svg" src="{{ asset('assets/images/logo/actual-size/logo-google__black.svg') }}" alt="Company 3" style="width: 110px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-img">
                    {{-- <img class="img-card img-fluid" src="{{ asset('assets/images/card-expenses.png') }}" alt="Image card" data-aos="fade-down" data-aos-delay="600"> --}}
                    <img class="img-main img-fluid rounded-4" src="{{ asset('assets/images/hero-img-1-min.jpg') }}" alt="Hero Image" data-aos="fade-in" data-aos-delay="500">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About -->
<section class="about__v4 section" id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-2">
                <div class="row justify-content-end">
                    <div class="col-md-11 mb-4 mb-md-0">
                        <span class="subtitle text-uppercase mb-3 d-block">About us</span>
                        <h2 class="mb-4">Experience the future of finance with our secure, efficient, and user-friendly financial services</h2>
                        <p>Founded with the vision of revolutionizing the financial industry, we are a leading fintech company dedicated to providing innovative and secure financial solutions.</p>
                        <p>Our cutting-edge platform ensures your transactions are safe, streamlined, and easy to manage, empowering you to take control of your financial journey with confidence and convenience.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img-wrap position-relative">
                    <img class="img-fluid rounded-4" src="{{ asset('assets/images/about_2-min.jpg') }}" alt="About image" data-aos="fade-up" data-aos-delay="0">
                    <div class="mission-statement p-4 rounded-4 d-flex gap-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="mission-icon text-center rounded-circle">
                            <i class="bi bi-lightbulb fs-4"></i>
                        </div>
                        <div>
                            <h3 class="text-uppercase fw-bold">Mission Statement</h3>
                            <p class="fs-5 mb-0">Our mission is to empower individuals and businesses by delivering secure, efficient, and user-friendly financial services.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="section features__v2" id="features">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-lg-flex p-5 rounded-4 content">
                    <div class="rounded-borders">
                        <div class="rounded-border-1"></div>
                        <div class="rounded-border-2"></div>
                        <div class="rounded-border-3"></div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-item">
                            <h3 class="fs-1 fw-bold"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="2">0</span><span>K+</span></h3>
                            <p class="mb-0">Customer Satisfaction</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-item">
                            <h3 class="fs-1 fw-bold"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="200" data-purecounter-duration="2">0</span><span>%+</span></h3>
                            <p class="mb-0">Revenue Increase</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-item">
                            <h3 class="fs-1 fw-bold"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="2">0</span><span>x</span></h3>
                            <p class="mb-0">Business Growth</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing -->
<section class="section pricing__v2" id="pricing">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-5 mx-auto text-center">
                <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">Pricing</span>
                <h2 class="mb-3" data-aos="fade-up" data-aos-delay="100">Plan for every budget</h2>
                <p data-aos="fade-up" data-aos-delay="200">
                    Experience the future of finance with our secure, efficient, and user-friendly financial services
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="300">
                <div class="p-5 rounded-4 price-table h-100">
                    <h3>Personal</h3>
                    <p>Choose a plan that fits your personal financial needs and start managing your finances more effectively.</p>
                    <div class="price mb-4"><strong>$7</strong><span>/ month</span></div>
                    <div><a class="btn" href="#">Get Started</a></div>
                </div>
            </div>
            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                <div class="p-5 rounded-4 price-table popular h-100">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="mb-3">Business</h3>
                            <p>Optimize your business financial operations with our tailored business plans.</p>
                            <div class="price mb-4"><strong>$29</strong><span>/ month</span></div>
                            <div><a class="btn btn-white hover-outline" href="#">Get Started</a></div>
                        </div>
                        <div class="col-md-6 pricing-features">
                            <h4 class="text-uppercase fw-bold mb-3">Features</h4>
                            <ul class="list-unstyled d-flex flex-column gap-3">
                                <li class="d-flex gap-2 align-items-start mb-0">
                                    <span class="icon rounded-circle position-relative mt-1"><i class="bi bi-check"></i></span>
                                    <span>Personalized financial insights and reports</span>
                                </li>
                                <li class="d-flex gap-2 align-items-start mb-0">
                                    <span class="icon rounded-circle position-relative mt-1"><i class="bi bi-check"></i></span>
                                    <span>Priority customer support</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section testimonials__v2" id="testimonials">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-5 mx-auto text-center">
                <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">Testimonials</span>
                <h2 class="mb-3" data-aos="fade-up" data-aos-delay="100">What Our Users Are Saying</h2>
                <p data-aos="fade-up" data-aos-delay="200">Real Stories of Success and Satisfaction from Our Diverse Community</p>
            </div>
        </div>
        <div class="row g-4" data-masonry='{"percentPosition": true}'>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                <div class="testimonial rounded-4 p-4">
                    <blockquote class="mb-3">&ldquo;This platform has completely transformed the way I manage my business finances.&rdquo;</blockquote>
                    <div class="testimonial-author d-flex gap-3 align-items-center">
                        <div class="author-img">
                            <img class="rounded-circle img-fluid" src="{{ asset('assets/images/person-sq-2-min.jpg') }}" alt="John Davis">
                        </div>
                        <div class="lh-base">
                            <strong class="d-block">John Davis</strong>
                            <span>Small Business Owner</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add more testimonials here -->
        </div>
    </div>
</section>

<!-- Contact -->
<section class="section contact__v2" id="contact">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 col-lg-7 mx-auto text-center">
                <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">Contact</span>
                <h2 class="h2 fw-bold mb-3" data-aos="fade-up" data-aos-delay="0">Contact Us</h2>
                <p data-aos="fade-up" data-aos-delay="100">Utilize our tools to develop your concepts and bring your vision to life.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex gap-5 flex-column">
                    <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="0">
                        <div class="icon d-block"><i class="bi bi-telephone"></i></div>
                        <span><span class="d-block">Phone</span><strong>+(01 234 567 890)</strong></span>
                    </div>
                    <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon d-block"><i class="bi bi-send"></i></div>
                        <span><span class="d-block">Email</span><strong>info@mydomain.com</strong></span>
                    </div>
                    <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon d-block"><i class="bi bi-geo-alt"></i></div>
                        <span><span class="d-block">Address</span><strong>123 Main Street Apt 4B Springfield, IL 62701 United States</strong></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-wrapper" data-aos="fade-up" data-aos-delay="300">
                    <form id="contactForm">
                        <div class="row gap-3 mb-3">
                            <div class="col-md-12">
                                <label class="mb-2" for="name">Name</label>
                                <input class="form-control" id="name" type="text" name="name" required>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-2" for="email">Email</label>
                                <input class="form-control" id="email" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="row gap-3 mb-3">
                            <div class="col-md-12">
                                <label class="mb-2" for="subject">Subject</label>
                                <input class="form-control" id="subject" type="text" name="subject">
                            </div>
                        </div>
                        <div class="row gap-3 mb-3">
                            <div class="col-md-12">
                                <label class="mb-2" for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary fw-semibold" type="submit">Send Message</button>
                    </form>
                    <div class="mt-3 d-none alert alert-success" id="successMessage">Message sent successfully!</div>
                    <div class="mt-3 d-none alert alert-danger" id="errorMessage">Message sending failed. Please try again later.</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection