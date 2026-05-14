@extends('layouts.main')


 @php
    $banner = App\Http\Controllers\HomeController::getpbanner();
    @endphp

@section('content')

<section class="page-banner">

            <div class="image-layer" style="background-image:url({{ asset( $banner) }});"></div>

    <div class="banner-inner">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>Support Center</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">Support</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Support Section-->
<section class="contact-section py-5">
    <div class="auto-container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="sec-title text-center with-separator mb-5">
                    <h2>How Can We Help You?</h2>
                    <div class="separator">
                        <span class="cir c-1"></span>
                        <span class="cir c-2"></span>
                        <span class="cir c-3"></span>
                    </div>
                    <div class="lower-text">Our support team is here to help you with any questions or issues you may have.</div>
                </div>

                <!-- Support Features -->
                <div class="row mb-5">
                    <div class="col-md-4 text-center mb-4">
                        <div class="support-feature">
                            <div class="icon mb-3">
                                <i class="flaticon-24-hours text-success" style="font-size: 48px;"></i>
                            </div>
                            <h5>24/7 Support</h5>
                            <p class="text-muted">We're here to help you anytime, day or night.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="support-feature">
                            <div class="icon mb-3">
                                <i class="flaticon-technical-support text-success" style="font-size: 48px;"></i>
                            </div>
                            <h5>Expert Help</h5>
                            <p class="text-muted">Get assistance from our experienced support team.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="support-feature">
                            <div class="icon mb-3">
                                <i class="flaticon-email text-success" style="font-size: 48px;"></i>
                            </div>
                            <h5>Quick Response</h5>
                            <p class="text-muted">We typically respond within a few hours.</p>
                        </div>
                    </div>
                </div>

                <!-- Support Form -->
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('support.submit') }}" id="supportForm">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="form-label fw-semibold">Full Name *</label>
                                        <input type="text" name="name" class="form-control form-control-lg" 
                                               placeholder="Enter your full name" 
                                               value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="form-label fw-semibold">Email Address *</label>
                                        <input type="email" name="email" class="form-control form-control-lg" 
                                               placeholder="Enter your email" 
                                               value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" name="phone" class="form-control form-control-lg" 
                                       placeholder="Enter your phone number (optional)" 
                                       value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-semibold">Subject *</label>
                                <input type="text" name="subject" class="form-control form-control-lg" 
                                       placeholder="Enter a brief subject for your support request" 
                                       value="{{ old('subject') }}" required>
                                <small class="form-text text-muted">Examples: "Login Issue", "Payment Problem", "Feature Request", etc.</small>
                                @error('subject')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-semibold">Message *</label>
                                <textarea name="message" class="form-control form-control-lg" 
                                          rows="6" placeholder="Please describe your issue in detail..." 
                                          required>{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="fa fa-paper-plane me-2"></i> 
                                    Submit Support Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Additional Support Info -->
                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title">Before Submitting</h5>
                                <ul class="list-unstyled">
                                    
                                    <li class="mb-2"><i class="fa fa-check text-success me-2"></i> Include relevant screenshots</li>
                                    <li class="mb-2"><i class="fa fa-check text-success me-2"></i> Provide detailed description</li>
                                    <li><i class="fa fa-check text-success me-2"></i> Include error messages if any</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title">What Happens Next?</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fa fa-clock text-success me-2"></i> You'll receive a confirmation email</li>
                                    <li class="mb-2"><i class="fa fa-user text-success me-2"></i> Our team will review your request</li>
                                    <li class="mb-2"><i class="fa fa-reply text-success me-2"></i> We'll respond within 24 hours</li>
                                    <li><i class="fa fa-check-circle text-success me-2"></i> We'll work to resolve your issue</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('styles')
<style>
.support-feature {
    padding: 30px 20px;
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.support-feature:hover {
    transform: translateY(-5px);
}

.card {
    border-radius: 15px;
}

.form-control-lg {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: #164A25;
    box-shadow: 0 0 0 0.2rem rgba(22, 74, 37, 0.25);
}

.btn-success {
    background: linear-gradient(135deg, #164A25, #00AA55);
    border: none;
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(22, 74, 37, 0.3);
}

.alert {
    border-radius: 10px;
    border: none;
}

.form-text {
    font-size: 0.875rem;
    margin-top: 0.25rem;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation enhancement
    const form = document.getElementById('supportForm');
    if (form) {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i> Submitting...';
        });
    }

    // Auto-suggest common subjects
    const subjectInput = document.querySelector('input[name="subject"]');
    const commonSubjects = [
        "Login Issue",
        "Password Reset",
        "Payment Problem", 
        "Account Access",
        "Technical Error",
        "Feature Request",
        "Bug Report",
        "Partnership Inquiry",
        "Donation Issue",
        "Event Registration Problem",
        "Website Not Working",
        "Mobile App Issue"
    ];

    if (subjectInput) {
        subjectInput.addEventListener('focus', function() {
            this.setAttribute('list', 'common-subjects');
        });

        // Create datalist for suggestions
        const datalist = document.createElement('datalist');
        datalist.id = 'common-subjects';
        
        commonSubjects.forEach(subject => {
            const option = document.createElement('option');
            option.value = subject;
            datalist.appendChild(option);
        });

        document.body.appendChild(datalist);
    }
});
</script>
@endsection