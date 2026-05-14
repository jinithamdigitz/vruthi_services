@extends('layouts.main')

@section('content')

<!-- Page Title -->
<section class="page-title">
    <div class="auto-container">
        <div class="icons-box parallax-scene-1">
            <div class="icon-one" data-depth="0.10"></div>
            <div class="icon-two" data-depth="0.30">
                <img src="{{ asset('assets/images/icons/vector-9.png') }}" alt="" />
            </div>
            <div class="icon-three" data-depth="0.30">
                <img src="{{ asset('assets/images/icons/vector-34.png') }}" alt="" />
            </div>
            <div class="icon-four" data-depth="0.10"></div>
        </div>
        <h2>{{ $project->name }}</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li><a href="{{ route('home.portfolio') }}">Portfolio</a></li>
            <li>{{ $project->name }}</li>
        </ul>
    </div>
</section>

<!-- Portfolio Details Section -->
<section class="portfolio-details-section">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Content Column -->
            <div class="content-column col-lg-8 col-md-12 col-sm-12">
                <div class="inner-column">
                    <!-- Project Image -->
                    <div class="project-image-box">
                        <div class="project-main-image">
                            @if($project->image)
                                <img src="{{ asset($project->image) }}" alt="{{ $project->name }}">
                            @elseif($project->category && $project->category->image)
                                <img src="{{ asset($project->category->image) }}" alt="{{ $project->name }}">
                            @else
                                <img src="{{ asset('assets/images/project-default.jpg') }}" alt="{{ $project->name }}">
                            @endif
                        </div>
                        
                        <!-- Project Meta Info -->
                        <div class="project-meta-info">
                            <div class="meta-item">
                                <span class="meta-label">Category:</span>
                                <span class="meta-value">{{ $project->category->name ?? 'Uncategorized' }}</span>
                            </div>
                            @if($project->date)
                            <div class="meta-item">
                                <span class="meta-label">Date:</span>
                                <span class="meta-value">{{ \Carbon\Carbon::parse($project->date)->format('M d, Y') }}</span>
                            </div>
                            @endif
                            @if($project->client)
                            <div class="meta-item">
                                <span class="meta-label">Client:</span>
                                <span class="meta-value">{{ $project->client }}</span>
                            </div>
                            @endif
                            @if($project->location)
                            <div class="meta-item">
                                <span class="meta-label">Location:</span>
                                <span class="meta-value">{{ $project->location }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Project Description -->
                    <div class="project-description-box">
                        <h3>Project Overview</h3>
                        <div class="description-content">
                            {!! nl2br(e($project->description ?? '')) !!}
                        </div>
                    </div>
                    
                    <!-- Experience & Skills Section -->
                    @if($project->experience || (!empty($project->skills) && (is_array($project->skills) ? count($project->skills) > 0 : trim($project->skills ?? '') !== '')))
                    <div class="experience-skills-box">
                        <div class="row clearfix">
                            @if($project->experience)
                            <!-- Experience Column -->
                            <div class="experience-column col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box">
                                   <h4><i class="fas fa-clock"></i> Experience</h4>
                                    <div class="experience-content">
                                        <p>{{ $project->experience }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            @if(!empty($project->skills))
                            <!-- Skills Column -->
                            <div class="skills-column col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box">
                                   <h4><i class="fas fa-code"></i> Skills & Technologies</h4>
                                    <div class="skills-content">
                                        @php
                                            $skills = is_array($project->skills) ? $project->skills : array_filter(array_map('trim', explode(',', $project->skills ?? '')));
                                        @endphp
                                        
                                        @if(!empty($skills))
                                            <div class="skills-tags">
                                                @foreach($skills as $skill)
                                                    @if(!empty($skill))
                                                    <span class="skill-tag">{{ $skill }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted">No skills specified</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <!-- ========== PROJECT GALLERY SECTION FROM ProjectImage TABLE ========== -->
                    <!-- ========== PROJECT GALLERY SECTION FROM ProjectImage TABLE ========== -->
@if(isset($project->images) && $project->images->count() > 0)
<div class="project-gallery-box">
    <h3><i class="flaticon-gallery"></i> Project Gallery</h3>
    
    <div class="gallery-grid">
        @foreach($project->images as $index => $image)
            @if(!empty($image->image))
            <div class="gallery-item">
                <a href="{{ asset($image->image) }}" 
                   class="lightbox-image" 
                   data-fancybox="project-gallery" 
                   data-caption="{{ $project->name }} - Image {{ $index + 1 }}">
                    <div class="gallery-image-wrapper">
                        <img src="{{ asset($image->image) }}" 
                             alt="{{ $project->name }} - Image {{ $index + 1 }}" 
                             loading="lazy">
                        <div class="gallery-overlay">
                            <span class="expand-icon"><i class="fas fa-search-plus"></i></span>
                        </div>
                    </div>
                </a>
            </div>
            @endif
        @endforeach
    </div>
    
    <div class="gallery-stats">
        <span class="stat-item">
            <i class="fas fa-images"></i> {{ $project->images->count() }} Images
        </span>
    </div>
</div>
@endif
                
                    <!-- Additional Content (if any) -->
                    @if($project->content)
                    <div class="project-additional-content">
                        {!! $project->content !!}
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Sidebar Column -->
            <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                <div class="inner-column">
                    
                    <!-- Project Info Widget (NEW) -->
                    <div class="sidebar-widget project-info-widget">
                        <div class="widget-title">
                            <h4><i class="fas fa-info-circle"></i> Project Details</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="project-info-list">
                                <li><strong>Category:</strong> {{ $project->category->name ?? 'Uncategorized' }}</li>
                                @if($project->date)<li><strong>Date:</strong> {{ \Carbon\Carbon::parse($project->date)->format('M d, Y') }}</li>@endif
                                @if($project->client)<li><strong>Client:</strong> {{ $project->client }}</li>@endif
                                @if($project->location)<li><strong>Location:</strong> {{ $project->location }}</li>@endif
                                @if($project->experience)<li><strong>Experience:</strong> {{ $project->experience }}</li>@endif
                                @if(isset($project->images) && $project->images->count() > 0)
                                <li><strong>Gallery Images:</strong> {{ $project->images->count() }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Recent Projects Widget -->
                    <div class="sidebar-widget recent-projects-widget">
                        <div class="widget-title">
                            <h4>Recent Projects</h4>
                        </div>
                        <div class="widget-content">
                            @forelse($relatedProjects as $recent)
                            <div class="recent-project-item">
                                <a href="{{ route('portfolio-details', $recent->slug) }}" class="recent-project-link">
                                    <div class="recent-project-image">
                                        @if($recent->image)
                                            <img src="{{ asset($recent->image) }}" alt="{{ $recent->name }}" loading="lazy">
                                        @elseif($recent->category && $recent->category->image)
                                            <img src="{{ asset($recent->category->image) }}" alt="{{ $recent->name }}" loading="lazy">
                                        @else
                                            <img src="{{ asset('assets/images/project-default.jpg') }}" alt="{{ $recent->name }}" loading="lazy">
                                        @endif
                                    </div>
                                    <div class="recent-project-content">
                                        <h5>{{ $recent->name }}</h5>
                                        <span class="project-category">{{ $recent->category->name ?? 'Uncategorized' }}</span>
                                    </div>
                                </a>
                            </div>
                            @empty
                            <p class="no-projects">No recent projects available.</p>
                            @endforelse
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
