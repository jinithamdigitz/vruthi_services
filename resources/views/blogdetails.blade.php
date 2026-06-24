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
<section class="blog-details-section">
    <div class="container">

        <div class="blog-details-layout">

            <!-- LEFT: MAIN CONTENT -->
            <div class="main-content">

                <!-- Article Header -->
                <div class="article-header reveal">
                    <h1 class="article-title">
                        {{ $blog->title }}
                    </h1>

                    <div class="article-date-simple">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ $blog->created_at->format('F d, Y') }}</span>
                    </div>
                </div>

                <!-- Featured Image -->
                @if($blog->image)
                <div class="article-card reveal">
                    <img src="{{ asset($blog->image) }}"
                         alt="{{ $blog->title }}"
                         class="article-cover">
                </div>
                @endif

                <!-- Blog Content -->
                <div class="article-body reveal">
                    <div class="article-content">
                        {!! $blog->body !!}
                    </div>
                </div>

            </div>

            <!-- RIGHT SIDEBAR -->
            <aside class="sidebar">

                <!-- Popular Articles -->
                <div class="sidebar-widget reveal">

                    <h4 class="sidebar-title">
                        Popular Articles
                    </h4>

                    @forelse($latestBlogs as $latestBlog)

                        <div class="popular-card">

                            @if($latestBlog->image)
                                <img src="{{ asset($latestBlog->image) }}"
                                     alt="{{ $latestBlog->title }}"
                                     class="popular-img">
                            @endif

                            <div class="popular-info">

                                <h5 class="popular-title">
                                    <a href="{{ route('dynamic.slug', $latestBlog->slug) }}">
                                        {{ $latestBlog->title }}
                                    </a>
                                </h5>

                                <div class="popular-meta">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $latestBlog->created_at->format('M d, Y') }}
                                </div>

                            </div>

                        </div>

                    @empty

                        <p>No popular articles available.</p>

                    @endforelse

                </div>

                <!-- CTA Card -->
                <div class="sd-contact reveal">
                            <div class="sd-contact__inner">
                                <div class="sd-contact__icon-wrap">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <div class="sd-contact__text">

                                    <span class="sd-contact__label">
                                        {{ $sdcta->title }}
                                    </span>

                                    <span class="sd-contact__sub">
                                        {!! $sdcta->body !!}
                                    </span>

                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $globalPhone) }}"
                                        class="sd-contact__phone">
                                        <i class="bi bi-telephone-fill"></i>
                                        {{ $globalPhone }}
                                    </a>

                                </div>
                            </div>
                        </div>

            </aside>

        </div>

    </div>
</section>
@endsection