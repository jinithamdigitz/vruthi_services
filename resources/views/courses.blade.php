@extends('layouts.main')

@section('content')
    <!-- =========================================
                                 COURSES - HERO SECTION
                            ========================================== -->
    <section class="courses-hero-section">
        <div class="container">
            <div class="row align-items-center courses-hero-row">
                <div class="col-lg-6">
                    <div class="courses-hero-content">
                        <p class="section-label">
                            <i class="bi bi-book"></i>
                            OUR COURSES
                        </p>
                        <h1 class="courses-hero-title">
                            Discover the Right Course for
                            <span>Your Goals</span>
                        </h1>
                        <p class="courses-hero-description">
                            Explore industry-relevant programs designed to build in-demand skills and accelerate your
                            career.
                        </p>
                        <div class="courses-search-wrapper">
                            <div class="courses-search-input-group">
                                <i class="bi bi-search"></i>
                                <input type="text" placeholder="Search courses, skills, or topics..." />
                            </div>
                            <button class="courses-search-btn">Search</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="courses-hero-image-wrapper">
                        <div class="courses-hero-shape"></div>
                        <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?q=80&w=1200&auto=format&fit=crop"
                            alt="Student Learning" class="courses-hero-image">
                        <div class="courses-student-card">
                            <div class="courses-student-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div>
                                <h4>15,000+</h4>
                                <p>Students Learning</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================
                                 COURSES - GRID SECTION
                            ========================================== -->
    <section class="courses-grid-section py-5">
        <div class="container">
            <div class="row">
                <!-- full width column to allow 4 cards per row -->
                <div class="col-12">
                    <!-- top bar with showing count -->
                    <div class="courses-topbar d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
                        <p class="text-secondary fw-semibold m-0">Showing {{ $courses->count() }} courses</p>
                    </div>

                    <!-- row with responsive grid: 4 cards on xl+, 3 on lg, 2 on md, 1 on mobile -->
                    <div class="row g-4">

                        @php
                            $icons = [
                                'bi-cpu',
                                'bi-megaphone',
                                'bi-people',
                                'bi-code-square',
                                'bi-graph-up',
                                'bi-cloud',
                                'bi-shield-lock',
                                'bi-robot',
                                'bi-bar-chart-steps',
                                'bi-phone-fill',
                                'bi-currency-bitcoin',
                                'bi-chat-dots',
                                'bi-book',
                                'bi-laptop',
                                'bi-database',
                                'bi-palette',
                            ];

                            $iconColors = [
                                'text-primary',
                                'text-success',
                                'text-purple',
                                'text-warning',
                                'text-info',
                                'text-danger',
                                'text-primary',
                                'text-success',
                            ];

                            $bgColors = [
                                'bg-primary',
                                'bg-success',
                                'bg-purple',
                                'bg-warning',
                                'bg-info',
                                'bg-danger',
                                'bg-primary',
                                'bg-success',
                            ];
                        @endphp
                        @foreach ($courses as $index => $course)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden course-card"
                                    style="background-image: url('{{ asset($course->image) }}'); background-size: cover; background-position: center;">

                                    <!-- Overlay div -->
                                    <div class="course-overlay"></div>

                                    <div class="card-body p-4">
                                        <div
                                            class="courses-icon {{ $bgColors[$index % count($bgColors)] }} bg-opacity-25 rounded-3 d-inline-flex p-3 mb-3">
                                            <i
                                                class="bi {{ $icons[$index % count($icons)] }} {{ $iconColors[$index % count($iconColors)] }}"></i>
                                        </div>
                                        <h4 class="card-title fw-bold fs-5 mb-2 text-white">{{ $course->course_name }}</h4>
                                        <p class="card-text small text-white">
                                            {{ Str::limit($course->description, 60) }}
                                        </p>
                                        <div class="courses-meta d-flex gap-3 mb-4">
                                            <span class="text-white"><i
                                                    class="bi bi-clock me-1"></i>{{ $course->duration }}</span>
                                        </div>
                                        <a href="{{ route('course.detail', $course->slug) }}"
                                            class="courses-arrow btn btn-light rounded-circle p-0 d-inline-flex align-items-center justify-content-center">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div> <!-- end row g-4 -->
                </div> <!-- end col-12 -->
            </div> <!-- end row outer -->
        </div> <!-- end container -->
    </section>


    <!-- =========================================
                                 COURSES - CTA SECTION
                            ========================================== -->
    <section class="courses-cta-section">
        <div class="container">
            <div class="courses-ribbon-wrapper">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-8">
                        <h2 class="courses-cta-heading">Can't Find What You're Looking For?</h2>
                        <p class="courses-cta-sub">Talk to our experts and get personalized course recommendations.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="#" class="btn-custom btn-cta-white">Talk to an Advisor <i
                                class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
