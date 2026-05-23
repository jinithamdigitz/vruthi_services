@extends('layouts.main')

@section('title', 'About Us | Outline Architects')


@section('content')



{{-- ══════════════════════════════════════
     HERO - DYNAMIC (ABOUT PAGE)
══════════════════════════════════════ --}}
<section class="abt-pg__hero">
    <div class="abt-pg__hero-bg" style="background-image: url('{{ asset($aboutBanner->image) }}');"></div>
    <div class="abt-pg__hero-overlay"></div>
    <div class="container abt-pg__hero-content">
        <nav class="abt-pg__breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home.index') }}">Home</a>
            <span class="abt-pg__breadcrumb-sep">›</span>
            <span>About</span>
        </nav>

        @php
        $titleParts = explode('|', $aboutBanner->title);
        $firstLine = trim($titleParts[0]);
        $secondLine = trim($titleParts[1]);
        @endphp
        <h1 class="abt-pg__hero-title">
            {{ $firstLine }}
            <span class="abt-pg__accent">{{ $secondLine }}</span>
        </h1>

        <p class="abt-pg__hero-desc">
            {!! strip_tags($aboutBanner->body) !!}
        </p>

        <a href="{{ route('contact') }}" class="btn-outline-custom btn-primary-custom">
            Get in Touch
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>
</section>
<!-- =============================================
       STATS SECTION
       ============================================= -->
<section class="home-stats" id="home-stats">
  <div class="container home-stats__inner">
    <div class="row text-center">
      @foreach($counters as $counter)
      <div class="col-6 col-md-3 home-stats__item">
        <div class="home-stats__icon mx-auto">
          @if($counter->image)
          <img src="{{ asset($counter->image) }}" alt="{{ $counter->title }}" class="stats-icon-img">
          @endif
        </div>
        @if($counter->title)
        <div class="stat-box__number stat-box__number--light">{{ $counter->title }}</div>
        @endif
        @if($counter->body)
        <div class="stat-box__label stat-box__label--light">{!! $counter->body !!}</div>
        @endif
      </div>
      @endforeach
    </div>
  </div>
</section>


{{-- ════════════════════════════════════════════
     OUR STORY
════════════════════════════════════════════ --}}
@if($ourStoryTitle && $ourStory)
<section class="about-pg__story section-pad">
    <div class="container">
        <div class="row align-items-center g-5">

            {{-- Image LEFT --}}
            <div class="col-lg-6 order-lg-1 order-2">
                <div class="about-pg__story-img-wrap">
                    <img src="{{ $ourStory->image }}"
                        alt="{{ $ourStoryTitle->title }}"
                        loading="lazy">

                    {{-- Floating promise card --}}
                    <div class="about-pg__story-promise">
                        <p>{!! $ourStoryTitle->body !!}</p>
                    </div>
                </div>
            </div>

            {{-- Copy RIGHT --}}
            <div class="col-lg-6 order-lg-2 order-1">
                <span class="section-label">{{ $ourStoryTitle->title }}</span>
                <h2 class="section-title section-title--lg mb-3">
                    {!! $ourStory->title !!}
                </h2>
                <hr class="divider-primary">

                <div class="about-pg__story-body">
                    <p>{!! $ourStory->body !!}</p>
                </div>

                <a href="{{ $ourStory->button_url ?? route('home.index') }}" class="btn-outline-custom btn-secondary-custom mt-2">
                    {{ $ourStory->button_text }} <span class="arrow">→</span>
                </a>
            </div>

        </div>
    </div>
</section>
@endif

{{-- ════════════════════════════════════════════
     VALUES / PRINCIPLES
════════════════════════════════════════════ --}}
@if($ourValueTitle && $ourValues && $ourValues->count() > 0)
<section class="about-pg__values section-pad">
    <div class="container">

        {{-- Section header --}}
        <div class="row mb-5">
            <div class="col-12 text-center">
                <span class="section-label">{{ $ourValueTitle->title }}</span>
                <h2 class="about-pg__values-title mt-1">{!! $ourValueTitle->body !!}</h2>
            </div>
        </div>

        {{-- Value cards --}}
        <div class="row g-4 justify-content-center">
            @foreach($ourValues as $value)
            <div class="col-sm-6 col-lg-4 col-xl">
                <div class="about-pg__value-card">
                    <div class="about-pg__value-icon">
                        <img src="{{ asset($value->image) }}" alt="{{ $value->title }}">
                    </div>
                    <h5>{{ $value->title }}</h5>
                    <p>{!! $value->body !!}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<hr class="orange-hr">

{{-- ════════════════════════════════════════════
     TEAM
════════════════════════════════════════════ --}}
<section class="about-pg__team section-pad">
    <div class="container">

        <div class="row mb-5">
            <div class="col-12">
                <span class="section-label">{{ $memberTitle['title'] }}</span>
                <h2 class="section-title section-title--lg mt-1">{!! $memberTitle['body'] !!}</h2>
            </div>
        </div>

        <div class="row g-4">
            @foreach($members as $member)
            <div class="col-sm-6 col-xl-3">
                <div class="about-pg__team-card">
                    <div class="about-pg__team-img-wrap">
                        <img src="{{ asset($member->image) }}" 
                            alt="{{ $member->name }}" 
                            loading="lazy">
                    </div>
                    <div class="about-pg__team-body">
                        <h5>{{ $member->name }}</h5>
                        <span class="about-pg__team-role">{{ $member->designation }}</span>
                        <p>{{ $member->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
</section>


<!-- =============================================
       CTA SECTION
       ============================================= -->
<section class="home-cta" id="home-cta">
  @if($ctasection && $ctasection->image)
  <div class="home-cta__bg" style="background-image: url('{{ asset($ctasection->image) }}');"></div>
  @endif
  <div class="home-cta__bg-overlay"></div>
  <div class="container home-cta__content text-center">
    <span class="section-label cta-label">Let's Build Together</span>
    @if($ctasection && $ctasection->title)
    <h2 class="section-title section-title--xl section-title--light mt-2 mb-3 cta-title-orange">
      {{ $ctasection->title }}
    </h2>
    @endif
    @if($ctasection && $ctasection->body)
    <p class="cta-body-white">
      {{ strip_tags($ctasection->body) }}
    </p>
    @endif
    <a href="#home-contact" class="btn-outline-custom btn-primary-custom cta-btn">
      Get In Touch &nbsp;<i class="bi bi-arrow-right"></i>
    </a>
  </div>
</section>

@endsection


<script>
    /* About page — counter animation on scroll */
    (function() {
        'use strict';

        function animateCounter(el, target, duration) {
            var start = 0;
            var increment = target / (duration / 16);
            var timer = setInterval(function() {
                start += increment;
                if (start >= target) {
                    start = target;
                    clearInterval(timer);
                }
                el.textContent = Math.floor(start) + '+';
            }, 16);
        }

        var counters = document.querySelectorAll('.about-pg__stat-num');
        if (!counters.length) return;

        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting && !entry.target.dataset.counted) {
                    entry.target.dataset.counted = '1';
                    var raw = entry.target.textContent.replace(/\D/g, '');
                    animateCounter(entry.target, parseInt(raw, 10), 1400);
                }
            });
        }, {
            threshold: 0.5
        });

        counters.forEach(function(c) {
            observer.observe(c);
        });
    })();
</script>
