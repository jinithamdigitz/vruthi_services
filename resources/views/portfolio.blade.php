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
        <h2>Our Portfolio</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li>Portfolio</li>
        </ul>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="auto-container">
        <div class="stats-wrapper">
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">{{ $totalProjects ?? 0 }}</span>
                    <span class="stat-label">Total Projects</span>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">{{ $categories->count() ?? 0 }}</span>
                    <span class="stat-label">Categories</span>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">5+</span>
                    <span class="stat-label">Years Exp.</span>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">50+</span>
                    <span class="stat-label">Happy Clients</span>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Category Filter Section - Horizontal Scroll -->
<!-- Category Filter Section - Horizontal Scroll -->
<section class="category-filter-section">
    <div class="auto-container">
        <div class="filter-header">
            <h3>Browse by Category</h3>
            <span class="filter-hint">← Scroll →</span>
        </div>
        <div class="category-filter-wrapper">
            <div class="category-filter-menu">
                <!-- All Projects Button -->
                <div class="filter-item">
                    <button class="filter-btn active" id="filterAll" data-category="all">
                        <div class="filter-icon">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <span class="filter-name">All Projects</span>
                    </button>
                </div>
                
                <!-- Category Buttons -->
                @foreach($categories as $category)
                <div class="filter-item">
                    <button class="filter-btn" data-category="{{ $category->slug }}">
                        <div class="filter-icon">
                            @if($category->image)
                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" loading="lazy">
                            @else
                                <i class="fas fa-folder"></i>
                            @endif
                            <!-- Count Overlay (appears on hover/touch) -->
                            <span class="count-overlay">{{ $category->projects_count }}</span>
                        </div>
                        <span class="filter-name">{{ $category->name }}</span>
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Active Filter Indicator -->
<div class="auto-container">
    <div class="filter-indicator" id="activeFilter">
        Showing: <strong>All Projects</strong> 
        <span class="project-count" id="visibleCount">({{ $projects->total() }} items)</span>
    </div>
</div>

<!-- Projects Grid Section -->
<section class="projects-section">
    <div class="auto-container">
        <div class="projects-grid" id="projectsGrid">
            @forelse($projects as $project)
            @php 
                $category = $categories->firstWhere('id', $project->project_category_id);
                $skills = $project->skills ? array_slice(array_filter(explode(',', $project->skills)), 0, 3) : [];
            @endphp
            <div class="project-item" data-category="{{ $project->project_category_id }}">
                <a href="{{ route('portfolio-details', $project->slug) }}" class="project-card">
                    <div class="project-image">
                        @if($project->image)
                            <img src="{{ asset($project->image) }}" alt="{{ $project->name }}" loading="lazy">
                        @elseif($category && $category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $project->name }}" loading="lazy">
                        @else
                            <img src="{{ asset('assets/images/project-default.jpg') }}" alt="{{ $project->name }}" loading="lazy">
                        @endif
                        <div class="project-overlay">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                    <div class="project-info">
                        <h3 class="project-title">{{ $project->name }}</h3>
                       
                       
                    </div>
                </a>
            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-folder"></i>
                <h4>No Projects Found</h4>
                <p>Check back later for our latest work!</p>
            </div>
            @endforelse
        </div>

        @if($projects->hasMorePages())
        <div class="load-more-container">
            <button class="load-more-btn" id="loadMoreBtn">
                <span class="btn-text">Load More Projects</span>
                <i class="fas fa-right-arrow"></i>
            </button>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="auto-container">
        <div class="cta-content">
            <h3>Have a Project in Mind?</h3>
            <a href="{{ route('contact') }}" class="cta-btn">
                Start a Project
                <i class="fas fa-right-arrow"></i>
            </a>
        </div>
    </div>
</section>



@endsection



