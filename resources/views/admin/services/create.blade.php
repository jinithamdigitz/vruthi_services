@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle"></i> Create New Service
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Services
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        
                        {{-- Title Field --}}
                        <div class="form-group">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   placeholder="Enter service title"
                                   value="{{ old('title') }}"
                                   required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- Slug Field --}}
                        <div class="form-group">
                            <label for="slug">Slug <span class="text-muted">(Optional - auto generates from title if left blank)</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                </div>
                                <input type="text" 
                                       name="slug" 
                                       id="slug" 
                                       class="form-control @error('slug') is-invalid @enderror" 
                                       placeholder="leave blank to auto-generate"
                                       value="{{ old('slug') }}">
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> Custom slug example: "custom-service-url" (use only lowercase letters, numbers, and hyphens). Leave blank to auto-generate from title.
                            </small>
                            <div id="slugPreview" class="mt-2" style="display: none;">
                                <span class="badge badge-info">Preview URL:</span> 
                                <code id="previewUrl">{{ url('/service') }}/</code>
                            </div>
                            @error('slug')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- Short Description Field (NEW) --}}
                        <div class="form-group">
                            <label for="short_description">Short Description</label>
                            <textarea name="short_description" 
                                      id="short_description" 
                                      class="form-control @error('short_description') is-invalid @enderror" 
                                      rows="3"
                                      placeholder="Brief description (max 500 characters) - appears in service listings">{{ old('short_description') }}</textarea>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> A concise summary of the service. Maximum 500 characters.
                            </small>
                            <div id="shortDescCounter" class="text-muted mt-1">
                                <span id="charCount">0</span> / 500 characters
                            </div>
                            @error('short_description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- Body / Description Field with CKEditor --}}
                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="body" class="mb-0">
                                    Full Description
                                </label>
                                <div class="form-check">
                                    <input type="checkbox"
                                           name="show_html"
                                           value="1"
                                           class="form-check-input"
                                           id="show_html"
                                           {{ old('show_html') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_html">
                                        <i class="fas fa-code"></i> Enable Rich Text Editor (CKEditor)
                                    </label>
                                </div>
                            </div>
                            <textarea name="body"
                                      id="body"
                                      class="form-control @error('body') is-invalid @enderror"
                                      rows="10"
                                      placeholder="Enter detailed service description">{{ old('body') }}</textarea>
                            <small class="form-text text-muted">
                                <i class="fas fa-shield-alt"></i> XSS protection enabled. HTML is only allowed when CKEditor is enabled.
                            </small>
                            @error('body')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- Features Field (NEW) --}}
                        <div class="form-group">
                            <label for="features">Features & Benefits</label>
                            <textarea name="features"
                                      id="features"
                                      class="form-control @error('features') is-invalid @enderror"
                                      rows="6"
                                      placeholder="Enter service features (one per line)&#10;Example:&#10;✓ 24/7 Customer Support&#10;✓ Free Consultation&#10;✓ 100% Satisfaction Guarantee">{{ old('features') }}</textarea>
                            <small class="form-text text-muted">
                                <i class="fas fa-list-ul"></i> Enter each feature on a new line. These will be displayed as a bullet list on the frontend.
                            </small>
                            @error('features')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- Main Image Field --}}
                        <div class="form-group">
                            <label for="image">Main Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" 
                                           name="image" 
                                           id="image" 
                                           class="custom-file-input @error('image') is-invalid @enderror"
                                           accept="image/jpeg,image/png,image/jpg,image/gif">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">Recommended size: 800x600px. Max 5MB. JPG, PNG, GIF only.</small>
                            @error('image')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            
                            {{-- Image Preview --}}
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <img id="previewImg" src="#" alt="Preview" style="max-width: 200px; height: auto; border-radius: 4px;">
                            </div>
                        </div>
                        
                        {{-- Icon Image Field --}}
                        <div class="form-group">
                            <label for="icon_image">Icon Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" 
                                           name="icon_image" 
                                           id="icon_image" 
                                           class="custom-file-input @error('icon_image') is-invalid @enderror"
                                           accept="image/jpeg,image/png,image/jpg,image/svg+xml">
                                    <label class="custom-file-label" for="icon_image">Choose icon file</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">Recommended size: 64x64px or 128x128px. Max 2MB. SVG, PNG, JPG allowed.</small>
                            @error('icon_image')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            
                            {{-- Icon Preview --}}
                            <div id="iconPreview" class="mt-2" style="display: none;">
                                <img id="iconPreviewImg" src="#" alt="Icon Preview" style="width: 64px; height: 64px; object-fit: contain;">
                            </div>
                        </div>
                        
                        {{-- Keyword Field --}}
                        <div class="form-group">
                            <label for="keyword">SEO Keywords</label>
                            <input type="text" 
                                   name="keyword" 
                                   id="keyword" 
                                   class="form-control @error('keyword') is-invalid @enderror" 
                                   placeholder="Enter SEO keywords (comma separated)"
                                   value="{{ old('keyword') }}">
                            <small class="form-text text-muted">Keywords for SEO optimization (comma separated). Example: "facility management, security services, housekeeping"</small>
                            @error('keyword')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- Sort Order & Status Row --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort_order">Sort Order</label>
                                    <input type="number" 
                                           name="sort_order" 
                                           id="sort_order" 
                                           class="form-control @error('sort_order') is-invalid @enderror" 
                                           placeholder="0"
                                           value="{{ old('sort_order', 0) }}">
                                    <small class="form-text text-muted">Lower numbers appear first. Default: 0</small>
                                    @error('sort_order')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">&nbsp;</label>
                                    <div class="form-check">
                                        <input type="checkbox" 
                                               name="is_active" 
                                               id="is_active" 
                                               class="form-check-input" 
                                               value="1"
                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            <i class="fas fa-check-circle text-success"></i> Active (Visible on Frontend)
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">Inactive services will not be displayed on the website.</small>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Service
                        </button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    // Auto-generate slug from title
    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }
    
    // Update slug preview
    function updateSlugPreview(slug) {
        if (slug) {
            $('#slugPreview').show();
            $('#previewUrl').text('{{ url("/service") }}/' + slug);
        } else {
            $('#slugPreview').hide();
        }
    }
    
    // Generate slug from title
    $('#title').on('keyup', function() {
        var title = $(this).val();
        var slugField = $('#slug');
        
        // Only auto-generate if slug field is empty
        if (slugField.val() === '') {
            var generatedSlug = slugify(title);
            slugField.val(generatedSlug);
            updateSlugPreview(generatedSlug);
        }
    });
    
    // When user manually types in slug field
    $('#slug').on('keyup', function() {
        var slug = $(this).val();
        updateSlugPreview(slug);
    });
    
    // Initial slug preview if value exists
    if ($('#slug').val()) {
        updateSlugPreview($('#slug').val());
    }
    
    // Character counter for short description
    $('#short_description').on('keyup', function() {
        var length = $(this).val().length;
        $('#charCount').text(length);
        
        if (length > 500) {
            $('#shortDescCounter').addClass('text-danger').removeClass('text-muted');
        } else {
            $('#shortDescCounter').removeClass('text-danger').addClass('text-muted');
        }
    });
    
    // Trigger character counter on load
    $('#short_description').trigger('keyup');
    
    // Main Image Preview
    $('#image').on('change', function(e) {
        const preview = $('#imagePreview');
        const img = $('#previewImg');
        
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.attr('src', e.target.result);
                preview.show();
            }
            reader.readAsDataURL(e.target.files[0]);
        } else {
            preview.hide();
        }
    });
    
    // Icon Image Preview
    $('#icon_image').on('change', function(e) {
        const preview = $('#iconPreview');
        const img = $('#iconPreviewImg');
        
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.attr('src', e.target.result);
                preview.show();
            }
            reader.readAsDataURL(e.target.files[0]);
        } else {
            preview.hide();
        }
    });
    
    // Custom file input label update
    $('.custom-file-input').on('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Choose file';
        const label = $(this).next('.custom-file-label');
        label.text(fileName);
    });
    
    // CKEditor Integration
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('show_html');
        const bodyTextarea = document.getElementById('body');
        const featuresTextarea = document.getElementById('features');
        
        let bodyEditor = null;
        let featuresEditor = null;
        
        function enableBodyEditor() {
            if (!bodyEditor) {
                ClassicEditor
                    .create(bodyTextarea, {
                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
                        heading: {
                            options: [
                                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                            ]
                        }
                    })
                    .then(editor => {
                        bodyEditor = editor;
                    })
                    .catch(error => {
                        console.error('CKEditor error:', error);
                    });
            }
        }
        
        function enableFeaturesEditor() {
            if (!featuresEditor) {
                ClassicEditor
                    .create(featuresTextarea, {
                        toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'undo', 'redo'],
                    })
                    .then(editor => {
                        featuresEditor = editor;
                    })
                    .catch(error => {
                        console.error('CKEditor error:', error);
                    });
            }
        }
        
        function disableBodyEditor() {
            if (bodyEditor) {
                let content = bodyEditor.getData();
                let plainText = content
                    .replace(/<[^>]*>/g, '')
                    .replace(/&nbsp;/g, ' ')
                    .replace(/<\/p>/gi, '\n')
                    .replace(/<br\s*\/?>/gi, '\n')
                    .replace(/[ \t]+/g, ' ')
                    .replace(/\n\s*\n/g, '\n\n')
                    .trim();
                
                bodyEditor.destroy()
                    .then(() => {
                        bodyEditor = null;
                        bodyTextarea.value = plainText;
                    });
            }
        }
        
        function disableFeaturesEditor() {
            if (featuresEditor) {
                let content = featuresEditor.getData();
                let plainText = content
                    .replace(/<[^>]*>/g, '')
                    .replace(/&nbsp;/g, ' ')
                    .replace(/<\/p>/gi, '\n')
                    .replace(/<br\s*\/?>/gi, '\n')
                    .trim();
                
                featuresEditor.destroy()
                    .then(() => {
                        featuresEditor = null;
                        featuresTextarea.value = plainText;
                    });
            }
        }
        
        if (checkbox.checked) {
            enableBodyEditor();
            enableFeaturesEditor();
        }
        
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                enableBodyEditor();
                enableFeaturesEditor();
            } else {
                disableBodyEditor();
                disableFeaturesEditor();
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    .custom-file-label::after {
        content: "Browse";
    }
    
    #slugPreview {
        padding: 5px 10px;
        background: #f8f9fc;
        border-radius: 4px;
        font-size: 13px;
    }
    
    #shortDescCounter {
        font-size: 12px;
    }
    
    .form-group label {
        font-weight: 600;
    }
    
    .card-footer {
        background-color: #f8f9fc;
    }
</style>
@endpush
@endsection