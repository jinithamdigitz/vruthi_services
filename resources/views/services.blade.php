{{-- ============================================================
     VRUDHI OUTSOURCING — Services Page
     Extends: layouts/main.blade.php
     Sections: services-hero, services-portfolio, services-why-us
     ============================================================ --}}

@extends('layouts.main')

@section('title', 'Our Services — Vrudhi Outsourcing Services Pvt. Ltd.')

@section('content')

    {{-- ============================================================
     SECTION 1 : SERVICES HERO BANNER
     ============================================================ --}}
    <section class="services-hero">
        <div class="services-hero__bg-overlay"></div>
        <div class="services-hero__wave-shape"></div>

        <div class="container">
            <div class="services-hero__content">

                {{-- Left: text --}}
                <div class="services-hero__left reveal reveal-left">

                    {{-- Breadcrumb --}}
                    <nav class="services-hero__breadcrumb" aria-label="breadcrumb">
                        <a href="{{ url('/') }}">Home</a>
                        <i class="bi bi-chevron-right"></i>
                        <span>Services</span>
                    </nav>

                    <h1 class="services-hero__title">Our Services</h1>
                    <p class="services-hero__tagline">Comprehensive Facility Management Solutions</p>
                    <p class="services-hero__desc">
                        We deliver integrated and innovative services that help organisations focus on their
                        core business while we manage their facilities efficiently and effectively.
                    </p>
                    <div class="services-hero__rule"></div>
                </div>

                {{-- Right: hero image --}}
                <div class="services-hero__right reveal reveal-right">
                    <img src="{{ asset('img/services/services-hero.png') }}" alt="Vrudhi facility management team"
                        class="services-hero__img" width="680" height="420">
                </div>

            </div>
        </div>
    </section>


    {{-- ============================================================
     SECTION 2 : SERVICE PORTFOLIO (all 7 services)
     Alternating image-left / image-right layout matching reference
     ============================================================ --}}
    <section class="services-portfolio">
        <div class="container">

            {{-- Section heading --}}
            <div class="row justify-content-center mb-5">
                <div class="col-12 text-center">
                    <span class="section-label services-portfolio__eyebrow">What We Offer</span>
                    <h2 class="services-portfolio__title mt-1">Our Service Portfolio</h2>
                    <div class="section-divider mx-auto mt-2"></div>
                </div>
            </div>

            {{-- ── SERVICE 01 : House Keeping & Upkeep Maintenance ── --}}
            {{-- Layout: image-left | number+info-centre | features-right --}}
            <div class="services-portfolio__row row g-0 align-items-stretch reveal">

                {{-- Image (left) --}}
                <div class="col-lg-3 col-md-4">
                    <div class="services-portfolio__img-wrap services-portfolio__img-wrap--left">
                        <img src="{{ asset('img/services/housekeeping.jpg') }}" alt="House Keeping & Upkeep Maintenance"
                            class="services-portfolio__img">
                    </div>
                </div>

                {{-- Centre: number, icon, title, description --}}
                <div class="col-lg-5 col-md-4">
                    <div class="services-portfolio__info">
                        <span class="services-portfolio__number">01</span>
                        <div class="services-portfolio__icon-wrap">
                            <i class="bi bi-bucket-fill"></i>
                        </div>
                        <h3 class="services-portfolio__service-title">
                            House Keeping &amp;<br>Upkeep Maintenance
                        </h3>
                        <p class="services-portfolio__service-desc">
                            We provide professional cleaning and maintenance services that ensure
                            hygienic, safe and well-maintained environments for every facility.
                        </p>
                    </div>
                </div>

                {{-- Features list (right) --}}
                <div class="col-lg-4 col-md-4">
                    <div class="services-portfolio__features">
                        <ul class="services-portfolio__feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Daily Cleaning Services</li>
                            <li><i class="bi bi-check-circle-fill"></i> Floor &amp; Carpet Care</li>
                            <li><i class="bi bi-check-circle-fill"></i> Washroom Hygiene</li>
                            <li><i class="bi bi-check-circle-fill"></i> Waste Management</li>
                            <li><i class="bi bi-check-circle-fill"></i> General Maintenance</li>
                        </ul>
                        <a href="{{ url('/services/housekeeping') }}" class="btn-outline-brand services-portfolio__cta">
                            Explore More <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>{{-- /.services-portfolio__row --}}


            {{-- ── SERVICE 02 : Security Guarding Service ── --}}
            {{-- Layout: features-left | number+info-centre | image-right --}}
            <div class="services-portfolio__row services-portfolio__row--alt row g-0 align-items-stretch reveal">

                {{-- Features list (left) --}}
                <div class="col-lg-4 col-md-4 order-md-1 order-3">
                    <div class="services-portfolio__features services-portfolio__features--left">
                        <ul class="services-portfolio__feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Manned Guarding</li>
                            <li><i class="bi bi-check-circle-fill"></i> Access Control</li>
                            <li><i class="bi bi-check-circle-fill"></i> CCTV Monitoring</li>
                            <li><i class="bi bi-check-circle-fill"></i> Event Security</li>
                            <li><i class="bi bi-check-circle-fill"></i> Emergency Response</li>
                        </ul>
                    </div>
                </div>

                {{-- Centre: number, icon, title, description --}}
                <div class="col-lg-5 col-md-4 order-md-2 order-1">
                    <div class="services-portfolio__info">
                        <span class="services-portfolio__number">02</span>
                        <div class="services-portfolio__icon-wrap">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="services-portfolio__service-title">
                            Security Guarding<br>Service
                        </h3>
                        <p class="services-portfolio__service-desc">
                            Trained and vigilant security professionals to ensure the safety of your
                            people, assets and premises round the clock.
                        </p>
                    </div>
                </div>

                {{-- Image (right) --}}
                <div class="col-lg-3 col-md-4 order-md-3 order-2">
                    <div class="services-portfolio__img-wrap services-portfolio__img-wrap--right">
                        <img src="{{ asset('img/services/security.jpg') }}" alt="Security Guarding Service"
                            class="services-portfolio__img">
                    </div>
                </div>

            </div>{{-- /.services-portfolio__row --}}


            {{-- ── SERVICE 03 : Care Taker Services ── --}}
            {{-- Layout: image-left | number+info-centre | features-right --}}
            <div class="services-portfolio__row row g-0 align-items-stretch reveal">

                <div class="col-lg-3 col-md-4">
                    <div class="services-portfolio__img-wrap services-portfolio__img-wrap--left">
                        <img src="{{ asset('img/services/caretaker.jpg') }}" alt="Care Taker Services"
                            class="services-portfolio__img">
                    </div>
                </div>

                <div class="col-lg-5 col-md-4">
                    <div class="services-portfolio__info">
                        <span class="services-portfolio__number">03</span>
                        <div class="services-portfolio__icon-wrap">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <h3 class="services-portfolio__service-title">
                            Care Taker<br>Services
                        </h3>
                        <p class="services-portfolio__service-desc">
                            Reliable caretaker services for residential, commercial and industrial
                            properties with a focus on attention and responsibility.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="services-portfolio__features">
                        <ul class="services-portfolio__feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Building Supervision</li>
                            <li><i class="bi bi-check-circle-fill"></i> Visitor Management</li>
                            <li><i class="bi bi-check-circle-fill"></i> Utility Management</li>
                            <li><i class="bi bi-check-circle-fill"></i> Vendor Coordination</li>
                            <li><i class="bi bi-check-circle-fill"></i> Routine Inspections</li>
                        </ul>
                        <a href="{{ url('/services/caretaker') }}" class="btn-outline-brand services-portfolio__cta">
                            Explore More <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>{{-- /.services-portfolio__row --}}


            {{-- ── SERVICE 04 : HR Outsourcing / Payroll Management ── --}}
            {{-- Layout: features-left | number+info-centre | image-right --}}
            <div class="services-portfolio__row services-portfolio__row--alt row g-0 align-items-stretch reveal">

                <div class="col-lg-4 col-md-4 order-md-1 order-3">
                    <div class="services-portfolio__features services-portfolio__features--left">
                        <ul class="services-portfolio__feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Payroll Processing</li>
                            <li><i class="bi bi-check-circle-fill"></i> Statutory Compliance</li>
                            <li><i class="bi bi-check-circle-fill"></i> Recruitment Support</li>
                            <li><i class="bi bi-check-circle-fill"></i> Employee Management</li>
                            <li><i class="bi bi-check-circle-fill"></i> HR Policy &amp; Advisory</li>
                        </ul>
                        <a href="{{ url('/services/hr-outsourcing') }}" class="btn-outline-brand services-portfolio__cta">
                            Explore More <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 col-md-4 order-md-2 order-1">
                    <div class="services-portfolio__info">
                        <span class="services-portfolio__number">04</span>
                        <div class="services-portfolio__icon-wrap">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3 class="services-portfolio__service-title">
                            HR Outsourcing /<br>Payroll Management
                        </h3>
                        <p class="services-portfolio__service-desc">
                            End-to-end HR and payroll solutions to streamline your workforce
                            management and ensure compliance with complete accuracy.
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 order-md-3 order-2">
                    <div class="services-portfolio__img-wrap services-portfolio__img-wrap--right">
                        <img src="{{ asset('img/services/hr-outsourcing.jpg') }}"
                            alt="HR Outsourcing & Payroll Management" class="services-portfolio__img">
                    </div>
                </div>

            </div>{{-- /.services-portfolio__row --}}


            {{-- ── SERVICE 05 : Pest Control Services ── --}}
            {{-- Layout: image-left | number+info-centre | features-right --}}
            <div class="services-portfolio__row row g-0 align-items-stretch reveal">

                <div class="col-lg-3 col-md-4">
                    <div class="services-portfolio__img-wrap services-portfolio__img-wrap--left">
                        <img src="{{ asset('img/services/pest-control.jpg') }}" alt="Pest Control Services"
                            class="services-portfolio__img">
                    </div>
                </div>

                <div class="col-lg-5 col-md-4">
                    <div class="services-portfolio__info">
                        <span class="services-portfolio__number">05</span>
                        <div class="services-portfolio__icon-wrap">
                            <i class="bi bi-bug-fill"></i>
                        </div>
                        <h3 class="services-portfolio__service-title">
                            Pest Control<br>Services
                        </h3>
                        <p class="services-portfolio__service-desc">
                            Safe, effective and eco-friendly pest control solutions to protect your
                            premises from pests and ensure a healthy environment.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="services-portfolio__features">
                        <ul class="services-portfolio__feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> General Disinfestation</li>
                            <li><i class="bi bi-check-circle-fill"></i> Termite Control</li>
                            <li><i class="bi bi-check-circle-fill"></i> Rodent Control</li>
                            <li><i class="bi bi-check-circle-fill"></i> Cockroach Control</li>
                            <li><i class="bi bi-check-circle-fill"></i> Preventive Treatments</li>
                        </ul>
                        <a href="{{ url('/services/pest-control') }}" class="btn-outline-brand services-portfolio__cta">
                            Explore More <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>{{-- /.services-portfolio__row --}}


            {{-- ── SERVICE 06 : MEP / Preventive / Conditional Maintenance ── --}}
            {{-- Layout: features-left | number+info-centre | image-right --}}
            <div class="services-portfolio__row services-portfolio__row--alt row g-0 align-items-stretch reveal">

                <div class="col-lg-4 col-md-4 order-md-1 order-3">
                    <div class="services-portfolio__features services-portfolio__features--left">
                        <ul class="services-portfolio__feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Electrical Maintenance</li>
                            <li><i class="bi bi-check-circle-fill"></i> Plumbing &amp; Pipework</li>
                            <li><i class="bi bi-check-circle-fill"></i> HVAC Servicing</li>
                            <li><i class="bi bi-check-circle-fill"></i> Preventive Schedules</li>
                            <li><i class="bi bi-check-circle-fill"></i> Breakdown Response</li>
                        </ul>
                        <a href="{{ url('/services/mep-maintenance') }}"
                            class="btn-outline-brand services-portfolio__cta">
                            Explore More <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 col-md-4 order-md-2 order-1">
                    <div class="services-portfolio__info">
                        <span class="services-portfolio__number">06</span>
                        <div class="services-portfolio__icon-wrap">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h3 class="services-portfolio__service-title">
                            MEP / Preventive /<br>Conditional Maintenance
                        </h3>
                        <p class="services-portfolio__service-desc">
                            Comprehensive mechanical, electrical and plumbing maintenance with
                            scheduled preventive and reactive services to maximise uptime.
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 order-md-3 order-2">
                    <div class="services-portfolio__img-wrap services-portfolio__img-wrap--right">
                        <img src="{{ asset('img/services/mep-maintenance.jpg') }}" alt="MEP Preventive Maintenance"
                            class="services-portfolio__img">
                    </div>
                </div>

            </div>{{-- /.services-portfolio__row --}}


            {{-- ── SERVICE 07 : Horticulture Services ── --}}
            {{-- Layout: image-left | number+info-centre | features-right --}}
            <div class="services-portfolio__row row g-0 align-items-stretch reveal">

                <div class="col-lg-3 col-md-4">
                    <div class="services-portfolio__img-wrap services-portfolio__img-wrap--left">
                        <img src="{{ asset('img/services/horticulture.jpg') }}" alt="Horticulture Services"
                            class="services-portfolio__img">
                    </div>
                </div>

                <div class="col-lg-5 col-md-4">
                    <div class="services-portfolio__info">
                        <span class="services-portfolio__number">07</span>
                        <div class="services-portfolio__icon-wrap">
                            <i class="bi bi-tree-fill"></i>
                        </div>
                        <h3 class="services-portfolio__service-title">
                            Horticulture<br>Services
                        </h3>
                        <p class="services-portfolio__service-desc">
                            Professional landscaping and horticulture solutions to create beautiful,
                            green and sustainable outdoor environments for every property.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="services-portfolio__features">
                        <ul class="services-portfolio__feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Lawn Care &amp; Mowing</li>
                            <li><i class="bi bi-check-circle-fill"></i> Landscape Design</li>
                            <li><i class="bi bi-check-circle-fill"></i> Plant Nursery Supply</li>
                            <li><i class="bi bi-check-circle-fill"></i> Irrigation Systems</li>
                            <li><i class="bi bi-check-circle-fill"></i> Seasonal Planting</li>
                        </ul>
                        <a href="{{ url('/services/horticulture') }}" class="btn-outline-brand services-portfolio__cta">
                            Explore More <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>{{-- /.services-portfolio__row --}}

        </div>{{-- /.container --}}
    </section>{{-- /.services-portfolio --}}


    {{-- ============================================================
     SECTION 3 : WHY PARTNER WITH US
     ============================================================ --}}
    <section class="services-why-us">
        <div class="container">

            <div class="row justify-content-center mb-5">
                <div class="col-12 text-center">
                    <span class="section-label services-why-us__eyebrow">Why Partner With Us</span>
                    <h2 class="services-why-us__title mt-1">Adding Value Beyond Services</h2>
                    <div class="section-divider mx-auto mt-2"></div>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach ($whyChooseUsCards as $index => $card)
                    <div class="col-sm-6 col-lg-3 reveal reveal-delay-{{ $index + 1 }}">
                        <div class="home-about__card h-100">

                            <div class="icon-wrap">
                                <img src="{{ asset($card->image) }}" alt="{{ $card->title }}"
                                    class="home-about__icon-img">
                            </div>

                            <h4>{{ $card->title }}</h4>

                            <p>{!! $card->body !!}</p>

                        </div>
                    </div>
                @endforeach

            </div>{{-- /.row --}}
        </div>{{-- /.container --}}
    </section>{{-- /.services-why-us --}}

@endsection
