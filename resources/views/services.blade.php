@extends('layouts.main')

@section('content')
@section('hero_title')

Our Solar Services

@endsection

@section('hero_text')

Complete solar solutions for homes and businesses

@endsection
    <section class="solar-section">
        <div class="solar-card">

            <!-- Left Image -->
            <div class="solar-left">
                <img src="assets/img/services/highlight.png" alt="Solar Panel">
            </div>

            <!-- Right Content -->
<div class="solar-right">
    <h2>Power Your Home with Clean Energy</h2>
    @foreach ($highlights as $highlight)
        <ul>
            <li>
                <span>{{ $highlight->title }}</span>
            </li>
        </ul>
    @endforeach
</div>

            <!-- RIGHT SMALL IMAGE -->
            <img src="assets/img/services/house2.png" class="solar-house" alt="">
        </div>
    </section>


    <section class="solar-features-section">

        <!-- FEATURES -->
        <h2 class="section-title">Features & Benefits</h2>

        <div class="features-grid">
            @foreach ($features as $feature)
                <div class="feature-card lime">
                    {{-- Icon removed, circular image added --}}
                    @if($feature->image)
                        <div class="feature-image-wrapper">
                            <img src="{{ asset($feature->image) }}" alt="{{ $feature->title }}" class="feature-image-circle">
                        </div>
                    @endif
                    <h4>{{ $feature->title }}</h4>
                </div>
            @endforeach
        </div>


        <section class="tech-section">

            <h2 class="section-title">Technical Specifications</h2>
            <div class="tech-container">
                <div class="tech-box">
                    @foreach ($specifications as $specification)
                        <div class="tech-item">
                            <span>
                                {{-- Icon replaced with image --}}
                                @if($specification->image)
                                    <img src="{{ asset($specification->image) }}" alt="{{ $specification->title }}" class="spec-icon-image">
                                @else
                                    <i class="fas fa-battery-full"></i>
                                @endif
                                {{ $specification->title }}
                            </span>
                            <strong>{{ $specification->body }}</strong>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        </div>


        <!-- INSTALLATIONS -->
        <h2 class="section-title">Our Installations</h2>

        <div class="installations-grid">
            @foreach ($projectlisting as $project)
                <img src="{{ asset($project->image) }}" alt="{{ $project->title }}">
            @endforeach
        </div>
    </section>

@endsection