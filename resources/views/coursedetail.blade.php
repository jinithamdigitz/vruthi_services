@extends('layouts.main')

@section('content')

    <!-- =========================================
                 COURSE DETAIL SECTION
            ========================================== -->
    <section class="course-detail-section">

        <div class="container">

            <!-- Breadcrumb -->
            <div class="course-detail-breadcrumb">

                <a href="{{ url('/') }}">
                    Home
                </a>

                <span>
                    <i class="bi bi-chevron-right"></i>
                </span>

                <a href="{{ route('courses') }}">
                    Courses
                </a>

                <span>
                    <i class="bi bi-chevron-right"></i>
                </span>

                <span>
                    {{ $course->title }}
                </span>

            </div>

            <!-- Main Row -->
            <div class="row g-4">

                <!-- LEFT CONTENT -->
                <div class="col-lg-8">

                    <!-- Hero Card -->
                    <!-- Hero Card -->
                    <div class="course-detail-hero-card">

                        <div class="course-detail-image-wrapper full-banner-image">

                            <img src="{{ asset($course->image) }}" alt="{{ $course->title }}" class="course-detail-image">

                            <!-- Overlay -->
                            <div class="course-detail-banner-overlay"></div>

                            <!-- Content -->
                            <div class="course-detail-banner-content">



                                <h1 class="course-detail-title">
                                    {{ $course->title }}
                                </h1>

                                <p class="course-detail-description">
                                    {{ $course->short_description }}
                                </p>

                                <!-- Duration -->
                                <div class="course-detail-duration-badge">

                                    <i class="bi bi-clock"></i>

                                    <div>

                                        <h6>
                                            {{ $course->duration }}
                                        </h6>

                                        <span>
                                            Course Duration
                                        </span>

                                    </div>

                                </div>

                            </div>



                        </div>

                    </div>

                    <!-- Tabs Card -->
                    <div class="course-detail-tabs-card">

                        <!-- Tabs -->
                        <ul class="nav course-detail-tabs">

                            <li class="nav-item">
                                <button class="nav-link active">
                                    Overview
                                </button>
                            </li>



                        </ul>

                        <!-- Overview -->
                        <div class="course-detail-overview">
                            <p>
                                {!! $course->description !!}
                            </p>

                            <!-- Tags -->
                            @if (!empty($course->tags))
                                <div class="course-detail-tags">

                                    @foreach (explode(',', $course->tags) as $tag)
                                        <span>
                                            {{ trim($tag) }}
                                        </span>
                                    @endforeach

                                </div>
                            @endif

                        </div>

                        <!-- Curriculum -->
                        @if ($course->curriculum)
                            <div class="course-detail-curriculum">

                                <div class="course-detail-curriculum-header">

                                    <h3 class="course-detail-section-title mb-0">
                                        Course Curriculum
                                    </h3>

                                </div>

                                <div class="course-detail-curriculum-content">

                                    {!! $course->curriculum !!}

                                </div>

                            </div>
                        @endif

                    </div>

                </div>

                <!-- SIDEBAR -->
                <div class="col-lg-4">





                    <!-- Other Courses -->
                    <div class="course-detail-sidebar-card">

                        <h4 class="course-detail-sidebar-title">
                            Other Courses
                        </h4>

                        <div class="other-courses-wrapper">

                            @foreach ($courses as $item)
                                <a href="{{ route('course.detail', $item->slug) }}" class="other-course-item">

                                    <div class="other-course-image">

                                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">

                                    </div>

                                    <div class="other-course-content">

                                        <span class="other-course-duration">
                                            <i class="bi bi-clock"></i>
                                            {{ $item->duration ?? '3 Months' }}
                                        </span>

                                        <h5>
                                            {{ $item->course_name }}
                                        </h5>

                                        <p>
                                            {{ Str::limit(strip_tags($item->description), 70) }}
                                        </p>

                                    </div>

                                </a>
                            @endforeach

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
