<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Outline Architects | Project Management</title>
  <meta name="description" content="Outline Architects & Project Management - We design innovative office and commercial interiors that elevate experiences and reflect your brand." />

  <link rel="icon" type="image/png" href="assets/favicon.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="assets/css/main.css" />


</head>

<body>

  <!-- =============================================
       NAVBAR
       ============================================= -->
  <nav class="navbar navbar-expand-lg navbar-outline" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.html">
        <img src="{{ asset('assets/img/Outline_Architects_Logo.png') }}" alt="Outline Architects | Project Management" class="logo-img" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list fs-4"></i>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Services</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Office Interiors</a></li>
              <li><a class="dropdown-item" href="#">Commercial Interiors</a></li>
              <li><a class="dropdown-item" href="#">Space Planning</a></li>
              <li><a class="dropdown-item" href="#">Design &amp; Build</a></li>
              <li><a class="dropdown-item" href="#">Project Management</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Careers</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Open Positions</a></li>
              <li><a class="dropdown-item" href="#">Life at Outline</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
        </ul>
        <a href="#home-contact" class="btn-outline-custom navbar-cta ms-lg-3">Let's Talk &nbsp;<i class="bi bi-arrow-right"></i></a>
      </div>
    </div>
  </nav>

 
  @yield('content')

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
            <img src="{{ asset('assets/img/Outline_Architects_Logo.png') }}" alt="Outline Architects | Project Management" class="footer-logo-img" />
          </div>
          <p class="footer-tagline">We design and deliver innovative office and commercial interiors with creativity, precision and passion.</p>
          <div class="social-links mt-4">
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6 col-6">
          <h6 class="footer-heading">Quick Links</h6>
          <ul class="footer-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </div>

        <!-- Services -->
        <div class="col-lg-2 col-md-6 col-6">
          <h6 class="footer-heading">Services</h6>
          <ul class="footer-links">
            <li><a href="#">Office Interiors</a></li>
            <li><a href="#">Commercial Interiors</a></li>
            <li><a href="#">Space Planning</a></li>
            <li><a href="#">Design &amp; Build</a></li>
            <li><a href="#">Project Management</a></li>
          </ul>
        </div>

        <!-- Follow Us -->
        <div class="col-lg-3 col-md-6">
          <h6 class="footer-heading">Follow Us</h6>
          <p class="footer-follow-text">Stay connected with us on social media for updates, project showcases and design inspiration.</p>
          <div class="mt-3">
            <div class="footer-contact-item">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                <circle cx="12" cy="10" r="3" />
              </svg>
              <span class="footer-small-contact">7th Floor, Inspire Tower, Pune 411045</span>
            </div>
            <div class="footer-contact-item">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
              </svg>
              <span class="footer-small-contact">+91 98765-43210</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <div class="row align-items-center">
          <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
            <p>© 2025 Outline Architects | Project Management. All Rights Reserved.</p>
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

    document.querySelectorAll('.service-card, .project-card, .testimonial-card, .home-stats__item, .home-about__badge').forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(24px)';
      el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(el);
    });
  </script>
</body>

</html>