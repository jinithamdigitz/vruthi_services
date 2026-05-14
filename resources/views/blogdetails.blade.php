@extends('layouts.main')

@section('content')

@section('hero_title')
Blog Details
@endsection

@section('hero_text')
Read our latest insights and expert opinions
@endsection

<!-- ===== BLOG DETAILS SECTION ===== -->
<div class="blog-details-container">
    <div class="blog-details-layout">

        <!-- LEFT: MAIN CONTENT -->
        <div class="main-content">
            <div class="article-card">
                @if($blog->image)
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="article-cover"
                        onerror="this.style.display='none'" />
                @endif
                <div class="article-body">
                    <div class="article-meta">
                        <span class="post-date"><i class="fas fa-calendar-alt"></i> {{ $blog->created_at->format('F d, Y') }}</span>
                        <span class="post-category"><i class="fas fa-tag"></i> {{ $blog->category->name ?? 'Blog' }}</span>
                    </div>

                    <div class="article-content">
                        {!! $blog->body !!}
                    </div>
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