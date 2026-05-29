@extends('layouts.main')

@section('content')

{{-- =============================================
     PAGE-SCOPED CAREERS CSS
     Namespaced under .careers-page to avoid conflicts
     ============================================= --}}
<style>
  /* ── WHY JOIN US – dark strip ── */
  .careers-page .careers-why {
    background: #111217;
    padding: 52px 0;
  }

  .careers-page .careers-why__item {
    text-align: center;
    padding: 32px 20px;
    border-radius: var(--radius-md);
    transition: background var(--transition-base);
  }

  .careers-page .careers-why__item:hover {
    background: rgba(200, 98, 42, 0.08);
  }

  .careers-page .careers-why__icon {
    width: 56px;
    height: 56px;
    margin: 0 auto 16px;
    color: var(--color-primary);
    font-size: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .careers-page .careers-why__icon svg {
    width: 100%;
    height: 100%;
    stroke: var(--color-primary);
    fill: none;
    stroke-width: 1.5;
  }

  .careers-page .careers-why__title {
    font-family: var(--font-heading);
    font-size: var(--fs-base);
    font-weight: var(--fw-semibold);
    color: #fff;
    margin-bottom: 8px;
  }

  .careers-page .careers-why__text {
    font-size: var(--fs-sm);
    color: rgba(255, 255, 255, 0.55);
    line-height: 1.7;
    margin: 0;
  }

  /* ── OPEN POSITIONS ── */
  .careers-page .careers-positions {
    background: var(--color-bg-light);
    padding: var(--space-3xl) 0;
  }

  .careers-page .positions-filters {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
  }

  /* Search Input Styling */
  .careers-page .search-input {
    padding: 10px 16px;
    background: #fff;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-sm);
    font-family: var(--font-body);
    font-size: var(--fs-sm);
    color: var(--color-gray-text);
    min-width: 200px;
    transition: all var(--transition-fast);
  }

  .careers-page .search-input:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 2px rgba(200, 98, 42, 0.1);
  }

  .careers-page .search-input::placeholder {
    color: #aaa;
  }

  .careers-page .filter-select {
    padding: 10px 16px;
    background: #fff;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-sm);
    font-family: var(--font-body);
    font-size: var(--fs-sm);
    color: var(--color-gray-text);
    cursor: pointer;
    min-width: 180px;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%235A5B66' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
    transition: border-color var(--transition-fast);
  }

  .careers-page .filter-select:focus {
    outline: none;
    border-color: var(--color-primary);
  }

  .careers-page .btn-clear-filters {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 20px;
    background: transparent;
    border: 1px solid var(--color-primary);
    border-radius: var(--radius-sm);
    font-family: var(--font-body);
    font-size: var(--fs-sm);
    font-weight: var(--fw-semibold);
    color: var(--color-primary);
    cursor: pointer;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    transition: all var(--transition-fast);
    text-decoration: none;
  }

  .careers-page .btn-clear-filters:hover {
    background: var(--color-primary);
    color: #fff;
  }

  .btn-apply-filter {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 24px;
    background: var(--color-primary);
    border: 1px solid var(--color-primary);
    border-radius: var(--radius-sm);
    font-family: var(--font-body);
    font-size: var(--fs-sm);
    font-weight: var(--fw-semibold);
    color: #fff;
    cursor: pointer;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    transition: all var(--transition-fast);
    text-decoration: none;
  }

  .btn-apply-filter:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(200, 98, 42, 0.3);
  }

  /* Job Card */
  .careers-page .job-card {
    background: #fff;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md);
    padding: 24px 28px;
    display: flex;
    align-items: center;
    gap: 20px;
    transition: border-color var(--transition-base), box-shadow var(--transition-base), transform var(--transition-base);
    margin-bottom: 16px;
  }

  .careers-page .job-card:hover {
    border-color: var(--color-primary);
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
  }

  .careers-page .job-card__icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    background: var(--color-bg-light);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-primary);
    font-size: 1.5rem;
    border: 1px solid var(--color-border);
  }

  .careers-page .job-card__body {
    flex: 1;
    min-width: 0;
  }

  .careers-page .job-card__title {
    font-family: var(--font-heading);
    font-size: var(--fs-md);
    font-weight: var(--fw-semibold);
    color: var(--color-dark);
    margin-bottom: 4px;
  }

  .careers-page .job-card__desc {
    font-size: var(--fs-sm);
    color: var(--color-gray-text);
    margin-bottom: 10px;
    line-height: 1.6;
  }

  .careers-page .job-tags {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }

  .careers-page .job-tag {
    display: inline-block;
    padding: 3px 12px;
    border-radius: var(--radius-full);
    font-size: 0.72rem;
    font-weight: var(--fw-medium);
    letter-spacing: 0.04em;
    background: rgba(200, 98, 42, 0.08);
    color: var(--color-primary);
    border: 1px solid rgba(200, 98, 42, 0.2);
  }

  .careers-page .job-card__meta {
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
  }

  .careers-page .job-meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.78rem;
    color: var(--color-gray-light);
  }

  .careers-page .job-meta-item svg {
    flex-shrink: 0;
    color: var(--color-primary);
  }

  .careers-page .btn-apply {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 20px;
    background: transparent;
    border: 1.5px solid var(--color-primary);
    border-radius: var(--radius-sm);
    font-family: var(--font-body);
    font-size: 0.78rem;
    font-weight: var(--fw-semibold);
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--color-primary);
    cursor: pointer;
    text-decoration: none;
    white-space: nowrap;
    transition: all var(--transition-fast);
    margin-top: 6px;
  }

  .careers-page .btn-apply:hover {
    background: var(--color-primary);
    color: #fff;
  }

  @media (max-width: 767.98px) {
    .careers-page .job-card {
      flex-wrap: wrap;
      padding: 20px;
    }

    .careers-page .job-card__meta {
      width: 100%;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 6px;
    }
  }

  /* ── GREAT TALENT CTA ── */
  .careers-page .careers-talent {
    position: relative;
    overflow: hidden;
    background: #000;
  }

  .careers-page .careers-talent__bg {
    position: absolute;
    inset: 0;
    background-image: url('{{ asset("assets/img/careers-talent-bg.jpg") }}');
    background-size: cover;
    background-position: center;
    opacity: 0.25;
  }

  .careers-page .careers-talent__inner {
    position: relative;
    z-index: 2;
    padding: var(--space-3xl) 0;
  }

  .careers-page .careers-talent__left {
    padding-right: var(--space-2xl);
  }

  .careers-page .talent-label {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.45);
    margin-bottom: 14px;
  }

  .careers-page .talent-label span {
    color: var(--color-primary);
  }

  .careers-page .careers-talent__title {
    font-family: var(--font-heading);
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: var(--fw-bold);
    color: #fff;
    line-height: 1.15;
    margin-bottom: 18px;
  }

  .careers-page .careers-talent__title em {
    font-style: normal;
    color: var(--color-primary);
  }

  .careers-page .careers-talent__sub {
    font-size: var(--fs-sm);
    color: rgba(255, 255, 255, 0.6);
    line-height: 1.8;
    margin-bottom: var(--space-lg);
    max-width: 380px;
  }

  .careers-page .btn-send-cv {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 30px;
    background: var(--color-primary);
    color: #fff;
    border: 2px solid var(--color-primary);
    border-radius: var(--radius-sm);
    font-family: var(--font-body);
    font-size: var(--fs-sm);
    font-weight: var(--fw-semibold);
    letter-spacing: 0.06em;
    text-transform: uppercase;
    cursor: pointer;
    text-decoration: none;
    transition: all var(--transition-base);
  }

  .careers-page .btn-send-cv:hover {
    background: var(--color-primary-dark);
    border-color: var(--color-primary-dark);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(200, 98, 42, 0.35);
  }

  .careers-page .talent-perks {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
  }

  .careers-page .talent-perk {
    display: flex;
    align-items: flex-start;
    gap: 14px;
  }

  .careers-page .talent-perk__icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    background: rgba(200, 98, 42, 0.15);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-primary);
    font-size: 1.1rem;
    margin-top: 2px;
  }

  .careers-page .talent-perk__title {
    font-family: var(--font-heading);
    font-size: var(--fs-sm);
    font-weight: var(--fw-semibold);
    color: #fff;
    margin-bottom: 4px;
  }

  .careers-page .talent-perk__text {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.55);
    line-height: 1.6;
    margin: 0;
  }

  @media (max-width: 991.98px) {
    .careers-page .careers-talent__left {
      padding-right: 0;
      margin-bottom: var(--space-xl);
    }
  }

  @media (max-width: 575.98px) {
    .careers-page .talent-perks {
      grid-template-columns: 1fr;
    }
  }

  /* ── LIFE AT OUTLINE ── */
  .careers-page .careers-life {
    background: var(--color-bg-white);
    padding: var(--space-3xl) 0;
  }

  .careers-page .life-gallery {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-top: var(--space-lg);
  }

  .careers-page .life-gallery__item {
    position: relative;
    border-radius: var(--radius-md);
    overflow: hidden;
    cursor: pointer;
  }

  .careers-page .life-gallery__item img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
    transition: transform var(--transition-slow);
  }

  .careers-page .life-gallery__item:hover img {
    transform: scale(1.06);
  }

  .careers-page .life-gallery__item::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.45) 0%, transparent 60%);
    opacity: 0;
    transition: opacity var(--transition-base);
  }

  .careers-page .life-gallery__item:hover::after {
    opacity: 1;
  }

  .careers-page .gallery-nav {
    display: flex;
    gap: 8px;
  }

  .careers-page .gallery-nav-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: 1px solid var(--color-border);
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: var(--color-gray-text);
    font-size: 0.9rem;
    transition: all var(--transition-fast);
  }

  .careers-page .gallery-nav-btn:hover {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: #fff;
  }

  @media (max-width: 991.98px) {
    .careers-page .life-gallery {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 575.98px) {
    .careers-page .life-gallery {
      grid-template-columns: 1fr 1fr;
    }

    .careers-page .life-gallery__item img {
      height: 160px;
    }
  }

  /* ── CONTACT STRIP ── */
  .careers-page .careers-contact-strip {
    background: #111217;
    padding: var(--space-xl) 0;
    border-top: 1px solid rgba(255, 255, 255, 0.06);
  }

  .careers-page .contact-strip__title {
    font-family: var(--font-heading);
    font-size: clamp(1.4rem, 3vw, 1.9rem);
    font-weight: var(--fw-bold);
    color: #fff;
    margin-bottom: 6px;
  }

  .careers-page .contact-strip__sub {
    font-size: var(--fs-sm);
    color: rgba(255, 255, 255, 0.5);
    margin: 0;
  }

  .careers-page .contact-strip__info {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .careers-page .contact-strip__info-item {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .careers-page .contact-strip__info-label {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.4);
    margin-bottom: 3px;
  }

  .careers-page .contact-strip__info-value {
    font-size: var(--fs-sm);
    color: rgba(255, 255, 255, 0.8);
  }

  .careers-page .contact-strip__info-icon {
    width: 36px;
    height: 36px;
    background: rgba(200, 98, 42, 0.15);
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-primary);
    flex-shrink: 0;
  }

  /* Scroll-reveal for job cards */
  .careers-page .job-card,
  .careers-page .careers-why__item,
  .careers-page .talent-perk,
  .careers-page .life-gallery__item {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.55s ease, transform 0.55s ease, border-color var(--transition-base), box-shadow var(--transition-base);
  }

  .careers-page .job-card.revealed,
  .careers-page .careers-why__item.revealed,
  .careers-page .talent-perk.revealed,
  .careers-page .life-gallery__item.revealed {
    opacity: 1;
    transform: translateY(0);
  }

  .careers-hero__sub {
    color: #AF2F09 !important;
  }

  /* Collapsible Description Styles */
  .careers-page .job-full-description {
    margin-top: 15px;
    padding-top: 10px;
    border-top: 1px solid var(--color-border);
  }

  .careers-page .btn-toggle-description {
    background: none;
    border: none;
    padding: 8px 0;
    color: var(--color-primary);
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all var(--transition-fast);
  }

  .careers-page .btn-toggle-description:hover {
    color: var(--color-primary-dark);
    gap: 12px;
  }

  .careers-page .btn-toggle-description .toggle-icon {
    transition: transform 0.3s ease;
    font-size: 0.9rem;
  }

  .careers-page .btn-toggle-description.active .toggle-icon {
    transform: rotate(180deg);
  }

  .careers-page .description-content {
    margin-top: 12px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: var(--radius-sm);
    border-left: 3px solid var(--color-primary);
  }

  .careers-page .description-inner {
    font-size: 0.9rem;
    line-height: 1.6;
    color: var(--color-gray-text);
  }

  .careers-page .description-inner p {
    margin-bottom: 10px;
  }

  .careers-page .description-inner ul,
  .careers-page .description-inner ol {
    margin-left: 20px;
    margin-bottom: 10px;
  }

  .careers-page .description-inner strong {
    color: var(--color-dark);
    font-weight: 600;
  }
</style>

{{-- Page wrapper with scoped class --}}
<div class="careers-page">
{{-- =============================================
       HERO SECTION - CAREERS (USING COMMON HERO)
       ============================================= --}}
<section class="page-hero">
    @if($careerbanner && $careerbanner->image)
    <div class="page-hero__bg" style="background-image: url('{{ asset($careerbanner->image) }}');"></div>
    @endif
    <div class="page-hero__overlay"></div>

    <div class="container page-hero__content">
        <nav class="page-hero__breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home.index') }}">Home</a>
            <span class="page-hero__breadcrumb-sep">/</span>
            <span class="current">Careers</span>
        </nav>

        @if($careerbanner && $careerbanner->title)
        @php
        $titleParts = explode('|', $careerbanner->title);
        $firstLine = trim($titleParts[0] ?? '');
        $secondLine = trim($titleParts[1] ?? '');
        @endphp
        <h1 class="page-hero__title">
            {{ $firstLine }}
            @if($secondLine)
            <span class="accent">{{ $secondLine }}</span>
            @endif
        </h1>
        @endif

        @if($careerbanner && $careerbanner->body)
        <p class="page-hero__desc">
            {!! strip_tags($careerbanner->body) !!}
        </p>
        @endif
    </div>
</section>

  {{-- =============================================
       WHY JOIN US
       ============================================= --}}


  <section class="careers-why">
    <div class="container">
      <div class="row g-0">


        @foreach($careerhighlights as $key => $highlight)
        <div class="col-6 col-md-3">
          <div class="careers-why__item">
            <div class="careers-why__icon">
              {{-- Display image as icon --}}
              <img src="{{ asset($highlight->image) }}" alt="{{ $highlight->title }}" style="width: 100%; height: auto; object-fit: contain;">
            </div>
            <h4 class="careers-why__title">{{ $highlight->title }}</h4>
            <p class="careers-why__text">{!! strip_tags($highlight->body) !!}</p>
          </div>
        </div>
        @endforeach


      </div>
    </div>
  </section>

  {{-- =============================================
       OPEN POSITIONS
       ============================================= --}}
  <section class="careers-positions">
    <div class="container">

      {{-- Section Header --}}
      <div class="row align-items-end gy-3 mb-4">
        <div class="col-md-5">
          <hr class="divider-primary" style="margin-bottom: 14px;" />
          <h2 class="section-title section-title--md mb-2">Open Positions</h2>
          <p style="font-size:var(--fs-sm); color:var(--color-gray-text); margin:0;">
            Explore opportunities to work on innovative projects and grow your career with us.
          </p>
        </div>
        <div class="col-md-7">
          <!-- Filter Form - Will submit on Enter key -->
          <form method="GET" action="{{ route('careers.index') }}" id="filterForm">
            <div class="positions-filters justify-content-md-end">
              <input type="text"
                name="search"
                class="search-input"
                id="searchInput"
                placeholder="🔍 Search by title, department, or location..."
                value="{{ request('search') }}">
              <select class="filter-select" name="department" id="deptFilter">
                <option value="">All Departments</option>
                @foreach($departments as $department)
                <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>
                  {{ $department }}
                </option>
                @endforeach
              </select>
              <select class="filter-select" name="location" id="locFilter">
                <option value="">All Locations</option>
                @foreach($locations as $location)
                <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                  {{ $location }}
                </option>
                @endforeach
              </select>
              <button type="submit" class="btn-apply-filter">
                Apply Filters &nbsp;<i class="bi bi-arrow-right"></i>
              </button>
              <a href="{{ route('careers.index') }}" class="btn-clear-filters">
                Clear Filters &nbsp;<i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      {{-- Job Cards --}}
      <div id="jobsList">
        @forelse($careerJobs as $careerJob)
        <div class="job-card">
          <div class="job-card__icon">
            <i class="bi bi-person-workspace"></i>
          </div>
          <div class="job-card__body">
            <h3 class="job-card__title">{{ $careerJob->title }}</h3>
            <p class="job-card__desc">{{ $careerJob->short_description }}</p>
            <div class="job-tags">
              <span class="job-tag">{{ $careerJob->department }}</span>
              <span class="job-tag">{{ $careerJob->experience }} Years Experience</span>
            </div>

            <!-- Collapsible Full Description -->
            <div class="job-full-description">
              <button class="btn-toggle-description" type="button">
                <span class="toggle-text">View Full Description</span>
                <i class="bi bi-chevron-down toggle-icon"></i>
              </button>
              <div class="description-content" style="display: none;">
                <div class="description-inner">
                  {!! nl2br(e($careerJob->description)) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="job-card__meta">
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                <circle cx="12" cy="10" r="3" />
              </svg>
              {{ $careerJob->location }}
            </div>
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="7" width="20" height="14" rx="2" />
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
              </svg>
              {{ ucfirst($careerJob->employment_type) }}
            </div>
            <a href="{{ route('careers.apply', $careerJob->id) }}" class="btn-apply">Apply Now &nbsp;<i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        @empty
        <div style="text-align:center; padding: 60px 0; color: var(--color-gray-light);">
          <i class="bi bi-search" style="font-size:3rem; color:var(--color-primary); display:block; margin-bottom:15px;"></i>
          <h4>No positions found</h4>
          <p style="font-size:0.9rem;">Try adjusting your search or filter criteria.</p>
        </div>
        @endforelse

        <!-- Pagination -->
        <div class="mt-4">
          {{ $careerJobs->appends(request()->query())->links() }}
        </div>
      </div>
    </div>
  </section>

  {{-- =============================================
       GREAT TALENT CTA
       ============================================= --}}

  {{-- =============================================
       LIFE AT OUTLINE
       ============================================= --}}




</div>{{-- end .careers-page --}}

{{-- =============================================
     PAGE-SPECIFIC SCRIPTS (Only for scroll reveal and gallery)
     ============================================= --}}

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Toggle description functionality
    const toggleButtons = document.querySelectorAll('.btn-toggle-description');

    toggleButtons.forEach(button => {
      button.addEventListener('click', function() {
        const descriptionContent = this.nextElementSibling;
        const toggleIcon = this.querySelector('.toggle-icon');
        const toggleText = this.querySelector('.toggle-text');

        if (descriptionContent.style.display === 'none' || descriptionContent.style.display === '') {
          descriptionContent.style.display = 'block';
          this.classList.add('active');
          toggleText.textContent = 'Hide Full Description';
        } else {
          descriptionContent.style.display = 'none';
          this.classList.remove('active');
          toggleText.textContent = 'View Full Description';
        }
      });
    });
  });
</script>
<script>
  (function() {
    'use strict';

    /* ── Scroll Reveal ── */
    const revealEls = document.querySelectorAll(
      '.careers-page .job-card, .careers-page .careers-why__item, .careers-page .talent-perk, .careers-page .life-gallery__item'
    );

    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.classList.add('revealed');
          }, 80 * (Array.from(revealEls).indexOf(entry.target) % 4));
          revealObserver.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.12
    });

    revealEls.forEach(el => revealObserver.observe(el));

    /* ── Gallery Nav (placeholder scroll) ── */
    const gallery = document.getElementById('lifeGallery');
    if (document.getElementById('galleryPrev')) {
      document.getElementById('galleryPrev').addEventListener('click', () => {
        gallery.scrollBy({
          left: -240,
          behavior: 'smooth'
        });
      });
      document.getElementById('galleryNext').addEventListener('click', () => {
        gallery.scrollBy({
          left: 240,
          behavior: 'smooth'
        });
      });
    }

  })();
</script>

@endsection