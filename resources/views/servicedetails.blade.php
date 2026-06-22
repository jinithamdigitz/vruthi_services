@extends('layouts.main')

@section('title', 'Our Services — Vrudhi Outsourcing Services Pvt. Ltd.')

@section('content')

    @php
        // Parse features from JSON or newline separated
        $features = [];
        if ($service->features) {
            $decoded = json_decode($service->features, true);
            if (is_array($decoded)) {
                $features = $decoded;
            } else {
                $features = array_filter(array_map('trim', explode("\n", trim($service->features))));
            }
        }

        $staticFeatures = [
            'Daily Cleaning Services',
            'Waste Collection & Disposal',
            'Floor & Carpet Care',
            'Public Area & Common Area Maintenance',
            'Washroom Hygiene Management',
            'Pest Control & Disinfectent',
        ];

        $displayFeatures = count($features) > 0 ? $features : $staticFeatures;

        // Benefits (first 5 features or static)
        $staticBenefits = [
            'Hygienic & Clean Environment',
            'Reduced Health Risks',
            'Improved Employee Productivity',
            'Well-Maintained Assets',
            'Cost Effective Operations',
        ];
        $benefits = count($features) > 0 ? array_slice($features, 0, 5) : $staticBenefits;

        // Description
        $description = $service->short_description ?? null;
        if (!$description && isset($service->body)) {
            $description = Str::limit(strip_tags($service->body), 220);
        }
        $description =
            $description ??
            'We deliver integrated and innovative facility management services that help organisations focus on their core business.';

        // Tagline
        $tagline = $service->tagline ?? ($service->short_description ?? 'Clean Spaces. Healthy Places. Happy People.');
    @endphp

    {{-- ============================================================
         SECTION 1 : SERVICE HERO BANNER
    ============================================================ --}}
    <section class="sd-hero">
        <div class="sd-hero__overlay"></div>
        <div class="sd-hero__wave"></div>

        <div class="container">
            <div class="sd-hero__content">

                <div class="sd-hero__left reveal reveal-left">
                    <nav class="sd-hero__breadcrumb" aria-label="breadcrumb">
                        <a href="{{ url('/') }}">Home</a>
                        <i class="bi bi-chevron-right"></i>
                        <a href="{{ route('home.services') }}">Services</a>
                        <i class="bi bi-chevron-right"></i>
                        <span>{{ $service->title }}</span>
                    </nav>

                    <h1 class="sd-hero__title">{{ $service->title }}</h1>

                    <p class="sd-hero__tagline">{{ $tagline }}</p>

                    <p class="sd-hero__desc">{{ $description }}</p>

                    <div class="sd-hero__actions">
                        <a href="#enquiry" class="btn-primary-brand">
                            Request a Quote <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="sd-hero__right reveal reveal-right">
                    @if ($service->image)
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="sd-hero__img">
                    @else
                        <img src="{{ asset('img/services/placeholder.jpg') }}" alt="{{ $service->title }}"
                            class="sd-hero__img">
                    @endif
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
   SECTION 2 : OVERVIEW + ENQUIRY FORM (Side by Side)
   ============================================================ --}}
    <section class="sd-overview" id="enquiry">
        <div class="container">
            <div class="row g-5">

                {{-- Left: Overview Content --}}
                <div class="col-lg-7">
                    <div class="sd-overview__content reveal">
                        <span class="section-label">Overview</span>
                        <div class="section-divider section-divider--left"></div>

                        @if (isset($service->body) && $service->body)
                            <div class="sd-overview__body">
                                @if ($service->show_html ?? false)
                                    {!! $service->body !!}
                                @else
                                    {!! nl2br(e($service->body)) !!}
                                @endif
                            </div>
                        @else
                            <div class="sd-overview__body">
                                <p>We provide professional housekeeping and maintenance services tailored to meet the unique
                                    needs of your facility. From routine cleaning to preventive maintenance, our trained
                                    staff and advanced tools help maintain the highest standards of cleanliness and hygiene.
                                </p>
                            </div>
                        @endif

                        {{-- Scope of Services --}}
                        @if (!empty($service->features))
                            <div class="sd-scope mt-5">
                                <span class="section-label">Scope Of Services</span>
                                <div class="section-divider section-divider--left"></div>

                                @php
                                    $featuresWithTick = preg_replace(
                                        '/<li>(.*?)<\/li>/',
                                        '<li><i class="bi bi-check-circle-fill"></i> $1</li>',
                                        $service->features,
                                    );
                                @endphp

                                <div class="sd-scope-list mt-4">
                                    {!! $featuresWithTick !!}
                                </div>
                            </div>
                        @endif

                        {{-- ============================================================
                         WHAT YOU GET (Benefits) - MOVED HERE BELOW SCOPE
                    ============================================================ --}}
                        <div class="sd-benefits sd-benefits--inline mt-4 reveal">
                            <div class="sd-benefits__header">
                                <i class="bi bi-gift-fill"></i>
                                <span class="section-label">What You Get</span>
                            </div>
                            <ul>
                                @foreach ($benefits as $benefit)
                                    @if (trim($benefit))
                                        <li> {!! trim($benefit) !!}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>

                {{-- Right: Enquiry Form + Contact --}}
                <div class="col-lg-5">
                    <div class="sd-sidebar">

                        {{-- Request a Quote Form --}}
                        <div class="sd-form reveal">
                            <h3>Request a Quote</h3>
                            <p>Fill in the form and our team will get back to you.</p>

                            <form action="#" method="POST">
                                @csrf
                                <input type="text" name="name" placeholder="Full Name *" required>
                                <input type="email" name="email" placeholder="Email Address *" required>
                                <input type="tel" name="phone" placeholder="Phone Number *" required>

                                <select name="service">
                                    <option value="" disabled selected>Select Service *</option>
                                    @if (isset($service->title))
                                        <option value="{{ $service->slug ?? $service->title }}" selected>
                                            {{ $service->title }}</option>
                                    @endif
                                    @if (isset($otherServices) && $otherServices->count() > 0)
                                        @foreach ($otherServices as $svc)
                                            <option value="{{ $svc->slug }}">{{ $svc->title }}</option>
                                        @endforeach
                                    @endif
                                </select>

                                <textarea rows="4" name="message" placeholder="Your Message *" required></textarea>

                                <div class="sd-form__captcha">
                                    <div class="g-recaptcha"
                                        data-sitekey="{{ config('services.recaptcha.site_key', '') }}">
                                        <div class="sd-form__captcha-placeholder">
                                            <input type="checkbox" id="notRobot">
                                            <label for="notRobot">I'm not a robot</label>
                                            <span class="sd-form__captcha-logo">reCAPTCHA</span>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn-primary-brand w-100 mt-2">
                                    SUBMIT ENQUIRY <i class="bi bi-arrow-right"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Need Immediate Assistance --}}
                        <div class="sd-contact reveal">
                            <div class="sd-contact__inner">
                                <div class="sd-contact__icon-wrap">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <div class="sd-contact__text">

                                    <span class="sd-contact__label">
                                        {{ $sdcta->title }}
                                    </span>

                                    <span class="sd-contact__sub">
                                        {!! $sdcta->body !!}
                                    </span>

                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $globalPhone) }}"
                                        class="sd-contact__phone">
                                        <i class="bi bi-telephone-fill"></i>
                                        {{ $globalPhone }}
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
         SECTION 4 : OUR SERVICE PROCESS
    ============================================================ --}}
    <section class="home-process" id="home-process">
        <div class="container">
            <div class="row justify-content-center text-center mb-3">
                <div class="col-lg-6">
                    <h2 class="section-title-unified">Our Process</h2>
                </div>
            </div>
            <div class="home-process__flow">

                @foreach ($ourprocess as $process)
                    <div class="home-process__item">

                        <div class="home-process__icon">
                            <img src="{{ asset($process->image) }}" alt="{{ $process->title }}"
                                class="home-process__icon-img">
                        </div>

                        <h4>{{ $process->title }}</h4>

                        <p>{!! $process->body !!}</p>

                    </div>

                    @if (!$loop->last)
                        <div class="home-process__arrow"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- /home-process -->
    {{-- ============================================================
         SECTION 5 : INDUSTRIES WE SERVE
    ============================================================ --}}
    <section class="home-industries" id="home-industries">
        <div class="container">
            <div class="row justify-content-center text-center mb-4">
                <div class="col-lg-6">
                    <h2 class="section-title-unified">Industries We Serve</h2>
                </div>
            </div>
            <div class="row g-4">

                @foreach ($industries as $industry)
                    <div class="col-6 col-md-3">
                        <div class="home-industries__item {{ $loop->last ? 'home-industries__item--last' : '' }}">

                            <img src="{{ asset($industry->image) }}" alt="{{ $industry->title }}"
                                class="home-industries__icon-img">

                            <span class="home-industries__label">
                                {{ $industry->title }}
                            </span>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- /home-industries -->

    {{-- ============================================================
         SECTION 9 : CLIENTS TESTIMONIALS
    ============================================================ --}}
    <section class="sd-client-stats">
        <div class="container">

            <div class="row g-0 align-items-center">

                {{-- LEFT : STATIC CLIENT TESTIMONIAL --}}
                <div class="col-lg-4">
                    <div class="sd-client-stats__testimonial">

                        <span class="section-label">What Our Clients Say</span>

                        <div id="clientTestimonialCarousel" class="carousel slide" data-bs-ride="carousel"
                            data-bs-interval="4000">
                            <div class="carousel-inner">
                                @foreach ($testimonials as $index => $testimonial)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="sd-testimonial-mini">
                                            <p>{!! $testimonial->body !!}</p>
                                            <strong>{{ $testimonial->title }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="sd-client-stats__dots">
                                @foreach ($testimonials as $index => $testimonial)
                                    <button type="button" data-bs-target="#clientTestimonialCarousel"
                                        data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                                        aria-label="Slide {{ $index + 1 }}">
                                    </button>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                {{-- RIGHT : COUNTERS FROM DB --}}
                <div class="col-lg-8">

                    <div class="row g-0">

                        @foreach ($counters as $counter)
                            <div class="col-lg-3 col-md-6">

                                <div class="sd-client-stats__counter">

                                    @if ($counter->image)
                                        <img src="{{ asset($counter->image) }}" alt="{{ $counter->title }}"
                                            class="sd-client-stats__icon">
                                    @endif

                                    <h4>{{ $counter->title }}</h4>

                                    <span>{!! strip_tags($counter->body) !!}</span>

                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

        </div>
    </section>

    {{-- ============================================================
         SECTION 9 : OTHER SERVICES
    ============================================================ --}}
    @if (isset($otherServices) && $otherServices->count() > 0)
        <section class="sd-other">
            <div class="container">
                <div class="row justify-content-center text-center mb-5">
                    <div class="col-lg-6">
                        <h2 class="mt-2">Other Services</h2>
                        <div class="section-divider mx-auto"></div>
                    </div>
                </div>

                <div class="row g-3 justify-content-center mt-3">
                    @foreach ($otherServices as $otherService)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="sd-other__card reveal w-100">
                                @if ($otherService->image)
                                    <img src="{{ asset($otherService->image) }}" alt="{{ $otherService->title }}"
                                        class="sd-other__icon">
                                @else
                                    <i class="bi bi-star-fill"></i>
                                @endif

                                <h4 class="sd-other__title">{{ $otherService->title }}</h4>

                                <p class="sd-other__desc">
                                    {{ Str::limit(strip_tags($otherService->short_description ?? ($otherService->body ?? '')), 60) }}
                                </p>

                                <a href="{{ route('frontend.service.detail', $otherService->slug) }}"
                                    class="sd-other__btn">
                                    Learn More <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
