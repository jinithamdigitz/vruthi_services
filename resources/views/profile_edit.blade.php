@extends('layouts.main')

@section('content')
<div class="container-fluid profile-container">
    <!-- Top Navigation -->
    <div class="top-nav">
        <div class="nav-content">
            <div class="greeting">
                <h2>Hello, {{ Auth::user()->name }}!</h2>
                <p>Manage your profile information</p>
            </div>
            <div class="nav-buttons">
                <a href="{{ route('profile') }}" class="nav-btn">
                    <i class="bi bi-person-circle"></i>
                    <span>My Profile</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="nav-btn active">
                    <i class="bi bi-pencil-square"></i>
                    <span>Edit Profile</span>
                </a>
                <a href="{{ route('profile.reports') }}" class="nav-btn">
                    <i class="bi bi-graph-up"></i>
                    <span>Donation Reports</span>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-btn logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-wrapper">
            <div class="dashboard-card">
                <h2 class="mb-4">Edit Profile</h2>
                
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
                    @csrf

                    <div class="row">
                        <!-- Left Column - Basic Info -->
                        <div class="col-md-6">
                            <div class="form-section">
                                <h5 class="section-title">Basic Information</h5>
                                
                                <!-- Full Name -->
                                <div class="mb-4">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" id="name" name="name" 
                                           value="{{ old('name', $user->name) }}" 
                                           class="form-control form-control-lg" required>
                                    @error('name')
                                    <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" id="email" name="email" 
                                           value="{{ old('email', $user->email) }}" 
                                           class="form-control form-control-lg" readonly>
                                    <small class="form-text">Email cannot be changed</small>
                                </div>

                                <!-- Location -->
                                <div class="mb-4">
                                    <label for="location" class="form-label">Location *</label>
                                    <input type="text" id="location" name="location"
                                           value="{{ old('location', $user->location ?? '') }}"
                                           class="form-control form-control-lg" required>
                                    @error('location')
                                    <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <label for="description" class="form-label">About Me</label>
                                    <textarea id="description" name="description" rows="5" 
                                              class="form-control form-control-lg" 
                                              placeholder="Tell us something about yourself...">{{ old('description', $user->description) }}</textarea>
                                    @error('description')
                                    <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Images -->
                        <div class="col-md-6">
                            <div class="form-section">
                                <h5 class="section-title">Profile Images</h5>
                                
                                <!-- Profile Image -->
                                <div class="mb-4">
                                    <label for="profile_image" class="form-label">Profile Image</label>
                                    <div class="image-upload-container">
                                        <div class="current-image-preview mb-3">
                                            @if($user->profile_image)
                                            <img src="{{ asset($user->profile_image) }}" alt="Current Profile Image" class="current-image">
                                            @else
                                            <div class="no-image-placeholder">
                                                <i class="bi bi-person-circle"></i>
                                                <span>No profile image</span>
                                            </div>
                                            @endif
                                        </div>
                                        <input type="file" id="profile_image" name="profile_image" 
                                               class="form-control form-control-lg" 
                                               accept="image/*">
                                        <small class="form-text">Recommended: Square image, 200x200 pixels or larger</small>
                                        @error('profile_image')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Cover Image -->
                                <div class="mb-4">
                                    <label for="cover_image" class="form-label">Cover Image</label>
                                    <div class="image-upload-container">
                                        <div class="current-image-preview mb-3">
                                            @if($user->cover_image)
                                            <img src="{{ asset($user->cover_image) }}" alt="Current Cover Image" class="current-image cover">
                                            @else
                                            <div class="no-image-placeholder cover">
                                                <i class="bi bi-image"></i>
                                                <span>No cover image</span>
                                            </div>
                                            @endif
                                        </div>
                                        <input type="file" id="cover_image" name="cover_image" 
                                               class="form-control form-control-lg" 
                                               accept="image/*">
                                        <small class="form-text">Recommended: 1200x400 pixels for best display</small>
                                        @error('cover_image')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions mt-5 pt-4 border-top">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-save me-2"></i>Save Changes
                                </button>
                                <a href="{{ route('profile') }}" class="btn btn-secondary btn-lg ms-2">
                                    <i class="bi bi-x-circle me-2"></i>Cancel
                                </a>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('admin.user.change-password.form') }}" class="btn btn-outline-primary btn-lg">
                                    <i class="bi bi-key me-2"></i>Change Password
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
:root {
    --enved-primary: #164A25;
    --enved-secondary: #00AA55;
    --enved-light: #e8f5e8;
    --enved-dark: #0d3518;
    --enved-gradient: linear-gradient(135deg, var(--enved-primary) 0%, var(--enved-secondary) 100%);
}

.profile-container {
    min-height: 100vh;
    background: #f8fdf8;
}

/* Top Navigation */
.top-nav {
    background: white;
    box-shadow: 0 2px 10px rgba(22, 74, 37, 0.1);
    padding: 15px 0;
    position: sticky;
    top: 0;
    z-index: 100;
}

