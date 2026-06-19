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
                    <img src="{{ asset('img/blogs/blog-1.jpg') }}" alt="">
                </div>

                <div class="col-lg-6">
                    <div class="blogs-featured__content">
                        <span class="blogs-badge">Featured Article</span>

                        <h3>
                            Transforming Workforce Management Through Strategic Outsourcing
                        </h3>

                        <p>
                            Discover how modern outsourcing solutions help businesses
                            improve efficiency, reduce operational costs and scale faster.
                        </p>

                        <a href="#" class="btn-outline-brand">
                            Read Article
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 g-5">

            {{-- Blogs --}}
            <div class="col-lg-8">

                <div class="row g-4">

                    @for ($i = 1; $i <= 6; $i++)
                        <div class="col-md-6 reveal">
                            <article class="blog-card-v2">

                                <div class="blog-card-v2__image">
                                    <img src="{{ asset('img/blogs/blog-' . $i . '.jpg') }}" alt="">
                                </div>

                                <div class="blog-card-v2__body">

                                    <div class="blog-card-v2__meta">
                                        <span>
                                            <i class="bi bi-calendar3"></i>
                                            June 2026
                                        </span>
                                    </div>

                                    <h4>
                                        Facility Management Trends Every Business Should Know
                                    </h4>

                                    <p>
                                        Explore the latest facility management practices
                                        helping organizations stay productive and efficient.
                                    </p>

                                    <a href="#">
                                        Read More
                                        <i class="bi bi-arrow-right"></i>
                                    </a>

                                </div>

                            </article>
                        </div>
                    @endfor

                </div>

                {{-- Pagination --}}
                <div class="blogs-pagination">
                    <a href="#">1</a>
                    <a href="#" class="active">2</a>
                    <a href="#">3</a>
                    <a href="#">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>

            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                <div class="blogs-sidebar">

                    <div class="blogs-sidebar__card">
                        <h4>Popular Articles</h4>

                        @for ($i = 1; $i <= 4; $i++)
                            <a href="#" class="blogs-popular">

                                <img src="{{ asset('img/blogs/blog-' . $i . '.jpg') }}" alt="">

                                <div>
                                    <h6>
                                        Strategic Workforce Solutions for Growing Businesses
                                    </h6>

                                    <span>June 2026</span>
                                </div>

                            </a>
                        @endfor
                    </div>

                    <div class="blogs-sidebar__cta">
                        <h4>Stay Updated</h4>
                        <p>
                            Get the latest industry insights delivered directly to your inbox.
                        </p>

                        <a href="#" class="btn-brand">
                            Subscribe Now
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>
@endsection
