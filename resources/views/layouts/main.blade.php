<!DOCTYPE html>
<html lang="en">

<head>
   @php
    $seoParameter = \App\Models\SeoParameter::where(
        'route_name',
        request()->path() == '/' ? '/' : '/' . request()->path()
    )->first();

    $defaultTitle = 'Outline Architects | Project Management';

    $defaultDescription = 'Outline Architects & Project Management - We design innovative office and commercial interiors that elevate experiences and reflect your brand.';

    $ogImage = !empty($seoParameter?->og_image)
        ? asset('storage/' . $seoParameter->og_image)
        : asset('uploads/default-og-image.webp');
@endphp

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $seoParameter->meta_title ?? $defaultTitle }}</title>

<meta name="description"
      content="{{ $seoParameter->meta_description ?? $defaultDescription }}" />

<meta property="og:title"
      content="{{ $seoParameter->meta_title ?? $defaultTitle }}">

<meta property="og:description"
      content="{{ $seoParameter->meta_description ?? $defaultDescription }}">

<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title"
      content="{{ $seoParameter->meta_title ?? $defaultTitle }}">
<meta name="twitter:description"
      content="{{ $seoParameter->meta_description ?? $defaultDescription }}">
<meta name="twitter:image" content="{{ $ogImage }}">

    <link rel="icon" type="image/png" href="assets/favicon.png" />
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" /> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

    @php
        $customCss = \App\Models\CustomCss::latest()->first();
    @endphp

    @if ($customCss && !empty($customCss->content_css))
        <style>
            {!! $customCss->content_css !!}
        </style>
    @endif

</head>

<body>
    <!-- =============================================
       NAVBAR
       ============================================= -->
    <nav class="navbar navbar-expand-lg navbar-outline" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                @if ($logo && $logo->image)
                    <img src="{{ asset($logo->image) }}" alt="Outline Architects | Project Management"
                        class="logo-img" />
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home.index') ? 'active' : '' }}"
                            href="{{ route('home.index') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home.about') ? 'active' : '' }}"
                            href="{{ route('home.about') }}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home.services') ? 'active' : '' }}"
                            href="{{ route('home.services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home.portfolio') ? 'active' : '' }}"
                            href="{{ route('home.portfolio') }}">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('careers.index') ? 'active' : '' }}"
                            href="{{ route('careers.index') }}">Careers</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
                <a href="{{ route('contact') }}" class="btn-outline-custom navbar-cta ms-lg-3">Let's Talk &nbsp;<i
                        class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- =============================================
       CTA SECTION - USING GLOBAL VARIABLE (NO FALLBACK)
       ============================================= -->
    @if (!request()->routeIs('contact*') && !request()->routeIs('contact') && $ctasection)
        <section class="home-cta" id="home-cta">
            @if ($ctasection->image)
                <div class="home-cta__bg" style="background-image: url('{{ asset($ctasection->image) }}');"></div>
            @endif
            <div class="home-cta__bg-overlay"></div>
            <div class="container home-cta__content text-center">
                <span class="section-label cta-label">Let's Build Together</span>

                @if ($ctasection->title)
                    <h2 class="section-title section-title--xl section-title--light mt-2 mb-3 cta-title-orange">
                        {{ $ctasection->title }}
                    </h2>
                @endif

                @if ($ctasection->body)
                    <p class="cta-body-white">
                        {{ strip_tags($ctasection->body) }}
                    </p>
                @endif

                <a href="{{ route('contact') }}" class="btn-outline-custom btn-primary-custom cta-btn">
                    Get In Touch &nbsp;<i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </section>
    @endif

    <!-- Orange thin solid divider -->
    <hr class="orange-hr" />
    <!-- =============================================
       FOOTER
       ============================================= -->
    <footer class="footer-outline" id="site-footer">
        <div class="container">
            <div class="row gy-5">
                <!-- Brand -->
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        @if ($logo && $logo->image)
                            <img src="{{ asset($logo->image) }}" alt="Outline Architects | Project Management"
                                class="footer-logo-img" />
                        @endif
                    </div>
                    <p class="footer-tagline">{{ $footerContent->title ?? '' }}</p>
                    <div class="social-links mt-4">
                        @foreach ($globalSocialIcons as $social)
                            <a href="{{ $social->description ?? '#' }}" aria-label="{{ $social->title }}"
                                target="_blank">
                                <i class="bi bi-{{ strtolower($social->title) }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-heading">Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li><a href="{{ route('home.about') }}">About Us</a></li>
                        <li><a href="{{ route('home.services') }}">Services</a></li>
                        <li><a href="{{ route('home.portfolio') }}">Portfolio</a></li>
                        <li><a href="{{ route('careers.index') }}">Careers</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Services (Dynamic) -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-heading">Services</h6>
                    <ul class="footer-links">
                        @if (isset($globalServices) && $globalServices->count() > 0)
                            @foreach ($globalServices as $service)
                                <li><a href="{{ route('home.services') }}">{{ $service->title }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Follow Us / Contact -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-heading">Follow Us</h6>
                    <p class="footer-follow-text">{!! $footerContent->body ?? '' !!}</p>
                    <div class="mt-3">
                        <!-- Dynamic Address -->
                        @if ($globalAddress)
                            <div class="footer-contact-item">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                <span
                                    class="footer-small-contact">{{ $globalAddress->title ?? ($globalAddress->description ?? '') }}</span>
                            </div>
                        @endif

                        <!-- Dynamic Phone -->
                        @if ($globalPhones && $globalPhones->count() > 0)
                            @foreach ($globalPhones as $phone)
                                <div class="footer-contact-item">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                                    </svg>
                                    <span class="footer-small-contact">{{ $phone->title }}</span>
                                </div>
                            @endforeach
                        @elseif($globalPhone)
                            <div class="footer-contact-item">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg>
                                <span class="footer-small-contact">{{ $globalPhone }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                        <p>© {{ date('Y') }} Outline Architects | Project Management. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p>
                            <a href="#" class="footer-legal-link">Privacy Policy</a>
                            <a href="#" class="footer-legal-link">Terms &amp; Conditions</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top -->
    <button id="scrollTop" aria-label="Scroll to top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const nav = document.getElementById('mainNav');

        function handleNavScroll() {
            nav.classList.toggle('scrolled', window.scrollY > 60);
        }
        window.addEventListener('scroll', handleNavScroll);
        handleNavScroll();

        const scrollBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            scrollBtn.classList.toggle('visible', window.scrollY > 400);
        });
        scrollBtn.addEventListener('click', () => window.scrollTo({
            top: 0,
            behavior: 'smooth'
        }));

        const dots = document.querySelectorAll('.testimonial-dots span');
        if (dots.length) {
            let dIdx = 0;
            setInterval(() => {
                dots[dIdx].classList.remove('active');
                dIdx = (dIdx + 1) % dots.length;
                dots[dIdx].classList.add('active');
            }, 3500);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.style.opacity = '1';
                    e.target.style.transform = 'translateY(0)';
                    observer.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.12
        });

        document.querySelectorAll('.service-card, .project-card, .testimonial-card, .home-stats__item, .home-about__badge')
            .forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(24px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });
    </script>

    @php
        $customJavascript = \App\Models\CustomJavascript::latest()->first();
    @endphp

    @if ($customJavascript && !empty($customJavascript->content_script))
        <script>
            {!! $customJavascript->content_script !!}
        </script>
    @endif

</body>

</html>