.nav-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.greeting h2 {
    color: var(--enved-primary);
    font-weight: 700;
    margin: 0;
    font-size: 1.8rem;
}

.greeting p {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
}

.nav-buttons {
    display: flex;
    gap: 10px;
}

.nav-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: white;
    color: var(--enved-primary);
    text-decoration: none;
    border-radius: 8px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    font-weight: 500;
}

.nav-btn:hover {
    background: var(--enved-light);
    border-color: var(--enved-secondary);
    transform: translateY(-2px);
}

.nav-btn.active {
    background: var(--enved-gradient);
    color: white;
    box-shadow: 0 4px 12px rgba(22, 74, 37, 0.2);
}

.nav-btn.logout-btn:hover {
    background: #ffe6e6;
    border-color: #ff4444;
    color: #cc0000;
}

/* Main Content */
.main-content {
    padding: 30px 20px;
}

.content-wrapper {
    max-width: 1000px;
    margin: 0 auto;
}

/* Dashboard Card */
.dashboard-card {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 5px 20px rgba(22, 74, 37, 0.1);
    border: 1px solid #e8f5e8;
}

.dashboard-card h2 {
    color: var(--enved-primary);
    font-weight: 700;
    border-bottom: 2px solid var(--enved-light);
    padding-bottom: 15px;
}

/* Form Sections */
.form-section {
    margin-bottom: 30px;
}

.section-title {
    color: var(--enved-primary);
    font-weight: 600;
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--enved-light);
}

/* Form Controls */
.form-control-lg {
    border: 2px solid #e8f5e8;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: var(--enved-secondary);
    box-shadow: 0 0 0 0.2rem rgba(0, 170, 85, 0.1);
}

.form-label {
    font-weight: 600;
    color: var(--enved-primary);
    margin-bottom: 8px;
}

.form-text {
    color: #6c757d;
    font-size: 0.875rem;
    margin-top: 5px;
}

/* Image Upload */
.image-upload-container {
    border: 2px dashed #e8f5e8;
    border-radius: 10px;
    padding: 20px;
    background: #f8fdf8;
    transition: all 0.3s ease;
}

.image-upload-container:hover {
    border-color: var(--enved-secondary);
    background: #f0faf0;
}

.current-image-preview {
    text-align: center;
}

.current-image {
    max-width: 100%;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.current-image:not(.cover) {
    width: 150px;
    height: 150px;
    object-fit: cover;
}

.current-image.cover {
    width: 100%;
    max-height: 200px;
    object-fit: cover;
}

.no-image-placeholder {
    padding: 40px 20px;
    color: #6c757d;
    text-align: center;
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    background: #f8f9fa;
}

.no-image-placeholder i {
    font-size: 3rem;
    display: block;
    margin-bottom: 10px;
    color: var(--enved-secondary);
}

.no-image-placeholder.cover {
    padding: 60px 20px;
}

/* Buttons */
.btn-primary {
    background: var(--enved-gradient);
    border: none;
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(22, 74, 37, 0.3);
}

.btn-secondary {
    background: #6c757d;
    border: none;
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.btn-outline-primary {
    border: 2px solid var(--enved-primary);
    color: var(--enved-primary);
    background: transparent;
    padding: 12px 25px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: var(--enved-primary);
    color: white;
    transform: translateY(-2px);
}

/* Error Messages */
.error-message {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
    display: block;
}

/* Form Actions */
.form-actions {
    border-top: 2px solid var(--enved-light);
}

/* Responsive */
@media (max-width: 768px) {
    .nav-content {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .nav-buttons {
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .main-content {
        padding: 20px 15px;
    }
    
    .dashboard-card {
        padding: 25px;
    }
    
    .form-actions .row {
        flex-direction: column;
        gap: 15px;
    }
    
    .form-actions .text-end {
        text-align: left !important;
    }
    
    .greeting h2 {
        font-size: 1.5rem;
    }
}

@media (max-width: 576px) {
    .nav-buttons {
        flex-direction: column;
        width: 100%;
    }
    
    .nav-btn {
        width: 100%;
        justify-content: center;
    }
    
    .dashboard-card {
        padding: 20px;
    }
    
    .btn-lg {
        padding: 10px 20px;
        font-size: 0.9rem;
        width: 100%;
        margin-bottom: 10px;
    }
    
    .form-actions .ms-2 {
        margin-left: 0 !important;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    const profileImageInput = document.getElementById('profile_image');
    const coverImageInput = document.getElementById('cover_image');
    
    function previewImage(input, previewClass) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const previewContainer = input.closest('.image-upload-container').querySelector('.current-image-preview');
                previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" class="${previewClass}">`;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    if (profileImageInput) {
        profileImageInput.addEventListener('change', function() {
            previewImage(this, 'current-image');
        });
    }
    
    if (coverImageInput) {
        coverImageInput.addEventListener('change', function() {
            previewImage(this, 'current-image cover');
        });
    }
    
    // Form submission loading state
    const form = document.getElementById('profileForm');
    if (form) {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat me-2"></i>Saving...';
        });
    }
});
</script>
@endsection