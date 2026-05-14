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
        <h2>{{ $caseStudy->title }}</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li><a href="{{ route('home.portfolio') }}">Case Studies</a></li>
            <li>{{ $caseStudy->title }}</li>
        </ul>
    </div>
</section>

<!-- Case Study Detail Section -->
<section class="case-study-detail">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Main Content -->
            <div class="col-lg-8 col-md-12 col-sm-12">
                <!-- Back Button -->
                <a href="{{ url('/') }}" class="btn-back">
                    <i class="fa fa-arrow-left"></i> Back to Home
                </a>
                
                <div class="case-study-header">
                    <h2>{{ $caseStudy->title }}</h2>
                    
                    <div class="case-study-meta">
                        @if($caseStudy->created_at)
                        <span>
                            <i class="fa fa-calendar"></i> 
                            {{ $caseStudy->created_at->format('F d, Y') }}
                        </span>
                        @endif
                        
                        @if(isset($caseStudy->category) && $caseStudy->category)
                        <span>
                            <i class="fa fa-folder"></i> 
                            {{ $caseStudy->category->name }}
                        </span>
                        @endif
                    </div>
                </div>
                
                <!-- Main Image -->
                @if($caseStudy->image)
                <div class="case-study-image">
                    <img src="{{ $mainImageUrl }}" alt="{{ $caseStudy->title }}">
                </div>
                @endif

                 <!-- Content -->
                <div class="case-study-content">
                    {!! $caseStudy->body !!}
                </div>
                
                <!-- Multiple Images Gallery -->
                @if(count($galleryImages) > 0)
                <div class="case-study-gallery">
                    <h3 class="gallery-title">Project Gallery</h3>
                    <div class="gallery-grid" id="galleryGrid">
                        @foreach($galleryImages as $index => $image)
                        <div class="gallery-item" data-index="{{ $index }}" onclick="openModal({{ $index }})">
                            <img 
                                src="{{ $image['url'] }}" 
                                alt="{{ $image['caption'] }}"
                                title="{{ $image['title'] }}"
                                loading="lazy"
                                onerror="this.src='{{ asset('images/image-placeholder.jpg') }}'; this.onerror=null;"
                            >
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <!-- Optional: Show message if no gallery images -->
                <div class="alert alert-info">
                    No gallery images available for this case study.
                </div>
                @endif
                
               
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                @if($otherCaseStudies->count() > 0)
                <div class="sidebar-widget">
                    <h4>Related Case Studies</h4>
                    <ul class="other-case-studies">
                        @foreach($otherCaseStudies as $other)
                        <li>
                            <a href="{{ route('home.casestudiesdetails', $other->slug) }}">
                                @if($other->image_url)
                                <img src="{{ $other->image_url }}" alt="{{ $other->title }}">
                                @else
                                <img src="{{ asset('images/default-thumbnail.jpg') }}" alt="Default Image">
                                @endif
                                <div class="info">
                                    <h5>{{ Str::limit($other->title, 50) }}</h5>
                                    <p>{{ Str::limit(strip_tags($other->excerpt ?? $other->body), 80) }}</p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- Contact Widget -->
                <div class="sidebar-widget">
                    <h4>Need Help?</h4>
                    <p>Contact us to discuss how we can help with your next project.</p>
                     <a href="{{ url('contact') }}" class="theme-btn btn-style-one clearfix">
                        <span class="btn-wrap">
                            <span class="text-one">Contact Us</span>
                            <span class="text-two">Contact Us</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="imageModal" class="image-modal">
    <span class="close-modal" onclick="closeModal()">&times;</span>
    <div class="modal-content">
        <img id="modalImage" src="" alt="Gallery Image">
        <div class="modal-caption" id="modalCaption"></div>
    </div>
    <div class="nav-buttons">
        <div class="prev-btn" onclick="changeImage(-1)">
            <i class="fa fa-chevron-left"></i>
        </div>
        <div class="next-btn" onclick="changeImage(1)">
            <i class="fa fa-chevron-right"></i>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get gallery images from PHP
        let galleryImages = @json($galleryImages);
        let currentImageIndex = 0;
        
        console.log('Gallery Images Count:', galleryImages.length);
        
        if(galleryImages.length > 0) {
            console.log('First image URL:', galleryImages[0].url);
        }
        
        // Open modal function
        window.openModal = function(index) {
            if(!galleryImages || galleryImages.length === 0) {
                console.warn('No images available');
                alert('No images to display');
                return;
            }
            
            if(index >= galleryImages.length) {
                console.warn('Invalid image index');
                return;
            }
            
            currentImageIndex = index;
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');
            
            if(modal && modalImage && modalCaption) {
                const image = galleryImages[currentImageIndex];
                modalImage.src = image.url;
                modalImage.alt = image.caption;
                modalCaption.textContent = image.caption;
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
                
                // Optional: Add loading state
                modalImage.style.opacity = '0';
                modalImage.onload = function() {
                    modalImage.style.opacity = '1';
                };
            }
        };
        
        // Close modal function
        window.closeModal = function() {
            const modal = document.getElementById('imageModal');
            if(modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        };
        
        // Change image function
        window.changeImage = function(direction) {
            if(!galleryImages || galleryImages.length === 0) return;
            
            currentImageIndex += direction;
            
            if(currentImageIndex < 0) {
                currentImageIndex = galleryImages.length - 1;
            } else if(currentImageIndex >= galleryImages.length) {
                currentImageIndex = 0;
            }
            
            const modalImage = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');
            
            if(modalImage && modalCaption) {
                const image = galleryImages[currentImageIndex];
                modalImage.style.opacity = '0';
                setTimeout(function() {
                    modalImage.src = image.url;
                    modalImage.alt = image.caption;
                    modalCaption.textContent = image.caption;
                    modalImage.style.opacity = '1';
                }, 200);
            }
        };
        
        // Close modal on background click
        const modal = document.getElementById('imageModal');
        if(modal) {
            modal.addEventListener('click', function(event) {
                if(event.target === this) {
                    window.closeModal();
                }
            });
        }
        
        // Keyboard navigation
        document.addEventListener('keydown', function(event) {
            const modal = document.getElementById('imageModal');
            if(modal && modal.style.display === 'block') {
                if(event.key === 'ArrowLeft') {
                    window.changeImage(-1);
                } else if(event.key === 'ArrowRight') {
                    window.changeImage(1);
                } else if(event.key === 'Escape') {
                    window.closeModal();
                }
            }
        });
        
        // Optional: Add image loading error handling
        document.querySelectorAll('.gallery-item img').forEach(img => {
            img.addEventListener('error', function() {
                console.error('Failed to load image:', this.src);
                this.src = '{{ asset('images/image-placeholder.jpg') }}';
                this.alt = 'Image not available';
            });
        });
    });
</script>
@endsection