@extends('layouts.main')

@section('title', 'About Us | Outline Architects')

@section('content')

    <!-- ============================================================
         SECTION 1: ABOUT HERO BANNER (STATIC)
         ============================================================ -->
    <section class="about-hero" id="about-hero">
      <div class="about-hero__bg-overlay"></div>
      <div class="about-hero__wave-shape"></div>

      <div class="container position-relative" style="z-index:3;">
        <div class="about-hero__content">

          <!-- Left: Text -->
          <div class="about-hero__left reveal reveal-left">

            <nav class="about-hero__breadcrumb" aria-label="breadcrumb">
              <a href="index.html">Home</a>
              <span><i class="bi bi-chevron-right"></i></span>
              <span>About Us</span>
            </nav>

            <h1 class="about-hero__title">About Us</h1>

            <div class="about-hero__tagline">
              Delivering Excellence. Every Day.
            </div>

            <p class="about-hero__desc">
              VRUDHI OUTSOURCING SERVICES PVT. LTD. is a leading service provider
              in the Facility Management industry with an outstanding reputation for
              quality and integrity throughout India &amp; part of Middle East.
            </p>

          </div>

          <!-- Right: Building Image -->
          <div class="about-hero__right reveal reveal-right">
            <img
              src="assets/images/about-image.png"
              alt="Vrudhi Corporate Office Building"
              class="about-hero__building-img"
            />
          </div>

        </div>
      </div>
    </section>
    <!-- /about-hero -->


    <!-- ============================================================
         SECTION 2: COMPANY OVERVIEW
         ============================================================ -->
    <section class="about-overview" id="about-overview">
      <div class="container">
        <div class="row align-items-center g-4 g-lg-5">

          <!-- Left: Content -->
          <div class="col-lg-4 reveal reveal-left">
            <div class="about-overview__content">

              <div class="section-label">COMPANY OVERVIEW</div>

              <p>
                VOSPL was established in year 2007 with a vision to offer sustainable,
                scalable and value based facility management services keeping customer
                and environment sensitivities specific to India.
              </p>

              <p>
                Over the years, we have grown from a single-service provider to a
                comprehensive facility management partner, trusted by 500+ clients
                across diverse industries.
              </p>

              <a href="#about-timeline" class="btn-banner mt-3">
                OUR JOURNEY
                <i class="bi bi-arrow-right"></i>
              </a>

            </div>
          </div>

          <!-- Right: Stats -->
          <div class="col-lg-8 reveal">
            <div class="about-overview__stats">

              <div class="about-overview__stat">
                <div class="about-overview__icon">
                  <i class="bi bi-calendar3"></i>
                </div>
                <div class="about-overview__number">17+</div>
                <div class="about-overview__label">Years of Experience</div>
              </div>

              <div class="about-overview__stat">
                <div class="about-overview__icon">
                  <i class="bi bi-buildings"></i>
                </div>
                <div class="about-overview__number">500+</div>
                <div class="about-overview__label">Happy Clients</div>
              </div>

              <div class="about-overview__stat">
                <div class="about-overview__icon">
                  <i class="bi bi-people"></i>
                </div>
                <div class="about-overview__number">25,000+</div>
                <div class="about-overview__label">Trained Workforce</div>
              </div>

              <div class="about-overview__stat">
                <div class="about-overview__icon">
                  <i class="bi bi-geo-alt"></i>
                </div>
                <div class="about-overview__label about-overview__label--large">
                  Pan India &amp;<br>Middle East Presence
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- /about-overview -->


    <!-- ============================================================
         SECTION 3: OUR VALUES
         ============================================================ -->
    <section class="about-values" id="about-values">
      <div class="container">
        <div class="row align-items-center g-4 g-lg-5">

          <!-- Left: Intro -->
          <div class="col-lg-3 reveal reveal-left">
            <div class="about-values__intro">

              <div class="section-label">OUR VALUES</div>

              <h2>The Principles That Drive Everything We Do</h2>

              <div class="section-divider section-divider--left mt-3 mb-4"></div>

              <p>
                Our core values define who we are and how we work with our clients,
                partners and communities.
              </p>

            </div>
          </div>

          <!-- Right: Values Grid -->
          <div class="col-lg-9 reveal">
            <div class="about-values__grid">

              <div class="about-values__item">
                <div class="about-values__icon">
                  <i class="bi bi-shield-check"></i>
                </div>
                <h4>Integrity</h4>
                <p>We uphold the highest standards of honesty and transparency.</p>
              </div>

              <div class="about-values__item">
                <div class="about-values__icon">
                  <i class="bi bi-people-fill"></i>
                </div>
                <h4>Customer First</h4>
                <p>We build long-term relationships through trust and reliability.</p>
              </div>

              <div class="about-values__item">
                <div class="about-values__icon">
                  <i class="bi bi-award"></i>
                </div>
                <h4>Excellence</h4>
                <p>We are committed to delivering superior quality in everything we do.</p>
              </div>

              <div class="about-values__item">
                <div class="about-values__icon">
                  <i class="bi-recycle"></i>
                </div>
                <h4>Sustainability</h4>
                <p>We care for people, communities and the environment.</p>
              </div>

              <div class="about-values__item">
                <div class="about-values__icon">
                  <i class="bi bi-lightbulb"></i>
                </div>
                <h4>Innovation</h4>
                <p>We continuously improve through new ideas and technology.</p>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- /about-values -->


    <!-- ============================================================
         SECTION 4: MISSION & VISION
         ============================================================ -->
    <section class="about-mv" id="about-mv">
      <div class="container">
        <div class="about-mv__card reveal">

          <!-- Mission -->
          <div class="about-mv__mission">
            <div class="about-mv__icon">
              <i class="bi bi-bullseye"></i>
            </div>
            <div class="about-mv__content">
              <span>OUR MISSION</span>
              <p>
                To provide sustainable, scalable and value-based facility management
                services by leveraging technology, best practices and a highly dedicated
                workforce, ensuring delight for our clients and a positive impact on
                the environment.
              </p>
            </div>
          </div>

          <!-- Arrow Divider -->
          <div class="about-mv__divider" aria-hidden="true"></div>

          <!-- Vision -->
          <div class="about-mv__vision">
            <div class="about-mv__icon">
              <i class="bi bi-eye"></i>
            </div>
            <div class="about-mv__content">
              <span>OUR VISION</span>
              <p>
                To be the most trusted and preferred facility management partner in
                India and the Middle East, recognized for our people, processes,
                innovation and commitment to creating better, cleaner and safer spaces.
              </p>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- /about-mv -->


    <!-- ============================================================
         SECTION 5: WHY WE ARE DIFFERENT
         ============================================================ -->
    <section class="about-difference" id="about-difference">
      <div class="container">
        <div class="row align-items-stretch g-0">

          <!-- Left: Content -->
          <div class="col-lg-5 d-flex align-items-center reveal reveal-left">
            <div class="about-difference__content pe-lg-5">

              <div class="section-label">WHY WE ARE DIFFERENT</div>

              <h2>Experience.<br>Expertise.<br>Commitment.</h2>

              <div class="section-divider section-divider--left mt-3 mb-4"></div>

              <ul class="about-difference__list">
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Customized solutions tailored to client needs
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Trained, verified and well-equipped workforce
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Strong operational network across India &amp; Middle East
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Advanced technology and quality control systems
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  24x7 support and quick response mechanism
                </li>
              </ul>

            </div>
          </div>

          <!-- Center: Image -->
          <div class="col-lg-4 reveal">
            <div class="about-difference__image-wrap">
              <img
                src="assets/images/about-leadership.png"
                alt="Vrudhi Team Collaboration"
                class="img-fluid about-difference__image"
              />
            </div>
          </div>

          <!-- Right: Leadership Card -->
          <div class="col-lg-3 d-flex align-items-center reveal reveal-right">
            <div class="about-difference__leadership-card">
              <div class="about-difference__lc-icon">
                <i class="bi bi-people-fill"></i>
              </div>
              <h5>LEADERSHIP THAT INSPIRES</h5>
              <p>
                Our leadership team brings deep industry knowledge and a passion
                for excellence. With a people-first approach, we empower our teams
                and build lasting partnerships with our clients.
              </p>
              <a href="#about-leadership" class="btn-banner w-100 justify-content-center mt-3">
                MEET OUR LEADERSHIP
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- /about-difference -->


    <!-- ============================================================
         SECTION 6: OUR MILESTONES / TIMELINE
         ============================================================ -->
    <section class="about-timeline" id="about-timeline">
      <div class="container">

        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-8 reveal">
            <div class="section-title-unified">OUR MILESTONES</div>
            <h2 class="mt-3">A Journey Of Growth &amp; Trust</h2>
          </div>
        </div>

        <div class="about-timeline__wrapper reveal">

          <!-- Timeline Line -->
          

          <!-- Item 1 -->
          <div class="about-timeline__item">
            <div class="about-timeline__year">2007</div>
            
            <div class="about-timeline__icon-wrap">
              <i class="bi bi-rocket-takeoff"></i>
            </div>
            <div class="about-timeline__card">
              <strong>Company</strong>
              <span>Established</span>
            </div>
          </div>

          <!-- Item 2 -->
          <div class="about-timeline__item">
            <div class="about-timeline__year">2010</div>
           
            <div class="about-timeline__icon-wrap">
              <i class="bi bi-buildings"></i>
            </div>
            <div class="about-timeline__card">
              <strong>Expanded Operations</strong>
              <span>Across North India</span>
            </div>
          </div>

          <!-- Item 3 -->
          <div class="about-timeline__item">
            <div class="about-timeline__year">2013</div>
           
            <div class="about-timeline__icon-wrap">
              <i class="bi bi-people-fill"></i>
            </div>
            <div class="about-timeline__card">
              <strong>500+ Clients</strong>
              <span>Onboarded</span>
            </div>
          </div>

          <!-- Item 4 -->
          <div class="about-timeline__item">
            <div class="about-timeline__year">2016</div>
           
            <div class="about-timeline__icon-wrap">
              <i class="bi bi-globe2"></i>
            </div>
            <div class="about-timeline__card">
              <strong>Entered</strong>
              <span>Middle East Market</span>
            </div>
          </div>

          <!-- Item 5 -->
          <div class="about-timeline__item">
            <div class="about-timeline__year">2019</div>
           
            <div class="about-timeline__icon-wrap">
              <i class="bi bi-person-badge"></i>
            </div>
            <div class="about-timeline__card">
              <strong>10,000+</strong>
              <span>Workforce Strength</span>
            </div>
          </div>

          <!-- Item 6 -->
          <div class="about-timeline__item">
            <div class="about-timeline__year">2022</div>
            <div class="about-timeline__icon-wrap">
              <i class="bi bi-patch-check"></i>
            </div>
            <div class="about-timeline__card">
              <strong>ISO Certified</strong>
              <span>Processes</span>
            </div>
          </div>

          <!-- Item 7 -->
          <div class="about-timeline__item">
             <div class="about-timeline__year">2024+</div>
            <div class="about-timeline__icon-wrap">
              <i class="bi bi-graph-up-arrow"></i>
            </div>
            <div class="about-timeline__card">
              <strong>Continuing Growth,</strong>
              <span>Delivering Excellence.</span>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- /about-timeline -->


    <!-- ============================================================
         SECTION 7: CERTIFICATIONS & RECOGNITIONS
         ============================================================ -->
    <section class="about-certifications" id="about-certifications">
      <div class="container">

        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-8 reveal">
            <div class="section-title-unified">CERTIFICATIONS &amp; RECOGNITIONS</div>
          </div>
        </div>

        <div class="row g-4 justify-content-center reveal">

          <div class="col-6 col-md-4 col-lg-2">
            <div class="about-certifications__card">
              <div class="about-certifications__badge-wrap">
                <i class="bi bi-patch-check"></i>
              </div>
              <div class="about-certifications__title">ISO 9001:2015</div>
              <div class="about-certifications__sub">Quality Management System</div>
            </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
            <div class="about-certifications__card">
              <div class="about-certifications__badge-wrap">
                <i class="bi bi-shield-check"></i>
              </div>
              <div class="about-certifications__title">ISO 14001:2015</div>
              <div class="about-certifications__sub">Environmental Management</div>
            </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
            <div class="about-certifications__card">
              <div class="about-certifications__badge-wrap">
                <i class="bi bi-file-earmark-check"></i>
              </div>
              <div class="about-certifications__title">ISO 401:2018</div>
              <div class="about-certifications__sub">Occupational Safety Management</div>
            </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
            <div class="about-certifications__card">
              <div class="about-certifications__badge-wrap">
                <i class="bi bi-award"></i>
              </div>
              <div class="about-certifications__title">MSME</div>
              <div class="about-certifications__sub">Registered Company</div>
            </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
            <div class="about-certifications__card">
              <div class="about-certifications__badge-wrap">
                <i class="bi bi-star"></i>
              </div>
              <div class="about-certifications__title">Startup India</div>
              <div class="about-certifications__sub">Recognized Entity</div>
            </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
            <div class="about-certifications__card">
              <div class="about-certifications__badge-wrap">
                <i class="bi bi-building-check"></i>
              </div>
              <div class="about-certifications__title">GeM</div>
              <div class="about-certifications__sub">Government &amp; Marketplace</div>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- /about-certifications -->

@endsection


<script>
    /* About page — counter animation on scroll */
    (function() {
        'use strict';

        function animateCounter(el, target, duration) {
            var start = 0;
            var increment = target / (duration / 16);
            var timer = setInterval(function() {
                start += increment;
                if (start >= target) {
                    start = target;
                    clearInterval(timer);
                }
                el.textContent = Math.floor(start) + '+';
            }, 16);
        }

        var counters = document.querySelectorAll('.about-pg__stat-num');
        if (!counters.length) return;

        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting && !entry.target.dataset.counted) {
                    entry.target.dataset.counted = '1';
                    var raw = entry.target.textContent.replace(/\D/g, '');
                    animateCounter(entry.target, parseInt(raw, 10), 1400);
                }
            });
        }, {
            threshold: 0.5
        });

        counters.forEach(function(c) {
            observer.observe(c);
        });
    })();
</script>
