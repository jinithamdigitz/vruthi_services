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
                    <img src="assets/images/about-image.png" alt="Vrudhi Corporate Office Building"
                        class="about-hero__building-img" />
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

                        <div class="section-label">{{ $aboutUSTitle->title }}</div>

                        <p>
                            {!! $aboutUSTitle->body !!}
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

                        @foreach ($counters as $index => $counter)
                            <div class="col-6 col-md-3">
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

                        <div class="section-label">{{ $ourvalues->title }}</div>

                        <h2>{!! $ourvalues->body !!}</h2>

                    </div>
                </div>

                <!-- Right: Values Grid -->
                <div class="col-lg-9 reveal">
                    <div class="about-values__grid">

                        @foreach ($whyChooseUsCards as $index => $card)
                            <div class="about-values__item reveal reveal-delay-{{ $index + 1 }}">
                                <div class="about-values__icon">
                                     @if (!empty($card->image))
        <img src="{{ asset($card->image) }}"
             alt="{{ $card->title }}"
             class="about-values__icon-img">
                                    @else
                                        <i class="bi bi-shield-check"></i>
                                    @endif
                                </div>
                                <h4>{{ $card->title }}</h4>
                                <p>{!! $card->body !!}</p>
                            </div>
                        @endforeach

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
                @foreach ($visionmission as $index => $item)
                    @if ($index == 0)
                        <div class="about-mv__mission">
                        @else
                            <div class="about-mv__vision">
                    @endif

                    <div class="about-mv__icon">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="about-mv__icon-img">
                    </div>

                    <div class="about-mv__content">
                        <span>{{ $item->title }}</span>
                        <p>{!! $item->body !!}</p>
                    </div>

            </div>

            @if (!$loop->last)
                <div class="about-mv__divider" aria-hidden="true"></div>
            @endif
            @endforeach

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

                        <div class="section-label">{{ $whyChooseUs->title }}</div>


                        <div class="about-difference__list">
                            {!! $whyChooseUs->body !!}
                        </div>

                    </div>


                </div>


                <!-- Center: Image -->
                <div class="col-lg-4 reveal">
                    <div class="about-difference__image-wrap">
                        <img src="{{ asset($leadershipcard->image) }}" alt="{{ $leadershipcard->title }}"
                            class="img-fluid about-difference__image" />
                    </div>
                </div>

                <!-- Right: Leadership Card -->
                <div class="col-lg-3 d-flex align-items-center reveal reveal-right">
                    <div class="about-difference__leadership-card">
                        <div class="about-difference__lc-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5>{{ $leadershipcard->title }}</h5>
                        <p>
                            {{ $leadershipcard->body }}
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
