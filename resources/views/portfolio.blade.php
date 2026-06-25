@extends('layouts.main')

@section('title', 'Portfolio — Outline Architects')




@section('content')
{{-- ══════════════════════════════════════
     HERO - DYNAMIC (PORTFOLIO PAGE) - USING COMMON HERO
══════════════════════════════════════ --}}
<section class="portfolio-hero">

    <div class="portfolio-hero__bg-overlay"></div>
    <div class="portfolio-hero__wave-shape"></div>

    <div class="container">

        <div class="portfolio-hero__content">

            <div class="portfolio-hero__left reveal reveal-left">

                <nav class="portfolio-hero__breadcrumb">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Portfolio</span>
                </nav>


                <p class="portfolio-hero__tagline">
                    {{ $portfolioBanner->title }}
                </p>

                <p class="portfolio-hero__desc">
                    {{ $portfolioBanner->body }}
                </p>

                <div class="portfolio-hero__rule"></div>

            </div>

            <div class="portfolio-hero__right reveal reveal-right">

                <img src="{{ $portfolioBanner->image }}"
                     alt="Portfolio"
                     class="portfolio-hero__img">

            </div>

        </div>

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

{{-- ════════════════════════════════════
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
                        <p class="pf-pg__card-text">{{ Str::limit($portfolio->body, 150) }}</p>
                    </div>

                    {{-- Footer --}}
                    <div class="pf-pg__card-footer">
                        <span class="pf-pg__card-cat">{{ $portfolio->category->name }}</span>
                    </div>

                </article>
            </div>
            @empty
            <p class="text-center" style="color:rgba(255,255,255,.35); padding:60px 0;">
                No projects found.
            </p>
            @endforelse

        </div>
        {{-- /#pf-masonry --}}

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