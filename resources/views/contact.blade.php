@extends('layouts.main')

@section('title', 'Contact Us — Vrudhi Outsourcing Services Pvt. Ltd.')

@section('content')

    {{-- HERO - DYNAMIC (CONTACT PAGE) --}}
    <section class="blogs-hero">

        <div class="blogs-hero__bg-overlay"></div>
        <div class="blogs-hero__wave-shape"></div>

        <div class="container">

            <div class="blogs-hero__content">

                <div class="blogs-hero__left reveal reveal-left">

                    <nav class="blogs-hero__breadcrumb">
                        <a href="{{ url('/') }}">Home</a>
                        <i class="bi bi-chevron-right"></i>
                        <span>Contact Us</span>
                    </nav>


                    <p class="blogs-hero__tagline">
                        {{ $contactBanner->title }}
                    </p>


                    <p class="about-hero__desc">
                        {{ $contactBanner->body }}
                    </p>

                </div>

                <div class="blogs-hero__right reveal reveal-right">

                    <img src="{{ $contactBanner->image }}" alt="Contact Us" class="blogs-hero__img">

                </div>

            </div>

        </div>

    </section>

    {{-- CONTACT SECTION --}}
    <section class="contact-section">
        <div class="container">
            <div class="row g-4">

                {{-- Left Panel - Contact Information --}}
                <div class="col-lg-5">
                    <div class="contact-panel contact-panel--left">
                        <h3 class="contact-panel__title">Contact Information</h3>
                        <p class="contact-panel__subtitle">We'd love to hear from you</p>

                        {{-- Address Section --}}
                        <div class="contact-info-item">
                            <div class="contact-info-item__icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <p class="contact-info-item__label">Visit Us</p>
                                @if ($globalAddresses && $globalAddresses->count() > 0)
                                    @foreach ($globalAddresses as $address)
                                        <p class="contact-info-item__text">{{ $address->title }}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        {{-- Phone Section --}}
                        <div class="contact-info-item">
                            <div class="contact-info-item__icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <p class="contact-info-item__label">Call Us</p>
                                @if ($globalPhones && $globalPhones->count() > 0)
                                    @foreach ($globalPhones as $phoneItem)
                                        <p class="contact-info-item__text">
                                            <a href="tel:{{ $phoneItem->title }}">{{ $phoneItem->title }}</a>
                                        </p>
                                    @endforeach
                                @else
                                    <p class="contact-info-item__text">
                                        <a href="tel:+919876543210">+91 98765 43210</a>
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Email Section --}}
                        <div class="contact-info-item">
                            <div class="contact-info-item__icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <p class="contact-info-item__label">Email Us</p>
                                @if ($globalEmails && $globalEmails->count() > 0)
                                    @foreach ($globalEmails as $emailItem)
                                        <p class="contact-info-item__text">
                                            <a href="mailto:{{ $emailItem->title }}">{{ $emailItem->title }}</a>
                                        </p>
                                    @endforeach
                                @else
                                    <p class="contact-info-item__text">
                                        <a href="mailto:info@vrudhi.com">info@vrudhi.com</a>
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Working Hours Section --}}
                        <div class="contact-info-item">
                            <div class="contact-info-item__icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div>
                                <p class="contact-info-item__label">Working Hours</p>
                                <p class="contact-info-item__text">
                                    {{ $globalTimings }}<br>

                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Right Panel - Contact Form --}}
                <div class="col-lg-7">
                    <div class="contact-panel contact-panel--right">
                        <h3 class="contact-panel__title">Send us a Message</h3>
                        <span class="contact-panel__subtitle">We'd love to hear from you</span>

                        <form id="contact-form" method="POST" action="{{ route('contact.submit') }}" novalidate>
                            @csrf

                            <div class="contact-form__row">
                                <div class="contact-form__group">
                                    <label for="contact_name" class="contact-form__label">Your Name</label>
                                    <input type="text" id="contact_name" name="name" class="contact-form__control"
                                        placeholder="Your Name *" required autocomplete="name" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="contact-form__error">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="contact-form__group">
                                    <label for="contact_email" class="contact-form__label">Your Email</label>
                                    <input type="email" id="contact_email" name="email" class="contact-form__control"
                                        placeholder="Your Email *" required autocomplete="email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <small class="contact-form__error">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="contact-form__group">
                                <label for="contact_phone" class="contact-form__label">Phone Number</label>
                                <input type="tel" id="contact_phone" name="phone" class="contact-form__control"
                                    placeholder="Phone Number" autocomplete="tel" value="{{ old('phone') }}">
                                @error('phone')
                                    <small class="contact-form__error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="contact-form__group">
                                <label for="contact_project_type" class="contact-form__label">
                                    Service Type
                                </label>

                                <select id="contact_project_type" name="project_type" class="contact-form__control">

                                    <option value="">Select Service</option>

                                    @foreach ($services as $service)
                                        <option value="{{ $service->title }}"
                                            {{ old('project_type') == $service->title ? 'selected' : '' }}>
                                            {{ $service->title }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            <div class="contact-form__group">
                                <label for="contact_message" class="contact-form__label">Additional Requirements(if
                                    any)</label>
                                <textarea id="contact_message" name="message" class="contact-form__control" placeholder="Your Message *" required
                                    rows="5">{{ old('message') }}</textarea>

                                @error('message')
                                    <small class="contact-form__error">{{ $message }}</small>
                                @enderror
                            </div>
                                <div class="sd-form__captcha">
                                    <div class="g-recaptcha"
                                        data-sitekey="{{ config('services.recaptcha.site_key', '') }}">
                                        <div class="sd-form__captcha-placeholder">
                                            <input type="checkbox" id="notRobot">
                                            <label for="notRobot">I'm not a robot</label>
                                            <span class="sd-form__captcha-logo">reCAPTCHA</span>
                                        </div>
                                    </div>
                                </div>
                            

                            <button type="submit" class="contact-form__submit">
                                <span>Send Message</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>

                            @if (session('success'))
                                <div class="contact-form__feedback contact-form__feedback--success" style="display:flex;">
                                    <i class="bi bi-check-circle"></i>
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="contact-form__feedback contact-form__feedback--error" style="display:flex;">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ session('error') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- MAP STRIP --}}
    <div class="contact-map">
        @php
            $mapAddress = '';
            if ($globalAddresses && $globalAddresses->count() > 0) {
                $addressText = $globalAddresses->first()->title;
                $mapAddress = urlencode($addressText);
            } else {
                $mapAddress = urlencode('7th Floor, Inspire Tower, Baker Road, Pune 411045 Maharashtra India');
            }
        @endphp
        <iframe src="https://www.google.com/maps?q={{ $mapAddress }}&output=embed" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" title="Our Office Location"></iframe>
    </div>

    {{-- Scroll-to-top button --}}
    <button class="contact-scroll-top" id="contact-scroll-top" aria-label="Back to top">
        <i class="bi bi-chevron-up"></i>
    </button>

@endsection

<script>
    (function() {
        'use strict';

        // Scroll to top button
        const scrollBtn = document.getElementById('contact-scroll-top');
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

        // Form input focus effects
        document.querySelectorAll('.contact-form__control').forEach(function(el) {
            el.addEventListener('focus', function() {
                this.closest('.contact-form__group')?.classList.add('focused');
            });
            el.addEventListener('blur', function() {
                this.closest('.contact-form__group')?.classList.remove('focused');
            });
        });

        // Auto-dismiss form feedback after 5 seconds
        const feedback = document.querySelector('.contact-form__feedback');
        if (feedback && feedback.style.display === 'flex') {
            setTimeout(function() {
                feedback.style.opacity = '0';
                feedback.style.transition = 'opacity 0.5s ease';
                setTimeout(function() {
                    feedback.style.display = 'none';
                }, 500);
            }, 5000);
        }
    })();
</script>
