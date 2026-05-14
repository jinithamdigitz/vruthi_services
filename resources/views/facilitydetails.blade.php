@extends('layouts.main')



@section('content')

    <!-- Page Title -->
    <section class="page-title">
        <div class="auto-container">
            <div class="icons-box parallax-scene-1">
                <div class="icon-one" data-depth="0.10"></div>
                <div class="icon-two" data-depth="0.30">
                    <img src="{{ asset('assets/images/icons/vector-9.png') }}" alt="">
                </div>
                <div class="icon-three" data-depth="0.30">
                    <img src="{{ asset('assets/images/icons/vector-34.png') }}" alt="">
                </div>
                <div class="icon-four" data-depth="0.10"></div>
            </div>

            <h2>{{ $facility->title }}</h2>

            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.index') }}">Home</a></li>
                <li>Pages</li>
                <li><a href="{{ route('home.facilities') }}">Facilities</a></li>
                <li>{{ $facility->title }}</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Facility Detail -->
    <section class="facility-detail">
        <div class="auto-container">

            <!-- Back Button -->
            <a href="{{ route('home.facilities') }}" class="facility-detail__back">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Back to Facilities
            </a>

            <!-- Hero Image -->
            <div class="facility-detail__image-wrap">
                <img
                    class="facility-detail__image"
                    src="{{ asset($facility->image) }}"
                    alt="{{ $facility->title }}"
                >
            </div>

            <!-- Title -->
            <h2 class="facility-detail__title">{{ $facility->title }}</h2>
            <div class="facility-detail__divider"></div>

            <!-- Body -->
            <div class="facility-detail__body">
                {!! $facility->body !!}
            </div>

        </div>
    </section>
    <!-- End Facility Detail -->

@endsection