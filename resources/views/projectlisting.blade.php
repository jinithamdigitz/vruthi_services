@extends('layouts.main')

@section('content')

@section('hero_title')

Our Solar Projects

@endsection

@section('hero_text')

Explore our successful installations

@endsection
    <div class="full-width-container">
        <!-- Filter row -->
        <div class="filter-section">
            <div class="search-wrapper">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-box" id="searchInput"
                    placeholder="Search by city, capacity, or keyword..." />
            </div>
        </div>

        <!-- Project Grid -->
        <div class="projects-grid" id="projectsGrid">
            @if (isset($projectlisting) && $projectlisting->count() > 0)
                @foreach ($projectlisting as $projectlistings)
                    <div class="project-card" data-type="5kw" data-search="5kw solar kochi kochi capacity 5kw residential">
                        @if ($projectlistings->image)
                            <img class="project-image" src="{{ asset($projectlistings->image) }}"
                                alt="{{ $projectlistings->title }}">
                        @endif
                        <div class="project-content">
                            <div class="project-title">{{ $projectlistings->title }}</div>
                            <div class="project-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Kochi, Kerala</span>
                            </div>
                            <a href="{{ route('projects.details', $projectlistings->slug) }}" class="btn-view">
                                <i class="fas fa-charging-station"></i> View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-projects" style="text-align: center; padding: 50px; width: 100%;">
                    <h3>No Projects Found</h3>
                    <p>There are currently no projects in the "projectlisting" category.</p>
                    @if (Auth::check() && Auth::user()->role === 'admin')
                        <p style="color: #666;">Admin: Add posts to the "projectlisting" category to display them here.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection