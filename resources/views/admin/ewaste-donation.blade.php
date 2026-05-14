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
                <h1>Donate E-Waste</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li class="active">Donate E-Waste</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="default-form booking-form">
    <section class="ewaste-donation-form py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-5">
                           
                            <div class="text-center mb-4">
                                <div class="impact-stats">
                                    <div class="stat-item">
                                        <i class="fas fa-recycle text-success me-2"></i>
                                        <span>Declutter Your Premises</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Alert Messages Section -->
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <div>
                                            <strong>{{ session('success') }}</strong>
                                            @if(session('donation_id'))
                                                <div class="small">Reference ID: {{ session('donation_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>{{ session('error') }}</strong>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="validationAlert">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <strong>Please correct the following errors:</strong>
                                    </div>
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('ewaste.donate') }}" id="donationForm">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Name *</label>
                                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter your full name" required value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Email Address *</label>
                                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter your email" required value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Contact Number *</label>
                                            <input type="text" name="phone" class="form-control form-control-lg" placeholder="Enter your phone number" required value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">We are *</label>
                                            <select name="donor_type" class="form-control form-control-lg" required>
                                                <option value="">Select Category</option>
                                                <option value="Individual/Residential" {{ old('donor_type') == 'Individual/Residential' ? 'selected' : '' }}>Individual/Residential</option>
                                                <option value="Association/Education" {{ old('donor_type') == 'Association/Education' ? 'selected' : '' }}>Association/Education</option>
                                                <option value="Institution/Corporate/Commercial" {{ old('donor_type') == 'Institution/Corporate/Commercial' ? 'selected' : '' }}>Institution/Corporate/Commercial</option>
                                                <option value="Establishment" {{ old('donor_type') == 'Establishment' ? 'selected' : '' }}>Establishment</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Pickup Location *</label>
                                    <textarea name="pickup_location" class="form-control form-control-lg" rows="3" placeholder="Enter complete pickup address with landmark" required>{{ old('pickup_location') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">What kind of waste you want to donate *</label>
                                    <textarea name="waste_type" class="form-control form-control-lg" rows="3" placeholder="Describe the electronic items you want to donate (e.g., old computers, mobile phones, printers, etc.)" required>{{ old('waste_type') }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Message</label>
                                    <textarea name="message" class="form-control form-control-lg" rows="3" placeholder="Any additional information or special instructions...">{{ old('message') }}</textarea>
                                </div>

                                <!-- GDPR Consent Section -->
                                <div class="gdpr-consent-section mb-4">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title fw-semibold mb-3 text-success">
                                                <i class="fas fa-shield-alt me-2"></i>Data Protection & Privacy
                                            </h6>
                                            
                                            <!-- Required Consent for Processing -->
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" 
                                                           type="checkbox" 
                                                           name="gdpr_consent" 
                                                           id="gdpr_consent" 
                                                           value="1" 
                                                           {{ old('gdpr_consent') ? 'checked' : '' }}
                                                           required>
                                                    <label class="form-check-label fw-medium" for="gdpr_consent">
                                                        I consent to the processing of my personal data for e-waste donation pickup and communication purposes. *
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Privacy Policy Link -->
                                            <div class="privacy-links mt-3 pt-3 border-top">
                                                <small class="text-muted">
                                                    By proceeding, you acknowledge that you have read and understand our 
                                                    <a href="{{ route('privacy') }}" target="_blank" class="text-success text-decoration-underline">Privacy Policy</a> 
                                                    and 
                                                    <a href="{{ route('termsandconditions') }}" target="_blank" class="text-success text-decoration-underline">Terms of Service</a>.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm donation-btn" id="donationSubmitBtn">
                                        <i class="fas fa-recycle me-2"></i> 
                                        <span class="btn-text">Submit Donation Request</span>
                                        <div class="spinner-border spinner-border-sm ms-2 d-none" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                    
                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            Our team will contact you within 24 hours to schedule pickup
                                        </small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('styles')
<style>
.impact-stats {
    background: linear-gradient(135deg, #164A25, #00AA55);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.stat-item {
    font-weight: 600;
    font-size: 1.1em;
}

.donation-btn {
    background: linear-gradient(135deg, #164A25, #00AA55);
    border: none;
    padding: 12px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.donation-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(22, 74, 37, 0.3);
}

.donation-btn:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Alert Styles */
.alert {
    border-radius: 10px;
    border: none;
    padding: 15px 20px;
    margin-bottom: 20px;
    animation: slideInDown 0.5s ease-out;
    position: relative;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border: 1px solid #c3e6cb;
    color: #155724;
    border-left: 4px solid #00AA55;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    border: 1px solid #f5c6cb;
    color: #721c24;
    border-left: 4px solid #dc3545;
}

/* Custom Close Button */
.btn-close {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    font-size: 1.2rem;
    font-weight: bold;
    color: inherit;
    opacity: 0.7;
    cursor: pointer;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.btn-close:hover {
    opacity: 1;
    background-color: rgba(0, 0, 0, 0.1);
}

.btn-close::before {
    content: "×";
    font-size: 1.5rem;
    line-height: 1;
}

@keyframes slideInDown {
    from {
        transform: translateY(-20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* GDPR Consent Styles */
.gdpr-consent-section .card {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef) !important;
    border: 1px solid #dee2e6 !important;
}

.gdpr-consent-section .form-check-input {
    margin-top: 0.25rem;
}

.gdpr-consent-section .form-check-input:checked {
    background-color: #164A25;
    border-color: #164A25;
}

.gdpr-consent-section .form-check-label {
    font-size: 0.95rem;
    line-height: 1.4;
    cursor: pointer;
}

.gdpr-consent-section .form-check-input:required + .form-check-label::after {
    content: " *";
    color: #dc3545;
}

.privacy-links a:hover {
    color: #0d351a !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .gdpr-consent-section .card-body {
        padding: 1rem;
    }
    
    .card-body.p-5 {
        padding: 2rem !important;
    }
}
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Form validation
    function validateForm() {
        const requiredFields = [
            'input[name="name"]',
            'input[name="email"]', 
            'input[name="phone"]',
            'select[name="donor_type"]',
            'textarea[name="pickup_location"]',
            'textarea[name="waste_type"]',
            '#gdpr_consent'
        ];

        let isValid = true;

        // Check required fields
        requiredFields.forEach(field => {
            const element = $(field);
            if (field === '#gdpr_consent') {
                if (!element.is(':checked')) {
                    isValid = false;
                }
            } else {
                if (!element.val().trim()) {
                    isValid = false;
                }
            }
        });

        $('#donationSubmitBtn').prop('disabled', !isValid);
        return isValid;
    }

    // Real-time form validation
    $('input, textarea, select').on('input change', function() {
        const isValid = validateForm();
        $('#donationSubmitBtn').prop('disabled', !isValid);
    });

    // Form submission
    $('#donationForm').on('submit', function(e) {
        const submitBtn = $('.donation-btn');
        const btnText = $('.btn-text');
        const spinner = $('.spinner-border');
        
        // Show loading state
        btnText.text('Submitting...');
        spinner.removeClass('d-none');
        submitBtn.prop('disabled', true);
    });

    // Auto-hide success message after 8 seconds
    const successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.classList.add('fade');
            setTimeout(() => {
                successAlert.remove();
            }, 500);
        }, 8000);
    }

    // Auto-hide error messages after 10 seconds
    const errorAlert = document.getElementById('errorAlert');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.classList.add('fade');
            setTimeout(() => {
                errorAlert.remove();
            }, 500);
        }, 10000);
    }

    const validationAlert = document.getElementById('validationAlert');
    if (validationAlert) {
        setTimeout(() => {
            validationAlert.classList.add('fade');
            setTimeout(() => {
                validationAlert.remove();
            }, 500);
        }, 10000);
    }

    // Initial form validation
    validateForm();
});
</script>
@endsection