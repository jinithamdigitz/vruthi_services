@extends('layouts.main')

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
          @php
            $titleParts = explode('|', $homebanner->title);
            $firstLine = trim($titleParts[0]);
            $secondLine = isset($titleParts[1]) ? trim($titleParts[1]) : '';
          @endphp
          {{ $firstLine }}
          @if($secondLine)
            <span class="home-hero__accent">{{ $secondLine }}</span>
          @endif
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

    </div>
  </div>
  <div class="home-hero__right">
    @if($homebanner && $homebanner->image)
    <img src="{{ asset($homebanner->image) }}" alt="{{ $homebanner->title ?? 'Outline Architects' }}" />
    @endif
  </div>
</section>

<!-- =============================================
       ABOUT SECTION
       ============================================= -->
<section class="section-pad section-bg-white" id="home-about">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-5 animate-fade-left">
        <div class="home-about__img-wrap">
          @if($about_us && $about_us->image)
          <img src="{{ asset($about_us->image) }}" alt="{{ $aboutUSTitle->title ?? '' }}" />
          @endif

          @if($aboutUSTitle && $aboutUSTitle->body)
          <div class="home-about__badge">
            {!! $aboutUSTitle->body !!}
          </div>
          @endif
        </div>
      </div>
      <div class="col-lg-6 offset-lg-1 animate-fade-right">
        @if($aboutUSTitle && $aboutUSTitle->title)
        <span class="section-label">{{ $aboutUSTitle->title }}</span>
        @endif

        @if($about_us && $about_us->title)
        <h2 class="section-title section-title--lg mb-3">
          {!! $about_us->title !!}
        </h2>
        @endif

        <hr class="divider-primary" />

        @if($about_us && $about_us->body)
        <p class="section-subtitle mb-4">
          {!! $about_us->body !!}
        </p>
        @endif

        <a href="#" class="btn-outline-custom btn-primary-custom">
          More About Us &nbsp;<i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- =============================================
       SERVICES SECTION
       ============================================= -->
<section class="section-pad" id="home-services">
  <div class="container">
    <div class="row align-items-end mb-5">
      <div class="col-lg-6">
        @if($service_title && $service_title->title)
        <span class="section-label">{{ $service_title->title }}</span>
        @endif
        @if($service_title && $service_title->body)
        <h2 class="service-section-title section-title--lg mb-0">
          {{ strip_tags($service_title->body) }}
        </h2>
        @endif
      </div>
      <div class="col-lg-6 text-lg-end mt-3 mt-lg-0">
        <a href="#" class="btn-text-link services-view-all">
          View All Services <span class="arrow">→</span>
        </a>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-lg-5">
        @if($service_title && $service_title->image)
        <div class="h-100 rounded-3 overflow-hidden services-featured-wrap">
          <img src="{{ asset($service_title->image) }}" alt="Services" class="services-featured-img" />
        </div>
        @endif
      </div>
      <div class="col-lg-7">
        <div class="row g-3 h-100">
          @foreach($services as $key => $service)
          @if($key == 4)
          <div class="col-12">
            <div class="service-card">
              <div class="d-flex align-items-start gap-3">
                <div class="service-card__icon-img flex-shrink-0">
                  @if($service->icon_image)
                  <img src="{{ asset($service->icon_image) }}" alt="{{ $service->title }}">
                  @endif
                </div>
                <div class="home-services__card-link flex-grow-1">
                  <div>
                    @if($service->title)
                    <div class="service-card__title">{{ $service->title }}</div>
                    @endif
                    @if($service->body)
                    <p class="service-card__text mb-0">{{ Str::limit($service->body, 100) }}</p>
                    @endif
                  </div>
                  <a href="#" class="service-arrow">
                    <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          @else
          <div class="col-sm-6">
            <div class="service-card h-100">
              <div class="service-card__icon-img">
                @if($service->icon_image)
                <img src="{{ asset($service->icon_image) }}" alt="{{ $service->title }}">
                @endif
              </div>
              <div class="home-services__card-link">
                <div>
                  @if($service->title)
                  <div class="service-card__title">{{ $service->title }}</div>
                  @endif
                  @if($service->body)
                  <p class="service-card__text">{{ Str::limit($service->body, 80) }}</p>
                  @endif
                </div>
                <a href="#" class="service-arrow">
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =============================================
       PORTFOLIO / FEATURED WORK
       ============================================= -->
