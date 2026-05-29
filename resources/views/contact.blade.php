@extends('layouts.main')

@section('title', 'Contact Us — Outline Architects')

@section('content')

{{-- HERO - DYNAMIC (CONTACT PAGE) - USING COMMON HERO --}}
<section class="page-hero">
    <div class="page-hero__bg" style="background-image: url('{{ asset($contactBanner->image) }}');"></div>
    <div class="page-hero__overlay"></div>
    <div class="container page-hero__content">
        <nav class="page-hero__breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home.index') }}">Home</a>
            <span class="page-hero__breadcrumb-sep">›</span>
            <span class="current">Contact</span>
        </nav>

        @php
        $titleParts = explode('|', $contactBanner->title);
        $firstLine = trim($titleParts[0]);
        $secondLine = isset($titleParts[1]) ? trim($titleParts[1]) : '';
        $thirdLine = isset($titleParts[2]) ? trim($titleParts[2]) : '';
        @endphp
        <h1 class="page-hero__title">
            {{ $firstLine }}
            @if($secondLine)
            <span class="accent">{{ $secondLine }}</span>
            @endif
            @if($thirdLine)
            <span class="accent">{{ $thirdLine }}</span>
            @endif
        </h1>

        <p class="page-hero__desc">
            {!! strip_tags($contactBanner->body) !!}
        </p>

    </div>
</section>

