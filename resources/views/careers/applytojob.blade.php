@extends('layouts.main')

@section('content')

<style>
  /* ============================================
     APPLY TO JOB PAGE — Scoped to .apply-page
     No conflicts with other pages
     ============================================ */

  /* ── HERO ── */
  .apply-page .apply-hero {
    position: relative;
    min-height: 52vh;
    display: flex;
    align-items: flex-end;
    overflow: hidden;
  }

  .apply-page .apply-hero__bg {
    position: absolute;
    inset: 0;
    background-image: url('{{ asset("assets/img/careers-hero.jpg") }}');
    background-size: cover;
    background-position: center 40%;
  }

  .apply-page .apply-hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right,
        rgba(0, 0, 0, 0.90) 0%,
        rgba(0, 0, 0, 0.60) 50%,
        rgba(0, 0, 0, 0.20) 100%);
  }

  .apply-page .apply-hero__content {
    position: relative;
    z-index: 2;
    padding: 130px 0 64px;
  }

  .apply-page .apply-hero__breadcrumb {
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.5);
    margin-bottom: 18px;
  }

  .apply-page .apply-hero__breadcrumb a {
    color: rgba(255, 255, 255, 0.5);
    text-decoration: none;
    transition: color var(--transition-fast);
  }

  .apply-page .apply-hero__breadcrumb a:hover {
    color: var(--color-primary);
  }

  .apply-page .apply-hero__breadcrumb span {
    color: var(--color-primary);
  }

  .apply-page .apply-hero__title {
    font-family: var(--font-heading);
    font-size: clamp(2.2rem, 5vw, 3.6rem);
    font-weight: var(--fw-bold);
    color: #fff;
    line-height: 1.1;
    margin-bottom: 16px;
  }

  .apply-page .apply-hero__title em {
    font-style: normal;
    color: var(--color-primary);
  }

  .apply-page .apply-hero__sub {
    font-size: var(--fs-sm);
    color: rgba(255, 255, 255, 0.65);
    max-width: 420px;
    line-height: 1.85;
    margin: 0;
  }

  /* Logo watermark on hero right */
  .apply-page .apply-hero__logo-mark {
    position: absolute;
    right: 5%;
    top: 50%;
    transform: translateY(-50%);
    z-index: 3;
    opacity: 0.85;
    pointer-events: none;
  }

  .apply-page .apply-hero__logo-mark img {
    height: 52px;
    filter: saturate(1.9) brightness(1.2) contrast(1.1);
  }

  @media (max-width: 767.98px) {
    .apply-page .apply-hero__logo-mark {
      display: none;
    }
  }

  /* ── APPLICATION FORM SECTION ── */
  .apply-page .apply-form-section {
    background: var(--color-bg-light);
    padding: var(--space-3xl) 0;
  }

  /* Form card */
  .apply-page .apply-form-card {
    background: #16171f;
    border-radius: var(--radius-xl);
    padding: 52px 56px;
    box-shadow: var(--shadow-xl);
  }

  @media (max-width: 767.98px) {
    .apply-page .apply-form-card {
      padding: 32px 24px;
    }
  }

  .apply-page .apply-form-card__title {
    font-family: var(--font-heading);
    font-size: clamp(1.6rem, 3vw, 2rem);
    font-weight: var(--fw-bold);
    color: #fff;
    margin-bottom: 6px;
  }

  .apply-page .apply-form-card__sub {
    font-size: var(--fs-sm);
    color: rgba(255, 255, 255, 0.45);
    margin-bottom: 40px;
  }

  .apply-page .apply-form-card__sub strong {
    color: var(--color-primary);
    font-weight: var(--fw-semibold);
  }

  /* Job Info Box */
  .apply-page .job-info-box {
    background: rgba(200, 98, 42, 0.08);
    border-left: 3px solid var(--color-primary);
    padding: 20px 24px;
    margin-bottom: 32px;
    border-radius: var(--radius-sm);
  }

  .apply-page .job-info-box__title {
    font-family: var(--font-heading);
    font-size: 1.1rem;
    font-weight: var(--fw-bold);
    color: #fff;
    margin-bottom: 12px;
  }

  .apply-page .job-info-box__details {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.65);
  }

  .apply-page .job-info-box__details span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .apply-page .job-info-box__details i {
    color: var(--color-primary);
    font-size: 0.9rem;
  }

  /* Field labels */
  .apply-page .form-label-custom {
    display: block;
    font-family: var(--font-body);
    font-size: 0.82rem;
    font-weight: var(--fw-medium);
    color: rgba(255, 255, 255, 0.75);
    margin-bottom: 8px;
    letter-spacing: 0.02em;
  }

  .apply-page .form-label-custom .req {
    color: var(--color-primary);
    margin-left: 2px;
  }

  /* Text inputs & select */
  .apply-page .apply-input {
    width: 100%;
    padding: 13px 16px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: var(--radius-sm);
    color: rgba(255, 255, 255, 0.85);
    font-family: var(--font-body);
    font-size: var(--fs-sm);
    line-height: 1.5;
    transition: border-color var(--transition-fast), background var(--transition-fast);
    -webkit-appearance: none;
    appearance: none;
  }

  .apply-page .apply-input::placeholder {
    color: rgba(255, 255, 255, 0.28);
  }

  .apply-page .apply-input:focus {
    outline: none;
    border-color: var(--color-primary);
    background: rgba(255, 255, 255, 0.08);
    box-shadow: 0 0 0 3px rgba(200, 98, 42, 0.15);
  }

  .apply-page select.apply-input {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,0.45)' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 38px;
    cursor: pointer;
  }

  .apply-page select.apply-input option {
    background: #1e1f29;
    color: rgba(255, 255, 255, 0.85);
  }

  /* Phone field with country code */
  .apply-page .phone-group {
    display: flex;
    gap: 0;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: var(--radius-sm);
    overflow: hidden;
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
  }

  .apply-page .phone-group:focus-within {
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(200, 98, 42, 0.15);
  }

  .apply-page .phone-country {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 0 12px;
    background: rgba(255, 255, 255, 0.06);
    border-right: 1px solid rgba(255, 255, 255, 0.12);
    cursor: pointer;
    white-space: nowrap;
  }

  .apply-page .phone-country__flag {
    font-size: 1.1rem;
    line-height: 1;
  }

  .apply-page .phone-country select {
    background: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.82rem;
    font-family: var(--font-body);
    cursor: pointer;
    -webkit-appearance: none;
    appearance: none;
    padding-right: 4px;
    outline: none;
  }

  .apply-page .phone-country select option {
    background: #1e1f29;
  }

  .apply-page .phone-number-input {
    flex: 1;
    padding: 13px 16px;
    background: rgba(255, 255, 255, 0.05);
    border: none;
    color: rgba(255, 255, 255, 0.85);
    font-family: var(--font-body);
    font-size: var(--fs-sm);
  }

  .apply-page .phone-number-input::placeholder {
    color: rgba(255, 255, 255, 0.28);
  }

  .apply-page .phone-number-input:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.08);
  }

  /* Textarea */
  .apply-page textarea.apply-input {
    resize: vertical;
    min-height: 140px;
  }

  /* File upload dropzone */
  .apply-page .file-dropzone {
    border: 1.5px dashed rgba(255, 255, 255, 0.18);
    border-radius: var(--radius-md);
    padding: 40px 24px;
    text-align: center;
    cursor: pointer;
    background: rgba(255, 255, 255, 0.03);
    transition: border-color var(--transition-base), background var(--transition-base);
    position: relative;
  }

  .apply-page .file-dropzone:hover,
  .apply-page .file-dropzone.drag-over {
    border-color: var(--color-primary);
    background: rgba(200, 98, 42, 0.05);
  }

  .apply-page .file-dropzone input[type="file"] {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
  }

  .apply-page .file-dropzone__icon {
    font-size: 2rem;
    color: var(--color-primary);
    display: block;
    margin-bottom: 12px;
  }

  .apply-page .file-dropzone__text {
    font-size: var(--fs-sm);
    color: rgba(255, 255, 255, 0.5);
    line-height: 1.6;
    margin: 0;
  }

  .apply-page .file-dropzone__text a {
    color: var(--color-primary);
    text-decoration: underline;
    text-underline-offset: 2px;
  }

  .apply-page .file-name-display {
    margin-top: 10px;
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.5);
    min-height: 20px;
  }

  .apply-page .file-name-display.has-file {
    color: #4ade80;
  }

  /* Checkbox */
  .apply-page .apply-checkbox-wrap {
    display: flex;
    align-items: flex-start;
    gap: 10px;
  }

  .apply-page .apply-checkbox {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
    accent-color: var(--color-primary);
    cursor: pointer;
    margin-top: 2px;
  }

  .apply-page .apply-checkbox-label {
    font-size: var(--fs-sm);
    color: rgba(255, 255, 255, 0.55);
    line-height: 1.6;
  }

  .apply-page .apply-checkbox-label a {
    color: var(--color-primary);
    text-decoration: underline;
    text-underline-offset: 2px;
  }

  /* Submit button */
  .apply-page .btn-submit-app {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 15px 36px;
    background: var(--color-primary);
    color: #fff;
    border: 2px solid var(--color-primary);
    border-radius: var(--radius-sm);
    font-family: var(--font-body);
    font-size: var(--fs-sm);
    font-weight: var(--fw-semibold);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all var(--transition-base);
  }

  .apply-page .btn-submit-app:hover {
    background: var(--color-primary-dark);
    border-color: var(--color-primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(200, 98, 42, 0.35);
  }

  .apply-page .btn-submit-app:disabled {
    opacity: 0.55;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
  }

  /* Form divider */
  .apply-page .form-divider {
    border: none;
    height: 1px;
    background: rgba(255, 255, 255, 0.08);
    margin: 32px 0;
  }

  /* Section group heading inside form */
  .apply-page .form-group-heading {
    font-family: var(--font-heading);
    font-size: 0.7rem;
    font-weight: var(--fw-semibold);
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--color-primary);
    margin-bottom: 20px;
  }

  /* Validation error */
  .apply-page .field-error {
    font-size: 0.75rem;
    color: #f87171;
    margin-top: 5px;
    display: none;
  }

  .apply-page .apply-input.is-error {
    border-color: #f87171;
  }

  /* Success state */
  .apply-page .apply-success {
    display: none;
    text-align: center;
    padding: 48px 24px;
  }

  .apply-page .apply-success__icon {
    width: 72px;
    height: 72px;
    background: rgba(200, 98, 42, 0.12);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--color-primary);
    margin: 0 auto 20px;
  }

  .apply-page .apply-success__title {
    font-family: var(--font-heading);
    font-size: 1.5rem;
    font-weight: var(--fw-bold);
    color: #fff;
    margin-bottom: 10px;
  }

  .apply-page .apply-success__text {
    font-size: var(--fs-sm);
    color: rgba(255, 255, 255, 0.55);
    max-width: 400px;
    margin: 0 auto 28px;
    line-height: 1.8;
  }

  .apply-page .btn-back-careers {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 11px 24px;
    border: 1.5px solid rgba(255, 255, 255, 0.2);
    border-radius: var(--radius-sm);
    color: rgba(255, 255, 255, 0.7);
    font-size: var(--fs-sm);
    font-weight: var(--fw-medium);
    text-decoration: none;
    transition: all var(--transition-fast);
  }

  .apply-page .btn-back-careers:hover {
    border-color: var(--color-primary);
    color: var(--color-primary);
  }
