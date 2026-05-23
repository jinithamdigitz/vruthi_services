@extends('layouts.main')

@section('title', 'Portfolio — Outline Architects')


<style>
    /* ============================================================
   PORTFOLIO PAGE  —  pf-pg__ prefix
   True CSS masonry via column-count — cards flow top-to-bottom
   in each column; cycling image heights create visual rhythm.
   ============================================================ */

    /* ── HERO ── */
    .pf-pg__hero {
        position: relative;
        min-height: 520px;
        background: #000;
        overflow: hidden;
        display: flex;
        align-items: flex-end;
    }

    .pf-pg__hero-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
    }

    .pf-pg__hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(105deg, rgba(0, 0, 0, .88) 0%, rgba(0, 0, 0, .55) 55%, rgba(0, 0, 0, .25) 100%);
    }

    .pf-pg__hero-content {
        position: relative;
        z-index: 2;
        padding-top: 160px;
        padding-bottom: 72px;
    }

    .pf-pg__breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: var(--fs-xs);
        font-weight: var(--fw-medium);
        letter-spacing: .08em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, .45);
        margin-bottom: 20px;
    }

    .pf-pg__breadcrumb a {
        color: rgba(255, 255, 255, .45);
        text-decoration: none;
        transition: color var(--transition-fast);
    }

    .pf-pg__breadcrumb a:hover {
        color: var(--color-primary);
    }

    .pf-pg__breadcrumb span {
        color: var(--color-primary);
    }

    .pf-pg__breadcrumb-sep {
        font-size: 10px;
        opacity: .35;
    }

    .pf-pg__hero-title {
        font-family: var(--font-heading);
        font-weight: var(--fw-extrabold);
        color: #fff;
        font-size: clamp(2.4rem, 5.5vw, 3.8rem);
        line-height: 1.1;
        margin-bottom: 18px;
    }

    .pf-pg__hero-title .pf-pg__accent {
        color: var(--color-primary);
        display: block;
    }

    .pf-pg__hero-desc {
        font-size: var(--fs-base);
        color: rgba(255, 255, 255, .62);
        line-height: 1.8;
        max-width: 460px;
        margin-bottom: 32px;
    }

    /* ── FILTER BAR ── */
    .pf-pg__filter-bar {
        background: #111114;
        border-bottom: 1px solid rgba(255, 255, 255, .07);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .pf-pg__filter-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 0;
    }

    .pf-pg__filter-tabs {
        display: flex;
        align-items: center;
        overflow-x: auto;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .pf-pg__filter-tabs::-webkit-scrollbar {
        display: none;
    }

    .pf-pg__filter-tab {
        font-family: var(--font-body);
        font-size: var(--fs-xs);
        font-weight: var(--fw-semibold);
        letter-spacing: .12em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, .40);
        padding: 20px 18px;
        border: none;
        border-bottom: 2px solid transparent;
        background: none;
        cursor: pointer;
        white-space: nowrap;
        transition: color var(--transition-fast), border-color var(--transition-fast);
        line-height: 1;
    }

    .pf-pg__filter-tab:hover {
        color: #fff;
    }

    .pf-pg__filter-tab.active {
        color: var(--color-primary);
        border-bottom-color: var(--color-primary);
    }

    .pf-pg__filter-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-family: var(--font-body);
        font-size: var(--fs-xs);
        font-weight: var(--fw-semibold);
        letter-spacing: .10em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, .65);
        background: rgba(255, 255, 255, .05);
        border: 1px solid rgba(255, 255, 255, .14);
        border-radius: var(--radius-sm);
        padding: 8px 14px;
        cursor: pointer;
        white-space: nowrap;
        flex-shrink: 0;
        transition: background var(--transition-fast), border-color var(--transition-fast), color var(--transition-fast);
    }

    .pf-pg__filter-btn:hover {
        background: var(--color-primary);
        border-color: var(--color-primary);
        color: #fff;
    }

    /* ── GRID SECTION ── */
    .pf-pg__grid-section {
        background: #0c0c0f;
        padding: 40px 0 80px;
    }

    /* ══════════════════════════════════════════
   TRUE CSS MASONRY — column-count layout
   Cards stack top-to-bottom in each column;
   varying image heights fill space organically.
══════════════════════════════════════════ */
    .pf-pg__masonry-grid {
        column-count: 3;
        column-gap: 20px;
    }

    @media (max-width: 991.98px) {
        .pf-pg__masonry-grid {
            column-count: 2;
        }
    }

    @media (max-width: 575.98px) {
        .pf-pg__masonry-grid {
            column-count: 1;
        }
    }

    /* Prevent card from splitting across column break */
    .pf-pg__masonry-item {
        break-inside: avoid;
        -webkit-column-break-inside: avoid;
        margin-bottom: 20px;
        display: block;
        transition: opacity .3s ease;
    }

    /* ── CARD ── */
    .pf-pg__card {
        background: rgba(255, 255, 255, .04);
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: var(--radius-md);
        overflow: hidden;
        transition: transform var(--transition-base), box-shadow var(--transition-base), border-color var(--transition-base);
        display: flex;
        flex-direction: column;
        position: relative;
        width: 100%;
    }

    .pf-pg__card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 56px rgba(0, 0, 0, .65);
        border-color: rgba(200, 98, 42, .40);
    }

    /* ── IMAGE HEIGHTS — cycle 4 sizes for masonry rhythm ── */
    .pf-pg__card-img-wrap {
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
        height: 220px;
    }

    .pf-pg__card[data-size="sm"] .pf-pg__card-img-wrap {
        height: 160px;
    }

    .pf-pg__card[data-size="md"] .pf-pg__card-img-wrap {
        height: 230px;
    }

    .pf-pg__card[data-size="lg"] .pf-pg__card-img-wrap {
        height: 290px;
    }

    .pf-pg__card[data-size="xl"] .pf-pg__card-img-wrap {
        height: 380px;
    }

    .pf-pg__card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        filter: brightness(.82);
        transition: transform .55s cubic-bezier(.25, .46, .45, .94), filter .35s ease;
    }

    .pf-pg__card:hover .pf-pg__card-img-wrap img {
        transform: scale(1.08);
        filter: brightness(1);
    }

    .pf-pg__card-img-wrap::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(0, 0, 0, .55) 0%, transparent 100%);
        pointer-events: none;
    }

    /* Badge */
    .pf-pg__card-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        font-family: var(--font-body);
        font-size: 9px;
        font-weight: var(--fw-semibold);
        letter-spacing: .13em;
        text-transform: uppercase;
        color: #fff;
        background: var(--color-primary);
        padding: 4px 9px;
        border-radius: var(--radius-sm);
        z-index: 2;
    }

    /* Card body */
    .pf-pg__card-body {
        padding: 15px 16px 4px;
        display: flex;
        flex-direction: column;
    }

    .pf-pg__card-location {
        font-size: 11px;
        color: rgba(255, 255, 255, .35);
        font-weight: var(--fw-medium);
        margin-bottom: 3px;
    }

    .pf-pg__card-title {
        font-family: var(--font-heading);
        font-size: var(--fs-base);
        font-weight: var(--fw-semibold);
        color: #fff;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .pf-pg__card-text {
        font-size: 12px;
        color: rgba(255, 255, 255, .50);
        line-height: 1.65;
        margin: 0;
    }

    /* Card footer */
    .pf-pg__card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 16px 14px;
        border-top: 1px solid rgba(255, 255, 255, .06);
        margin-top: 12px;
    }

    .pf-pg__card-cat {
        font-size: 11px;
        color: rgba(255, 255, 255, .30);
        font-weight: var(--fw-medium);
        letter-spacing: .03em;
    }

    .pf-pg__read-more {
        font-size: 11px;
        color: var(--color-primary);
        text-decoration: none;
        font-weight: var(--fw-semibold);
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: color var(--transition-fast), gap .2s ease;
    }

    .pf-pg__read-more:hover {
        color: var(--color-primary-light);
        gap: 8px;
    }

    /* Empty state */
    .pf-pg__empty {
        display: none;
        text-align: center;
        padding: 60px 0;
        color: rgba(255, 255, 255, .35);
        font-size: var(--fs-base);
    }

    .pf-pg__empty svg {
        display: block;
        margin: 0 auto 16px;
        opacity: .25;
    }

    /* ── RESPONSIVE HERO ── */
    @media (max-width: 991.98px) {
        .pf-pg__hero-content {
            padding-top: 130px;
            padding-bottom: 56px;
        }
    }

    @media (max-width: 767.98px) {
        .pf-pg__hero-title {
            font-size: 2.1rem;
        }

        .pf-pg__grid-section {
            padding: 32px 0 56px;
        }

        .pf-pg__filter-tab {
            padding: 16px 12px;
            font-size: 10px;
        }
    }

    @media (max-width: 575.98px) {
        .pf-pg__hero-content {
            padding-top: 110px;
            padding-bottom: 44px;
        }

        .pf-pg__hero-title {
            font-size: 1.85rem;
        }

        .pf-pg__filter-btn span {
            display: none;
        }
    }
</style>


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