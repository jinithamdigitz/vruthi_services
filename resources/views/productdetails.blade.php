@extends('layouts.main')

@section('hero_title', $product->title ?? 'Product Details')
@section('hero_text', $product->short_description ?? 'Learn more about this solar product')

@php
    $bodyClass = 'product-page';
   
@endphp
@section('content')

   

        <div class="page product-details-page">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert-success-custom">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert-error-custom">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Product Details + Enquiry Form Section (Side by Side) --}}
            <section class="product-enquiry-section">
                <div class="product-enquiry-container">

                    {{-- LEFT SIDE: Product Image, Title, Description --}}
                    <div class="product-details-left">

                        <div class="product-main-image">
                            <img src="{{ !empty($product->image) ? url($product->image) : 'https://via.placeholder.com/500x400?text=Product+Image' }}"
                                alt="{{ $product->title }}">
                        </div>
                        <div class="product-info-content">

                            @if (!empty($product->description))
                                <div class="product-full-description">
                                    <p>{!! $product->description !!}</p>
                                </div>
                            @endif


                        </div>
                    </div>

                    {{-- RIGHT SIDE: Enquiry Form --}}
                    <div class="enquiry-form-right">
                        <div class="enquiry-card">
                            <div class="enquiry-header">
                                <h3><i class="fas fa-paper-plane"></i> Get a Quote</h3>
                                <p>Fill out the form below and our solar experts will get back to you within 24 hours.</p>
                            </div>

                            <form action="{{ url('/enquiry-store') }}" method="POST" class="enquiry-form">
                                @csrf

                                {{-- Hidden product field --}}
                                <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                                <input type="hidden" name="product_name" value="{{ $product->title ?? '' }}">

                                <div class="form-group-enquiry">
                                    <label><i class="fas fa-user"></i> Your Name <span class="required">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        placeholder="Enter your full name" required>
                                    @error('name')
                                        <span class="error-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-enquiry">
                                    <label><i class="fas fa-mobile-alt"></i> Contact Number <span
                                            class="required">*</span></label>
                                    <input type="tel" name="contact_number" value="{{ old('contact_number') }}"
                                        placeholder="+91 XXXXXXXXXX" required>
                                    @error('contact_number')
                                        <span class="error-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-enquiry">
                                    <label><i class="fas fa-envelope"></i> Email Address <span
                                            class="required">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        placeholder="your@email.com" required>
                                    @error('email')
                                        <span class="error-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-enquiry">
                                    <label><i class="fas fa-location-dot"></i> Location</label>
                                    <input type="text" name="location" value="{{ old('location') }}"
                                        placeholder="City / District">
                                    @error('location')
                                        <span class="error-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-enquiry">
                                    <label><i class="fas fa-comment-dots"></i> Message</label>
                                    <textarea name="message" rows="4" placeholder="Tell us about your requirements...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="error-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- CAPTCHA Field --}}
                                <div class="form-group-enquiry captcha-group">
                                    <label><i class="fas fa-shield-alt"></i> Enter CAPTCHA <span
                                            class="required">*</span></label>
                                    <div class="captcha-wrapper">
                                        <img src="{{ url('/captcha-image') }}" id="captcha-img" class="captcha-image"
                                            alt="CAPTCHA">
                                        <button type="button" onclick="refreshCaptcha()" class="captcha-refresh">
                                            <i class="fas fa-sync-alt"></i> Refresh
                                        </button>
                                    </div>
                                    <input type="text" name="captcha" placeholder="Enter the code shown above" required>
                                    @error('captcha')
                                        <span class="error-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn-submit-enquiry">
                                    <span>Send Enquiry</span>
                                    <i class="fas fa-paper-plane"></i>
                                </button>

                                <p class="form-footer-note">
                                    <i class="fas fa-lock"></i> Your information is safe with us.
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <section class="brand-slider-section">
                <h2 class="brand-title">CHOOSE PRODUCT BY BRANDS</h2>

                <div class="brand-slider">
                    <div class="brand-track">

                        {{-- First Loop --}}
                        @foreach ($slider as $item)
                            <div class="brand-item">
                                <img src="{{ url($item->image) }}" alt="brand">
                            </div>
                        @endforeach

                        {{-- Duplicate Loop (for infinite smooth scroll) --}}
                        @foreach ($slider as $item)
                            <div class="brand-item">
                                <img src="{{ url($item->image) }}" alt="brand">
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        </div>

        <section class="subsections">
            <div class="subsections-container">
                @if ($ourproductsections->count())
                    @foreach ($ourproductsections as $key => $section)
                        @if ($key % 2 == 0)
                            <div class="subsections-row">
                                {{-- LEFT BLUE --}}
                                <div class="subsections-left product-details d-flex flex-column justify-content-center">
                                    <div class="subsections-content">
                                        <h3>{{ $section->title }}</h3>
                                        <div class="subsections-text">{!! $section->description !!}</div>
                                    </div>
                                </div>

                                {{-- RIGHT LIGHT --}}
                                @if (isset($ourproductsections[$key + 1]))
                                    <div
                                        class="subsections-right product-details d-flex flex-column justify-content-center">
                                        <div class="subsections-content">
                                            <h3>{{ $ourproductsections[$key + 1]->title }}</h3>
                                            <div class="subsections-text">{!! $ourproductsections[$key + 1]->description !!}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </section>


        <section class="faq-wrapper">
            @if (isset($faqs) && $faqs->count() > 0)
                <div class="faq-section">
                    <div class="faq-header">
                        <h2 class="faq-title">FAQS</h2>
                        <p class="faq-subtitle">Everything you need to know about our solar solutions</p>
                    </div>

                    <div class="faq-grid">
                        @foreach ($faqs as $key => $faq)
                            <div class="faq-card">
                                <div class="faq-card-inner">
                                    <div class="faq-question" onclick="toggleFAQ(this)">
                                        <div class="faq-question-text">
                                            <i class="fas fa-solar-panel faq-icon-left"></i>
                                            <span>{{ $faq->question }}</span>
                                        </div>
                                        <div class="faq-icon-wrapper">
                                            <i class="fas fa-plus faq-icon"></i>
                                        </div>
                                    </div>
                                    <div class="faq-answer">
                                        <div class="faq-answer-content">

                                            <div>{!! $faq->answer !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        <script>
            function toggleFAQ(element) {
                // Get the clicked FAQ card
                const currentCard = element.closest('.faq-card');

                // Check if card exists
                if (!currentCard) return;

                // Check if current card is already active
                const isActive = currentCard.classList.contains('active');

                // Close all other FAQs (Accordion mode)
                const allCards = document.querySelectorAll('.faq-card');
                allCards.forEach(card => {
                    if (card !== currentCard && card.classList.contains('active')) {
                        card.classList.remove('active');
                        // Change icon back to plus for closed cards
                        const otherIcon = card.querySelector('.faq-icon');
                        if (otherIcon) {
                            otherIcon.className = 'fas fa-plus faq-icon';
                        }
                    }
                });

                // Toggle current card
                if (isActive) {
                    currentCard.classList.remove('active');
                    const icon = currentCard.querySelector('.faq-icon');
                    if (icon) {
                        icon.className = 'fas fa-plus faq-icon';
                    }
                } else {
                    currentCard.classList.add('active');
                    const icon = currentCard.querySelector('.faq-icon');
                    if (icon) {
                        icon.className = 'fas fa-minus faq-icon';
                    }
                }
            }
        </script>

        <script>
            function refreshCaptcha() {
                document.getElementById('captcha-img').src = "{{ url('/captcha-image') }}?" + Date.now();
            }
        </script>


   

@endsection
