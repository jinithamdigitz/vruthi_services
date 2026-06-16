@extends('layouts.main')

@section('title', $service->title . ' — Vrudhi Outsourcing Services Pvt. Ltd.')

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

        // Fallback static features
        $staticFeatures = [
            'Daily Cleaning Services',
            'Waste Collection & Disposal',
            'Floor & Carpet Care',
            'Public Area & Common Area Maintenance',
            'Washroom Hygiene Management',
            'Pest Control & Disinfection',
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
        $description = $description ?? 'We deliver integrated and innovative facility management services that help organisations focus on their core business.';

        // Tagline
        $tagline = $service->tagline ?? $service->short_description ?? 'Clean Spaces. Healthy Places. Happy People.';
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
                        <img src="{{ asset('img/services/placeholder.jpg') }}" alt="{{ $service->title }}" class="sd-hero__img">
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
                            <p>We provide professional housekeeping and maintenance services tailored to meet the unique needs of your facility. From routine cleaning to preventive maintenance, our trained staff and advanced tools help maintain the highest standards of cleanliness and hygiene.</p>
                        </div>
                    @endif

                    {{-- Scope of Services --}}
                    @if (count($displayFeatures) > 0)
                        <div class="sd-scope mt-5">
                            <span class="section-label">Scope Of Services</span>
                            <div class="section-divider section-divider--left"></div>

                            <div class="row g-3 mt-3">
                                @foreach ($displayFeatures as $feature)
                                    @if (trim($feature))
                                        <div class="col-md-6">
                                            <div class="sd-scope__card reveal">
                                                <i class="bi bi-check-circle-fill"></i>
                                                <span>{{ trim($feature) }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
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
                                    <li><i class="bi bi-check-circle-fill"></i> {{ trim($benefit) }}</li>
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
                                    <option value="{{ $service->slug ?? $service->title }}" selected>{{ $service->title }}</option>
                                @endif
                                @if (isset($otherServices) && $otherServices->count() > 0)
                                    @foreach ($otherServices as $svc)
                                        <option value="{{ $svc->slug }}">{{ $svc->title }}</option>
                                    @endforeach
                                @endif
                            </select>

                            <textarea rows="4" name="message" placeholder="Your Message *" required></textarea>

                            <div class="sd-form__captcha">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key', '') }}">
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
                                <span class="sd-contact__label">Need Immediate Assistance?</span>
                                <span class="sd-contact__sub">Talk to our experts now.</span>
                                <a href="tel:+911204567890" class="sd-contact__phone">
                                    <i class="bi bi-telephone-fill"></i> +91 120 456 7890
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
            <div class="row justify-content-center text-center mb-5">
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
         SECTION 7 : TESTIMONIALS
    ============================================================ --}}
