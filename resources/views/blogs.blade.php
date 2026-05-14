@extends('layouts.main')

@section('content')

@section('hero_title')
Blogs
@endsection

@section('hero_text')
Latest solar trends and energy knowledge
@endsection

<!-- ===== BLOG SECTION ===== -->
<div class="blog-container">

    <!-- Search -->
    <div class="search-wrapper">
        <form method="GET" action="{{ route('home.blogs') }}" class="search-box" id="searchForm">
            <i class="fas fa-search"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles..."
                autocomplete="off" id="searchInput">
            @if(request('search'))
                <a href="{{ route('home.blogs') }}" class="clear-search" id="clearSearch">
                    <i class="fas fa-times"></i>
                </a>
            @endif
            <button type="submit" style="display: none;">Search</button>
        </form>
    </div>

    <!-- Search Result Info -->
    @if(request('search'))
        <div class="search-info">
            <p>Showing results for: <strong>"{{ request('search') }}"</strong> 
                <a href="{{ route('home.blogs') }}" class="clear-results">Clear search</a>
            </p>
            <p>Found {{ $blogs->total() }} result(s)</p>
        </div>
    @endif

    <!-- Two-column layout -->
    <div class="blog-layout">

        <!-- LEFT: Blog Cards -->
        <div>
            @if($blogs->count() > 0)
                <div class="blog-grid">
                    @foreach ($blogs as $blog)
                        <div class="blog-card wow fadeInUp" data-wow-delay=".4s">
                            <div class="blog-img-box">
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                            </div>
                            <div class="blog-content">
                                <div class="blog-date">{{ $blog->created_at->format('F d, Y') }}</div>
                                <h3 class="blog-title">{{ $blog->title }}</h3>
                                @if($blog->excerpt)
                                    <p class="blog-excerpt">{{ Str::limit($blog->excerpt, 100) }}</p>
                                @endif
                                <div class="blog-footer">
                                    <a href="{{ route('dynamic.slug', $blog->slug) }}" class="read-more">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($blogs->hasPages())
                    <ul class="styled-pagination text-center">
                        {{-- Previous --}}
                        @if ($blogs->onFirstPage())
                            <li class="disabled"><span>&laquo;</span></li>
                        @else
                            <li><a href="{{ $blogs->previousPageUrl() }}">&laquo;</a></li>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                            <li class="{{ $blogs->currentPage() == $page ? 'active' : '' }}">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next --}}
                        @if ($blogs->hasMorePages())
                            <li><a href="{{ $blogs->nextPageUrl() }}">&raquo;</a></li>
                        @else
                            <li class="disabled"><span>&raquo;</span></li>
                        @endif
                    </ul>
                @endif
            @else
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>No articles found</h3>
                    <p>We couldn't find any articles matching "<strong>{{ request('search') }}</strong>"</p>
                    <a href="{{ route('home.blogs') }}" class="btn-back">View all articles</a>
                </div>
            @endif
        </div>

        <!-- RIGHT: Popular Articles Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-title">Popular Articles</div>

            @forelse($latestBlogs as $index => $latestBlog)
                <div class="popular-card">
                    <img src="{{ asset($latestBlog->image) }}" alt="{{ $latestBlog->title }}" class="popular-img"
                        onerror="this.src='https://via.placeholder.com/90x80?text=No+Image'">
                    <div class="popular-info">
                        <p class="popular-title">
                            <a href="{{ route('dynamic.slug', $latestBlog->slug) }}"
                                style="text-decoration: none; color: inherit;">
                                {{ Str::limit($latestBlog->title, 45) }}
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
                        <p class="popular-title">No latest blogs found.</p>
                    </div>
                </div>
            @endforelse
        </aside>
    </div>
</div>


@endsection