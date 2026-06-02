@extends('layouts.main')

@section('content')

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