<section class="sd-testimonials">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="section-label">What Our Clients Say</span>
                <h2 class="mt-2">Trusted by Industry Leaders</h2>
                <div class="section-divider mx-auto"></div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-lg-10 col-xl-8">
                @if (isset($testimonials) && $testimonials->count() > 0)
                    <div id="testimonialCarousel" class="carousel slide sd-testimonials__carousel" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($testimonials as $index => $testimonial)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="sd-testimonial__card">
                                        <i class="bi bi-quote sd-testimonial__quote-icon"></i>
                                        <p class="sd-testimonial__text">{{ $testimonial->body ?? $testimonial->content }}</p>
                                        <div class="sd-testimonial__author">
                                            <strong>{{ $testimonial->title ?? $testimonial->name }}</strong>
                                            @if (isset($testimonial->designation))
                                                <span>{{ $testimonial->designation }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        {{-- Carousel Controls --}}
                        <button class="sd-testimonials__control sd-testimonials__control--prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="sd-testimonials__control sd-testimonials__control--next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                        
                        <div class="sd-testimonials__dots">
                            @foreach ($testimonials as $index => $t)
                                <button class="sd-testimonials__dot {{ $index === 0 ? 'active' : '' }}"
                                    data-bs-target="#testimonialCarousel"
                                    data-bs-slide-to="{{ $index }}"
                                    aria-label="Testimonial {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                    </div>
                @else
                    {{-- Static Testimonials --}}
                    <div id="testimonialCarousel" class="carousel slide sd-testimonials__carousel" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="sd-testimonial__card">
                                    <i class="bi bi-quote sd-testimonial__quote-icon"></i>
                                    <p class="sd-testimonial__text">"VOSPL has maintained the highest standards of cleanliness and upkeep in our premises. Their team is professional, reliable and always responsive."</p>
                                    <div class="sd-testimonial__author">
                                        <strong>– Facility Manager, IT Park, Noida</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="sd-testimonial__card">
                                    <i class="bi bi-quote sd-testimonial__quote-icon"></i>
                                    <p class="sd-testimonial__text">"Exceptional service quality and a dedicated team that truly understands our facility requirements. Highly recommended for any corporate environment."</p>
                                    <div class="sd-testimonial__author">
                                        <strong>– Operations Head, Corporate Park, Gurugram</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="sd-testimonial__card">
                                    <i class="bi bi-quote sd-testimonial__quote-icon"></i>
                                    <p class="sd-testimonial__text">"We have been partnering with VOSPL since 2019 and the consistency in their service delivery has been outstanding throughout."</p>
                                    <div class="sd-testimonial__author">
                                        <strong>– Admin Director, Healthcare Facility, Delhi</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="sd-testimonials__dots">
                            <button class="sd-testimonials__dot active" data-bs-target="#testimonialCarousel" data-bs-slide-to="0"></button>
                            <button class="sd-testimonials__dot" data-bs-target="#testimonialCarousel" data-bs-slide-to="1"></button>
                            <button class="sd-testimonials__dot" data-bs-target="#testimonialCarousel" data-bs-slide-to="2"></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
    {{-- ============================================================
         SECTION 8 : STATS
    ============================================================ --}}
    @if (isset($counters) && $counters->count() > 0)
        <section class="home-stats sd-stats">
            <div class="container">
                <div class="row home-stats__row justify-content-center">
                    @foreach ($counters as $counter)
                        <div class="col-lg-3 col-md-6 col-6">
                            <div class="home-stats__item text-center">
                                @if ($counter->image)
                                    <div class="home-stats__icon">
                                        <img src="{{ asset($counter->image) }}" alt="{{ $counter->title }}" class="home-stats__icon-img">
                                    </div>
                                @endif
                                <div class="home-stats__number">{{ $counter->title }}</div>
                                <div class="home-stats__label">{!! $counter->body !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="home-stats sd-stats">
            <div class="container">
                <div class="row home-stats__row justify-content-center">
                    @php
                        $staticCounters = [
                            ['num' => '17+', 'label' => 'Years of Experience'],
                            ['num' => '500+', 'label' => 'Happy Clients'],
                            ['num' => '25,000+', 'label' => 'Trained Workforce'],
                            ['num' => 'PAN India & Middle East', 'label' => 'Presence'],
                        ];
                    @endphp
                    @foreach ($staticCounters as $counter)
                        <div class="col-lg-3 col-md-6 col-6">
                            <div class="home-stats__item text-center">
                                <div class="home-stats__number">{{ $counter['num'] }}</div>
                                <div class="home-stats__label">{{ $counter['label'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============================================================
         SECTION 9 : OTHER SERVICES
    ============================================================ --}}
    @if (isset($otherServices) && $otherServices->count() > 0)
        <section class="sd-other">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <span class="section-label">Other Services</span>
                        <h2 class="mt-2">Explore Our Other Services</h2>
                        <div class="section-divider mx-auto"></div>
                    </div>
                </div>

                <div class="row g-4 mt-4">
                    @foreach ($otherServices as $otherService)
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                            <div class="sd-other__card reveal w-100">
                                @if ($otherService->image)
                                    <img src="{{ asset($otherService->image) }}" alt="{{ $otherService->title }}" class="sd-other__icon">
                                @else
                                    <i class="bi bi-star-fill"></i>
                                @endif

                                <h4 class="sd-other__title">{{ $otherService->title }}</h4>

                                <p class="sd-other__desc">
                                    {{ Str::limit(strip_tags($otherService->short_description ?? $otherService->body ?? ''), 60) }}
                                </p>

                                <a href="{{ route('frontend.service.detail', $otherService->slug) }}" class="sd-other__btn">
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