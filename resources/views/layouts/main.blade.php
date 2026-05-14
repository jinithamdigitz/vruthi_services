<!DOCTYPE html>
<html lang="en">

<head>
    <!-- =========================================
         META SECTION
    ========================================== -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paradigm Learning – Home</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap CSS & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- Master CSS (External) -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body>

    <!-- =========================================
     HOME PAGE WRAPPER
     All sections below are prefixed with "home-"
========================================== -->

    <div class="home-page-wrapper">

        <!-- =========================================
         NAVBAR SECTION (Shared)
    ========================================== -->
        <header class="main-header">
            <nav class="navbar navbar-expand-lg main-navbar fixed-top">
                <div class="container">
                    <a href="#" class="navbar-brand brand-wrapper">
                        <img src="{{ asset($logo->image) }}" alt="Paradigm Learning Logo" class="navbar-logo" />
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                        aria-label="Toggle Navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="mainNavbar">
                        <ul class="navbar-nav navbar-menu mx-auto">
                            <li class="nav-item">
                                <a href="{{ route('home.index') }}" class="nav-link active">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('home.about') }}" class="nav-link">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('courses') }}" class="nav-link">Courses</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('home.faculty') }}" class="nav-link">Faculties</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Blogs</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Testimonials</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Contact</a>
                            </li>
                        </ul>

                        <a href="#" class="btn-custom btn-primary-custom">Enroll Now</a>
                    </div>
                </div>
            </nav>
        </header>

        @yield('content')

        <!-- =========================================
         FOOTER SECTION (Shared)
    ========================================== -->
        <footer class="main-footer">
            <div class="container">
                <div class="row footer-row gy-5">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-brand-wrapper">
                            <img src="{{ asset($logo->image) }}" alt="Paradigm Learning Logo" class="footer-logo" />
                        </div>
                        <p class="footer-description">Empowering learners with innovative education and career-focused
                            programs.</p>
                        <div class="footer-social-links">
                            <a href="#" class="footer-social" aria-label="Facebook"><i
                                    class="bi bi-facebook"></i></a>
                            <a href="#" class="footer-social" aria-label="Twitter"><i
                                    class="bi bi-twitter-x"></i></a>
                            <a href="#" class="footer-social" aria-label="LinkedIn"><i
                                    class="bi bi-linkedin"></i></a>
                            <a href="#" class="footer-social" aria-label="Instagram"><i
                                    class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-6">
                        <h5 class="footer-title">Quick Links</h5>
                        <ul class="footer-list">
                            <li><a href="#" class="footer-link">Courses</a></li>
                            <li><a href="#" class="footer-link">Admissions</a></li>
                            <li><a href="#" class="footer-link">About Us</a></li>
                            <li><a href="#" class="footer-link">Resources</a></li>
                            <li><a href="#" class="footer-link">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 col-6">
                        <h5 class="footer-title">Support</h5>
                        <ul class="footer-list">
                            <li><a href="#" class="footer-link">Help Center</a></li>
                            <li><a href="#" class="footer-link">FAQ</a></li>
                            <li><a href="#" class="footer-link">Terms & Conditions</a></li>
                            <li><a href="#" class="footer-link">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="footer-title">Contact Us</h5>
                        <ul class="footer-list contact-list">
                            <li class="footer-contact-item"><i
                                    class="bi bi-envelope me-2"></i>hello@paradigmlearning.com</li>
                            <li class="footer-contact-item"><i class="bi bi-telephone me-2"></i>+1100-202-3070</li>
                            <li class="footer-contact-item"><i class="bi bi-globe me-2"></i>www.paradigmlearning.com
                            </li>
                        </ul>
                        <div class="newsletter-wrap">
                            <h5 class="footer-title mt-3">Subscribe to Newsletter</h5>
                            <div class="newsletter-input-wrap">
                                <input type="email" placeholder="Enter your email" class="newsletter-input"
                                    aria-label="Email address" />
                                <button class="newsletter-btn" aria-label="Subscribe"><i
                                        class="bi bi-send-fill"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="footer-hr" />
                <p class="footer-copy-text">© 2026 Paradigm Learning. All Rights Reserved.</p>
            </div>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.addEventListener("scroll", function() {

            const navbar = document.querySelector(".main-navbar");

            if (window.scrollY > 20) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }

        });
    </script>
</body>

</html>