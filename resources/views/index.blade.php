@extends('layouts.main')

@section('content')

    <!-- ============================================================
                SECTION 3: HOME HERO SECTION — DYNAMIC SLIDER
    ============================================================ -->
    @if ($homebanner->count())
        <section class="home-hero" id="home-hero">

            <div id="heroCarousel" class="carousel slide home-hero__carousel" data-bs-ride="carousel" data-bs-interval="5000"
                data-bs-pause="false" data-bs-wrap="true">

                <!-- Indicators -->
                <div class="carousel-indicators home-hero__indicators">

                    @foreach ($homebanner as $key => $banner)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}">
                        </button>
                    @endforeach

                </div>

                <!-- Slides -->
                <div class="carousel-inner">

                    @foreach ($homebanner as $key => $banner)
                        @php
                            $lines = preg_split('/\r\n|\r|\n/', trim($banner->title));
                            $lastLine = count($lines) - 1;
                        @endphp

                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                            <div class="home-hero__slide">

                                <div class="home-hero__shape home-hero__shape--1"></div>
                                <div class="home-hero__shape home-hero__shape--2"></div>
                                <div class="home-hero__shape home-hero__shape--3"></div>

                                <div class="container h-100">

                                    <div class="row align-items-center h-100 g-4 g-lg-5">

                                        <!-- Left Content -->
                                        <div class="col-lg-6 col-xl-5">

                                            <div class="home-hero__eyebrow">
                                                We Manage, You Focus
                                            </div>

                                            <h1 class="home-hero__title">

                                                @foreach ($lines as $index => $line)
                                                    @if ($index == $lastLine)
                                                        <span class="accent-line">
                                                            {{ $line }}
                                                        </span>
                                                    @else
                                                        {{ $line }}<br>
                                                    @endif
                                                @endforeach

                                            </h1>

                                            @if ($banner->body)
                                                <div class="home-hero__desc">
                                                    {!! $banner->body !!}
                                                </div>
                                            @endif

                                            <div class="home-hero__actions">

                                                <a href="{{ route('home.services') }}" class="btn-banner">
                                                    OUR SERVICES
                                                    <i class="bi bi-arrow-right"></i>
                                                </a>

                                                <a href="{{ route('contact') }}" class="btn-outline-brand">
                                                    Contact Us
                                                    <i class="bi bi-arrow-right-short fs-5"></i>
                                                </a>

                                            </div>

                                        </div>

                                        <!-- Right Image -->
                                        <div class="col-lg-6 col-xl-7 d-flex justify-content-center justify-content-lg-end">

                                            <div class="home-hero__img-wrap">

                                                @if ($banner->image)
                                                    <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}"
                                                        class="img-fluid">
                                                @endif

                                                <div class="home-hero__img-dot"></div>


                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">

                    <span class="carousel-control-prev-icon"></span>

                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">

                    <span class="carousel-control-next-icon"></span>

                </button>

            </div>

        </section>
    @endif

    <!-- ============================================================
                    SECTION 4: HOME ABOUT SECTION
    ============================================================ -->
    <section class="home-about" id="home-about">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Left: About Text -->
                <div class="col-lg-4">
                    <span class="section-label section-label--light reveal reveal-left">{{ $aboutUSTitle->title }}</span>
                    <h2 class="mb-3 reveal reveal-left reveal-delay-1 text-white">{!! $aboutUSTitle->body !!}</h2>
                    <a href="{{ route('home.about') }}"
                        class="btn-outline-light mt-3 d-inline-flex reveal reveal-left reveal-delay-3">Know
                        More About Us <i class="bi bi-arrow-right-short fs-5"></i></a>
                </div>

                <!-- Right: Value Cards -->
                <div class="col-lg-8">
                    <div class="row g-3">

                        @foreach ($whyChooseUsCards as $index => $card)
                            <div class="col-sm-6 col-lg-3 reveal reveal-delay-{{ $index + 1 }}">
                                <div class="home-about__card h-100">

                                    <div class="icon-wrap">
                                        <img src="{{ asset($card->image) }}" alt="{{ $card->title }}"
                                            class="home-about__icon-img">
                                    </div>

                                    <h4>{{ $card->title }}</h4>

                                    <p>{!! $card->body !!}</p>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /home-about -->

    <!-- ============================================================
                SECTION 5: HOME SERVICES SECTION
    ============================================================ -->
    <section class="home-services" id="home-services">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-7">
                    <h2 class="section-title-unified">Our Services</h2>
                    <br />
                    <h2 class="reveal reveal-delay-1 text-center">Comprehensive Facility Management Solutions</h2>
                    <div class="section-divider mx-auto reveal reveal-delay-2"></div>
                </div>
            </div>

            <!-- Bootstrap row-cols for responsive 5 columns -->
            <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                <!-- Service 1 -->
                <div class="col reveal">
                    <div class="home-services__card h-100 text-center">
                        <div class="home-services__icon mx-auto"><i class="bi bi-house-check"></i></div>
                        <h4>House Keeping &amp; Upkeep Maintenance</h4>
                        <p>Professional cleaning and upkeep solutions to keep your spaces clean, safe and hygienic.</p>
                        <a href="javascript:void(0)" class="btn-arrow mx-auto" aria-label="Learn more about Housekeeping"><i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="col reveal">
                    <div class="home-services__card h-100 text-center">
                        <div class="home-services__icon mx-auto"><i class="bi bi-shield-lock"></i></div>
                        <h4>Security Guarding Service</h4>
                        <p>Trained security personnel and modern surveillance systems for a secure environment.</p>
                        <a href="javascript:void(0)" class="btn-arrow mx-auto"
                            aria-label="Learn more about Security Services"><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="col reveal">
                    <div class="home-services__card h-100 text-center">
                        <div class="home-services__icon mx-auto"><i class="bi-person-vcard"></i></div>
                        <h4>Care Taker Services</h4>
                        <p>Reliable caretaking support for residential, commercial and industrial properties.</p>
                        <a href="javascript:void(0)" class="btn-arrow mx-auto"
                            aria-label="Learn more about Care Taker Services"><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="col reveal">
                    <div class="home-services__card h-100 text-center">
                        <div class="home-services__icon mx-auto"><i class="bi bi-diagram-3"></i></div>
                        <h4>HR Outsourcing / Payroll Management</h4>
                        <p>End-to-end HR and payroll solutions ensuring compliance and efficiency.</p>
                        <a href="javascript:void(0)" class="btn-arrow mx-auto"
                            aria-label="Learn more about HR Outsourcing"><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="col reveal">
                    <div class="home-services__card h-100 text-center">
                        <div class="home-services__icon mx-auto"><i class="bi-bug"></i></div>
                        <h4>Pest Control</h4>
                        <p>Safe and effective pest control solutions for a healthy and pest free environment.</p>
                        <a href="javascript:void(0)" class="btn-arrow mx-auto"
                            aria-label="Learn more about Pest Control"><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /row -->

            <div class="row justify-content-center mt-5">
                <div class="col-auto reveal">
                    <a href="services.html" class="btn-primary-brand">View All Services <i
                            class="bi bi-arrow-right-short fs-5"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- /home-services -->

    <!-- ============================================================
            SECTION 6: HOME STATS / WHY CHOOSE US SECTION
    ============================================================ -->
    <section class="home-stats" id="home-stats">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-4 col-xl-3">
                    <span
                        class="section-label section-label--light reveal reveal-left">{{ $whychooseustitle->title }}</span>
                    <h2 class="mb-3 reveal reveal-left reveal-delay-1 text-white">{!! $whychooseustitle->body !!}</h2>
                    <a href="about.html"
                        class="btn-outline-light mt-3 d-inline-flex reveal reveal-left reveal-delay-3">Partner With Us <i
                            class="bi bi-arrow-right-short fs-5"></i></a>
                </div>

                <div class="col-lg-8 col-xl-9">
                    <div class="row g-3 justify-content-center home-stats__row">

                        @foreach ($counters as $index => $counter)
                            <div class="col-6 col-md-3 reveal reveal-delay-{{ $index + 1 }}">
                                <div class="home-stats__item text-center">
                                    <div class="home-stats__icon">
                                        <img src="{{ asset($counter->image) }}" alt="{{ $counter->title }}"
                                            class="home-stats__icon-img">
                                    </div>

                                    @if (!empty($counter->title))
                                        <div class="home-stats__number">
                                            {{ $counter->title }}
                                        </div>
                                    @endif

                                    <div class="home-stats__label">
                                        {!! $counter->body !!}
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /home-stats -->

    <!-- ============================================================
                    SECTION 7: HOME INDUSTRIES SECTION
    ============================================================ -->
    <section class="home-industries" id="home-industries">
        <div class="container">
            <div class="row justify-content-center text-center mb-4">
                <div class="col-lg-6">
                    <h2 class="section-title-unified">Industries We Serve</h2>
                </div>
            </div>
            <div class="row g-4">

                @foreach ($industries as $industry)
                    <div class="col-6 col-md-3">
                        <div class="home-industries__item {{ $loop->last ? 'home-industries__item--last' : '' }}">

                            <img src="{{ asset($industry->image) }}" alt="{{ $industry->title }}"
                                class="home-industries__icon-img">

                            <span class="home-industries__label">
                                {{ $industry->title }}
                            </span>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- /home-industries -->

    <!-- ============================================================
                    SECTION 8: HOME PROCESS SECTION
    ============================================================ -->
    <section class="home-process" id="home-process">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-6">
                    <h2 class="section-title-unified">Our Process</h2>
                </div>
            </div>
            <div class="home-process__flow">

                @foreach ($ourprocess as $process)
                    <div class="home-process__item">

                        <div class="home-process__icon">
                            <img src="{{ asset($process->image) }}" alt="{{ $process->title }}"
                                class="home-process__icon-img">
                        </div>

                        <h4>{{ $process->title }}</h4>

                        <p>{!! $process->body !!}</p>

                    </div>

                    @if (!$loop->last)
                        <div class="home-process__arrow"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- /home-process -->

    <!-- =======================================================
            SECTION 9: HOME CLIENTS SECTION
    ============================================================ -->
    <section class="home-clients" id="home-clients">
        <div class="container">

            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-6">
                    <h2 class="section-title-unified">Our Valued Clients</h2>
                </div>
            </div>

            <div class="home-clients__track-wrapper reveal">

                <div class="home-clients__track">
                    @for ($i = 0; $i < 4; $i++)
                        @foreach ($clients as $client)
                            <div class="home-clients__logo">
                                <img src="{{ asset($client->image) }}" alt="{{ $client->title }}"
                                    class="home-clients__logo-img">
                            </div>
                        @endforeach
                    @endfor
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection

