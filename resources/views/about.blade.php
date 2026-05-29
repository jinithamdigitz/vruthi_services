@extends('layouts.main')

@section('title', 'About Us | Outline Architects')


@section('content')


{{-- ══════════════════════════════════════
     HERO - DYNAMIC (ABOUT PAGE) - USING COMMON HERO
══════════════════════════════════════ --}}
<section class="page-hero">
    <div class="page-hero__bg" style="background-image: url('{{ asset($aboutBanner->image) }}');"></div>
    <div class="page-hero__overlay"></div>
    <div class="container page-hero__content">
        <nav class="page-hero__breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home.index') }}">Home</a>
            <span class="page-hero__breadcrumb-sep">›</span>
            <span class="current">About</span>
        </nav>

        @php
        $titleParts = explode('|', $aboutBanner->title);
        $firstLine = trim($titleParts[0]);
        $secondLine = trim($titleParts[1]);
        @endphp
        <h1 class="page-hero__title">
            {{ $firstLine }}
            <span class="accent">{{ $secondLine }}</span>
        </h1>

        <p class="page-hero__desc">
            {!! strip_tags($aboutBanner->body) !!}
        </p>

        {{-- Optional: Add actions/buttons if needed --}}
        {{-- 
        <div class="page-hero__actions">
            <a href="#story" class="btn-primary-custom btn-outline-custom">Our Story</a>
            <a href="{{ route('contact.index') }}" class="btn-outline-white btn-outline-custom">Get in Touch</a>
        </div>
        --}}
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
                        <p>{!! strip_tags($ourStoryTitle->body) !!}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 order-lg-2 order-1">
                <span class="section-label">{{ $ourStoryTitle->title }}</span>
                <h2 class="section-title section-title--lg mb-3">
                    {!! $ourStory->title !!}
                </h2>
                <hr class="divider-primary">

                <div class="about-pg__story-body">
                    <p>{!! $ourStory->body !!}</p>
                </div>

                <a href="{{ $ourStory->button_url ?? route('home.portfolio') }}" class="btn-outline-custom btn-secondary-custom mt-2">
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
                <h2 class="about-pg__values-title mt-1">{!! strip_tags($ourValueTitle->body) !!}</h2>
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
                <span class="section-label">{!! strip_tags($memberTitle['title']) !!}</span>
                <h2 class="about-section-title section-title--lg mt-1">{!! strip_tags($memberTitle['body']) !!}</h2>
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
