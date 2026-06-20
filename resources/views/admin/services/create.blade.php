@extends('layouts.admin')

@section('content')
<style>
    .ck-editor__editable {
        min-height: 300px;
        max-height: 500px;
    }
    
    .image-preview {
        max-width: 200px;
        margin-top: 10px;
    }
    
    .service-image-preview {
        max-width: 150px;
        margin-top: 10px;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 4px;
    }
    
    .remove-item {
        cursor: pointer;
    }
    
    .benefit-item, .faq-item, .section-item {
        transition: all 0.3s ease;
    }
    
    .benefit-item:hover, .faq-item:hover, .section-item:hover {
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    /* Minimizable Card Styles */
    .card-header {
        cursor: pointer;
        user-select: none;
        transition: background-color 0.3s ease;
    }
    
    .card-header:hover {
        opacity: 0.95;
    }
    
    .card-header .toggle-icon {
        float: right;
        transition: transform 0.3s ease;
        font-size: 1.2rem;
    }
    
    .card-header.collapsed .toggle-icon {
        transform: rotate(180deg);
    }
    
    .card-body {
        transition: all 0.3s ease;
    }
    
    .card-body.collapsed {
        display: none;
    }

    .benefit-item {
        background-color: #f9f9f9;
        transition: all 0.3s ease;
    }

    .benefit-item:hover {
        background-color: #fefefe;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .btn {
        border-radius: 5px;
        font-weight: 500;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-plus-circle"></i> Add New Service</h3>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Services
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-triangle"></i> Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" id="serviceForm">
        @csrf

        <!-- Basic Information Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white" onclick="toggleCard(this)">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle"></i> Basic Information 
                    <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Service Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title') }}" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   placeholder="Enter service title"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug">Slug (Optional)</label>
                            <input type="text" 
                                   name="slug" 
                                   id="slug" 
                                   value="{{ old('slug') }}" 
                                   class="form-control @error('slug') is-invalid @enderror" 
                                   placeholder="leave-empty-to-auto-generate">
                            <small class="form-text text-muted">Leave empty to auto-generate from title. Use only letters, numbers, and hyphens.</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label for="short_description">Short Description</label>
                            <textarea name="short_description" 
                                      id="short_description" 
                                      class="form-control @error('short_description') is-invalid @enderror" 
                                      rows="3"
                                      placeholder="Brief description (max 500 characters) - appears in service listings">{{ old('short_description') }}</textarea>
                            <small class="form-text text-muted">A concise summary of the service. Maximum 500 characters.</small>
                            <div id="shortDescCounter" class="text-muted mt-1">
                                <span id="charCount">0</span> / 500 characters
                            </div>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label for="body">Full Description</label>
                            <textarea name="body" 
                                      id="body" 
                                      class="form-control @error('body') is-invalid @enderror" 
                                      rows="8"
                                      placeholder="Enter detailed service description">{{ old('body') }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Features Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white" onclick="toggleCard(this)">
                <h5 class="mb-0">
                    <i class="bi bi-list-check"></i> Features & Benefits 
                    <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
                </h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="features">Features List</label>
                    <textarea name="features" 
                              id="features" 
                              class="form-control @error('features') is-invalid @enderror" 
                              rows="6"
                              placeholder="Enter service features (one per line)&#10;Example:&#10;✓ 24/7 Customer Support&#10;✓ Free Consultation&#10;✓ 100% Satisfaction Guarantee">{{ old('features') }}</textarea>
                    <small class="form-text text-muted">Enter each feature on a new line. These will be displayed as a bullet list on the frontend.</small>
                    @error('features')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- What You Get - Service Benefits Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-dark" onclick="toggleCard(this)">
                <h5 class="mb-0">
                    <i class="bi bi-gift"></i> What You Get - Service Benefits 
                    <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> 
                    Add the benefits that customers will get with this service (e.g., Lawn Care & Mowing, Landscape Design, etc.)
                </div>
                
                <div id="benefit-wrapper">
                    <!-- Initial Benefit Item -->
                    <div class="benefit-item border rounded p-3 mb-3">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Benefit Title <span class="text-danger">*</span></label>
                                    <input type="text" name="benefit_title[]" class="form-control" placeholder="Enter benefit title (e.g., Lawn Care & Mowing)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="benefit_status[]" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Benefit Image</label>
                                    <input type="file" name="benefit_image[]" class="form-control-file" accept="image/*">
                                    <small class="form-text text-muted">Allowed formats: JPG, JPEG, PNG, WEBP. Max size: 2MB</small>
                                    <div class="benefit-image-preview"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button type="button" class="btn btn-danger remove-benefit">
                                            <i class="bi bi-trash"></i> Remove Benefit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="button" class="btn btn-success" id="add-benefit">
                    <i class="bi bi-plus"></i> Add More Benefit
                </button>
            </div>
        </div>

        <!-- Images Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white" onclick="toggleCard(this)">
                <h5 class="mb-0">
                    <i class="bi bi-images"></i> Service Images 
                    <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Main Image</label>
                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   class="form-control-file @error('image') is-invalid @enderror" 
                                   accept="image/*">
                            <small class="form-text text-muted">Recommended size: 800x600px. Max 5MB. JPG, PNG, GIF only.</small>
                            <div id="mainImagePreview"></div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="icon_image">Icon Image</label>
                            <input type="file" 
                                   name="icon_image" 
                                   id="icon_image" 
                                   class="form-control-file @error('icon_image') is-invalid @enderror" 
                                   accept="image/*">
                            <small class="form-text text-muted">Recommended size: 64x64px or 128x128px. Max 2MB. SVG, PNG, JPG allowed.</small>
                            <div id="iconImagePreview"></div>
                            @error('icon_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white" onclick="toggleCard(this)">
                <h5 class="mb-0">
                    <i class="bi bi-search"></i> SEO & Settings 
                    <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="keyword">SEO Keywords</label>
                            <input type="text" 
                                   name="keyword" 
                                   id="keyword" 
                                   value="{{ old('keyword') }}" 
                                   class="form-control @error('keyword') is-invalid @enderror" 
                                   placeholder="Enter SEO keywords (comma separated)">
                            <small class="form-text text-muted">Keywords for SEO optimization (comma separated). Example: "facility management, security services, housekeeping"</small>
                            @error('keyword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" 
                                   name="sort_order" 
                                   id="sort_order" 
                                   value="{{ old('sort_order', 0) }}" 
                                   class="form-control @error('sort_order') is-invalid @enderror" 
                                   placeholder="0">
                            <small class="form-text text-muted">Lower numbers appear first. Default: 0</small>
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active" 
                                       class="form-check-input" 
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <i class="bi bi-check-circle text-success"></i> Active (Visible on Frontend)
                                </label>
                            </div>
                            <small class="form-text text-muted">Inactive services will not be displayed on the website.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group text-center mb-4">
            <button type="submit" class="btn btn-lg btn-success">
                <i class="bi bi-save"></i> Save Service
            </button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-lg btn-secondary ml-2">
                <i class="bi bi-x"></i> Cancel
            </a>
        </div>
    </form>
</div>

<!-- JavaScript for Dynamic Fields and Image Previews -->
<script>
// Toggle Card Function
function toggleCard(headerElement) {
    const cardBody = headerElement.closest('.card').querySelector('.card-body');
    const icon = headerElement.querySelector('.toggle-icon i');
    
    if (cardBody.classList.contains('collapsed')) {
        // Expand
        cardBody.classList.remove('collapsed');
        headerElement.classList.remove('collapsed');
        icon.classList.remove('bi-plus-circle');
        icon.classList.add('bi-dash-circle');
    } else {
        // Minimize
        cardBody.classList.add('collapsed');
        headerElement.classList.add('collapsed');
        icon.classList.remove('bi-dash-circle');
        icon.classList.add('bi-plus-circle');
    }
}

// Character counter for short description
document.getElementById('short_description').addEventListener('keyup', function() {
    var length = $(this).val().length;
    $('#charCount').text(length);
    
    if (length > 500) {
        $('#shortDescCounter').addClass('text-danger').removeClass('text-muted');
    } else {
        $('#shortDescCounter').removeClass('text-danger').addClass('text-muted');
    }
});

// Trigger character counter on load
document.addEventListener('DOMContentLoaded', function() {
    const shortDesc = document.getElementById('short_description');
    if (shortDesc) {
        const length = shortDesc.value.length;
        document.getElementById('charCount').textContent = length;
    }
});

// Add Benefit
document.getElementById('add-benefit').addEventListener('click', function() {
    const benefitHtml = `
        <div class="benefit-item border rounded p-3 mb-3">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Benefit Title <span class="text-danger">*</span></label>
                        <input type="text" name="benefit_title[]" class="form-control" placeholder="Enter benefit title (e.g., Lawn Care & Mowing)">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="benefit_status[]" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Benefit Image</label>
                        <input type="file" name="benefit_image[]" class="form-control-file" accept="image/*">
                        <small class="form-text text-muted">Allowed formats: JPG, JPEG, PNG, WEBP. Max size: 2MB</small>
                        <div class="benefit-image-preview"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div>
                            <button type="button" class="btn btn-danger remove-benefit">
                                <i class="bi bi-trash"></i> Remove Benefit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('benefit-wrapper').insertAdjacentHTML('beforeend', benefitHtml);
});

// Remove Benefit
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-benefit') || e.target.parentElement.classList.contains('remove-benefit')) {
        const button = e.target.classList.contains('remove-benefit') ? e.target : e.target.parentElement;
        button.closest('.benefit-item').remove();
    }
});

// Main Image Preview
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('mainImagePreview');
    preview.innerHTML = '';
    
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('service-image-preview');
            preview.appendChild(img);
        };
        reader.readAsDataURL(this.files[0]);
    }
});

// Icon Image Preview
document.getElementById('icon_image').addEventListener('change', function(e) {
    const preview = document.getElementById('iconImagePreview');
    preview.innerHTML = '';
    
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('service-image-preview');
            img.style.width = '64px';
            img.style.height = '64px';
            img.style.objectFit = 'contain';
            preview.appendChild(img);
        };
        reader.readAsDataURL(this.files[0]);
    }
});

// Benefit Image Preview (Dynamic)
document.addEventListener('change', function(e) {
    if (e.target && e.target.name === 'benefit_image[]') {
        const preview = e.target.closest('.benefit-item').querySelector('.benefit-image-preview');
        preview.innerHTML = '';
        
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('service-image-preview');
                preview.appendChild(img);
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    }
});

// Auto-generate slug from title
document.getElementById('title').addEventListener('keyup', function() {
    const slugInput = document.getElementById('slug');
    if (slugInput.value === '') {
        let slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        slugInput.value = slug;
    }
});
</script>
@endsection