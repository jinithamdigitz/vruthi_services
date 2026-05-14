@extends('layouts.main')

@section('content')
    <!-- =========================================
                     HOME - HERO SECTION
                ========================================== -->
   <section class="home-hero-section">
    <div class="container">

        <div id="heroBannerSlider"
    class="carousel slide home-hero-slider"
    data-bs-ride="carousel"
    data-bs-interval="4000"
    data-bs-pause="false">

            <!-- Indicators -->
            <div class="carousel-indicators">
                @foreach ($banner as $key => $banners)
                    <button type="button"
                        data-bs-target="#heroBannerSlider"
                        data-bs-slide-to="{{ $key }}"
                        class="{{ $key == 0 ? 'active' : '' }}">
                    </button>
                @endforeach
            </div>

            <!-- Slider Items -->
            <div class="carousel-inner">

                @foreach ($banner as $key => $banners)

                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                        <div class="row align-items-center home-hero-row">

                            <div class="col-lg-6">
                                <div class="home-hero-content">

                                    <p class="section-label">
                                        <i class="bi bi-stars"></i>
                                        Empower Your Future
                                    </p>

                                    <h1 class="home-hero-title">
                                        {{ $banners->title }}
                                    </h1>

                                    <p class="home-hero-description">
                                        {!! $banners->body !!}
                                    </p>

                                    <div class="home-hero-button-group">
                                        <a href="#"
                                            class="btn-custom btn-primary-custom">
                                            Explore Courses
                                            <i class="bi bi-arrow-right"></i>
                                        </a>

                                        <a href="#"
                                            class="btn-custom btn-outline-custom">
                                            Learn More
                                        </a>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="home-hero-image-wrapper">
                                    <img src="{{ $banners->image }}"
                                        alt="Learning Banner"
                                        class="home-hero-image img-fluid" />
                                </div>
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <!-- Controls -->
            <button class="carousel-control-prev"
                type="button"
                data-bs-target="#heroBannerSlider"
                data-bs-slide="prev">

                <span class="carousel-control-prev-icon"></span>

            </button>

            <button class="carousel-control-next"
                type="button"
                data-bs-target="#heroBannerSlider"
                data-bs-slide="next">

                <span class="carousel-control-next-icon"></span>

            </button>

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

    <!-- =========================================
                     HOME - WHY CHOOSE US SECTION
                ========================================== -->
    <section class="home-why-section">
        <div class="container">
            <div class="home-section-header text-center">
                <p class="section-label"><i class="bi bi-stars me-1"></i> OUR ADVANTAGE</p>
                <h2 class="home-global-heading">Why Choose Us</h2>
            </div>
            <div class="row home-why-row gy-4 mt-2">
                @foreach ($homeychoose as $whychoose)
                    <div class="col-sm-6 col-lg-3">
                        <div class="home-why-card">
                            <div class="home-why-icon home-why-icon-yellow">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>{{ $whychoose->title }}</h5>
                            <p class="home-why-desc">{!! $whychoose->body !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =========================================
                     HOME - TESTIMONIALS SECTION
                ========================================== -->
    <section class="home-testimonial-section">
        <div class="container">
            <div class="home-section-header text-center">
                <p class="section-label">TESTIMONIALS</p>
                <h2 class="home-global-heading">What Our Students Say</h2>
            </div>
            <div id="testimonialCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @php
                        // Split testimonials into chunks of 3
                        $chunks = $testimonials->chunk(3);
                    @endphp

                    @foreach ($chunks as $index => $chunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row gy-4 justify-content-center">
                                @foreach ($chunk as $testimony)
                                    <div class="col-md-4">
                                        <div class="home-testimonial-card">
                                            <span class="home-quote-mark">&ldquo;</span>
                                            <p class="home-testimonial-text">{!! $testimony->body !!}</p>
                                            <div class="home-testimonial-author">
                                                <img src="{{ $testimony->image }}" class="home-testimonial-avatar"
                                                    alt="{{ $testimony->name }}" />
                                                <div class="home-author-info">
                                                    <p class="home-testimonial-name">{{ $testimony->title }}</p>
                                                    @if (isset($testimony->role))
                                                        <p class="home-testimonial-role">{{ $testimony->role }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="home-carousel-controls-custom">
                    <button class="home-carousel-ctrl-btn" type="button" data-bs-target="#testimonialCarousel"
                        data-bs-slide="prev">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <div class="home-carousel-indicators-custom">
                        <button class="home-ind active" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide-to="0"></button>
                        <button class="home-ind" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide-to="1"></button>
                    </div>
                    <button class="home-carousel-ctrl-btn" type="button" data-bs-target="#testimonialCarousel"
                        data-bs-slide="next">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================
                     HOME - MENTORS SECTION
                ========================================== -->
    <section class="home-mentors-section">
        <div class="container">
            <div class="home-mentors-header">
                <div>
                    <p class="section-label">OUR MENTORS</p>
                    <h2 class="home-global-heading mb-0">Learn from the Best</h2>
                </div>
                <a href="#" class="home-view-all-link">View All Mentors <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
            <div class="row gy-4 mt-2">
                <div class="col-6 col-md-3">
                    <div class="home-mentor-card">
                        <img src="https://randomuser.me/api/portraits/men/41.jpg" class="home-mentor-img"
                            alt="Marees Monoten" loading="lazy" />
                        <div class="home-mentor-info">
                            <p class="home-mentor-name">Marees Monoten</p>
                            <p class="home-mentor-role">AI &amp; Data Science Instructor</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="home-mentor-card">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" class="home-mentor-img"
                            alt="Natasha Dizar" loading="lazy" />
                        <div class="home-mentor-info">
                            <p class="home-mentor-name">Natasha Dizar</p>
                            <p class="home-mentor-role">Digital Marketing Expert</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="home-mentor-card">
                        <img src="https://randomuser.me/api/portraits/men/28.jpg" class="home-mentor-img" alt="Ben Dones"
                            loading="lazy" />
                        <div class="home-mentor-info">
                            <p class="home-mentor-name">Ben Dones</p>
                            <p class="home-mentor-role">Leadership &amp; Strategy Coach</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="home-mentor-card">
                        <img src="https://randomuser.me/api/portraits/women/33.jpg" class="home-mentor-img"
                            alt="Cetaciaa Stenios" loading="lazy" />
                        <div class="home-mentor-info">
                            <p class="home-mentor-name">Cetaciaa Stenios</p>
                            <p class="home-mentor-role">Product Design Instructor</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================
                     HOME - CTA SECTION (RIBBON STYLE)
                ========================================== -->
    <section class="home-cta-section ribbon-style">
        <div class="container">
            <div class="home-ribbon-wrapper">
                <div class="home-ribbon-overlay"></div>
                <div class="row align-items-center gy-4 position-relative z-2">
                    <div class="col-lg-8">
                        <div class="home-cta-content">
                            <span class="home-cta-badge"><i class="bi bi-stars"></i> Start Learning Today</span>
                            <h2 class="home-cta-heading">{{ $calltoaction->title }}</h2>
                            <p class="home-cta-sub text-white">
                                {!! $calltoaction->body !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="#" class="btn-custom btn-cta-white">Enroll Today <i
                                class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
