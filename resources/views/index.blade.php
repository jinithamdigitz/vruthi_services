@extends('layouts.main')

@section('content')

    <!-- ============================================================
         SECTION 3: HOME HERO SECTION — DYNAMIC SLIDER
         ============================================================ -->
    @if ($homebanner->count())
        <section class="home-hero" id="home-hero">

            <div id="heroCarousel" class="carousel slide home-hero__carousel" data-bs-ride="carousel" data-bs-interval="5000">

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

                                                <div class="home-hero__img-badge">
                                                    <div class="badge-num">17+</div>

                                                    <div>
                                                        <div class="badge-text fw-bold">
                                                            Years of
                                                        </div>
                                                        <div class="badge-text">
                                                            Experience
                                                        </div>
                                                    </div>
                                                </div>

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
                    <span class="section-label section-label--light reveal reveal-left">About Us</span>
                    <h2 class="mb-3 reveal reveal-left reveal-delay-1 text-white">Delivering Excellence Every Day</h2>
                    <p class="reveal reveal-left reveal-delay-2 text-white-75">VOSPL was established in year 2007 with a
                        vision to offer sustainable, scalable and value based facility management services keeping customer
                        and environment sensitivities specific to India.</p>
                    <a href="about.html" class="btn-outline-light mt-3 d-inline-flex reveal reveal-left reveal-delay-3">Know
                        More About Us <i class="bi bi-arrow-right-short fs-5"></i></a>
                </div>

                <!-- Right: Value Cards -->
                <div class="col-lg-8">
                    <div class="row g-3">
                        <div class="col-sm-6 col-lg-3 reveal reveal-delay-1">
                            <div class="home-about__card h-100">
                                <div class="icon-wrap"><i class="bi-shield-check"></i></div>
                                <h4>Quality &amp; Integrity</h4>
                                <p>We uphold the highest standards of quality and operate with integrity in everything we
                                    do.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 reveal reveal-delay-2">
                            <div class="home-about__card h-100">
                                <div class="icon-wrap"><i class="bi bi-globe-central-south-asia"></i></div>
                                <h4>Pan India Presence</h4>
                                <p>Strong operational network across India &amp; part of Middle East.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 reveal reveal-delay-3">
                            <div class="home-about__card h-100">
                                <div class="icon-wrap"><i class="bi bi-person-workspace"></i></div>
                                <h4>Trained Workforce</h4>
                                <p>Skilled, verified and well-trained professionals ensuring reliable service delivery.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 reveal reveal-delay-4">
                            <div class="home-about__card h-100">
                                <div class="icon-wrap"><i class="bi-hand-thumbs-up"></i></div>
                                <h4>Customer First</h4>
                                <p>We believe in building long-term relationships through trust, transparency and value.</p>
                            </div>
                        </div>
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
                    <span class="section-label section-label--light reveal reveal-left">Why Choose Us</span>
                    <h2 class="mb-3 reveal reveal-left reveal-delay-1 text-white">Experience. Expertise. Excellence.</h2>
                    <p class="reveal reveal-left reveal-delay-2 text-white-75">With years of experience and a
                        customer-centric approach, we deliver smart, efficient and sustainable facility management
                        solutions.</p>
                    <a href="about.html"
                        class="btn-outline-light mt-3 d-inline-flex reveal reveal-left reveal-delay-3">Partner With Us <i
                            class="bi bi-arrow-right-short fs-5"></i></a>
                </div>

                <div class="col-lg-8 col-xl-9">
                    <div class="row g-3 justify-content-center home-stats__row">
                        <div class="col-6 col-md-3 reveal reveal-delay-1">
                            <div class="home-stats__item text-center">
                                <div class="home-stats__icon"><i class="bi bi-calendar3"></i></div>
                                <div class="home-stats__number">17<span class="home-stats__num-suffix">+</span></div>
                                <div class="home-stats__label">Years of Experience</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 reveal reveal-delay-2">
                            <div class="home-stats__item text-center">
                                <div class="home-stats__icon"><i class="bi bi-buildings"></i></div>
                                <div class="home-stats__number">500<span class="home-stats__num-suffix">+</span></div>
                                <div class="home-stats__label">Happy Clients</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 reveal reveal-delay-3">
                            <div class="home-stats__item text-center">
                                <div class="home-stats__icon"><i class="bi bi-people-fill"></i></div>
                                <div class="home-stats__number">25,000<span class="home-stats__num-suffix">+</span></div>
                                <div class="home-stats__label">Trained Workforce</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 reveal reveal-delay-4">
                            <div class="home-stats__item text-center">
                                <div class="home-stats__icon"><i class="bi bi-geo-alt"></i></div>
                                <div class="home-stats__label fw-bold fs-4 text-white">Pan India</div>
                                <div class="home-stats__label">& Middle East Presence</div>
                            </div>
                        </div>
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
            <div class="row g-0 align-items-center">
                <div class="col">
                    <div class="home-industries__item"><i class="bi bi-building home-industries__icon"></i><span
                            class="home-industries__label">Corporate Offices</span></div>
                </div>
                <div class="col">
                    <div class="home-industries__item"><i class="bi bi-hospital home-industries__icon"></i><span
                            class="home-industries__label">Hospitals</span></div>
                </div>
                <div class="col">
                    <div class="home-industries__item"><i class="bi bi-building-gear home-industries__icon"></i><span
                            class="home-industries__label">Manufacturing</span></div>
                </div>
                <div class="col">
                    <div class="home-industries__item"><i class="bi bi-shop home-industries__icon"></i><span
                            class="home-industries__label">Retail & Malls</span></div>
                </div>
                <div class="col">
                    <div class="home-industries__item"><i class="bi bi-house-door home-industries__icon"></i><span
                            class="home-industries__label">Residential Complexes</span></div>
                </div>
                <div class="col">
                    <div class="home-industries__item"><i class="bi bi-mortarboard home-industries__icon"></i><span
                            class="home-industries__label">Educational Institutions</span></div>
                </div>
                <div class="col">
                    <div class="home-industries__item"><i class="bi bi-pc-display home-industries__icon"></i><span
                            class="home-industries__label">IT Parks</span></div>
                </div>
                <div class="col">
                    <div class="home-industries__item home-industries__item--last"><i
                            class="bi bi-buildings home-industries__icon"></i><span
                            class="home-industries__label">Hotels</span></div>
                </div>
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
                <div class="home-process__item">
                    <div class="home-process__icon"><i class="bi bi-chat-dots"></i></div>
                    <h4>Understand</h4>
                    <p>We understand your requirements</p>
                </div>
                <div class="home-process__arrow"></div>
                <div class="home-process__item">
                    <div class="home-process__icon"><i class="bi bi-file-earmark-text"></i></div>
                    <h4>Plan</h4>
                    <p>We design a customized solution</p>
                </div>
                <div class="home-process__arrow"></div>
                <div class="home-process__item">
                    <div class="home-process__icon"><i class="bi bi-gear-fill"></i></div>
                    <h4>Execute</h4>
                    <p>We deploy trained resources</p>
                </div>
                <div class="home-process__arrow"></div>
                <div class="home-process__item">
                    <div class="home-process__icon"><i class="bi bi-check-circle-fill"></i></div>
                    <h4>Monitor</h4>
                    <p>We ensure quality & compliance</p>
                </div>
                <div class="home-process__arrow"></div>
                <div class="home-process__item">
                    <div class="home-process__icon"><i class="bi bi-bar-chart-line-fill"></i></div>
                    <h4>Improve</h4>
                    <p>We continuously improve for better results</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /home-process -->

    <!-- ============================================================
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

                    {{-- Original Set --}}
                    @foreach ($clients as $client)
                        <div class="home-clients__logo">
                            <img src="{{ asset($client->image) }}" alt="{{ $client->title }}"
                                class="home-clients__logo-img">
                        </div>
                    @endforeach

                    {{-- Duplicate Set For Infinite Loop --}}
                    @foreach ($clients as $client)
                        <div class="home-clients__logo">
                            <img src="{{ asset($client->image) }}" alt="{{ $client->title }}"
                                class="home-clients__logo-img">
                        </div>
                    @endforeach

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
</script>
