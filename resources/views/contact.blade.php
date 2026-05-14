@extends('layouts.main')

@section('content')

@section('hero_title')

Contact Solar Masters

@endsection

@section('hero_text')

Talk with our solar experts today

@endsection
<!-- ========================= INFO CARDS (above form) ========================= -->
<section class="contact-cards-section">
    <h2>Get in Touch With Us</h2>
    <div class="contact-cards-grid">

        <!-- BLUE — Call Now (Dynamic) -->
        <div class="info-card card-blue">
            <i class="fas fa-phone"></i>
            <h4>Call Now</h4>
            <p>
                @php
                    $phones = App\Http\Controllers\HomeController::getphone();
                @endphp
                @foreach($phones as $phone)
                    {{ $phone->title }}<br>
                @endforeach
            </p>
        </div>

        <!-- GREEN — Email (Dynamic) -->
        <div class="info-card card-green">
            <i class="fas fa-envelope"></i>
            <h4>Email Support</h4>
            <p>
                @php
                    $emails = App\Http\Controllers\HomeController::getemail();
                @endphp
                @foreach($emails as $email)
                    {{ $email->title }}<br>
                @endforeach
            </p>
        </div>

        <!-- TEAL — South Kerala (Dynamic Address) -->
        <div class="info-card card-teal">
            <i class="fas fa-location-dot"></i>
            <h4>South Kerala</h4>
            <p>
                @php
                    $addresses = App\Http\Controllers\HomeController::getalladdress();
                @endphp
                @foreach($addresses as $address)
                    {{ $address->body }}
                    
                @endforeach
            </p>
        </div>

    </div>
</section>
<!-- ========================= INFO CARDS end ========================= -->

<!-- ========================= CONTACT FORM (Unified Container) ========================= -->
<section class="contact-section-enhanced">
    <div class="unified-container">
        <!-- Opening Hours & Info (Static Data) -->
        <div class="info-sidebar">
            <div class="info-header">
                <span class="badge">Opening Hours</span>
                <div class="hours-content">
                    <p><strong>Mon-Fri:</strong> 9am – 7.30pm</p>
                    <p><strong>Sat:</strong> 9am – 7.30pm</p>
                    <p><strong>Sun:</strong> <span class="closed">Closed</span></p>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <div class="form-header">
                <h3>Send Us a Message</h3>
                <p>Have a project or an idea in mind? Call us or simply drop a line for your requirements and suggestions. We will reply within 24 hours.</p>
            </div>

            <!-- Simple Success Message -->
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
            @endif

            <!-- Simple Error Messages -->
            @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ url('/enquiry-store') }}" method="POST" class="unified-form">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user"></i>
                            Your Name <span class="required">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required />
                        @error('name')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_number">
                            <i class="fas fa-mobile-alt"></i>
                            Contact Number <span class="required">*</span>
                        </label>
                        <input type="tel" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" placeholder="+91 12345 67890" required />
                        @error('contact_number')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            Email Address <span class="required">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required />
                        @error('email')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="location">
                            <i class="fas fa-location-dot"></i>
                            Location
                        </label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Your City/District" />
                        @error('location')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="message">
                        <i class="fas fa-comment-dots"></i>
                        Your Message
                    </label>
                    <textarea id="message" name="message" placeholder="Tell us about your project or inquiry..." rows="5">{{ old('message') }}</textarea>
                    @error('message')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

<!-- CAPTCHA -->
<div class="form-group full-width">
    <label>
        <i class="fas fa-shield-alt"></i>
        Enter CAPTCHA <span class="required">*</span>
    </label>

    <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
        <img src="{{ url('/captcha-image') }}" id="captcha-img" 
             style="height:50px; border-radius:6px; border:1px solid #ddd;">
        
        <button type="button" onclick="refreshCaptcha()" 
                style="border:none; background:#eee; padding:8px 12px; border-radius:6px; cursor:pointer;">
            <i class="fas fa-sync-alt"></i> Refresh
        </button>
    </div>

    <input type="text" name="captcha" placeholder="Enter CAPTCHA" required
           style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
    
    @error('captcha')
    <span class="error-message" style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">
        <i class="fas fa-exclamation-circle"></i> {{ $message }}
    </span>
    @enderror
</div>
                

                <div class="form-footer">
                    <button type="submit" class="btn-send-enhanced">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                    <p class="form-note">
                        <i class="fas fa-lock"></i> Your information is safe with us.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- ========================= CONTACT FORM end ========================= -->

<!-- ========================= MAP ========================= -->
<div class="map-section">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.1234!2d76.312345!3d10.023456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080d514abcd123%3A0x123456789abcdef!2sSolar%20Master%20Pvt%20Ltd%2C%20MC%20Building%20Edappally%2C%20Opp%20Metro%20Piller%20363%2C%20Ernakulam%2C%20Kerala%20682024!5e0!3m2!1sen!2sin!4v1690000000000!5m2!1sen!2sin"
        width="100%"
        height="450"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Solar Master Head Office">
    </iframe>
</div>
<!-- ========================= MAP end ========================= -->



<script>
function refreshCaptcha() {
    document.getElementById('captcha-img').src = "{{ route('captcha.image') }}?" + Date.now();
}
</script>


@endsection