@extends('layouts.main')

@section('content')

<section class="faculty-grid-section">
    <div class="container">

        <!-- Heading -->
        <div class="text-center mb-2">
            <h2 class="faculty-grid-heading">Our Expert Faculties</h2>
        </div>

        <!-- Dynamic Cards -->
        <div class="row g-4">
            @forelse($faculties as $faculty)
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="faculty-card">
                    <div class="faculty-avatar-wrap">
                        <img src="{{ $faculty->image_url }}" alt="{{ $faculty->title }}" class="faculty-avatar" />
                    </div>
                    <p class="faculty-name">{{ $faculty->title }}</p>
                    <p class="faculty-exp">{{ $faculty->experience }}</p>
                    <p class="faculty-desc">{{ Str::limit($faculty->description, 80) }}</p>
                    <div class="faculty-tags">
                        @php
                        $qualifications = explode(',', $faculty->qualification);
                        @endphp
                        @foreach($qualifications as $qual)
                        @if(trim($qual))
                        <span class="faculty-tag">{{ trim($qual) }}</span>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center">
                    <p>No faculty members found.</p>
                </div>
            </div>
            @endforelse
        </div><!-- /row -->

    </div>
</section>

<!-- SECTION 2 · STATS BAR -->
<section class="home-stats-section">
    <div class="container">
        <div class="row home-stats-row gy-4">
            @foreach ($counters as $counter)
            <div class="col-6 col-md-3">
                <div class="home-stats-card">
                    <div class="home-stats-icon home-stats-icon-blue">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="home-stats-info">
                        <h4 class="home-stats-number">{{ $counter->title }}</h4>
                        <p class="home-stats-label">{!! $counter->body !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- SECTION 3 · TEACHING APPROACH -->
<section class="faculty-approach-section">
    <div class="container">
        <div class="row align-items-center gy-5">

            <!-- Left: illustration -->
            <div class="col-12 col-lg-5">
                <div class="faculty-approach-img-wrap">
                    <img src="{{ asset($teachingApproach->image) }}" alt="{{ $teachingApproach->title }}" class="faculty-approach-img" />
                </div>
            </div>

            <!-- Right: content -->
            <div class="col-12 col-lg-7">
                <div class="faculty-approach-content">
                    <span class="section-label mb-3">{{ $teachingApproach->keyword }}</span>
                    <h2 class="faculty-approach-heading">
                        {{ $teachingApproach->title }}
                    </h2>
                    <p class="faculty-approach-description">
                        {!! $teachingApproach->body !!}
                    </p>

                    <div class="faculty-approach-cards-row">
                        @foreach($teachingApproachCards as $card)
                        <div class="faculty-approach-card">
                            <div class="faculty-approach-icon">
                                <img src="{{ asset($card->image) }}" alt="{{ $card->title }}" class="faculty-approach-card-img" />
                            </div>
                            <p class="faculty-approach-card-title">{{ $card->title }}</p>
                            <p class="faculty-approach-card-desc">{!! $card->body !!}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* Category pill filter – UI toggle only */
    document.querySelectorAll('.faculty-pill').forEach(pill => {
        pill.addEventListener('click', () => {
            document.querySelectorAll('.faculty-pill').forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
        });
    });
</script>

@endsection