@extends('layouts.main')

@section('title', 'About Us | Outline Architects')


@section('content')



<!-- =============================================
       HERO SECTION
       ============================================= -->
<section class="home-hero" id="home-hero">
  <div class="home-hero__left">
    <div class="home-hero__content">
      <p class="home-hero__breadcrumb animate-fade-up">
        Architecture &nbsp;/&nbsp; Interior Design &nbsp;/&nbsp; <span>Project Management</span>
      </p>

      <h1 class="home-hero__title animate-fade-up delay-100">
        @if($homebanner && $homebanner->title)
        {!! $homebanner->title !!}
        @endif
      </h1>

      <p class="home-hero__sub animate-fade-up delay-200">
        @if($homebanner && $homebanner->body)
        {{ strip_tags($homebanner->body) }}
        @endif
      </p>

      <div class="home-hero__actions animate-fade-up delay-300">
        <a href="#home-services" class="btn-outline-custom btn-primary-custom">
          Our Services &nbsp;<i class="bi bi-arrow-right"></i>
        </a>
        <a href="#home-portfolio" class="btn-outline-custom hero-btn-ghost">
          View Portfolio
        </a>
      </div>

      <div class="mt-4 animate-fade-up delay-400">
        <button class="play-btn" onclick="openVideoModal('https://www.youtube.com/watch?v=your-video-id')">
          <span class="play-btn__circle"><i class="bi bi-play-fill"></i></span>
          &nbsp;See How We Work
        </button>
      </div>
    </div>
  </div>
  <div class="home-hero__right">
    @if($homebanner && $homebanner->image)
    <img src="{{ asset($homebanner->image) }}" alt="{{ $homebanner->title ?? 'Outline Architects' }}" />
    @endif
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

{{-- ════════════════════════════════════════════
     TEAM
════════════════════════════════════════════ --}}
<section class="about-pg__team section-pad">
    <div class="container">

        <div class="row mb-5">
            <div class="col-12">
                <span class="section-label">Meet Our Leadership</span>
                <h2 class="section-title section-title--lg mt-1">The Minds Behind the Vision</h2>
            </div>
        </div>

        <div class="row g-4">

            {{-- Team Member 1 --}}
            <div class="col-sm-6 col-xl-3">
                <div class="about-pg__team-card">
                    <div class="about-pg__team-img-wrap">
                        <img src="{{ asset('images/team/rahul-sharma.jpg') }}"
                            alt="Rahul Sharma" loading="lazy">
                    </div>
                    <div class="about-pg__team-body">
                        <h5>Rahul Sharma</h5>
                        <span class="about-pg__team-role">Founder &amp; CEO</span>
                        <p>Visionary leader with 20+ years of experience in architecture and project management.</p>
                        <a href="#" class="about-pg__team-linkedin" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Team Member 2 --}}
            <div class="col-sm-6 col-xl-3">
                <div class="about-pg__team-card">
                    <div class="about-pg__team-img-wrap">
                        <img src="{{ asset('images/team/anita-verma.jpg') }}"
                            alt="Anita Verma" loading="lazy">
                    </div>
                    <div class="about-pg__team-body">
                        <h5>Anita Verma</h5>
                        <span class="about-pg__team-role">Design Director</span>
                        <p>Creative strategist passionate about transforming ideas into extraordinary spaces.</p>
                        <a href="#" class="about-pg__team-linkedin" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Team Member 3 --}}
            <div class="col-sm-6 col-xl-3">
                <div class="about-pg__team-card">
                    <div class="about-pg__team-img-wrap">
                        <img src="{{ asset('images/team/karan-mehta.jpg') }}"
                            alt="Karan Mehta" loading="lazy">
                    </div>
                    <div class="about-pg__team-body">
                        <h5>Karan Mehta</h5>
                        <span class="about-pg__team-role">Project Director</span>
                        <p>Expert in delivering complex projects with precision, quality, and on-time execution.</p>
                        <a href="#" class="about-pg__team-linkedin" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Team Member 4 --}}
            <div class="col-sm-6 col-xl-3">
                <div class="about-pg__team-card">
                    <div class="about-pg__team-img-wrap">
                        <img src="{{ asset('images/team/neha-iyer.jpg') }}"
                            alt="Neha Iyer" loading="lazy">
                    </div>
                    <div class="about-pg__team-body">
                        <h5>Neha Iyer</h5>
                        <span class="about-pg__team-role">Operations Director</span>
                        <p>Drives operational excellence and ensures seamless project delivery across teams.</p>
                        <a href="#" class="about-pg__team-linkedin" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>

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
