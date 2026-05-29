@extends('layouts.main')


@section('content')

{{-- HERO SECTION - USING COMMON HERO --}}
<section class="page-hero">
    @if($serviceBanner && $serviceBanner->image)
    <div class="page-hero__bg" style="background-image: url('{{ asset($serviceBanner->image) }}');"></div>
    @endif
    <div class="page-hero__overlay"></div>

    <div class="container page-hero__content">
        <nav class="page-hero__breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home.index') }}">Home</a>
            <span class="page-hero__breadcrumb-sep">/</span>
            <span class="current">Services</span>
        </nav>

        @if($serviceBanner && $serviceBanner->title)
        @php
        $titleParts = explode('|', $serviceBanner->title);
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

        @if($serviceBanner && $serviceBanner->body)
        <p class="page-hero__desc">
            {!! strip_tags($serviceBanner->body) !!}
        </p>
        @endif
    </div>
</section>


{{-- INTRO SECTION --}}
<section class="svc-pg__intro">
    <div class="container">
        <div class="text-center">
            <span class="svc-pg__intro-eyebrow">What We Do</span>

            @if($serviceContent && $serviceContent->title)
            <h2 class="svc-pg__intro-title">
                {{ $serviceContent->title }}
            </h2>
            @endif

            @if($serviceContent && $serviceContent->body)
            <p class="svc-pg__intro-sub mx-auto">
                {!! $serviceContent->body !!}
            </p>
            @endif
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
                        @endif

                        <div class="svc-pg__card-icon-img" aria-hidden="true">
                            @if($service->icon_image)
                            <img src="{{ asset($service->icon_image) }}" alt="{{ $service->title }}">
                            @else
                            <svg width="24" height="24" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                            @endif
                        </div>
                    </div>
                    <div class="svc-pg__card-body">
                        <h3 class="svc-pg__card-title">{{ $service->title }}</h3>
                        <p class="svc-pg__card-text">
                            {{ Str::limit($service->body, 100) }}
                        </p>
                        <a href="{{ route('home.services') }}" class="svc-pg__card-link">
                            Learn More
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
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

                @if($whyChooseUs && $whyChooseUs->title)
                <h2 class="svc-pg__why-title">
                    {{ $whyChooseUs->title }}
                </h2>
                @endif

                @if($whyChooseUs && $whyChooseUs->body)
                <p class="svc-pg__why-sub">
                    {!! strip_tags($whyChooseUs->body) !!}
                </p>
                @endif

                <a href="{{ route('contact') }}" class="btn-outline-custom btn-primary-custom">
                    Let's Work Together
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="svc-pg__why-right">
                <div class="svc-pg__pillars-row">
                    @foreach($whyChooseUsCards as $card)
                    <div class="svc-pg__pillar">
                        <div class="svc-pg__pillar-icon">
                            @if($card->image)
                            <img src="{{ asset($card->image) }}" alt="{{ $card->title }}">

                            @endif
                        </div>
                        <h4 class="svc-pg__pillar-title">{{ $card->title }}</h4>
                        <p class="svc-pg__pillar-text">{!! strip_tags($card->body) !!}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection