@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i> Edit Service
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Services
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        
                        {{-- Title Field --}}
                        <div class="form-group">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   placeholder="Enter service title"
                                   value="{{ old('title', $service->title) }}"
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
                                       value="{{ old('slug', $service->slug) }}">
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> Custom slug example: "custom-service-url" (use only lowercase letters, numbers, and hyphens). Leave blank to auto-generate from title.
                            </small>
                            <div id="slugPreview" class="mt-2">
                                <span class="badge badge-info">Preview URL:</span> 
                                <code id="previewUrl">{{ url('/service') }}/{{ $service->slug }}</code>
                            </div>
                            @error('slug')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- Short Description Field --}}
                        <div class="form-group">
                            <label for="short_description">Short Description</label>
                            <textarea name="short_description" 
                                      id="short_description" 
                                      class="form-control @error('short_description') is-invalid @enderror" 
                                      rows="3"
                                      placeholder="Brief description (max 500 characters) - appears in service listings">{{ old('short_description', $service->short_description) }}</textarea>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> A concise summary of the service. Maximum 500 characters.
                            </small>
                            <div id="shortDescCounter" class="mt-1">
                                <span id="charCount">{{ strlen($service->short_description ?? '') }}</span> / 500 characters
                                <span id="charWarning" class="text-danger" style="display: none;"> (Limit exceeded!)</span>
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
                                           {{ old('show_html', $service->show_html) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_html">
                                        <i class="fas fa-code"></i> Enable Rich Text Editor (CKEditor)
                                    </label>
                                </div>
                            </div>
                            <textarea name="body"
                                      id="body"
                                      class="form-control @error('body') is-invalid @enderror"
                                      rows="10"
                                      placeholder="Enter detailed service description">{{ old('body', $service->body) }}</textarea>
                            <small class="form-text text-muted">
                                <i class="fas fa-shield-alt"></i> XSS protection enabled. HTML is only allowed when CKEditor is enabled.
                            </small>
                            @error('body')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- Features Field --}}
                        <div class="form-group">
                            <label for="features">Features & Benefits</label>
                            <textarea name="features"
                                      id="features"
                                      class="form-control @error('features') is-invalid @enderror"
                                      rows="6"
                                      placeholder="Enter service features (one per line)&#10;Example:&#10;✓ 24/7 Customer Support&#10;✓ Free Consultation&#10;✓ 100% Satisfaction Guarantee">{{ old('features', $service->features) }}</textarea>
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
                            @if($service->image)
                                <div class="mb-2">
                                    <img src="{{ asset($service->image) }}" alt="Current Image" style="max-width: 200px; height: auto; border-radius: 4px;">
                                    <br>
                                    <small class="text-muted">Current image</small>
                                </div>
                            @endif
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" 
                                           name="image" 
                                           id="image" 
                                           class="custom-file-input @error('image') is-invalid @enderror"
                                           accept="image/jpeg,image/png,image/jpg,image/gif">
                                    <label class="custom-file-label" for="image">Choose new file (leave empty to keep current)</label>
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
                            @if($service->icon_image)
                                <div class="mb-2">
                                    <img src="{{ asset($service->icon_image) }}" alt="Current Icon" style="width: 64px; height: 64px; object-fit: contain;">
                                    <br>
                                    <small class="text-muted">Current icon</small>
                                </div>
                            @endif
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" 
                                           name="icon_image" 
                                           id="icon_image" 
                                           class="custom-file-input @error('icon_image') is-invalid @enderror"
                                           accept="image/jpeg,image/png,image/jpg,image/svg+xml">
                                    <label class="custom-file-label" for="icon_image">Choose new icon (leave empty to keep current)</label>
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
                                   value="{{ old('keyword', $service->keyword) }}">
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
                                           value="{{ old('sort_order', $service->sort_order ?? 0) }}">
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
                                               {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
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
                            <i class="fas fa-save"></i> Update Service
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
@endsection

@push('scripts')
<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('show_html');
    const bodyTextarea = document.getElementById('body');
    const featuresTextarea = document.getElementById('features');
    
    let bodyEditor = null;
    let featuresEditor = null;
    
    // Store original values
    let originalBodyValue = bodyTextarea.value;
    let originalFeaturesValue = featuresTextarea.value;
    
    function enableBodyEditor() {
        if (!bodyEditor && bodyTextarea) {
            // Store current plain text value
            originalBodyValue = bodyTextarea.value;
            
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
                    // Set the content if there was HTML content
                    if (originalBodyValue && originalBodyValue.includes('<')) {
                        editor.setData(originalBodyValue);
                    }
                })
                .catch(error => {
                    console.error('CKEditor body error:', error);
                });
        }
    }
    
    function enableFeaturesEditor() {
        if (!featuresEditor && featuresTextarea) {
            // Store current plain text value
            originalFeaturesValue = featuresTextarea.value;
            
            ClassicEditor
                .create(featuresTextarea, {
                    toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'undo', 'redo'],
                })
                .then(editor => {
                    featuresEditor = editor;
                    // Set the content if there was HTML content
                    if (originalFeaturesValue && originalFeaturesValue.includes('<')) {
                        editor.setData(originalFeaturesValue);
                    }
                })
                .catch(error => {
                    console.error('CKEditor features error:', error);
                });
        }
    }
    
    function disableBodyEditor() {
        if (bodyEditor) {
            // Get HTML content from editor
            let htmlContent = bodyEditor.getData();
            
            // Convert HTML to plain text for XSS safety
            let plainText = htmlContent
                .replace(/<p[^>]*>/gi, '')
                .replace(/<\/p>/gi, '\n')
                .replace(/<br\s*\/?>/gi, '\n')
                .replace(/<[^>]*>/g, '')
                .replace(/&nbsp;/g, ' ')
                .replace(/&amp;/g, '&')
                .replace(/&lt;/g, '<')
                .replace(/&gt;/g, '>')
                .replace(/&quot;/g, '"')
                .replace(/&#39;/g, "'")
                .replace(/[ \t]+/g, ' ')
                .replace(/\n\s*\n/g, '\n\n')
                .trim();
            
            bodyEditor.destroy()
                .then(() => {
                    bodyEditor = null;
                    bodyTextarea.value = plainText;
                })
                .catch(error => {
                    console.error('Error destroying body editor:', error);
                });
        }
    }
    
    function disableFeaturesEditor() {
        if (featuresEditor) {
            // Get HTML content from editor
            let htmlContent = featuresEditor.getData();
            
            // Convert HTML to plain text
            let plainText = htmlContent
                .replace(/<p[^>]*>/gi, '')
                .replace(/<\/p>/gi, '\n')
                .replace(/<br\s*\/?>/gi, '\n')
                .replace(/<li[^>]*>/gi, '• ')
                .replace(/<\/li>/gi, '\n')
                .replace(/<[^>]*>/g, '')
                .replace(/&nbsp;/g, ' ')
                .replace(/&amp;/g, '&')
                .replace(/&lt;/g, '<')
                .replace(/&gt;/g, '>')
                .trim();
            
            featuresEditor.destroy()
                .then(() => {
                    featuresEditor = null;
                    featuresTextarea.value = plainText;
                })
                .catch(error => {
                    console.error('Error destroying features editor:', error);
                });
        }
    }
    
    // Initialize based on checkbox state
    if (checkbox && checkbox.checked) {
        // Hide textareas and show editors
        bodyTextarea.style.display = 'none';
        featuresTextarea.style.display = 'none';
        enableBodyEditor();
        enableFeaturesEditor();
    } else {
        // Show textareas
        bodyTextarea.style.display = 'block';
        featuresTextarea.style.display = 'block';
    }
    
    // Handle checkbox change
    if (checkbox) {
        checkbox.addEventListener('change', function (e) {
            console.log('Checkbox changed to:', this.checked);
            
            if (this.checked) {
                // Switch to CKEditor mode
                bodyTextarea.style.display = 'none';
                featuresTextarea.style.display = 'none';
                enableBodyEditor();
                enableFeaturesEditor();
            } else {
                // Switch to plain text mode
                disableBodyEditor();
                disableFeaturesEditor();
                bodyTextarea.style.display = 'block';
                featuresTextarea.style.display = 'block';
            }
        });
    }
    
    // Slug auto-generation
    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }
    
    $('#title').on('keyup', function() {
        var title = $(this).val();
        var slugField = $('#slug');
        
        if (slugField.val() === '' || slugField.data('auto') !== false) {
            var generatedSlug = slugify(title);
            slugField.val(generatedSlug);
            slugField.data('auto', true);
            $('#previewUrl').text('{{ url("/service") }}/' + generatedSlug);
        }
    });
    
    $('#slug').on('keyup', function() {
        $(this).data('auto', false);
        $('#previewUrl').text('{{ url("/service") }}/' + $(this).val());
    });
    
    // Character counter for short description
    function updateCharCount() {
        var length = $('#short_description').val().length;
        $('#charCount').text(length);
        
        if (length > 500) {
            $('#charWarning').show();
            $('#shortDescCounter').addClass('text-danger');
        } else {
            $('#charWarning').hide();
            $('#shortDescCounter').removeClass('text-danger');
        }
    }
    
    $('#short_description').on('keyup', updateCharCount);
    updateCharCount();
    
    // Image previews
    $('#image').on('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImg').attr('src', e.target.result);
                $('#imagePreview').show();
            }
            reader.readAsDataURL(e.target.files[0]);
        } else {
            $('#imagePreview').hide();
        }
    });
    
    $('#icon_image').on('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#iconPreviewImg').attr('src', e.target.result);
                $('#iconPreview').show();
            }
            reader.readAsDataURL(e.target.files[0]);
        } else {
            $('#iconPreview').hide();
        }
    });
    
    // Custom file input label
    $('.custom-file-input').on('change', function(e) {
        var fileName = e.target.files[0]?.name || 'Choose file';
        $(this).next('.custom-file-label').text(fileName);
    });
});
</script>
@endpush