<section class="section-pad home-portfolio" id="home-portfolio">
  <div class="container">
    <div class="row align-items-end mb-4">
      <div class="col-lg-7">
        <span class="section-label">Featured Work</span>
        @if($featured_work_title && $featured_work_title->title)
        <h2 class="section-title section-title--lg mb-2">{!! $featured_work_title->title !!}</h2>
        @endif
        @if($featured_work_title && $featured_work_title->body)
        <p class="section-subtitle">{!! $featured_work_title->body !!}</p>
        @endif
      </div>
      <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
        <a href="#" class="btn-text-link">Explore Portfolio <span class="arrow">→</span></a>
      </div>
    </div>
    <div class="row g-3">
      @forelse($featured_work as $project)
      <div class="col-md-6 col-lg-4">
        <div class="project-card">
          @if($project->image)
          <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" class="home-portfolio__project-img" />
          @endif
          <div class="project-card__overlay">
            @if($project->title)
            <div class="project-card__title">{{ $project->title }}</div>
            @endif
            @if($project->location)
            <div class="project-card__location">{!! $project->location !!}</div>
            @endif
          </div>
        </div>
      </div>
      @empty
      <div class="col-12">
        <p class="text-center">No portfolio items found.</p>
      </div>
      @endforelse
    </div>
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

<!-- =============================================
       WHY CHOOSE US
       ============================================= -->
<section class="section-pad section-bg-white" id="home-why">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6 order-2 order-lg-1 animate-fade-left">
        @if($whychooseustitle && $whychooseustitle->title)
        <span class="section-label">{{ $whychooseustitle->title }}</span>
        @endif
        @if($whychooseus && $whychooseus->title)
        <h2 class="section-title section-title--lg mb-3">{!! $whychooseus->title !!}</h2>
        @endif
        <hr class="divider-primary" />
        @if($whychooseus && $whychooseus->body)
        <div class="mt-4 home-why__checklist">
          {!! $whychooseus->body !!}
        </div>
        @endif
      </div>
      <div class="col-lg-6 order-1 order-lg-2 animate-fade-right">
        <div class="home-why__img-wrap">
          @if($whychooseus && $whychooseus->image)
          <img src="{{ asset($whychooseus->image) }}" alt="Why Choose Outline" />
          @endif
          @if($whychooseustitle && ($whychooseustitle->body || $whychooseustitle->short_description))
          <div class="home-why__promise">
            @if($whychooseustitle->body)
            <h5>{!! $whychooseustitle->body !!}</h5>
            @endif
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =============================================
       TESTIMONIALS
       ============================================= -->
<section class="section-pad home-testimonials" id="home-testimonials">
  <div class="container">
    <div class="text-center mb-5">
      @if($testimonialstitle && $testimonialstitle->title)
      <span class="section-label">{{ $testimonialstitle->title }}</span>
      @endif
      @if($testimonialstitle && $testimonialstitle->body)
      <h2 class="section-title section-title--lg">{!! $testimonialstitle->body !!}</h2>
      @endif
    </div>
    <div class="row g-4">
      @foreach($testimonials as $testimonial)
      <div class="col-md-6 col-lg-4">
        <div class="testimonial-card">
          <div class="testimonial-quote">"</div>
          @if($testimonial->title)
          <p class="testimonial-card__text">{{ $testimonial->title }}</p>
          @endif
          <div class="d-flex align-items-center gap-3 mt-auto">
            <div class="testimonial-avatar">
              @if($testimonial->image)
              <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->title }}" width="44" height="44" />
              @endif
            </div>
            <div>
              @if($testimonial->body)
              <div class="testimonial-card__role">{!! $testimonial->body !!}</div>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="testimonial-dots">
      <span class="active"></span><span></span><span></span>
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

