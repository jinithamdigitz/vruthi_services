@extends('layouts.main')


<style>
/* ============================================
   SERVICES PAGE — Scoped CSS (.svc-pg__)
   ============================================ */

/* ── HERO ── */
.svc-pg__hero {
    position: relative;
    min-height: 520px;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: #0c0d12;
}

.svc-pg__hero-bg {
    position: absolute;
    inset: 0;
    background-image: url('https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1600&q=80');
    background-size: cover;
    background-position: center 30%;
}

.svc-pg__hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(10, 11, 16, 0.88) 0%,
        rgba(10, 11, 16, 0.60) 100%
    );
}

.svc-pg__hero-content {
    position: relative;
    z-index: 2;
    padding-top: 140px;
    padding-bottom: 80px;
}

.svc-pg__breadcrumb {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: var(--fs-xs);
    font-weight: var(--fw-medium);
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.50);
    margin-bottom: 18px;
}

.svc-pg__breadcrumb a {
    color: rgba(255,255,255,0.50);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.svc-pg__breadcrumb a:hover { color: var(--color-primary); }
.svc-pg__breadcrumb span   { color: var(--color-primary); }

.svc-pg__hero-title {
    font-family: var(--font-heading);
    font-weight: var(--fw-extrabold);
    color: #fff;
    font-size: clamp(2.2rem, 5.5vw, 3.6rem);
    line-height: 1.1;
    margin-bottom: 16px;
}

.svc-pg__hero-title .svc-pg__accent {
    color: var(--color-primary);
    display: block;
}

.svc-pg__hero-desc {
    font-size: var(--fs-base);
    color: rgba(255,255,255,0.68);
    line-height: 1.8;
    max-width: 480px;
    margin-bottom: var(--space-lg);
}

.svc-pg__hero-stats {
    display: flex;
    align-items: center;
    gap: 28px;
    flex-wrap: wrap;
}

.svc-pg__hero-stat {
    display: flex;
    align-items: center;
    gap: 12px;
}

.svc-pg__hero-stat-icon {
    width: 42px;
    height: 42px;
    border-radius: var(--radius-md);
    background: rgba(200,98,42,0.15);
    border: 1px solid rgba(200,98,42,0.28);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-primary);
    flex-shrink: 0;
}

.svc-pg__hero-stat-num {
    font-family: var(--font-heading);
    font-size: var(--fs-lg);
    font-weight: var(--fw-extrabold);
    color: #fff;
    line-height: 1;
}

.svc-pg__hero-stat-label {
    font-size: var(--fs-xs);
    color: rgba(255,255,255,0.50);
    letter-spacing: 0.04em;
    margin-top: 2px;
}

.svc-pg__hero-stat-sep {
    width: 1px;
    height: 32px;
    background: rgba(255,255,255,0.12);
}

/* ── INTRO SECTION ── */
.svc-pg__intro {
    background: #fff;
    padding: 72px 0 56px;
}

.svc-pg__intro-eyebrow {
    display: inline-block;
    font-size: var(--fs-xs);
    font-weight: var(--fw-semibold);
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--color-primary);
    margin-bottom: 12px;
}

.svc-pg__intro-title {
    font-family: var(--font-heading);
    font-weight: var(--fw-bold);
    color: var(--color-darker);
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    margin-bottom: 14px;
    line-height: 1.2;
}

.svc-pg__intro-sub {
    font-size: var(--fs-sm);
    color: var(--color-gray-text);
    line-height: 1.85;
    max-width: 560px;
    margin: 0 auto;
}

/* ── SERVICE CARDS GRID ── */
.svc-pg__grid {
    background: #fff;
    padding-bottom: 80px;
}

/* Dark card — matching template exactly */
.svc-pg__card {
    background: #252630;
    border-radius: 0;
    overflow: hidden;
    border: none;
    transition: transform var(--transition-base), box-shadow var(--transition-base);
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
}

.svc-pg__card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 36px rgba(0,0,0,0.35);
}

/* Image area */
.svc-pg__card-img-wrap {
    position: relative;
    height: 200px;
    display: block;
    flex-shrink: 0;
}

.svc-pg__card-img-link {
    display: block;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.svc-pg__card-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-slow);
    display: block;
}

.svc-pg__card:hover .svc-pg__card-img-wrap img {
    transform: scale(1.06);
}

/* Floating orange icon image */
.svc-pg__card-icon-img {
    position: absolute;
    bottom: -20px;
    left: 16px;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--color-darker);
    border: 3px solid #252630;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3;
    flex-shrink: 0;
    overflow: hidden;
}

.svc-pg__card-icon-img img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 10px;
}

