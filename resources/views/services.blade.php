{{-- ============================================================
     VRUDHI OUTSOURCING — Services Page
     Extends: layouts/main.blade.php
     Routes: home.services (index) | frontend.service.detail (detail)
     ============================================================ --}}

@extends('layouts.main')

@section('title', 'Our Services — Vrudhi Outsourcing Services Pvt. Ltd.')

@section('content')

    {{-- ============================================================
     SECTION 1 : SERVICES HERO BANNER
     ============================================================ --}}
    <section class="services-hero">
        <div class="services-hero__bg-overlay"></div>
        <div class="services-hero__wave-shape"></div>

        <div class="container">
            <div class="services-hero__content">

                {{-- Left: text --}}
                <div class="services-hero__left reveal reveal-left">

                    {{-- Breadcrumb --}}
                    <nav class="services-hero__breadcrumb" aria-label="breadcrumb">
                        <a href="{{ url('/') }}">Home</a>
                        <i class="bi bi-chevron-right"></i>
                        <span>Services</span>
                    </nav>

                    <h1 class="services-hero__title">Our Services</h1>
                    <p class="services-hero__tagline">Comprehensive Facility Management Solutions</p>
                    <p class="services-hero__desc">
                        We deliver integrated and innovative services that help organisations focus on their
                        core business while we manage their facilities efficiently and effectively.
                    </p>
                    <div class="services-hero__rule"></div>
                </div>

                {{-- Right: hero image --}}
                <div class="services-hero__right reveal reveal-right">
                    <img src="{{ asset('img/services/services-hero.png') }}" alt="Vrudhi facility management team"
                        class="services-hero__img" width="680" height="420">
                </div>

            </div>
        </div>
    </section>


    {{-- ============================================================
     SECTION 2 : SERVICE PORTFOLIO (Dynamic from $services)
     Alternating image-left / image-right layout based on $loop->index
     ============================================================ --}}
    <section class="services-portfolio">
        <div class="container">

            {{-- Section heading --}}
            <div class="row justify-content-center mb-5">
                <div class="col-12 text-center">
                    <span class="section-label services-portfolio__eyebrow">What We Offer</span>
                    <h2 class="services-portfolio__title mt-1">Our Service Portfolio</h2>
                    <div class="section-divider mx-auto mt-2"></div>
                </div>
            </div>

            {{-- Loop through services dynamically --}}
            @forelse ($services as $index => $service)
                @php
                    // Only show active services
                    if (!$service->is_active) {
                        continue;
                    }

                    // Determine layout: even index (0,2,4) = image-left, odd index (1,3,5) = image-right
                    $isEven = $index % 2 == 0;
                    // Service number with leading zero (01, 02, 03...)
                    $serviceNumber = str_pad($index + 1, 2, '0', STR_PAD_LEFT);

                    // Parse features from JSON or newline separated
                    $features = [];
                    if ($service->features) {
                        // Check if features is JSON
                        $decoded = json_decode($service->features, true);
                        if (is_array($decoded)) {
                            $features = $decoded;
                        } else {
                            // Split by newline
                            $features = explode("\n", trim($service->features));
                        }
                    }

                    // Get icon class from icon_image or use default
                    $iconClass = $service->icon_image ?: 'bi bi-star-fill';

                    // Get description (short_description or truncated body)
                    $description = $service->short_description;
                    if (!$description && $service->body) {
                        $description = Str::limit(strip_tags($service->body), 120);
                    }
                    if (!$description) {
                        $description = 'Professional facility management services tailored to your needs.';
                    }
                @endphp

                {{-- Service Row --}}
                <div
                    class="services-portfolio__row {{ $isEven ? '' : 'services-portfolio__row--alt' }} row g-0 align-items-stretch reveal">

                    @if ($isEven)
                        {{-- LAYOUT: Image Left | Info Centre | Features Right --}}

                        {{-- Image Column (Left) --}}
                        <div class="col-lg-3 col-md-4">
                            <div class="services-portfolio__img-wrap services-portfolio__img-wrap--left">
                                @if ($service->image)
                                    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}"
                                        class="services-portfolio__img">
                                @else
                                    <img src="{{ asset('img/services/placeholder.jpg') }}" alt="{{ $service->title }}"
                                        class="services-portfolio__img">
                                @endif
                            </div>
                        </div>

                        {{-- Info Column (Centre) --}}
                        <div class="col-lg-5 col-md-4">
                            <div class="services-portfolio__info">
                                <span class="services-portfolio__number">{{ $serviceNumber }}</span>
                                <div class="services-portfolio__icon-wrap">
                                    @if (str_contains($iconClass, 'bi') || str_contains($iconClass, 'fa'))
                                        <i class="{{ $iconClass }}"></i>
                                    @else
                                        <img src="{{ asset($iconClass) }}" alt="{{ $service->title }}"
                                            style="width: 40px; height: 40px; object-fit: contain;">
                                    @endif
                                </div>
                                <h3 class="services-portfolio__service-title">
                                    {!! nl2br(e($service->title)) !!}
                                </h3>
                                <p class="services-portfolio__service-desc">
                                    {{ $description }}
                                </p>
                            </div>
                        </div>

                        {{-- Features Column (Right) --}}
                        <div class="col-lg-4 col-md-4">
                            <div class="services-portfolio__features">
                                @if ($service->features)
                                    @php
                                        // Add tick icon to each list item
                                        $featuresWithTick = preg_replace(
                                            '/<li>(.*?)<\/li>/',
                                            '<li><i class="bi bi-check-circle-fill"></i> $1</li>',
                                            $service->features,
                                        );
                                    @endphp
                                    <div class="services-portfolio__feature-list">
                                        {!! $featuresWithTick !!}
                                    </div>
                                @endif

                                <a href="{{ route('frontend.service.detail', $service->slug) }}"
                                    class="btn-outline-brand services-portfolio__cta">
                                    Explore More <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- LAYOUT: Features Left | Info Centre | Image Right (Alternating) --}}

                        {{-- Features Column (Left) --}}
                        <div class="col-lg-4 col-md-4 order-md-1 order-3">
                            <div class="services-portfolio__features services-portfolio__features--left">
                                <ul class="services-portfolio__feature-list">
                                    @forelse($features as $feature)
                                        @if (trim($feature))
                                            <li><i class="bi bi-check-circle-fill"></i> {!! $feature !!}</li>
                                        @endif
                                    @empty
                                        <li><i class="bi bi-check-circle-fill"></i> Quality Service Guarantee</li>
                                        <li><i class="bi bi-check-circle-fill"></i> Professional Team</li>
                                        <li><i class="bi bi-check-circle-fill"></i> 24/7 Support Available</li>
                                        <li><i class="bi bi-check-circle-fill"></i> Industry Best Practices</li>
                                    @endforelse
                                </ul>
                                <a href="{{ route('frontend.service.detail', $service->slug) }}"
                                    class="btn-outline-brand services-portfolio__cta">
                                    Explore More <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        {{-- Info Column (Centre) --}}
                        <div class="col-lg-5 col-md-4 order-md-2 order-1">
                            <div class="services-portfolio__info">
                                <span class="services-portfolio__number">{{ $serviceNumber }}</span>
                                <div class="services-portfolio__icon-wrap">
                                    @if (str_contains($iconClass, 'bi') || str_contains($iconClass, 'fa'))
                                        <i class="{{ $iconClass }}"></i>
                                    @else
                                        <img src="{{ asset($iconClass) }}" alt="{{ $service->title }}"
                                            class="services-portfolio__icon-img">
                                    @endif
                                </div>
                                <h3 class="services-portfolio__service-title">
                                    {!! nl2br(e($service->title)) !!}
                                </h3>
                                <p class="services-portfolio__service-desc">
                                    {{ $description }}
                                </p>
                            </div>
                        </div>

                        {{-- Image Column (Right) --}}
                        <div class="col-lg-3 col-md-4 order-md-3 order-2">
                            <div class="services-portfolio__img-wrap services-portfolio__img-wrap--right">
                                @if ($service->image)
                                    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}"
                                        class="services-portfolio__img">
                                @else
                                    <img src="{{ asset('img/services/placeholder.jpg') }}" alt="{{ $service->title }}"
                                        class="services-portfolio__img">
                                @endif
                            </div>
                        </div>
                    @endif

                </div>{{-- /.services-portfolio__row --}}
            @empty
                {{-- No services found --}}
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-tools display-1 text-muted"></i>
                        <h3 class="mt-3">Services Coming Soon!</h3>
                        <p class="text-muted">We are currently updating our service offerings. Please check back later.</p>
                    </div>
                </div>
            @endforelse

        </div>{{-- /.container --}}
    </section>{{-- /.services-portfolio --}}


    {{-- ============================================================
     SECTION 3 : WHY PARTNER WITH US (Dynamic from $whyChooseUsCards)
     ============================================================ --}}
    @if (isset($whyChooseUsCards) && $whyChooseUsCards->count())
        <section class="services-why-us">
            <div class="container">

                <div class="row justify-content-center mb-5">
                    <div class="col-12 text-center">
                        <span class="section-label services-why-us__eyebrow">{{ $whychooseustitle->title }}</span>
                        <div class="section-divider mx-auto mt-2"></div>
                    </div>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach ($whyChooseUsCards as $index => $card)
                        <div class="col-sm-6 col-lg-3 reveal reveal-delay-{{ min($index + 1, 5) }}">
                            <div class="home-about__card h-100">

                                <div class="icon-wrap">
                                    @if ($card->image)
                                        <img src="{{ asset($card->image) }}" alt="{{ $card->title }}"
                                            class="home-about__icon-img">
                                    @else
                                        <i class="bi bi-star-fill" style="font-size: 2rem; color: #0d7a6e;"></i>
                                    @endif
                                </div>

                                <h4>{{ $card->title }}</h4>

                                <p>{{ Str::limit(strip_tags($card->body), 100) }}</p>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
