<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Vrudhi Outsourcing Services Pvt. Ltd. — A leading facility management company in India & Middle East. Housekeeping, Security, HR Outsourcing, Pest Control and more." />
    <title>Vrudhi Outsourcing Services Pvt. Ltd.</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons (only one) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Nunito+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- Main CSS (External) -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body>
    <!-- ============================================================
     SECTION 1: TOP INFO BAR
     ============================================================ -->
    <div class="topbar">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <!-- Left: Contact Info -->
                <div class="topbar__contact d-flex align-items-center flex-wrap gap-3">
                    <span>
                        <i class="bi bi-telephone-fill me-1"></i>
                        <a href="tel:+911204567890">+91 120 456 7890</a>
                    </span>
                    <span>
                        <i class="bi bi-envelope-fill me-1"></i>
                        <a href="mailto:info@vrudhioutsource.com">info@vrudhioutsource.com</a>
                    </span>
                </div>

                <!-- Center: Follow Us -->
                <div class="d-flex align-items-center gap-2">
                    <span class="topbar__follow-label">Follow Us:</span>
                    <div class="topbar__social">
                        <a href="javascript:void(0)" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="javascript:void(0)" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        <a href="javascript:void(0)" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="javascript:void(0)" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <!-- Right: Location -->
                <div class="topbar__location d-none d-md-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>PAN India &nbsp;|&nbsp; Middle East</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /topbar -->

    <!-- ============================================================
     SECTION 2: MAIN NAVIGATION
     ============================================================ -->
    <nav class="navbar navbar-main navbar-expand-lg" id="mainNav">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand navbar-logo" href="index.html">
                <img src="assets/images/vrudhi_logo.png" alt="Vrudhi Outsourcing Services Pvt. Ltd." />
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home.index') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                            href="{{ route('home.about') }}">
                            About Us
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('home.about') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="industries.html">Industries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="careers.html">Careers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery.html">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact Us</a>
                    </li>
                </ul>

                <!-- CTA Button -->
                <a href="contact.html" class="btn-banner">
                    GET A QUOTE
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </nav>
    <!-- /navbar-main -->

    @yield('content')

    <!-- ============================================================
     SECTION 10: HOME CTA BAND SECTION
     ============================================================ -->
    <section class="home-cta-band" id="home-cta-band">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-8 reveal reveal-left">
                    <h2 class="mb-2 text-white">Let's Build a Better, Cleaner &amp; Safer Tomorrow Together</h2>
                    <p class="mb-0 text-white-75">Partner with VRUDHI OUTSOURCING SERVICES PVT. LTD. for all your
                        facility management needs.</p>
                </div>
                <div class="col-lg-4 text-lg-end reveal reveal-right">
                    <a href="contact.html" class="btn-outline-light">Get In Touch <i
                            class="bi bi-arrow-right-short"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- /home-cta-band -->

    <!-- ============================================================
     SECTION 11: SITE FOOTER
     ============================================================ -->
    <footer class="site-footer" id="site-footer">
        <div class="container">
            <div class="row g-4 g-lg-5">
                <div class="col-lg-4 col-md-6">
                    <div class="site-footer__logo"><img src="assets/images/vrudhi_logo.png"
                            alt="Vrudhi Outsourcing Services Pvt. Ltd." /></div>
                    <p class="site-footer__desc">Delivering reliable, efficient and sustainable facility management
                        solutions across India &amp; Middle East since 2007.</p>
                    <div class="site-footer__social">
                        <a href="javascript:void(0)" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="javascript:void(0)" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="javascript:void(0)" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        <a href="javascript:void(0)" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <h5>Quick Links</h5>
                    <ul class="site-footer__links">
                        <li><a href="home.html">Home</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="industries.html">Industries</a></li>
                        <li><a href="careers.html">Careers</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h5>Services</h5>
                    <ul class="site-footer__links">
                        <li><a href="javascript:void(0)">House Keeping &amp; Upkeep Maintenance</a></li>
                        <li><a href="javascript:void(0)">Security Guarding Service</a></li>
                        <li><a href="javascript:void(0)">Care Taker Services</a></li>
                        <li><a href="javascript:void(0)">HR Outsourcing / Payroll Management</a></li>
                        <li><a href="javascript:void(0)">Pest Control</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Contact Us</h5>
                    <div class="site-footer__contact-item">
                        <div class="icon"><i class="bi bi-geo-alt-fill"></i></div><span>8-123, Sector-63,
                            Noida,<br />Uttar Pradesh – 201301, India</span>
                    </div>
                    <div class="site-footer__contact-item">
                        <div class="icon"><i class="bi bi-telephone-fill"></i></div><a href="tel:+911204567890">+91
                            120 456 7890</a>
                    </div>
                    <div class="site-footer__contact-item">
                        <div class="icon"><i class="bi bi-envelope-fill"></i></div><a
                            href="mailto:info@vrudhioutsource.com">info@vrudhioutsource.com</a>
                    </div>
                    <div class="site-footer__contact-item">
                        <div class="icon"><i class="bi bi-globe"></i></div><a
                            href="https://www.vrudhioutsource.com" target="_blank"
                            rel="noopener noreferrer">www.vrudhioutsource.com</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-footer__bottom">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <p>&copy; 2024 VRUDHI OUTSOURCING SERVICES PVT. LTD. All Rights Reserved.</p>
                    <div class="d-flex gap-3"><a href="javascript:void(0)">Privacy Policy</a><span
                            class="footer-separator">|</span><a href="javascript:void(0)">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /site-footer -->

    <!-- ============================================================
     SECTION 12: BACK TO TOP BUTTON
     ============================================================ -->
    <a href="javascript:void(0)" class="back-to-top" id="backToTop" aria-label="Back to top"><i
            class="bi bi-chevron-up"></i></a>

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
</body>

</html>
