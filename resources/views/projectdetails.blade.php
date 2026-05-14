@extends('layouts.main')

@section('content')

@section('hero_title')
Project Details
@endsection

@section('hero_text')
Details of installations
@endsection

<div class="sidebar-page-container project-detail-container">
  <div class="auto-container">
    <div class="row clearfix">

      {{-- ── CONTENT SIDE ── --}}
      <div class="content-side col-lg-9 col-md-12 col-sm-12">

        {{-- Main Card --}}
        <div class="project-main-card">

          {{-- Hero Image --}}
          <div class="project-hero-img">
            @if($project->image)
              <img src="{{ asset($project->image) }}" alt="{{ $project->title }}">
            @endif

            <div class="date-chip">
              <i class="fas fa-calendar-alt"></i>
              {{ $project->created_at->format('d M Y') }}
            </div>

            @if($project->category)
              <div class="category-chip">{{ $project->category->name }}</div>
            @endif
          </div>

          {{-- Body --}}
          <div class="project-body">

            {{-- Meta --}}
            <div class="project-meta-row">
              <div class="meta-dot"></div>
              <div class="meta-item">
                <i class="fas fa-clock"></i>
                {{ $project->created_at->diffForHumans() }}
              </div>
              <div class="meta-dot"></div>
              <div class="meta-item">
                <i class="fas fa-book-open"></i>
                {{ ceil(str_word_count(strip_tags($project->body)) / 200) }} min read
              </div>
            </div>

            {{-- Title --}}
            <h1 class="project-title">{{ $project->title }}</h1>

            {{-- Body Text --}}
            <div class="project-body-text">
              {!! nl2br(e($project->body)) !!}
            </div>

            @if($project->additional_info ?? false)
              <div class="project-body-text" style="margin-top:28px; padding-top:24px; border-top:1px solid #edf0f5;">
                {!! nl2br(e($project->additional_info)) !!}
              </div>
            @endif

          </div>
        </div>

        {{-- ── Related Projects ── --}}
        @if(isset($relatedProjects) && $relatedProjects->count() > 0)
        <div class="related-section">
          <div class="section-bar">
            <h4>Related Projects</h4>
          </div>
          <div class="row">
            @foreach($relatedProjects as $related)
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="r-card">
                <div class="r-img">
                  @if($related->image)
                    <img src="{{ asset($related->image) }}" alt="">
                  @endif
                  <div class="r-overlay">
                    <a href="{{ route('projects.details', $related->slug) }}" class="r-overlay-btn">
                      View Project
                    </a>
                  </div>
                </div>
                <div class="r-body">
                  <h6>
                    <a href="{{ route('projects.details', $related->slug) }}">
                      {{ $related->title }}
                    </a>
                  </h6>
                  @if($related->category)
                    <div class="r-cat">{{ $related->category->name }}</div>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        @endif

      </div>
      {{-- End Content Side --}}

      {{-- ── SIDEBAR ── --}}
      <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
        <div class="project-sidebar">

          {{-- Follow Card --}}
          <div class="s-card share-card">
            <div class="s-label">Follow Us</div>
            <div class="share-row">
              <a href="https://www.facebook.com/gosolarmaster"
                 target="_blank" class="share-btn fb">
                <div class="left">
                  <i class="fab fa-facebook-f"></i>
                  Facebook
                </div>
                <span class="follow-tag">Follow</span>
              </a>
              <a href="https://www.youtube.com/@solarmasterpvtltd"
                 target="_blank" class="share-btn yt">
                <div class="left">
                  <i class="fab fa-youtube"></i>
                  YouTube
                </div>
                <span class="follow-tag">Follow</span>
              </a>
            </div>
          </div>

          {{-- Simple Gallery Section --}}
          @if($multiImages->count() > 0)
          <div class="project-gallery">
            <div class="gallery-header">
              <h4 class="gallery-title">Project Gallery</h4>
              <span class="gallery-count">{{ $multiImages->count() }} photos</span>
            </div>

            <div class="gallery-grid">
              @foreach($multiImages as $index => $img)
              <div class="gallery-item" onclick="openLightbox({{ $index }})">
                <img src="{{ asset($img->image_name) }}" alt="Gallery image {{ $index + 1 }}">
              </div>
              @endforeach
            </div>
          </div>
          @endif

        </div>
      </div>
      {{-- End Sidebar --}}

    </div>
  </div>
</div>

{{-- Lightbox Modal --}}
<div id="lightboxOverlay" class="lightbox-overlay" onclick="closeLightbox()">
  <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
  <span class="lightbox-prev" onclick="prevImage(event)">&#10094;</span>
  <span class="lightbox-next" onclick="nextImage(event)">&#10095;</span>
  <img id="lightboxImage" class="lightbox-image" src="">
</div>

@endsection

@section('scripts')
<script>
  // Gallery Lightbox functionality
  let currentImageIndex = 0;
  let galleryImages = [];

  @if($multiImages->count() > 0)
    galleryImages = @json($multiImages->pluck('image_name')->map(function($img) { return asset($img); }));
  @endif

  function openLightbox(index) {
    currentImageIndex = index;
    const lightbox = document.getElementById('lightboxOverlay');
    const lightboxImage = document.getElementById('lightboxImage');
    lightboxImage.src = galleryImages[currentImageIndex];
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    const lightbox = document.getElementById('lightboxOverlay');
    lightbox.classList.remove('active');
    document.body.style.overflow = '';
  }

  function nextImage(event) {
    event.stopPropagation();
    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    const lightboxImage = document.getElementById('lightboxImage');
    lightboxImage.src = galleryImages[currentImageIndex];
  }

  function prevImage(event) {
    event.stopPropagation();
    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
    const lightboxImage = document.getElementById('lightboxImage');
    lightboxImage.src = galleryImages[currentImageIndex];
  }

  // Keyboard navigation
  document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightboxOverlay');
    if (lightbox.classList.contains('active')) {
      if (e.key === 'ArrowRight') {
        nextImage(e);
      } else if (e.key === 'ArrowLeft') {
        prevImage(e);
      } else if (e.key === 'Escape') {
        closeLightbox();
      }
    }
  });
</script>
@endsection