{{-- CONTACT SECTION --}}
<section class="ct-pg__section">
    <div class="container">
        <div class="row g-4">

            {{-- Left Panel - Full Black --}}
            <div class="col-lg-5">
                <div class="ct-pg__left-panel">
                    <h3 class="ct-pg__left-title">Contact Information</h3>

                    {{-- Address Section --}}
                    <div class="ct-pg__info-item">
                        <div class="ct-pg__info-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                        </div>
                        <div>
                            <p class="ct-pg__info-label">Visit Us</p>
                            @if($globalAddresses && $globalAddresses->count() > 0)
                            @foreach($globalAddresses as $address)
                            <p class="ct-pg__info-text">
                                {{ $address->title }}
                            </p>
                            @endforeach
                            @else
                            <p class="ct-pg__info-text">
                                7th Floor, Inspire Tower, Baker Road,<br>
                                Pune – 411045<br>
                                Maharashtra, India
                            </p>
                            @endif
                        </div>
                    </div>

                    {{-- Phone Section --}}
                    <div class="ct-pg__info-item">
                        <div class="ct-pg__info-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 012 1.18 2 2 0 013.98 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" />
                            </svg>
                        </div>
                        <div>
                            <p class="ct-pg__info-label">Call Us</p>
                            @if($globalPhones && $globalPhones->count() > 0)
                            @foreach($globalPhones as $phoneItem)
                            <p class="ct-pg__info-text">
                                <a href="tel:{{ $phoneItem->title }}">{{ $phoneItem->title }}</a>
                            </p>
                            @endforeach
                            @else
                            <p class="ct-pg__info-text">
                                <a href="tel:+919876543210">+91 98765 43210</a>
                            </p>
                            @endif
                        </div>
                    </div>

                    {{-- Email Section --}}
                    <div class="ct-pg__info-item">
                        <div class="ct-pg__info-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                        </div>
                        <div>
                            <p class="ct-pg__info-label">Email Us</p>
                            @if($globalEmails && $globalEmails->count() > 0)
                            @foreach($globalEmails as $emailItem)
                            <p class="ct-pg__info-text">
                                <a href="mailto:{{ $emailItem->title }}">{{ $emailItem->title }}</a>
                            </p>
                            @endforeach
                            @else
                            <p class="ct-pg__info-text">
                                <a href="mailto:info@outlinearchitects.com">info@outlinearchitects.com</a>
                            </p>
                            @endif
                        </div>
                    </div>

                    {{-- Working Hours Section --}}
                    <div class="ct-pg__info-item">
                        <div class="ct-pg__info-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </div>
                        <div>
                            <p class="ct-pg__info-label">Working Hours</p>
                            <p class="ct-pg__info-text">
                                {{ $globalTimings ?? 'Mon – Sat: 9:00 AM – 6:00 PM' }}<br>
                                Sunday: Closed
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Right Panel - White with Orange --}}
            <div class="col-lg-7">
                <div class="ct-pg__right-panel">
                    <h3 class="ct-pg__right-title">Send us a Message</h3>
                    <span class="ct-pg__right-subtitle">We'd love to hear from you</span>

                    <form id="ct-contact-form" method="POST" action="{{ route('contact.submit') }}" novalidate>
                        @csrf

                        <div class="ct-pg__form-row">
                            <div class="ct-pg__form-group">
                                <label for="ct_name" class="ct-pg__form-label">Your Name</label>
                                <input type="text" id="ct_name" name="name" class="ct-pg__form-control" placeholder="Your Name *" required autocomplete="name" value="{{ old('name') }}">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="ct-pg__form-group">
                                <label for="ct_email" class="ct-pg__form-label">Your Email</label>
                                <input type="email" id="ct_email" name="email" class="ct-pg__form-control" placeholder="Your Email *" required autocomplete="email" value="{{ old('email') }}">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="ct-pg__form-group">
                            <label for="ct_phone" class="ct-pg__form-label">Phone Number</label>
                            <input type="tel" id="ct_phone" name="phone" class="ct-pg__form-control" placeholder="Phone Number" autocomplete="tel" value="{{ old('phone') }}">
                            @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="ct-pg__form-group">
                            <label for="ct_project_type" class="ct-pg__form-label">Project Type</label>
                            <input type="text" id="ct_project_type" name="project_type" class="ct-pg__form-control" placeholder="Project Type (e.g., Residential, Commercial)" value="{{ old('project_type') }}">
                            @error('project_type')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="ct-pg__form-group">
                            <label for="ct_message" class="ct-pg__form-label">Your Message</label>
                            <textarea id="ct_message" name="message" class="ct-pg__form-control" placeholder="Your Message *" required rows="5">{{ old('message') }}</textarea>
                            @error('message')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="ct-pg__submit-btn">
                            <span>Send Message</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12" />
                                <polyline points="12 5 19 12 12 19" />
                            </svg>
                        </button>

                        @if(session('success'))
                        <div class="ct-pg__form-feedback ct-pg__form-feedback--success" style="display:flex;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="ct-pg__form-feedback ct-pg__form-feedback--error" style="display:flex;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            {{ session('error') }}
                        </div>
                        @endif
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- MAP STRIP with dynamic address from database --}}
<div class="ct-pg__map-strip">
    @php
    $mapAddress = '';
    if($globalAddresses && $globalAddresses->count() > 0) {
    $addressText = $globalAddresses->first()->title;
    $mapAddress = urlencode($addressText);
    } else {
    $mapAddress = urlencode('7th Floor, Inspire Tower, Baker Road, Pune 411045 Maharashtra India');
    }
    @endphp
    <iframe
        src="https://www.google.com/maps?q={{ $mapAddress }}&output=embed"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Our Office Location"></iframe>
</div>

{{-- Scroll-to-top button --}}
<button class="ct-pg__scroll-top" id="ct-scroll-top" aria-label="Back to top">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
        <polyline points="18 15 12 9 6 15" />
    </svg>
</button>

@endsection

<script>
    (function() {
        'use strict';

        const scrollBtn = document.getElementById('ct-scroll-top');
        if (scrollBtn) {
            window.addEventListener('scroll', function() {
                scrollBtn.classList.toggle('visible', window.scrollY > 320);
            }, {
                passive: true
            });
            scrollBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        document.querySelectorAll('.ct-pg__form-control').forEach(function(el) {
            el.addEventListener('focus', function() {
                el.closest('.ct-pg__form-group')?.classList.add('focused');
            });
            el.addEventListener('blur', function() {
                el.closest('.ct-pg__form-group')?.classList.remove('focused');
            });
        });
    })();
</script>