@extends('layouts.main')

@section('content')

{{-- =============================================
     PAGE-SCOPED CAREERS CSS
     Namespaced under .careers-page to avoid conflicts
     ============================================= --}}
<style>
  /* ── CAREERS HERO ── */
  .careers-page .careers-hero {
    position: relative;
    min-height: 62vh;
    display: flex;
    align-items: flex-end;
    overflow: hidden;
  }

  .careers-page .careers-hero__bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center 30%;
    background-image: url('{{ asset("assets/img/careers-hero.jpg") }}');
  }

  .careers-page .careers-hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      to right,
      rgba(0, 0, 0, 0.88) 0%,
      rgba(0, 0, 0, 0.55) 55%,
      rgba(0, 0, 0, 0.18) 100%
    );
  }

  .careers-page .careers-hero__content {
    position: relative;
    z-index: 2;
    padding: 140px 0 72px;
  }

  .careers-page .careers-hero__breadcrumb {
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.5);
    margin-bottom: 20px;
  }

  .careers-page .careers-hero__breadcrumb span {
    color: var(--color-primary);
  }

  .careers-page .careers-hero__title {
    font-family: var(--font-heading);
    font-size: clamp(2.4rem, 5vw, 4rem);
    font-weight: var(--fw-bold);
    color: #fff;
    line-height: 1.1;
    margin-bottom: 18px;
  }

  .careers-page .careers-hero__title em {
    font-style: normal;
    color: var(--color-primary);
  }

  .careers-page .careers-hero__sub {
    font-size: var(--fs-base);
    color: rgba(255, 255, 255, 0.65);
    max-width: 400px;
    line-height: 1.8;
  }

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

  /* Search highlight */
  .careers-page .search-highlight {
    background-color: rgba(200, 98, 42, 0.2);
    color: var(--color-primary);
    font-weight: 600;
    padding: 0 2px;
    border-radius: 3px;
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
    background: linear-gradient(to top, rgba(0,0,0,0.45) 0%, transparent 60%);
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
    border-top: 1px solid rgba(255,255,255,0.06);
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
    color: rgba(255,255,255,0.4);
    margin-bottom: 3px;
  }

  .careers-page .contact-strip__info-value {
    font-size: var(--fs-sm);
    color: rgba(255,255,255,0.8);
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
</style>

{{-- Page wrapper with scoped class --}}
<div class="careers-page">

  {{-- =============================================
       HERO
       ============================================= --}}
  <section class="careers-hero">
    <div class="careers-hero__bg"></div>
    <div class="careers-hero__overlay"></div>
    <div class="container">
      <div class="careers-hero__content">
        <p class="careers-hero__breadcrumb">Home &nbsp;/&nbsp; <span>Careers</span></p>
        <h1 class="careers-hero__title">
          Build Your Career<br>
          <em>Design the Future.</em>
        </h1>
        <p class="careers-hero__sub">
          Join Outline Architects and be part of a team that creates inspiring spaces and meaningful impact.
        </p>
      </div>
    </div>
  </section>

  {{-- =============================================
       WHY JOIN US
       ============================================= --}}
  <section class="careers-why">
    <div class="container">
      <div class="row g-0">

        <div class="col-6 col-md-3">
          <div class="careers-why__item">
            <div class="careers-why__icon">
              {{-- Growth & Learning --}}
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
              </svg>
            </div>
            <h4 class="careers-why__title">Growth &amp; Learning</h4>
            <p class="careers-why__text">Continuous learning and career development</p>
          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="careers-why__item">
            <div class="careers-why__icon">
              {{-- Great Culture --}}
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z"/>
              </svg>
            </div>
            <h4 class="careers-why__title">Great Culture</h4>
            <p class="careers-why__text">Collaborative, inclusive, and supportive team</p>
          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="careers-why__item">
            <div class="careers-why__icon">
              {{-- Meaningful Work --}}
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                <line x1="8" y1="21" x2="16" y2="21"/>
                <line x1="12" y1="17" x2="12" y2="21"/>
              </svg>
            </div>
            <h4 class="careers-why__title">Meaningful Work</h4>
            <p class="careers-why__text">Work on impactful projects that shape communities</p>
          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="careers-why__item">
            <div class="careers-why__icon">
              {{-- Work-Life Balance --}}
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
            </div>
            <h4 class="careers-why__title">Work-Life Balance</h4>
            <p class="careers-why__text">Flexible environment that respects your life</p>
          </div>
        </div>

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
          <div class="positions-filters justify-content-md-end">
            <!-- Search Input Added Here -->
            <input type="text" 
                   class="search-input" 
                   id="searchInput" 
                   placeholder="🔍 Search by title, department, or location..." 
                   onkeyup="filterJobs()">
            <select class="filter-select" id="deptFilter" onchange="filterJobs()">
              <option value="">All Departments</option>
              <option value="Architecture">Architecture</option>
              <option value="Project Management">Project Management</option>
              <option value="Interior Design">Interior Design</option>
              <option value="BIM">BIM</option>
              <option value="Visualization">Visualization</option>
            </select>
            <select class="filter-select" id="locFilter" onchange="filterJobs()">
              <option value="">All Locations</option>
              <option value="Dubai, UAE">Dubai, UAE</option>
              <option value="Pune, India">Pune, India</option>
            </select>
            <button class="btn-clear-filters" onclick="clearFilters()">
              Clear Filters &nbsp;<i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>
      </div>

      {{-- Job Cards --}}
      <div id="jobsList">
        @forelse($careerJobs as $careerJob)
        <div class="job-card" data-dept="Architecture" data-loc="Dubai, UAE" data-title="Senior Architect" data-desc="Lead architectural projects from concept to completion and mentor junior team members.">
          <div class="job-card__icon">
            <i class="bi bi-person-workspace"></i>
          </div>
          <div class="job-card__body">
            <h3 class="job-card__title">Senior Architect ggg</h3>
            <p class="job-card__desc">Lead architectural projects from concept to completion and mentor junior team members.</p>
            <div class="job-tags">
              <span class="job-tag">Architecture</span>
              <span class="job-tag">5+ Years Experience</span>
            </div>
          </div>
          <div class="job-card__meta">
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Dubai, UAE
            </div>
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
              Full-time
            </div>
            <a href="#careers-contact-strip" class="btn-apply">Apply Now &nbsp;<i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
		
		  @empty
        {{-- No Results --}}
        <div id="noJobsMsg" style="display:none; text-align:center; padding: 40px 0; color: var(--color-gray-light);">
          <i class="bi bi-search" style="font-size:2rem; color:var(--color-primary); display:block; margin-bottom:10px;"></i>
          <p>No positions found matching your search criteria.</p>
          <p style="font-size:0.85rem;">Try adjusting your filters or search terms.</p>
        </div>
		
		 @endforelse


        <div class="job-card" data-dept="Project Management" data-loc="Dubai, UAE" data-title="Project Manager" data-desc="Manage project timelines, budgets, and resources to ensure successful delivery.">
          <div class="job-card__icon">
            <i class="bi bi-clipboard-data"></i>
          </div>
          <div class="job-card__body">
            <h3 class="job-card__title">Project Manager</h3>
            <p class="job-card__desc">Manage project timelines, budgets, and resources to ensure successful delivery.</p>
            <div class="job-tags">
              <span class="job-tag">Project Management</span>
              <span class="job-tag">5+ Years Experience</span>
            </div>
          </div>
          <div class="job-card__meta">
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Dubai, UAE
            </div>
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
              Full-time
            </div>
            <a href="#careers-contact-strip" class="btn-apply">Apply Now &nbsp;<i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="job-card" data-dept="Interior Design" data-loc="Dubai, UAE" data-title="Interior Designer" data-desc="Design functional and aesthetic interiors that reflect client needs and brand identity.">
          <div class="job-card__icon">
            <i class="bi bi-palette"></i>
          </div>
          <div class="job-card__body">
            <h3 class="job-card__title">Interior Designer</h3>
            <p class="job-card__desc">Design functional and aesthetic interiors that reflect client needs and brand identity.</p>
            <div class="job-tags">
              <span class="job-tag">Interior Design</span>
              <span class="job-tag">3+ Years Experience</span>
            </div>
          </div>
          <div class="job-card__meta">
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Dubai, UAE
            </div>
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
              Full-time
            </div>
            <a href="#careers-contact-strip" class="btn-apply">Apply Now &nbsp;<i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="job-card" data-dept="BIM" data-loc="Dubai, UAE" data-title="BIM Coordinator" data-desc="Coordinate BIM models and ensure accuracy across all project disciplines.">
          <div class="job-card__icon">
            <i class="bi bi-grid-3x3-gap"></i>
          </div>
          <div class="job-card__body">
            <h3 class="job-card__title">BIM Coordinator</h3>
            <p class="job-card__desc">Coordinate BIM models and ensure accuracy across all project disciplines.</p>
            <div class="job-tags">
              <span class="job-tag">BIM</span>
              <span class="job-tag">3+ Years Experience</span>
            </div>
          </div>
          <div class="job-card__meta">
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Dubai, UAE
            </div>
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
              Full-time
            </div>
            <a href="#careers-contact-strip" class="btn-apply">Apply Now &nbsp;<i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="job-card" data-dept="Visualization" data-loc="Dubai, UAE" data-title="Architectural Visualizer" data-desc="Create high-quality 3D visualizations and animations for presentations and marketing.">
          <div class="job-card__icon">
            <i class="bi bi-camera-video"></i>
          </div>
          <div class="job-card__body">
            <h3 class="job-card__title">Architectural Visualizer</h3>
            <p class="job-card__desc">Create high-quality 3D visualizations and animations for presentations and marketing.</p>
            <div class="job-tags">
              <span class="job-tag">Visualization</span>
              <span class="job-tag">3+ Years Experience</span>
            </div>
          </div>
          <div class="job-card__meta">
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Dubai, UAE
            </div>
            <div class="job-meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
              Full-time
            </div>
            <a href="#careers-contact-strip" class="btn-apply">Apply Now &nbsp;<i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
		
		 <div class="mt-3">
                    {{ $careerJobs->appends(request()->query())->links() }}
                </div>
        
      </div>
    </div>
  </section>

  {{-- =============================================
       GREAT TALENT CTA
       ============================================= --}}
  <section class="careers-talent">
    <div class="careers-talent__bg"></div>
    <div class="careers-talent__inner">
      <div class="container">
        <div class="row align-items-center gy-5">

          <div class="col-lg-5 careers-talent__left">
            <p class="talent-label">— <span>Join Our Team</span></p>
            <h2 class="careers-talent__title">
              We're Always Looking for<br>
              <em>Great Talent.</em>
            </h2>
            <p class="careers-talent__sub">
              If you're passionate about design and innovation, we'd love to hear from you.
            </p>
            <a href="mailto:careers@outlinearchitects.ae" class="btn-send-cv">
              Send Your CV &nbsp;<i class="bi bi-arrow-right"></i>
            </a>
          </div>

          <div class="col-lg-7">
            <div class="talent-perks">

              <div class="talent-perk">
                <div class="talent-perk__icon"><i class="bi bi-people"></i></div>
                <div>
                  <h5 class="talent-perk__title">Be Part of a Creative Team</h5>
                  <p class="talent-perk__text">Work with talented professionals who inspire and challenge you.</p>
                </div>
              </div>

              <div class="talent-perk">
                <div class="talent-perk__icon"><i class="bi bi-rocket-takeoff"></i></div>
                <div>
                  <h5 class="talent-perk__title">Work on Exciting Projects</h5>
                  <p class="talent-perk__text">From concept to completion, see your ideas come to life.</p>
                </div>
              </div>

              <div class="talent-perk">
                <div class="talent-perk__icon"><i class="bi bi-graph-up-arrow"></i></div>
                <div>
                  <h5 class="talent-perk__title">Grow Your Career</h5>
                  <p class="talent-perk__text">We invest in your growth and support your ambitions.</p>
                </div>
              </div>

              <div class="talent-perk">
                <div class="talent-perk__icon"><i class="bi bi-award"></i></div>
                <div>
                  <h5 class="talent-perk__title">Make a Difference</h5>
                  <p class="talent-perk__text">Help shape spaces that make a positive impact.</p>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  {{-- =============================================
       LIFE AT OUTLINE
       ============================================= --}}
  <section class="careers-life">
    <div class="container">

      <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-2">
        <div>
          <span class="section-label">Life at Outline</span>
          <h2 class="section-title section-title--md mt-1 mb-0">Our Culture &amp; Workspace</h2>
        </div>
        <div class="gallery-nav">
          <button class="gallery-nav-btn" id="galleryPrev" aria-label="Previous"><i class="bi bi-chevron-left"></i></button>
          <button class="gallery-nav-btn" id="galleryNext" aria-label="Next"><i class="bi bi-chevron-right"></i></button>
        </div>
      </div>

      <div class="life-gallery" id="lifeGallery">
        <div class="life-gallery__item">
          <img src="{{ asset('assets/img/life-1.jpg') }}" alt="Team collaboration at Outline Architects" loading="lazy" />
        </div>
        <div class="life-gallery__item">
          <img src="{{ asset('assets/img/life-2.jpg') }}" alt="Design studio workspace" loading="lazy" />
        </div>
        <div class="life-gallery__item">
          <img src="{{ asset('assets/img/life-3.jpg') }}" alt="Modern office lounge" loading="lazy" />
        </div>
        <div class="life-gallery__item">
          <img src="{{ asset('assets/img/life-4.jpg') }}" alt="Team meeting at Outline" loading="lazy" />
        </div>
      </div>

    </div>
  </section>

  {{-- =============================================
       CONTACT STRIP
       ============================================= --}}
  <section class="careers-contact-strip" id="careers-contact-strip">
    <div class="container">
      <div class="row align-items-center gy-4">

        <div class="col-lg-4">
          <span class="section-label" style="color: rgba(255,255,255,0.4);">Life at Outline?</span>
          <h2 class="contact-strip__title">We'd Love to Hear From You</h2>
          <p class="contact-strip__sub">Reach out to our HR team for any career-related inquiries.</p>
        </div>

        <div class="col-lg-3 col-md-4 d-flex align-items-center">
          <a href="#" class="btn-send-cv">Contact Us &nbsp;<i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="col-lg-5 col-md-8">
          <div class="row gy-3">
            <div class="col-4 text-center">
              <div class="contact-strip__info-label">Email Us</div>
              <div class="contact-strip__info-value" style="font-size:0.8rem;">careers@outline.ae</div>
            </div>
            <div class="col-4 text-center">
              <div class="contact-strip__info-label">Call Us</div>
              <div class="contact-strip__info-value" style="font-size:0.8rem;">+971 4 123 4567</div>
            </div>
            <div class="col-4 text-center">
              <div class="contact-strip__info-label">Visit Us</div>
              <div class="contact-strip__info-value" style="font-size:0.8rem;">Dubai, UAE</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

</div>{{-- end .careers-page --}}

{{-- =============================================
     PAGE-SPECIFIC SCRIPTS
     ============================================= --}}
<script>
  (function () {
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
    }, { threshold: 0.12 });

    revealEls.forEach(el => revealObserver.observe(el));

    /* ── Job Filtering with Search ── */
    window.filterJobs = function () {
      const dept = document.getElementById('deptFilter').value;
      const loc  = document.getElementById('locFilter').value;
      const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
      const cards = document.querySelectorAll('#jobsList .job-card');
      let visible = 0;

      cards.forEach(card => {
        const matchDept = !dept || card.dataset.dept === dept;
        const matchLoc  = !loc  || card.dataset.loc  === loc;
        
        // Search matching - check title and description
        let matchSearch = true;
        if (searchTerm) {
          const title = (card.dataset.title || '').toLowerCase();
          const desc = (card.dataset.desc || '').toLowerCase();
          const deptText = (card.dataset.dept || '').toLowerCase();
          const locText = (card.dataset.loc || '').toLowerCase();
          
          matchSearch = title.includes(searchTerm) || 
                       desc.includes(searchTerm) || 
                       deptText.includes(searchTerm) || 
                       locText.includes(searchTerm);
        }
        
        const show = matchDept && matchLoc && matchSearch;
        card.style.display = show ? 'flex' : 'none';
        if (show) visible++;
      });

      document.getElementById('noJobsMsg').style.display = visible === 0 ? 'block' : 'none';
      
      // Optional: Add highlight to search terms (uncomment if needed)
      if (searchTerm) {
        highlightSearchTerms(searchTerm);
      } else {
        removeHighlights();
      }
    };

    window.clearFilters = function () {
      document.getElementById('deptFilter').value = '';
      document.getElementById('locFilter').value = '';
      document.getElementById('searchInput').value = '';
      filterJobs();
    };
    
    // Optional: Highlight search terms in job cards
    function highlightSearchTerms(term) {
      removeHighlights();
      const cards = document.querySelectorAll('#jobsList .job-card');
      cards.forEach(card => {
        if (card.style.display !== 'none') {
          const titleElem = card.querySelector('.job-card__title');
          const descElem = card.querySelector('.job-card__desc');
          
          if (titleElem && titleElem.innerText.toLowerCase().includes(term)) {
            highlightText(titleElem, term);
          }
          if (descElem && descElem.innerText.toLowerCase().includes(term)) {
            highlightText(descElem, term);
          }
        }
      });
    }
    
    function highlightText(element, term) {
      const regex = new RegExp(`(${term})`, 'gi');
      element.innerHTML = element.innerText.replace(regex, '<span class="search-highlight">$1</span>');
    }
    
    function removeHighlights() {
      const cards = document.querySelectorAll('#jobsList .job-card');
      cards.forEach(card => {
        const titleElem = card.querySelector('.job-card__title');
        const descElem = card.querySelector('.job-card__desc');
        if (titleElem && titleElem.innerHTML.includes('search-highlight')) {
          titleElem.innerHTML = titleElem.innerText;
        }
        if (descElem && descElem.innerHTML.includes('search-highlight')) {
          descElem.innerHTML = descElem.innerText;
        }
      });
    }

    /* ── Gallery Nav (placeholder scroll) ── */
    const gallery = document.getElementById('lifeGallery');
    document.getElementById('galleryPrev').addEventListener('click', () => {
      gallery.scrollBy({ left: -240, behavior: 'smooth' });
    });
    document.getElementById('galleryNext').addEventListener('click', () => {
      gallery.scrollBy({ left: 240, behavior: 'smooth' });
    });

    // Add Enter key support for search
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        filterJobs();
      }
    });

  })();
</script>

@endsection