</style>

<div class="apply-page">

  {{-- =============================================
       HERO - APPLY/APPLICATION PAGE (USING COMMON HERO)
       ============================================= --}}
  <section class="page-hero">
    <div class="page-hero__bg" style="background-image: url('{{ asset($careerJob->banner_image ?? ) }}');"></div>
    <div class="page-hero__overlay"></div>

    {{-- Optional: Logo watermark (can be added via CSS or kept as is) --}}
    @if(isset($showLogoWatermark) && $showLogoWatermark)
    <div class="apply-hero__logo-mark" style="position: absolute; bottom: 20px; right: 20px; z-index: 2; opacity: 0.1;">
      <img src="{{ asset('assets/img/Outline_Architects_Logo.png') }}" alt="Outline Architects" style="max-width: 120px;" />
    </div>
    @endif

    <div class="container page-hero__content">
      <nav class="page-hero__breadcrumb" aria-label="breadcrumb">
        <a href="{{ url('/') }}">Home</a>
        <span class="page-hero__breadcrumb-sep">/</span>
        <a href="{{ url('/careers') }}">Careers</a>
        <span class="page-hero__breadcrumb-sep">/</span>
        <span class="current">Apply for {{ $careerJob->title }}</span>
      </nav>

      <h1 class="page-hero__title">
        Apply for<br>
        <span class="accent">{{ $careerJob->title }}</span>
      </h1>

      @if($careerJob->short_description)
      <p class="page-hero__desc">
        {{ $careerJob->short_description }}
      </p>
      @endif
    </div>
  </section>

  {{-- =============================================
       APPLICATION FORM
       ============================================= --}}
  <section class="apply-form-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">

          <div class="apply-form-card">

            {{-- Success message (hidden by default) --}}
            <div class="apply-success" id="applySuccess">
              <div class="apply-success__icon">
                <i class="bi bi-check-lg"></i>
              </div>
              <h2 class="apply-success__title">Application Submitted!</h2>
              <p class="apply-success__text">
                Thank you for applying to Outline Architects. We've received your application for the <strong>{{ $careerJob->title }}</strong> position and will be in touch within 5–7 business days.
              </p>
              <a href="{{ url('/careers') }}" class="btn-back-careers">
                <i class="bi bi-arrow-left"></i> Back to Careers
              </a>
            </div>

            {{-- Form --}}
            <div id="applyFormWrap">

              <h2 class="apply-form-card__title">Job Application</h2>
              <p class="apply-form-card__sub">
                Please fill in the details below. Fields marked with <strong>*</strong> are required.
              </p>

              {{-- Job Information Box --}}
              <div class="job-info-box">
                <div class="job-info-box__title">{{ $careerJob->title }}</div>
                <div class="job-info-box__details">
                  <span><i class="bi bi-building"></i> {{ $careerJob->department }}</span>
                  <span><i class="bi bi-geo-alt"></i> {{ $careerJob->location }}</span>
                  <span><i class="bi bi-briefcase"></i> {{ ucfirst($careerJob->employment_type) }}</span>
                  <span><i class="bi bi-clock-history"></i> {{ $careerJob->experience }} years experience</span>
                </div>
              </div>

              <form id="applyForm" novalidate>
                @csrf
                <input type="hidden" name="job_id" value="{{ $careerJob->id }}">
                <input type="hidden" name="job_title" value="{{ $careerJob->title }}">
                <input type="hidden" name="job_department" value="{{ $careerJob->department }}">
                <input type="hidden" name="job_location" value="{{ $careerJob->location }}">
                <input type="hidden" name="job_type" value="{{ $careerJob->employment_type }}">

                {{-- ── PERSONAL DETAILS ── --}}
                <p class="form-group-heading">Personal Details</p>

                <div class="row gy-4">

                  <div class="col-md-6">
                    <label class="form-label-custom" for="fullName">
                      Full Name <span class="req">*</span>
                    </label>
                    <input
                      type="text"
                      id="fullName"
                      name="full_name"
                      class="apply-input"
                      placeholder="Enter your full name"
                      autocomplete="name" />
                    <p class="field-error" id="err-fullName">Please enter your full name.</p>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label-custom" for="email">
                      Email Address <span class="req">*</span>
                    </label>
                    <input
                      type="email"
                      id="email"
                      name="email"
                      class="apply-input"
                      placeholder="Enter your email address"
                      autocomplete="email" />
                    <p class="field-error" id="err-email">Please enter a valid email address.</p>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label-custom" for="location">
                      Current Location <span class="req">*</span>
                    </label>
                    <input
                      type="text"
                      id="location"
                      name="location"
                      class="apply-input"
                      placeholder="Enter your current location"
                      autocomplete="address-level2" />
                    <p class="field-error" id="err-location">Please enter your current location.</p>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label-custom" for="phoneNumber">
                      Phone Number <span class="req">*</span>
                    </label>
                    <div class="phone-group">
                      <div class="phone-country">
                        <span class="phone-country__flag" id="countryFlag">🇮🇳</span>
                        <select id="countryCode" name="country_code" onchange="updateFlag(this)">
                          <option value="+91" data-flag="🇮🇳">+91</option>
                          <option value="+971" data-flag="🇦🇪">+971</option>
                          <option value="+1" data-flag="🇺🇸">+1</option>
                          <option value="+44" data-flag="🇬🇧">+44</option>
                          <option value="+65" data-flag="🇸🇬">+65</option>
                          <option value="+60" data-flag="🇲🇾">+60</option>
                          <option value="+966" data-flag="🇸🇦">+966</option>
                          <option value="+974" data-flag="🇶🇦">+974</option>
                        </select>
                      </div>
                      <input
                        type="tel"
                        id="phoneNumber"
                        name="phone"
                        class="phone-number-input"
                        placeholder="Enter your phone number"
                        autocomplete="tel-national" />
                    </div>
                    <p class="field-error" id="err-phone">Please enter a valid phone number.</p>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label-custom" for="experience">
                      Experience (Years) <span class="req">*</span>
                    </label>
                    <select id="experience" name="experience" class="apply-input">
                      <option value="" disabled selected>Select experience</option>
                      <option value="0-1">0 – 1 Year (Fresher)</option>
                      <option value="1-3">1 – 3 Years</option>
                      <option value="3-5">3 – 5 Years</option>
                      <option value="5-8">5 – 8 Years</option>
                      <option value="8+">8+ Years</option>
                    </select>
                    <p class="field-error" id="err-experience">Please select your experience level.</p>
                  </div>

                </div>

                <hr class="form-divider" />

                {{-- ── COVER / DESCRIPTION ── --}}
                <p class="form-group-heading">Cover / Description</p>

                <div class="row gy-4">
                  <div class="col-12">
                    <label class="form-label-custom" for="coverLetter">
                      Cover / Description <span class="req">*</span>
                    </label>
                    <p style="font-size:0.78rem; color:rgba(255,255,255,0.38); margin-bottom:10px; margin-top:-4px;">
                      Tell us about yourself and why you're a great fit for this role.
                    </p>
                    <textarea
                      id="coverLetter"
                      name="cover_letter"
                      class="apply-input"
                      placeholder="Write your message here..."
                      rows="6"></textarea>
                    <p class="field-error" id="err-cover">Please write a brief cover note.</p>
                  </div>
                </div>

                <hr class="form-divider" />

                {{-- ── RESUME UPLOAD ── --}}
                <p class="form-group-heading">Resume / CV</p>

                <div class="row gy-4">
                  <div class="col-12">
                    <label class="form-label-custom">
                      Resume (PDF, DOC, DOCX – Max 5MB) <span class="req">*</span>
                    </label>
                    <div class="file-dropzone" id="dropzone">
                      <input
                        type="file"
                        id="resumeFile"
                        name="resume"
                        accept=".pdf,.doc,.docx"
                        onchange="handleFileSelect(this)" />
                      <i class="bi bi-cloud-arrow-up file-dropzone__icon"></i>
                      <p class="file-dropzone__text">
                        Drag &amp; drop your resume here<br>
                        or <a href="#" onclick="event.preventDefault(); document.getElementById('resumeFile').click();">browse</a> to upload
                      </p>
                    </div>
                    <p class="file-name-display" id="fileNameDisplay"></p>
                    <p class="field-error" id="err-resume">Please upload your resume (PDF, DOC, or DOCX).</p>
                  </div>
                </div>

                <hr class="form-divider" />

                {{-- ── CONSENT & SUBMIT ── --}}
                <div class="row align-items-center gy-4">

                  <div class="col-12">
                    <div class="apply-checkbox-wrap">
                      <input type="checkbox" id="agreeTerms" name="agree_terms" class="apply-checkbox" />
                      <label class="apply-checkbox-label" for="agreeTerms">
                        I agree to the <a href="#">Privacy Policy</a> and <a href="#">Terms &amp; Conditions</a>.
                      </label>
                    </div>
                    <p class="field-error" id="err-terms">You must agree to the terms to continue.</p>
                  </div>

                  <div class="col-12">
                    <button type="submit" class="btn-submit-app" id="submitBtn">
                      Submit Application &nbsp;<i class="bi bi-arrow-right"></i>
                    </button>
                  </div>

                </div>

              </form>
            </div>{{-- end #applyFormWrap --}}

          </div>{{-- end .apply-form-card --}}
        </div>
      </div>
    </div>
  </section>

</div>{{-- end .apply-page --}}

<script>
  (function() {
    'use strict';

    /* ── Country flag sync ── */
    window.updateFlag = function(select) {
      const opt = select.options[select.selectedIndex];
      document.getElementById('countryFlag').textContent = opt.dataset.flag || '🌐';
    };

    /* ── File select handler ── */
    window.handleFileSelect = function(input) {
      const display = document.getElementById('fileNameDisplay');
      const err = document.getElementById('err-resume');

      if (!input.files.length) {
        display.textContent = '';
        display.classList.remove('has-file');
        return;
      }

      const file = input.files[0];
      const maxSize = 5 * 1024 * 1024; // 5MB
      const allowed = ['application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
      ];

      if (!allowed.includes(file.type) && !file.name.match(/\.(pdf|doc|docx)$/i)) {
        display.textContent = '✗ Invalid file type. Only PDF, DOC, DOCX allowed.';
        display.classList.remove('has-file');
        input.value = '';
        return;
      }

      if (file.size > maxSize) {
        display.textContent = '✗ File too large. Max 5MB allowed.';
        display.classList.remove('has-file');
        input.value = '';
        return;
      }

      display.textContent = '✓ ' + file.name;
      display.classList.add('has-file');
      err.style.display = 'none';
    };

    /* ── Drag & drop visual ── */
    const dropzone = document.getElementById('dropzone');
    if (dropzone) {
      dropzone.addEventListener('dragover', e => {
        e.preventDefault();
        dropzone.classList.add('drag-over');
      });
      dropzone.addEventListener('dragleave', () => dropzone.classList.remove('drag-over'));
      dropzone.addEventListener('drop', e => {
        e.preventDefault();
        dropzone.classList.remove('drag-over');
        const fileInput = document.getElementById('resumeFile');
        if (e.dataTransfer.files.length) {
          const dt = new DataTransfer();
          dt.items.add(e.dataTransfer.files[0]);
          fileInput.files = dt.files;
          handleFileSelect(fileInput);
        }
      });
    }

    /* ── Form validation & submit ── */
    const form = document.getElementById('applyForm');
    const submitBtn = document.getElementById('submitBtn');

    function showError(id, show) {
      const el = document.getElementById('err-' + id);
      if (el) el.style.display = show ? 'block' : 'none';
    }

    function validateForm() {
      let valid = true;

      // Full Name
      const name = document.getElementById('fullName').value.trim();
      const nameOk = name.length >= 2;
      showError('fullName', !nameOk);
      document.getElementById('fullName').classList.toggle('is-error', !nameOk);
      if (!nameOk) valid = false;

      // Email
      const email = document.getElementById('email').value.trim();
      const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      showError('email', !emailOk);
      document.getElementById('email').classList.toggle('is-error', !emailOk);
      if (!emailOk) valid = false;

      // Location
      const loc = document.getElementById('location').value.trim();
      const locOk = loc.length >= 2;
      showError('location', !locOk);
      document.getElementById('location').classList.toggle('is-error', !locOk);
      if (!locOk) valid = false;

      // Phone
      const phone = document.getElementById('phoneNumber').value.trim();
      const phoneOk = /^\d{7,15}$/.test(phone.replace(/[\s\-().]/g, ''));
      showError('phone', !phoneOk);
      if (!phoneOk) valid = false;

      // Experience
      const exp = document.getElementById('experience').value;
      showError('experience', !exp);
      document.getElementById('experience').classList.toggle('is-error', !exp);
      if (!exp) valid = false;

      // Cover letter
      const cover = document.getElementById('coverLetter').value.trim();
      const coverOk = cover.length >= 30;
      showError('cover', !coverOk);
      document.getElementById('coverLetter').classList.toggle('is-error', !coverOk);
      if (!coverOk) valid = false;

      // Resume
      const resume = document.getElementById('resumeFile');
      const resumeOk = resume.files && resume.files.length > 0;
      showError('resume', !resumeOk);
      if (!resumeOk) valid = false;

      // Terms
      const terms = document.getElementById('agreeTerms').checked;
      showError('terms', !terms);
      if (!terms) valid = false;

      return valid;
    }

    if (form) {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!validateForm()) return;

        // Disable button & show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Submitting…';

        // Send via fetch (Laravel route)
        const formData = new FormData(form);

        fetch('{{ route("careers.submit-application") }}', {
            method: 'POST',
            body: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
              'Accept': 'application/json'
            }
          })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              document.getElementById('applyFormWrap').style.display = 'none';
              document.getElementById('applySuccess').style.display = 'block';
            } else {
              submitBtn.disabled = false;
              submitBtn.innerHTML = 'Submit Application &nbsp;<i class="bi bi-arrow-right"></i>';
              alert(data.message || 'Something went wrong. Please try again.');
            }
          })
          .catch(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Submit Application &nbsp;<i class="bi bi-arrow-right"></i>';
            alert('Network error. Please check your connection and try again.');
          });
      });
    }

    /* ── Live input clear errors ── */
    document.querySelectorAll('.apply-page .apply-input').forEach(input => {
      input.addEventListener('input', function() {
        this.classList.remove('is-error');
      });
    });

  })();
</script>

@endsection