<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get DOM elements
    const projectsGrid = document.getElementById('projectsGrid');
    const projectItems = document.querySelectorAll('.project-item');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const filterAll = document.getElementById('filterAll');
    const activeFilter = document.getElementById('activeFilter');
    const visibleCount = document.getElementById('visibleCount');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    
    let currentFilter = 'all';
    let isLoading = false;
    
    // Filter projects by category
    function filterProjects(categoryId) {
        let visibleProjects = 0;
        
        projectItems.forEach(item => {
            const itemCategory = item.dataset.category;
            
            if (categoryId === 'all' || itemCategory === categoryId) {
                item.style.display = 'block';
                visibleProjects++;
                
                // Add animation delay for staggered effect
                item.style.animation = 'none';
                item.offsetHeight; // Trigger reflow
                item.style.animation = 'fadeIn 0.5s ease';
            } else {
                item.style.display = 'none';
            }
        });
        
        // Update visible count
        updateVisibleCount(visibleProjects);
        
        // Show no results message if needed
        toggleNoResults(visibleProjects);
        
        return visibleProjects;
    }
    
    // Update active filter display
    function updateVisibleCount(count) {
        if (visibleCount) {
            visibleCount.textContent = `(${count} item${count !== 1 ? 's' : ''})`;
        }
    }
    
    // Toggle no results message
    function toggleNoResults(visibleCount) {
        let noResultsEl = document.querySelector('.no-results');
        
        if (visibleCount === 0) {
            if (!noResultsEl) {
                noResultsEl = document.createElement('div');
                noResultsEl.className = 'no-results';
                noResultsEl.innerHTML = `
                    <i class="fas fa-folder"></i>
                    <h4>No Projects Found</h4>
                    <p>Try selecting a different category</p>
                `;
                projectsGrid.appendChild(noResultsEl);
            }
        } else {
            if (noResultsEl) {
                noResultsEl.remove();
            }
        }
    }
    
    // Update active filter button
    function setActiveFilter(activeButton) {
        filterButtons.forEach(btn => {
            btn.classList.remove('active');
        });
        activeButton.classList.add('active');
        
        // Update active filter text
        const filterName = activeButton.querySelector('.filter-name').textContent;
        const categoryId = activeButton.dataset.category;
        const count = categoryId === 'all' 
            ? projectItems.length 
            : Array.from(projectItems).filter(item => item.dataset.category === categoryId).length;
        
        activeFilter.innerHTML = `Showing: <strong>${filterName}</strong> <span class="project-count">(${count} item${count !== 1 ? 's' : ''})</span>`;
    }
    
    // Handle filter button clicks
    filterButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get category
            const categoryId = this.dataset.category;
            
            // Update current filter
            currentFilter = categoryId;
            
            // Filter projects
            filterProjects(categoryId);
            
            // Set active button
            setActiveFilter(this);
            
            // Scroll to projects grid smoothly
            projectsGrid.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        });
    });
    
    // Handle "All" button click
    if (filterAll) {
        filterAll.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Show all projects
            filterProjects('all');
            
            // Set active button
            setActiveFilter(this);
        });
    }
    
    // Load more functionality (if needed)
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', async function(e) {
            e.preventDefault();
            
            if (isLoading) return;
            
            isLoading = true;
            this.classList.add('loading');
            
            const btnText = this.querySelector('.btn-text');
            const originalText = btnText.textContent;
            btnText.textContent = 'Loading...';
            
            try {
                // Simulate loading (replace with actual AJAX call)
                await new Promise(resolve => setTimeout(resolve, 1000));
                
                // Here you would load more projects via AJAX
                console.log('Load more projects for filter:', currentFilter);
                
            } catch (error) {
                console.error('Error loading more projects:', error);
            } finally {
                isLoading = false;
                this.classList.remove('loading');
                btnText.textContent = originalText;
            }
        });
    }
    
    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { 
        threshold: 0.1, 
        rootMargin: '0px 0px -50px 0px' 
    });
    
    // Apply animations to project cards
    document.querySelectorAll('.project-card').forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(el);
    });
    
    // Touch scroll hint for mobile
    const filterWrapper = document.querySelector('.category-filter-wrapper');
    if (filterWrapper) {
        let isScrolling = false;
        
        filterWrapper.addEventListener('scroll', () => {
            if (!isScrolling) {
                isScrolling = true;
                filterWrapper.style.scrollBehavior = 'smooth';
                
                setTimeout(() => {
                    isScrolling = false;
                }, 150);
            }
        });
    }
    
    // Initialize - set initial active filter
    if (filterAll) {
        filterAll.classList.add('active');
    }
    
    // Initial count update
    updateVisibleCount(projectItems.length);
});
</script>