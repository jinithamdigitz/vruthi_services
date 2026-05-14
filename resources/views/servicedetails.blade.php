@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/service-detail.css') }}">
@endsection

@section('content')

    <!-- Page Title -->
    <section class="page-title">
        <div class="auto-container">
            <div class="icons-box parallax-scene-1">
                <div class="icon-one" data-depth="0.10"></div>
                <div class="icon-two" data-depth="0.30">
                    <img src="{{ asset('images/icons/vector-9.png') }}" alt="">
                </div>
                <div class="icon-three" data-depth="0.30">
                    <img src="{{ asset('images/icons/vector-34.png') }}" alt="">
                </div>
                <div class="icon-four" data-depth="0.10"></div>
            </div>
            <h2>{{ $service->title }}</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.index') }}">Home</a></li>
                <li>Pages</li>
                <li>{{ $service->title }}</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Content Side -->
                <div class="content-side col-xl-9 col-lg-8 col-md-12 col-sm-12">
                    <div class="service-detail">
                        <div class="inner-box">

                            <!-- Hero Image -->
                            <div class="service-detail__image-wrap">
                                <img
                                    src="{{ asset('uploads/services/' . $service->image) }}"
                                    alt="{{ $service->title }}"
                                    class="service-detail__image"
                                >
                            </div>

                            <!-- Content -->
                            <div class="lower-content">

                                <h3 class="service-detail__title">{{ $service->title }}</h3>
                                <div class="service-detail__divider"></div>

                                <div class="service-detail__body">
                                    {!! $service->description !!}
                                </div>

                                <!-- Gallery -->
                                @if ($service->images->count() > 0)
                                    <div class="service-detail__gallery">
                                        <h5 class="service-detail__gallery-title">
                                            <span></span> Image Gallery
                                        </h5>
                                        <div class="row g-2">
                                            @foreach ($service->images as $img)
                                                <div class="col-4 col-md-4 mb-2">
                                                    <a
                                                        href="{{ asset('uploads/service-gallery/' . $img->image) }}"
                                                        data-lightbox="service-gallery"
                                                        class="service-detail__gallery-item"
                                                    >
                                                        <img
                                                            src="{{ asset('uploads/service-gallery/' . $img->image) }}"
                                                            class="img-fluid"
                                                            alt="Gallery image"
                                                        >
                                                        <div class="service-detail__gallery-overlay">
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                                 stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                                <circle cx="11" cy="11" r="8"></circle>
                                                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                                <line x1="11" y1="8" x2="11" y2="14"></line>
                                                                <line x1="8" y1="11" x2="14" y2="11"></line>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Side -->
                <div class="sidebar-side col-xl-3 col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar sticky-top">
                        <div class="sidebar-widget services-widget">
                            <div class="widget-content">

                                <h5 class="services-widget__title">Other Services</h5>

                                @php $count = 0; @endphp
                                @foreach ($services as $s)
                                    @if ($s->id != $service->id && $count < 3)
                                        <a href="{{ route('home.servicedetails', $s->slug) }}" class="service-card">
                                            <div class="service-card__image-wrap">
                                                <img
                                                    src="{{ asset('uploads/services/' . $s->image) }}"
                                                    alt="{{ $s->title }}"
                                                    class="service-card__image"
                                                >
                                            </div>
                                            <div class="service-card__body">
                                                <h6 class="service-card__title">{{ $s->title }}</h6>
                                            </div>
                                        </a>
                                        @php $count++; @endphp
                                    @endif
                                @endforeach

                                <a href="{{ route('home.services') }}" class="services-widget__see-more">
                                    See All Services
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </a>

                            </div>
                        </div>
                    </aside>
                </div>

            </div>
        </div>
    </div>

@endsection