@extends('layouts.main')

@section('content')



<div class="apply-page">

{{-- =============================================
       HERO - APPLY/APPLICATION PAGE (USING COMMON HERO)
       ============================================= --}}
<section class="page-hero">
    @if($applybanner->image)
    <div class="page-hero__bg" style="background-image: url('{{ asset($applybanner->image) }}');"></div>
    @endif
    <div class="page-hero__overlay"></div>

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