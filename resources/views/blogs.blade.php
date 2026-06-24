@extends('layouts.main')

@section('content')
@section('hero_title')
    Blogs
@endsection

@section('hero_text')
    Latest solar trends and energy knowledge
@endsection

<section class="blogs-hero">

    <div class="blogs-hero__bg-overlay"></div>
    <div class="blogs-hero__wave-shape"></div>

    <div class="container">

        <div class="blogs-hero__content">

            <div class="blogs-hero__left reveal reveal-left">

                <nav class="blogs-hero__breadcrumb">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Blogs</span>
                </nav>

                <h1 class="blogs-hero__title">
                    Insights & Industry Updates
                </h1>

                <p class="blogs-hero__tagline">
                    Knowledge Hub
                </p>

                <p class="blogs-hero__desc">
                    Explore expert insights, industry trends, workforce strategies,
                    outsourcing solutions and facility management updates from
                    Vrudhi Outsourcing.
                </p>

                <div class="blogs-hero__rule"></div>

            </div>

            <div class="blogs-hero__right reveal reveal-right">

                <img src="{{ asset('img/blogs/blogs-hero.png') }}"
                     alt="Blogs"
                     class="blogs-hero__img">

            </div>

        </div>

    </div>

</section>


<section class="blogs-page">
    <div class="container">

        {{-- Heading --}}
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="section-label">Latest Insights</span>
                <h2 class="blogs-page__title">Knowledge Hub & Industry Updates</h2>
                <div class="section-divider mx-auto"></div>
            </div>
        </div>

        {{-- Search --}}
        <div class="blogs-search reveal">
            <form>
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Search articles, insights and updates...">
            </form>
        </div>

        {{-- Featured Blog --}}
        <div class="blogs-featured reveal">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6">
                    @if ($latestBlog && $latestBlog->image)
                        <img src="{{ asset($latestBlog->image) }}" alt="{{ $latestBlog->title }}">
                    @else
                        <img src="{{ asset('img/blogs/blog-1.jpg') }}" alt="Featured">
                    @endif
                </div>

                <div class="col-lg-6">
                    <div class="blogs-featured__content">
                        <span class="blogs-badge">Latest Article</span>
                        <br>
                        <br>
                        <h3>
                            {{ $latestBlog->title ?? 'Latest Blog Article' }}
                        </h3>

                        <p>
                            {{ Str::limit($latestBlog->body ?? 'Discover our latest insights and updates.', 150) }}
                        </p>

                        @if ($latestBlog)
                            <a href="{{ route('dynamic.slug', $latestBlog->slug) }}" class="btn-outline-brand">
                                Read Article
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 g-5">

            {{-- Blogs --}}
            <div class="col-lg-8">

                <div class="row g-4">

                    @forelse ($blogs as $index => $blog)
                        <div class="col-md-6 reveal">
                            <article class="blog-card-v2">

                                <div class="blog-card-v2__image">
                                    @if ($blog->image)
                                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                                    @else
                                        <img src="{{ asset('img/blogs/blog-' . ($index % 6 + 1) . '.jpg') }}" alt="{{ $blog->title }}">
                                    @endif
                                </div>

                                <div class="blog-card-v2__body">

                                    <div class="blog-card-v2__meta">
                                        <span>
                                            <i class="bi bi-calendar3"></i>
                                            {{ $blog->created_at->format('F Y') }}
                                        </span>
                                    </div>

                                    <h4>
                                        {{ $blog->title }}
                                    </h4>

                                    <p>
                                        {{ Str::limit($blog->body, 100) }}
                                    </p>

                                    <a href="{{ route('dynamic.slug', $blog->slug) }}">
                                        Read More
                                        <i class="bi bi-arrow-right"></i>
                                    </a>

                                </div>

                            </article>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p>No blogs available.</p>
                        </div>
                    @endforelse

                </div>

                {{-- Pagination --}}
                <div class="blogs-pagination">
                    @if ($blogs->onFirstPage())
                        <span class="disabled" style="opacity: 0.5; cursor: not-allowed;">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $blogs->previousPageUrl() }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    @endif

                    @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                        @if ($page == $blogs->currentPage())
                            <a href="#" class="active">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($blogs->hasMorePages())
                        <a href="{{ $blogs->nextPageUrl() }}">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    @else
                        <span class="disabled" style="opacity: 0.5; cursor: not-allowed;">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    @endif
                </div>

            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                <div class="blogs-sidebar">

                    <div class="blogs-sidebar__card">
                        <h4>Popular Articles</h4>

                        @forelse ($popularBlogs as $popBlog)
                            <a href="{{ route('dynamic.slug', $popBlog->slug) }}" class="blogs-popular">

                                @if ($popBlog->image)
                                    <img src="{{ asset($popBlog->image) }}" alt="{{ $popBlog->title }}">
                                @else
                                    <img src="{{ asset('img/blogs/blog-1.jpg') }}" alt="{{ $popBlog->title }}">
                                @endif

                                <div>
                                    <h6>
                                        {{ Str::limit($popBlog->title, 50) }}
                                    </h6>

                                    <span>{{ $popBlog->created_at->format('M d, Y') }}</span>
                                </div>

                            </a>
                        @empty
                            <p class="text-muted">No popular blogs available.</p>
                        @endforelse
                    </div>

                    <div class="blogs-sidebar__cta">
                        <h4>Stay Updated</h4>
                        <p>
                            Get the latest industry insights delivered directly to your inbox.
                        </p>

                       <a href="{{ route('contact') }}" class="btn-outline-brand">
    Connect Now
</a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>
@endsection
