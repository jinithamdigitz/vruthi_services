@extends('layouts.main')

@section('hero_title', 'About Solar Masters')
@section('hero_text', 'Learn about our mission and solar expertise')

@section('content')

   <!-- =========================================
         ABOUT - HERO SECTION
    ========================================== -->
    <section class="about-hero-section">
        <div class="container">
            <div class="row align-items-center about-hero-row">
                <div class="col-lg-5">
                    <div class="about-content">
                        <p class="section-label">
                            <i class="bi bi-person-circle"></i>
                            ABOUT US
                        </p>
                        <h1 class="about-title">
                            About
                            <span>Paradigm Learning</span>
                        </h1>
                        <p class="about-description">
                            We're on a mission to transform lives through accessible, practical, and future-ready education that empowers learners to achieve their dreams.
                        </p>
                        <div class="about-feature-card">
                            <div class="about-feature-icon">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                            <div>
                                <h5 class="about-feature-title">Education That Empowers</h5>
                                <p class="about-feature-desc">We democratize quality education and make learning accessible to everyone, everywhere.</p>
                            </div>
                        </div>
                        <div class="about-feature-card">
                            <div class="about-feature-icon">
                                <i class="bi bi-bullseye"></i>
                            </div>
                            <div>
                                <h5 class="about-feature-title">Skills That Matter</h5>
                                <p class="about-feature-desc">Our courses are designed with industry experts to ensure you learn what truly matters.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="about-image-wrapper">
                        <img src="banner.png" alt="About Banner" class="img-fluid about-image" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================
         HOME - STATS SECTION
    ========================================= -->
    <section class="home-stats-section">
        <div class="container">
            <div class="row home-stats-row gy-4">
                @foreach ($counters as $counter)
                    <div class="col-6 col-md-3">
                        <div class="home-stats-card">
                            <div class="home-stats-icon home-stats-icon-blue">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="home-stats-info">
                                <h4 class="home-stats-number">{{ $counter->title }}</h4>
                                <p class="home-stats-label">{!! $counter->body !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

   <section class="about-mission-section">
    <div class="container">

        <div class="about-section-header text-center">
            <h2 class="about-global-heading">
                Our Mission & Vision
            </h2>
        </div>

        <div class="row gy-4">

            @foreach($commitment as $item)

                <div class="col-lg-6">

                    <div class="about-mission-card">

                        @if($item->image)
                            <div class="about-mission-image mb-3">

                                <img src="{{ asset($item->image) }}">

                            </div>
                        @endif

                        <div>

                            <h4 class="about-mission-title">
                                {{ $item->title }}
                            </h4>

                            <p class="about-mission-desc">
                                {!! $item->body !!}
                            </p>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>
</section>

    <!-- =========================================
         ABOUT - CORE VALUES SECTION
    ========================================== -->
    <section class="about-core-values-section">
        <div class="container">
            <div class="about-section-header text-center">
                <h2 class="about-global-heading">Our Core Values</h2>
            </div>
            <div class="row gy-4">
                <div class="col-md-6 col-lg-3">
                    <div class="about-value-card">
                        <div class="about-value-icon about-value-icon-blue">
                            <i class="bi bi-star"></i>
                        </div>
                        <h5 class="about-value-title">Excellence</h5>
                        <p class="about-value-desc">We are committed to delivering high-quality education that exceeds expectations.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="about-value-card">
                        <div class="about-value-icon about-value-icon-green">
                            <i class="bi bi-people"></i>
                        </div>
                        <h5 class="about-value-title">Integrity</h5>
                        <p class="about-value-desc">We operate with honesty, transparency and respect in everything we do.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="about-value-card">
                        <div class="about-value-icon about-value-icon-yellow">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <h5 class="about-value-title">Innovation</h5>
                        <p class="about-value-desc">We embrace creativity and innovation to deliver the best learning experiences.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="about-value-card">
                        <div class="about-value-icon about-value-icon-purple">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h5 class="about-value-title">Impact</h5>
                        <p class="about-value-desc">We are driven by making a positive difference in learners' lives and communities.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================
         ABOUT - JOURNEY SECTION
    ========================================== -->
    <section class="about-journey-section">
        <div class="container">
            <div class="about-section-header text-center">
                <h2 class="about-global-heading">Our Journey</h2>
            </div>
            <div class="row gy-4">
                <div class="col-md-6 col-lg-3">
                    <div class="about-journey-card">
                        <div class="about-journey-dot about-journey-dot-blue"></div>
                        <div class="about-journey-icon about-journey-icon-blue">
                            <i class="bi bi-rocket-takeoff"></i>
                        </div>
                        <h6 class="about-journey-year">2018</h6>
                        <h5 class="about-journey-title">The Beginning</h5>
                        <p class="about-journey-desc">Paradigm Learning was founded with a vision to make quality education accessible to all.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="about-journey-card">
                        <div class="about-journey-dot about-journey-dot-green"></div>
                        <div class="about-journey-icon about-journey-icon-green">
                            <i class="bi bi-book"></i>
                        </div>
                        <h6 class="about-journey-year">2019</h6>
                        <h5 class="about-journey-title">Growing Together</h5>
                        <p class="about-journey-desc">Launched our first courses and onboarded our first 1,000 amazing learners.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="about-journey-card">
                        <div class="about-journey-dot about-journey-dot-yellow"></div>
                        <div class="about-journey-icon about-journey-icon-yellow">
                            <i class="bi bi-people"></i>
                        </div>
                        <h6 class="about-journey-year">2021</h6>
                        <h5 class="about-journey-title">Expanding Horizons</h5>
                        <p class="about-journey-desc">Introduced advanced programs and reached 10,000+ students worldwide.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="about-journey-card">
                        <div class="about-journey-dot about-journey-dot-purple"></div>
                        <div class="about-journey-icon about-journey-icon-purple">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <h6 class="about-journey-year">2024 & Beyond</h6>
                        <h5 class="about-journey-title">Building the Future</h5>
                        <p class="about-journey-desc">Continuing to innovate and empower learners for a brighter tomorrow.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================
         ABOUT - CTA SECTION
    ========================================== -->
    <section class="about-cta-section">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-8">
                    <h2 class="about-cta-heading">Ready to Unlock Your Future?</h2>
                    <p class="about-cta-sub">Join thousands of learners and start your journey today.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="#" class="btn-custom btn-cta-white">Explore Courses <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </section>

    
@endsection