<!-- =============================================
       CONTACT — form left + info/map right
       ============================================= -->
<section class="home-contact section-pad" id="home-contact">
  <div class="container">
    <form action="{{ route('contact.submit') }}" method="POST">
      @csrf
      <div class="row gy-5">

        <!-- Left: Form -->
        <div class="col-lg-6">
          <span class="section-label contact-heading-label">Get In Touch</span>
          <h2 class="cta-section-title section-title--md section-title--light mb-4">We'd Love To Hear From You</h2>

          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
          @endif

          @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="row g-3">
            <div class="col-sm-6">
              <input type="text" name="name" class="form-control-custom" placeholder="Your Name" value="{{ old('name') }}" required />
            </div>
            <div class="col-sm-6">
              <input type="email" name="email" class="form-control-custom" placeholder="Email Address" value="{{ old('email') }}" required />
            </div>
            <div class="col-sm-6">
              <input type="tel" name="phone" class="form-control-custom" placeholder="Phone Number" value="{{ old('phone') }}" />
            </div>
            <div class="col-sm-6">
              <input type="text" name="project_type" class="form-control-custom" placeholder="Project Type" value="{{ old('project_type') }}" />
            </div>
            <div class="col-12">
              <textarea name="message" class="form-control-custom" rows="4" placeholder="Your Message" required>{{ old('message') }}</textarea>
            </div>
            <div class="col-12">
              <button type="submit" class="btn-outline-custom btn-primary-custom w-100">
                Send Message &nbsp;<i class="bi bi-send"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Right: Info + Map -->
        <div class="col-lg-5 offset-lg-1">
          <div class="mb-2">

            {{-- Global Addresses --}}
            @if($globalAddresses && $globalAddresses->count() > 0)
              @foreach($globalAddresses as $address)
              <div class="contact-info-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                  <circle cx="12" cy="10" r="3" />
                </svg>
                <span>{!! $address->title !!}</span>
              </div>
              @endforeach
            @endif

            {{-- Global Phones --}}
            @if($globalPhones && $globalPhones->count() > 0)
              @foreach($globalPhones as $phone)
              <div class="contact-info-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
                <span>{{ $phone->title }}</span>
              </div>
              @endforeach
            @endif

            {{-- Global Emails --}}
            @if($globalEmails && $globalEmails->count() > 0)
              @foreach($globalEmails as $email)
              <div class="contact-info-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                  <polyline points="22,6 12,13 2,6" />
                </svg>
                <span>{{ $email->title }}</span>
              </div>
              @endforeach
            @endif

            {{-- Global Timings --}}
            @if($globalTimings)
            <div class="contact-info-item">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg>
              <span>{{ $globalTimings }}</span>
            </div>
            @endif

          </div>

          <!-- Map iframe with dynamic address -->
          <div class="home-contact__map">
            @php
              $mapAddress = '';
              if($globalAddresses && $globalAddresses->count() > 0) {
                  $addressText = $globalAddresses->first()->title;
                  $mapAddress = urlencode(strip_tags($addressText));
              } else {
                  $mapAddress = urlencode('Inspire Tower, Baner, Pune, Maharashtra, India');
              }
            @endphp
            <iframe
              src="https://www.google.com/maps?q={{ $mapAddress }}&output=embed"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              title="Outline Architects Location">
            </iframe>
          </div>

          <!-- Address badge below map -->
          @if($globalAddresses && $globalAddresses->count() > 0)
          <div class="contact-map-badge">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
              <circle cx="12" cy="10" r="3" />
            </svg>
            <div>
              <strong>Outline Architects</strong>
              <p>{{ strip_tags($globalAddresses->first()->title) }}</p>
            </div>
          </div>
          @endif

          <!-- Social icons -->
          <div class="contact-social">
            <div class="social-links">
              <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
              <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>
</section>
@endsection