/* Card body */
.svc-pg__card-body {
    padding: 28px 20px 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.svc-pg__card-title {
    font-family: var(--font-heading);
    font-size: var(--fs-base);
    font-weight: var(--fw-semibold);
    color: #ffffff;
    margin-bottom: 10px;
    line-height: 1.3;
}

.svc-pg__card-text {
    font-size: var(--fs-xs);
    color: rgba(255,255,255,0.62);
    line-height: 1.75;
    margin-bottom: 18px;
    flex: 1;
}

.svc-pg__card-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: var(--font-body);
    font-size: var(--fs-xs);
    font-weight: var(--fw-semibold);
    letter-spacing: 0.10em;
    text-transform: uppercase;
    color: var(--color-primary);
    text-decoration: none;
    transition: gap var(--transition-fast), color var(--transition-fast);
}

.svc-pg__card-link svg {
    transition: transform var(--transition-fast);
}

.svc-pg__card-link:hover {
    gap: 10px;
    color: var(--color-primary-light);
}

.svc-pg__card-link:hover svg {
    transform: translateX(4px);
}

/* ── WHY CHOOSE US ── */
.svc-pg__why {
    background: #1a1b22;
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.svc-pg__why-inner {
    display: flex;
    align-items: center;
    gap: 0;
}

.svc-pg__why-left {
    flex: 0 0 38%;
    max-width: 38%;
    padding-right: 56px;
}

.svc-pg__why-right {
    flex: 1;
    min-width: 0;
    border-left: 1px solid rgba(255,255,255,0.07);
}

.svc-pg__why-eyebrow {
    display: inline-block;
    font-size: var(--fs-xs);
    font-weight: var(--fw-semibold);
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--color-primary);
    margin-bottom: 12px;
}

.svc-pg__why-title {
    font-family: var(--font-heading);
    font-weight: var(--fw-bold);
    color: #fff;
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    line-height: 1.2;
    margin-bottom: 16px;
}

.svc-pg__why-title .svc-pg__accent {
    color: var(--color-primary);
}

.svc-pg__why-sub {
    font-size: var(--fs-sm);
    color: rgba(255,255,255,0.55);
    line-height: 1.8;
    margin-bottom: var(--space-lg);
}

.svc-pg__pillars-row {
    display: flex;
    gap: 0;
    flex-wrap: nowrap;
}

.svc-pg__pillar {
    flex: 1;
    text-align: center;
    padding: 40px 24px;
    border-right: 1px solid rgba(255,255,255,0.07);
    transition: background var(--transition-base);
}

.svc-pg__pillar:hover {
    background: rgba(200,98,42,0.06);
}

.svc-pg__pillar-icon {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: rgba(200,98,42,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: var(--color-primary);
    transition: background var(--transition-base);
}

.svc-pg__pillar:hover .svc-pg__pillar-icon {
    background: rgba(200,98,42,0.22);
}

.svc-pg__pillar-title {
    font-family: var(--font-heading);
    font-size: var(--fs-sm);
    font-weight: var(--fw-semibold);
    color: #fff;
    margin-bottom: 10px;
}

.svc-pg__pillar-text {
    font-size: var(--fs-xs);
    color: rgba(255,255,255,0.50);
    line-height: 1.75;
    margin: 0;
}

/* ── RESPONSIVE ── */
@media (max-width: 991.98px) {
    .svc-pg__hero-content {
        padding-top: 120px;
        padding-bottom: 60px;
    }

    .svc-pg__why-inner {
        flex-direction: column;
        gap: 0;
    }

    .svc-pg__why-left {
        flex: none;
        max-width: 100%;
        width: 100%;
        padding-right: 0;
        padding-bottom: 40px;
    }

    .svc-pg__why-right {
        width: 100%;
        border-left: none;
        border-top: 1px solid rgba(255,255,255,0.07);
    }

    .svc-pg__pillars-row {
        flex-wrap: wrap;
    }

    .svc-pg__pillar {
        flex: 0 0 50%;
        border-top: 1px solid rgba(255,255,255,0.07);
    }
}

@media (max-width: 767.98px) {
    .svc-pg__hero-title { font-size: 2rem; }
    .svc-pg__hero-stat-sep { display: none; }
    .svc-pg__card-img-wrap { height: 175px; }
}

@media (max-width: 575.98px) {
    .svc-pg__hero-content {
        padding-top: 100px;
        padding-bottom: 48px;
    }
    .svc-pg__hero-title { font-size: 1.75rem; }
    .svc-pg__hero-stat-icon { display: none; }
    .svc-pg__pillar {
        flex: 0 0 100%;
        border-right: 1px solid rgba(255,255,255,0.07);
    }
}
</style>


@section('content')

{{-- HERO SECTION --}}
<section class="svc-pg__hero">
    <div class="svc-pg__hero-bg"></div>
    <div class="svc-pg__hero-overlay"></div>

    <div class="container svc-pg__hero-content">
        <nav class="svc-pg__breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home.index') }}">Home</a>
            <span>/</span>
            <span>Services</span>
        </nav>

        <h1 class="svc-pg__hero-title">
            Our Services
            <span class="svc-pg__accent">Design. Plan. Deliver.</span>
        </h1>

        <p class="svc-pg__hero-desc">
            From concept to completion, we provide end-to-end architecture and project
            management solutions tailored to your vision and goals.
        </p>

        <div class="svc-pg__hero-stats">
            <div class="svc-pg__hero-stat">
                <div class="svc-pg__hero-stat-icon">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <div>
                    <div class="svc-pg__hero-stat-num">10+</div>
                    <div class="svc-pg__hero-stat-label">Years of Experience</div>
                </div>
            </div>

            <div class="svc-pg__hero-stat-sep"></div>

            <div class="svc-pg__hero-stat">
                <div class="svc-pg__hero-stat-icon">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div>
                    <div class="svc-pg__hero-stat-num">250+</div>
                    <div class="svc-pg__hero-stat-label">Projects Completed</div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- INTRO SECTION --}}
