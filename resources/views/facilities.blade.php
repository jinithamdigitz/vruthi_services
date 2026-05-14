@extends('layouts.main')

@section('content')

<style>
    .facility-box {
        background: #fff;
        padding: 15px;
        border: 1px solid #eee;
        text-align: center;
        transition: 0.3s;
        height: 100%;
    }

    .facility-box img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .facility-box h5 {
        margin-top: 15px;
        font-weight: 600;
    }

    .facility-box:hover {
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .facilities-section {
        padding-bottom: 60px;
    }
    .facilities-section {
    padding-bottom: 120px; 
}

    .facility-box {
    margin-bottom: 30px;
}
</style>

<!-- Page Title -->
<section class="page-title">
    <div class="auto-container">
        <!-- Icons Box -->
        <div class="icons-box parallax-scene-1">
            <div class="icon-one" data-depth="0.10"></div>
            <div class="icon-two" data-depth="0.30">
                <img src="{{ asset('assets/images/icons/vector-9.png') }}" alt="" />
            </div>
            <div class="icon-three" data-depth="0.30">
                <img src="{{ asset('assets/images/icons/vector-34.png') }}" alt="" />
            </div>
            <div class="icon-four" data-depth="0.10"></div>
        </div>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li>Pages</li>
            <li><a href="{{ route('home.facilities') }}">Facilities</a></li>
        </ul>
    </div>
</section>
<!-- End Page Title -->

<!-- Facilities Section -->
<section class="facilities-section">
    <div class="auto-container">
        <div class="row">

        @foreach ($facilities as $facility)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="facility-box">
            <a href="{{ route('home.facilitydetails', $facility->slug) }}">
                <img src="{{ asset($facility->image) }}">
                <h5>{{ $facility->title }}</h5>
            </a>
        </div>
    </div>
@endforeach

        </div>
    </div>
</section>

@endsection