<!-- ============================================================
     SCRIPTS
     ============================================================ -->
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Main JavaScript -->
<script>
    (function() {
        // Hero Carousel Elements
        const heroCarousel = document.getElementById("heroCarousel");
        const progressBar = document.getElementById("heroProgressBar");
        const SLIDE_DURATION = 5000;

        // Function to trigger slide animations
        function triggerSlideAnims(slideEl) {
            if (!slideEl) return;
            const texts = slideEl.querySelectorAll(".home-hero__animate-text");
            const img = slideEl.querySelector(".home-hero__animate-img");
            texts.forEach((el) => {
                el.style.animation = "none";
                el.offsetHeight;
                el.style.animation = "";
            });
            if (img) {
                img.style.animation = "none";
                img.offsetHeight;
                img.style.animation = "";
            }
        }

        // Progress Bar Functions
        function resetProgressBar() {
            if (progressBar) {
                progressBar.style.transition = "none";
                progressBar.style.width = "0%";
            }
        }

        function startProgressBar() {
            if (!progressBar) return;
            progressBar.style.transition = "none";
            progressBar.style.width = "0%";
            requestAnimationFrame(() =>
                requestAnimationFrame(() => {
                    progressBar.style.transition = `width ${SLIDE_DURATION}ms linear`;
                    progressBar.style.width = "100%";
                })
            );
        }

        // Initialize Carousel Events
        if (heroCarousel) {
            heroCarousel.addEventListener("slide.bs.carousel", resetProgressBar);
            heroCarousel.addEventListener("slid.bs.carousel", (e) => {
                triggerSlideAnims(e.relatedTarget);
                startProgressBar();
            });
            startProgressBar();
            const activeSlide = document.querySelector("#heroCarousel .carousel-item.active");
            if (activeSlide) triggerSlideAnims(activeSlide);
        }

        // Navbar Scroll Effect
        const mainNav = document.getElementById("mainNav");
        if (mainNav) {
            window.addEventListener("scroll", () => {
                if (window.scrollY > 60) {
                    mainNav.classList.add("scrolled");
                } else {
                    mainNav.classList.remove("scrolled");
                }
            });
        }

        // Scroll Reveal Animation
        const revealEls = document.querySelectorAll(".reveal, .reveal-left, .reveal-right");
        if (revealEls.length) {
            const revealObserver = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("active");
                            revealObserver.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.12,
                    rootMargin: "0px 0px -40px 0px"
                }
            );
            revealEls.forEach((el) => revealObserver.observe(el));
        }

        // Counter Animation for Stats
        function animateCounter(el, target, duration = 2000) {
            if (!el) return;
            const step = target / (duration / 16);
            let current = 0;
            const update = () => {
                current = Math.min(current + step, target);
                if (target >= 1000) {
                    if (target === 25000) {
                        el.textContent = Math.floor(current).toLocaleString("en-IN");
                    } else {
                        el.textContent = current >= 1000 ? (current / 1000).toFixed(0) + ",000" : Math.floor(
                            current).toLocaleString("en-IN");
                    }
                } else {
                    el.textContent = Math.floor(current);
                }
                if (current < target) requestAnimationFrame(update);
            };
            requestAnimationFrame(update);
        }

        const statsSection = document.getElementById("home-stats");
        let statsAnimated = false;
        if (statsSection) {
            const statsObserver = new IntersectionObserver(
                (entries) => {
                    if (entries[0].isIntersecting && !statsAnimated) {
                        statsAnimated = true;
                        const statNumbers = document.querySelectorAll(".home-stats__number");
                        const nums = [{
                                el: statNumbers[0],
                                val: 17
                            },
                            {
                                el: statNumbers[1],
                                val: 500
                            },
                            {
                                el: statNumbers[2],
                                val: 25000
                            }
                        ];
                        nums.forEach(({
                            el,
                            val
                        }) => {
                            if (el) {
                                const suffix = el.querySelector(".home-stats__num-suffix");
                                animateCounter(el, val);
                                if (suffix) el.appendChild(suffix);
                            }
                        });
                    }
                }, {
                    threshold: 0.3
                }
            );
            statsObserver.observe(statsSection);
        }

        // Back To Top Button
        const backToTop = document.getElementById("backToTop");
        if (backToTop) {
            window.addEventListener("scroll", () => {
                if (window.scrollY > 400) {
                    backToTop.classList.add("show");
                } else {
                    backToTop.classList.remove("show");
                }
            });
            backToTop.addEventListener("click", (e) => {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });
        }

        // Active Nav Link on Scroll
        const sections = document.querySelectorAll("section[id]");
        const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
        if (sections.length && navLinks.length) {
            window.addEventListener("scroll", () => {
                let current = "";
                sections.forEach((sec) => {
                    const top = sec.offsetTop - 100;
                    if (window.scrollY >= top) current = sec.getAttribute("id");
                });
                navLinks.forEach((link) => {
                    link.classList.remove("active");
                    const href = link.getAttribute("href");
                    if (href === "#" + current || href === current + ".html") {
                        link.classList.add("active");
                    }
                });
            });
        }
    })();
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const track = document.getElementById('clientTrack');

        if (!track) return;

        const originalContent = track.innerHTML;

        while (track.scrollWidth < window.innerWidth * 3) {
            track.innerHTML += originalContent;
        }

    });

    const swiper = new Swiper('.hero-swiper', {
        loop: true,
        speed: 8000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
        slidesPerView: 1,
    });
</script>