<section class="svc-pg__intro">
    <div class="container">
        <div class="text-center">
            <span class="svc-pg__intro-eyebrow">What We Do</span>
            <h2 class="svc-pg__intro-title">Comprehensive Services</h2>
            <p class="svc-pg__intro-sub mx-auto">
                We combine creative design with technical expertise and meticulous planning
                to deliver spaces that are functional, sustainable, and inspiring.
            </p>
        </div>
    </div>
</section>


{{-- SERVICE CARDS - DYNAMIC FROM DATABASE --}}
<section class="svc-pg__grid">
    <div class="container">
        <div class="row g-3">
            @forelse($services as $service)
            <div class="col-6 col-lg-3 d-flex">
                <article class="svc-pg__card w-100">
                    <div class="svc-pg__card-img-wrap">
                        
                            @if($service->image)
                                <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" loading="lazy">
                            @else
                                <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=600&q=80" alt="{{ $service->title }}" loading="lazy">
                            @endif

                        <div class="svc-pg__card-icon-img" aria-hidden="true">
                            @if($service->icon_image)
                                <img src="{{ asset($service->icon_image) }}" alt="{{ $service->title }}">
                            @else
                                <svg width="24" height="24" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                                </svg>
                            @endif
                        </div>
                    </div>
                    <div class="svc-pg__card-body">
                        <h3 class="svc-pg__card-title">{{ $service->title }}</h3>
                        <p class="svc-pg__card-text">
                            {{ Str::limit($service->body, 100) }}
                        </p>
                        <a href="{{ route('home.index', $service->slug) }}" class="svc-pg__card-link">
                            Learn More
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </article>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <p class="text-muted">No services found. Please add services from admin panel.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>


{{-- WHY CHOOSE OUTLINE --}}
<section class="svc-pg__why">
    <div class="container">
        <div class="svc-pg__why-inner">
            <div class="svc-pg__why-left">
                <span class="svc-pg__why-eyebrow">Why Choose Outline</span>
                <h2 class="svc-pg__why-title">
                    More Than Design.<br>
                    <span class="svc-pg__accent">We Deliver Value.</span>
                </h2>
                <p class="svc-pg__why-sub">
                    Our integrated approach ensures every project is handled with precision,
                    transparency, and a commitment to excellence.
                </p>
                <a href="{{ route('contact') }}" class="btn-outline-custom btn-primary-custom">
                    Let's Work Together
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="svc-pg__why-right">
                <div class="svc-pg__pillars-row">
                    <div class="svc-pg__pillar">
                        <div class="svc-pg__pillar-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <h4 class="svc-pg__pillar-title">Client-Focused</h4>
                        <p class="svc-pg__pillar-text">We listen, collaborate, and deliver solutions tailored for your needs.</p>
                    </div>

                    <div class="svc-pg__pillar">
                        <div class="svc-pg__pillar-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>
                            </svg>
                        </div>
                        <h4 class="svc-pg__pillar-title">Innovative Approach</h4>
                        <p class="svc-pg__pillar-text">Smart strategies that bring your vision to life brilliantly.</p>
                    </div>

                    <div class="svc-pg__pillar">
                        <div class="svc-pg__pillar-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <h4 class="svc-pg__pillar-title">Quality Assurance</h4>
                        <p class="svc-pg__pillar-text">Highest standards in design, documentation, and delivery.</p>
                    </div>

                    <div class="svc-pg__pillar">
                        <div class="svc-pg__pillar-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                        <h4 class="svc-pg__pillar-title">On-Time Delivery</h4>
                        <p class="svc-pg__pillar-text">Efficient planning and execution to deliver projects on schedule.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection