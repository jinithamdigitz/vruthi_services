@extends('layouts.main')

@section('content')

@section('hero_title')
Blog Details
@endsection

@section('hero_text')
Read our latest insights and expert opinions
@endsection

<!-- ============================================================
     BLOG DETAILS HERO SECTION
============================================================ -->
<section class="blogs-hero">

    <div class="blogs-hero__bg-overlay"></div>
    <div class="blogs-hero__wave-shape"></div>

    <div class="container">

        <div class="blogs-hero__content">

            <div class="blogs-hero__left reveal reveal-left">

                <nav class="blogs-hero__breadcrumb">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="bi bi-chevron-right"></i>
                    <a href="{{ route('home.blogs') }}">Blogs</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>{{ $blog->title }}</span>
                </nav>

                <h1 class="blogs-hero__title">
                    {{ $blog->title }}
                </h1>

                



            </div>

            <div class="blogs-hero__right reveal reveal-right">

                @if($blog->featured_image)
                    <img src="{{ asset($blog->featured_image) }}"
                         alt="{{ $blog->title }}"
                         class="blogs-hero__img">
                @else
                    <img src="{{ asset('img/blogs/blogs-hero.png') }}"
                         alt="Blog Details"
                         class="blogs-hero__img">
                @endif

            </div>

        </div>

    </div>

</section>

<!-- ===== BLOG DETAILS SECTION ===== -->
<div class="blog-details-container">
    <div class="blog-details-layout">

        <!-- LEFT: MAIN CONTENT -->
        <div class="main-content">
            <!-- Title & Date (Above Image) -->
            <div class="article-header">
                <h1 class="article-title">{{ $blog->title }}</h1>
                <div class="article-date-simple">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ $blog->created_at->format('F d, Y') }}</span>
                </div>
            </div>

            <!-- Article Image Card -->
            <div class="article-card">
                @if($blog->image)
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="article-cover"
                        onerror="this.style.display='none'" />
                @endif
            </div>

            <!-- Article Content (Below Image) -->
            <div class="article-body">
                <div class="article-content">
                    {!! $blog->body !!}
                </div>
            </div>
        </div>

        <!-- RIGHT: SIDEBAR WITH POPULAR ARTICLES -->
        <aside class="sidebar">
            <!-- Popular Articles Widget -->
            <div class="sidebar-widget">
                <div class="sidebar-title">Popular Articles</div>

                @forelse($latestBlogs as $index => $latestBlog)
                    <div class="popular-card">
                        <img src="{{ asset($latestBlog->image) }}" alt="{{ $latestBlog->title }}" class="popular-img"
                            onerror="this.style.backgroundColor='#e5e7eb'; this.style.display='none'">
                        <div class="popular-info">
                            <p class="popular-title">
                                <a href="{{ route('dynamic.slug', $latestBlog->slug) }}">
                                    {{ $latestBlog->title }}
                                </a>
                            </p>
                            <div class="popular-meta">
                                <span><i class="fas fa-calendar-alt"></i> {{ $latestBlog->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="popular-card">
                        <div class="popular-info">
                            <p class="popular-title">No popular blogs found.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- CTA Card -->
            <div class="cta-card">
                <i class="fas fa-solar-panel"></i>
                <h4>Ready to Go Solar?</h4>
                <p>Get a free assessment and custom quote from our experts today.</p>
                <a href="{{ route('contact') }}">Get Free Quote</a>
            </div>
        </aside>
    </div>
</div>
@endsection