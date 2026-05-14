@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="cookie-alert">

        <h1>Cookie Preferences</h1>

        <p>
            We use cookies to ensure basic website functionality.
            You can choose whether to allow optional cookies.
        </p>

        <!-- Necessary Cookies -->
        <div class="cookie-option">
            <label>
                <input type="checkbox" checked disabled>
                <strong>Necessary Cookies</strong>
            </label>
            <p>
                These cookies are required for core site functionality and
                cannot be disabled.
            </p>
        </div>

        <!-- Optional / Analytics Cookies -->
        <div class="cookie-option">
            <label>
                <input type="checkbox" id="analyticsCookies">
                <strong>Analytics & Optional Cookies</strong>
            </label>
            <p>
                These cookies help us understand how visitors interact with
                the website and improve performance.
            </p>
        </div>

        <!-- Actions -->
        <div class="cookie-actions mt-4">
            <button class="btn-accept" onclick="saveCookiePreferences()">
                Accept selected cookies
            </button>
        </div>

    </div>
</div>

@endsection