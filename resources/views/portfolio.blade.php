@extends('layouts.main')

@section('title', 'Portfolio — Outline Architects')




@section('content')
{{-- ══════════════════════════════════════
     HERO - DYNAMIC
══════════════════════════════════════ --}}
<section class="pf-pg__hero">
    <div class="pf-pg__hero-bg" style="background-image: url('{{ asset($portfolioBanner->image) }}');"></div>
    <div class="pf-pg__hero-overlay"></div>
    <div class="container pf-pg__hero-content">
        <nav class="pf-pg__breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home.index') }}">Home</a>
            <span class="pf-pg__breadcrumb-sep">›</span>
            <span>Portfolio</span>
        </nav>

        @php
        $titleParts = explode('|', $portfolioBanner->title);
        $firstLine = trim($titleParts[0]);
        $secondLine = trim($titleParts[1]);
        @endphp
        <h1 class="pf-pg__hero-title">
            {{ $firstLine }}
            <span class="pf-pg__accent">{{ $secondLine }}</span>
        </h1>

        <p class="pf-pg__hero-desc">
            {!! strip_tags($portfolioBanner->body) !!}
        </p>

        <a href="{{ route('home.index') }}" class="btn-outline-custom btn-primary-custom">
            View Project Inquiry
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>
</section>

{{-- ══════════════════════════════════════
     FILTER BAR
══════════════════════════════════════ --}}
<div class="pf-pg__filter-bar">
    <div class="container">
        <div class="pf-pg__filter-inner">
            <div class="pf-pg__filter-tabs" role="tablist" aria-label="Filter projects by category">
                <button class="pf-pg__filter-tab active"
                    data-filter="*"
                    role="tab"
                    aria-selected="true">All Projects</button>
                @foreach($categories as $category)
                <button class="pf-pg__filter-tab"
                    data-filter="{{ $category->slug }}"
                    role="tab"
                    aria-selected="false">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════
     MASONRY GRID
══════════════════════════════════════ --}}
<section class="pf-pg__grid-section">
    <div class="container">

        <div class="pf-pg__masonry-grid" id="pf-masonry">

            @php
            $colPatterns = [
            0 => ['xl', 'sm', 'lg', 'md'],
            1 => ['sm', 'lg', 'md', 'xl'],
            2 => ['lg', 'md', 'xl', 'sm'],
            ];
            @endphp

            @forelse($portfolios as $portfolio)
            @php
            $col = $loop->index % 3;
            $row = (int) floor($loop->index / 3);
            $pattern = $colPatterns[$col];
            $cardSize = $pattern[$row % count($pattern)];
            @endphp
            <div class="pf-pg__masonry-item"
                data-category="{{ $portfolio->category->slug }}">

                <article class="pf-pg__card"
                    data-size="{{ $cardSize }}">

                    {{-- Image --}}
                    <div class="pf-pg__card-img-wrap">
                        <img src="{{ asset($portfolio->image) }}"
                            alt="{{ $portfolio->title }}"
                            loading="lazy">
                        <span class="pf-pg__card-badge">{{ $portfolio->category->name }}</span>
                    </div>

                    {{-- Body --}}
                    <div class="pf-pg__card-body">
                        <p class="pf-pg__card-location">{{ $portfolio->location }}</p>
                        <h3 class="pf-pg__card-title">{{ $portfolio->title }}</h3>
                        <p class="pf-pg__card-text">{{ Str::limit($portfolio->body, 120) }}</p>
                    </div>

                    {{-- Footer --}}
                    <div class="pf-pg__card-footer">
                        <span class="pf-pg__card-cat">{{ $portfolio->category->name }}</span>
                        <a href="#" class="pf-pg__read-more">
                            View Project
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                </article>
            </div>
            @empty
            <p class="text-center" style="color:rgba(255,255,255,.35); padding:60px 0;">
                No projects found.
            </p>
            @endforelse

        </div>{{-- /#pf-masonry --}}

        {{-- Empty state (JS-controlled when filter yields 0) --}}
        <div class="pf-pg__empty" id="pf-empty" aria-live="polite">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            No projects found in this category.
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $portfolios->links() }}
        </div>

    </div>
</section>

@endsection


<script>
    (function() {
        'use strict';

        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {

            const tabs = document.querySelectorAll('.pf-pg__filter-tab');
            const masonry = document.getElementById('pf-masonry');
            const empty = document.getElementById('pf-empty');

            // If masonry doesn't exist, exit
            if (!masonry) return;

            function filterCards(cat) {
                const items = masonry.querySelectorAll('.pf-pg__masonry-item');
                let visibleCount = 0;

                items.forEach(function(item) {
                    const itemCategory = item.getAttribute('data-category');

                    // Check if the item should be visible
                    const shouldShow = (cat === '*') || (itemCategory === cat);

                    if (shouldShow) {
                        item.style.display = '';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Show/hide empty state message
                if (empty) {
                    empty.style.display = visibleCount === 0 ? 'block' : 'none';
                }
            }

            // Add click event listeners to all filter tabs
            tabs.forEach(function(tab) {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    const filterValue = this.getAttribute('data-filter');

                    // Update active state on tabs
                    tabs.forEach(function(t) {
                        t.classList.remove('active');
                        t.setAttribute('aria-selected', 'false');
                    });
                    this.classList.add('active');
                    this.setAttribute('aria-selected', 'true');

                    // Apply filter
                    filterCards(filterValue);
                });
            });
        });
    })();
</script>