@extends('layouts.admin')

@section('content')
<style>
    .ck-editor__editable {
        min-height: 300px;
        max-height: 500px;
    }
    
    .service-image-preview {
        max-width: 150px;
        margin-top: 10px;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 4px;
    }
    
    .benefit-item {
        background-color: #f9f9f9;
        transition: all 0.3s ease;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .benefit-item:hover {
        background-color: #fefefe;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .benefit-image-preview {
        max-width: 100px;
        margin-top: 10px;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 4px;
    }
    
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

    .editor-toggle {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #6c757d;
        background: #fff;
        color: #6c757d;
    }

    .editor-toggle:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .editor-toggle.active {
        border-color: #28a745;
        background: #28a745;
        color: #fff;
    }

    .editor-toggle.inactive {
        border-color: #dc3545;
        background: #dc3545;
        color: #fff;
    }

    .editor-toggle .toggle-status {
        font-size: 12px;
    }

    .editor-toggle .toggle-icon-btn {
        font-size: 16px;
    }

    .editor-wrapper {
        position: relative;
    }

    .editor-wrapper .editor-status {
        position: absolute;
        top: -12px;
        right: 10px;
        background: #fff;
        padding: 2px 12px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 600;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        z-index: 10;
    }

    .editor-wrapper .editor-status.enabled {
        color: #28a745;
    }

    .editor-wrapper .editor-status.disabled {
        color: #dc3545;
    }

    .editor-toolbar {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }

    .editor-toolbar .editor-label {
        font-weight: 600;
        font-size: 14px;
        margin-right: 10px;
    }
</style>

<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Edit Service</h1>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to Services
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Main Content Section -->
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">📄 Main Content</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" value="{{ old('title', $service->title) }}" class="form-control" required>
                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Slug</label>
                                    <input type="text" name="slug" value="{{ old('slug', $service->slug) }}" class="form-control" placeholder="Leave empty to auto-generate">
                                    <small class="text-muted">Leave empty to auto-generate from title</small>
                                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Short Description</label>
                            <textarea name="short_description" class="form-control" rows="3" maxlength="500">{{ old('short_description', $service->short_description) }}</textarea>
                            <small class="text-muted">Maximum 500 characters. <span id="charCount">0</span> characters used.</small>
                            @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Full Description with CKEditor Toggle -->
                        <div class="mb-3">
                            <div class="editor-toolbar">
                                <span class="editor-label">Full Description</span>
                                <button type="button" class="editor-toggle {{ $service->show_html ? 'active' : 'inactive' }}" 
                                        id="bodyEditorToggle" 
                                        onclick="toggleEditor('body')">
                                    <span class="toggle-icon-btn">
                                        <i class="bi {{ $service->show_html ? 'bi-code-square' : 'bi-file-text' }}"></i>
                                    </span>
                                    <span>{{ $service->show_html ? 'HTML Mode' : 'Plain Text' }}</span>
                                    <span class="toggle-status badge {{ $service->show_html ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $service->show_html ? 'ON' : 'OFF' }}
                                    </span>
                                </button>
                                <input type="hidden" name="show_html" id="show_html" value="{{ $service->show_html ? 1 : 0 }}">
                            </div>
                            <div class="editor-wrapper" id="bodyEditorWrapper">
                                <span class="editor-status {{ $service->show_html ? 'enabled' : 'disabled' }}" id="bodyEditorStatus">
                                    <i class="bi {{ $service->show_html ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                                    {{ $service->show_html ? 'HTML Enabled' : 'HTML Disabled' }}
                                </span>
                                <textarea name="body" id="body" class="form-control" rows="8" 
                                    data-editor="body"
                                    data-show-html="{{ $service->show_html ? 'true' : 'false' }}"
                                    placeholder="Enter detailed service description">{{ old('body', $service->body) }}</textarea>
                            </div>
                            @error('body') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Features with CKEditor Toggle -->
                        <div class="mb-3">
                            <div class="editor-toolbar">
                                <span class="editor-label">Features & Benefits</span>
                                <button type="button" class="editor-toggle {{ $service->show_html ? 'active' : 'inactive' }}" 
                                        id="featuresEditorToggle" 
                                        onclick="toggleEditor('features')">
                                    <span class="toggle-icon-btn">
                                        <i class="bi {{ $service->show_html ? 'bi-code-square' : 'bi-list-ul' }}"></i>
                                    </span>
                                    <span>{{ $service->show_html ? 'HTML Mode' : 'Plain Text' }}</span>
                                    <span class="toggle-status badge {{ $service->show_html ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $service->show_html ? 'ON' : 'OFF' }}
                                    </span>
                                </button>
                            </div>
                            <div class="editor-wrapper" id="featuresEditorWrapper">
                                <span class="editor-status {{ $service->show_html ? 'enabled' : 'disabled' }}" id="featuresEditorStatus">
                                    <i class="bi {{ $service->show_html ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                                    {{ $service->show_html ? 'HTML Enabled' : 'HTML Disabled' }}
                                </span>
                                <textarea name="features" id="features" class="form-control" rows="5" 
                                    data-editor="features"
                                    data-show-html="{{ $service->show_html ? 'true' : 'false' }}"
                                    placeholder="Enter features (one per line)">{{ old('features', $service->features) }}</textarea>
                            </div>
                            <small class="text-muted">Enter each feature on a new line. Use HTML tags for formatting when HTML mode is ON.</small>
                            @error('features') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                <!-- What You Get - Service Benefits Section -->
                <div class="card mb-3">
                    <div class="card-header bg-success text-white" onclick="toggleCard(this)">
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
                            @if($service->benefits->count() > 0)
                                @foreach($service->benefits as $index => $benefit)
                                <div class="benefit-item">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Benefit Title <span class="text-danger">*</span></label>
                                                <input type="text" name="benefit_title[]" class="form-control" placeholder="Enter benefit title" value="{{ old('benefit_title.'.$index, $benefit->title) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="benefit_status[]" class="form-control">
                                                    <option value="1" {{ $benefit->is_active ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ !$benefit->is_active ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Benefit Image</label>
                                                @if($benefit->image)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('uploads/' . $benefit->image) }}" alt="{{ $benefit->title }}" class="benefit-image-preview">
                                                        <small class="d-block text-muted">Current image</small>
                                                    </div>
                                                    <input type="hidden" name="existing_benefit_image[]" value="{{ $benefit->image }}">
                                                @endif
                                                <input type="file" name="benefit_image[]" class="form-control-file" accept="image/*">
                                                <small class="text-muted">Allowed formats: JPG, JPEG, PNG, WEBP. Max size: 2MB</small>
                                                <div class="benefit-image-preview-container"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div>
                                                    <input type="hidden" name="benefit_id[]" value="{{ $benefit->id }}">
                                                    <button type="button" class="btn btn-danger remove-benefit">
                                                        <i class="bi bi-trash"></i> Remove Benefit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <!-- Empty benefit item -->
                                <div class="benefit-item">
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
                                                <small class="text-muted">Allowed formats: JPG, JPEG, PNG, WEBP. Max size: 2MB</small>
                                                <div class="benefit-image-preview-container"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div>
                                                    <input type="hidden" name="benefit_id[]" value="">
                                                    <button type="button" class="btn btn-danger remove-benefit">
                                                        <i class="bi bi-trash"></i> Remove Benefit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <button type="button" class="btn btn-success mt-2" id="add-benefit">
                            <i class="bi bi-plus"></i> Add More Benefit
                        </button>
                    </div>
                </div>

                <!-- Images Section -->
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">🖼️ Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Main Image</label>
                                    @if($service->image)
                                        <div class="mb-2">
                                            <img src="{{ asset($service->image) }}" alt="Main Image" class="service-image-preview">
                                        </div>
                                    @endif
                                    <input type="file" name="image" class="form-control">
                                    <small class="text-muted">Recommended size: 800x600px. Max 5MB</small>
                                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Icon Image</label>
                                    @if($service->icon_image)
                                        <div class="mb-2">
                                            <img src="{{ asset($service->icon_image) }}" alt="Icon Image" class="service-image-preview" style="width:64px;height:64px;object-fit:contain;">
                                        </div>
                                    @endif
                                    <input type="file" name="icon_image" class="form-control">
                                    <small class="text-muted">Recommended size: 64x64px. Max 2MB</small>
                                    @error('icon_image') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Section -->
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">🔍 SEO & Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>SEO Keywords</label>
                            <input type="text" name="keyword" value="{{ old('keyword', $service->keyword) }}" class="form-control" placeholder="Enter SEO keywords (comma separated)">
                            <small class="text-muted">Example: "facility management, security services, housekeeping"</small>
                            @error('keyword') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" class="form-control">
                                    <small class="text-muted">Lower numbers appear first</small>
                                    @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>&nbsp;</label>
                                    <div class="form-check">
                                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            <i class="bi bi-check-circle text-success"></i> Active (Visible on Frontend)
                                        </label>
                                    </div>
                                    <small class="text-muted">Inactive services will not be displayed</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Update Service
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
// Editor instances
let bodyEditor = null;
let featuresEditor = null;
let bodyEditorActive = {{ $service->show_html ? 'true' : 'false' }};
let featuresEditorActive = {{ $service->show_html ? 'true' : 'false' }};

// Toggle Editor Function
function toggleEditor(editorName) {
    const showHtmlInput = document.getElementById('show_html');
    const isBodyEditor = editorName === 'body';
    
    if (isBodyEditor) {
        bodyEditorActive = !bodyEditorActive;
        const toggleBtn = document.getElementById('bodyEditorToggle');
        const statusBadge = document.getElementById('bodyEditorStatus');
        const textarea = document.getElementById('body');
        
        if (bodyEditorActive) {
            // Enable CKEditor
            enableCKEditor('body', textarea, toggleBtn, statusBadge);
        } else {
            // Disable CKEditor
            disableCKEditor('body', textarea, toggleBtn, statusBadge);
        }
    } else {
        featuresEditorActive = !featuresEditorActive;
        const toggleBtn = document.getElementById('featuresEditorToggle');
        const statusBadge = document.getElementById('featuresEditorStatus');
        const textarea = document.getElementById('features');
        
        if (featuresEditorActive) {
            enableCKEditor('features', textarea, toggleBtn, statusBadge);
        } else {
            disableCKEditor('features', textarea, toggleBtn, statusBadge);
        }
    }
    
    // Update the hidden input
    if (bodyEditorActive || featuresEditorActive) {
        showHtmlInput.value = 1;
    } else {
        showHtmlInput.value = 0;
    }
}

function enableCKEditor(name, textarea, toggleBtn, statusBadge) {
    // Update button
    toggleBtn.className = 'editor-toggle active';
    toggleBtn.querySelector('.toggle-icon-btn i').className = 'bi bi-code-square';
    toggleBtn.querySelector('span:not(.toggle-icon-btn):not(.toggle-status)').textContent = 'HTML Mode';
    toggleBtn.querySelector('.toggle-status').textContent = 'ON';
    toggleBtn.querySelector('.toggle-status').className = 'toggle-status badge bg-success';
    
    // Update status badge
    statusBadge.className = 'editor-status enabled';
    statusBadge.innerHTML = '<i class="bi bi-check-circle"></i> HTML Enabled';
    
    // Initialize CKEditor
    if (name === 'body') {
        if (bodyEditor) {
            bodyEditor.destroy();
            bodyEditor = null;
        }
        ClassicEditor
            .create(textarea, {
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
    } else {
        if (featuresEditor) {
            featuresEditor.destroy();
            featuresEditor = null;
        }
        ClassicEditor
            .create(textarea, {
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

function disableCKEditor(name, textarea, toggleBtn, statusBadge) {
    // Get content from editor
    let content = '';
    if (name === 'body' && bodyEditor) {
        content = bodyEditor.getData();
        bodyEditor.destroy();
        bodyEditor = null;
    } else if (name === 'features' && featuresEditor) {
        content = featuresEditor.getData();
        featuresEditor.destroy();
        featuresEditor = null;
    }
    
    // Update textarea with plain text
    if (content) {
        let plainText = content
            .replace(/<[^>]*>/g, '')
            .replace(/&nbsp;/g, ' ')
            .replace(/<\/p>/gi, '\n')
            .replace(/<br\s*\/?>/gi, '\n')
            .replace(/[ \t]+/g, ' ')
            .replace(/\n\s*\n/g, '\n\n')
            .trim();
        textarea.value = plainText;
    }
    
    // Update button
    toggleBtn.className = 'editor-toggle inactive';
    toggleBtn.querySelector('.toggle-icon-btn i').className = 'bi bi-file-text';
    toggleBtn.querySelector('span:not(.toggle-icon-btn):not(.toggle-status)').textContent = 'Plain Text';
    toggleBtn.querySelector('.toggle-status').textContent = 'OFF';
    toggleBtn.querySelector('.toggle-status').className = 'toggle-status badge bg-secondary';
    
    // Update status badge
    statusBadge.className = 'editor-status disabled';
    statusBadge.innerHTML = '<i class="bi bi-x-circle"></i> HTML Disabled';
}

// Toggle Card Function
function toggleCard(headerElement) {
    const cardBody = headerElement.closest('.card').querySelector('.card-body');
    const icon = headerElement.querySelector('.toggle-icon i');
    
    if (cardBody.classList.contains('collapsed')) {
        cardBody.classList.remove('collapsed');
        headerElement.classList.remove('collapsed');
        icon.classList.remove('bi-plus-circle');
        icon.classList.add('bi-dash-circle');
    } else {
        cardBody.classList.add('collapsed');
        headerElement.classList.add('collapsed');
        icon.classList.remove('bi-dash-circle');
        icon.classList.add('bi-plus-circle');
    }
}

// Initialize CKEditor based on show_html value
document.addEventListener('DOMContentLoaded', function() {
    const showHtml = {{ $service->show_html ? 'true' : 'false' }};
    
    if (showHtml) {
        // Initialize Body Editor
        const bodyTextarea = document.getElementById('body');
        if (bodyTextarea) {
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
        
        // Initialize Features Editor
        const featuresTextarea = document.getElementById('features');
        if (featuresTextarea) {
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
});

// Character counter for short description
const shortDesc = document.querySelector('textarea[name="short_description"]');
if (shortDesc) {
    const charCount = document.getElementById('charCount');
    if (charCount) {
        charCount.textContent = shortDesc.value.length;
    }
    
    shortDesc.addEventListener('keyup', function() {
        const count = document.getElementById('charCount');
        if (count) {
            count.textContent = this.value.length;
            if (this.value.length > 500) {
                count.style.color = 'red';
            } else {
                count.style.color = 'inherit';
            }
        }
    });
}

// Add Benefit
document.getElementById('add-benefit').addEventListener('click', function() {
    const benefitHtml = `
        <div class="benefit-item">
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
                        <small class="text-muted">Allowed formats: JPG, JPEG, PNG, WEBP. Max size: 2MB</small>
                        <div class="benefit-image-preview-container"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div>
                            <input type="hidden" name="benefit_id[]" value="">
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
        const benefitItem = button.closest('.benefit-item');
        const benefitId = benefitItem.querySelector('input[name="benefit_id[]"]');
        
        if (benefitId && benefitId.value) {
            const deleteInput = document.createElement('input');
            deleteInput.type = 'hidden';
            deleteInput.name = 'deleted_benefit_ids[]';
            deleteInput.value = benefitId.value;
            document.getElementById('benefit-wrapper').appendChild(deleteInput);
        }
        
        benefitItem.remove();
    }
});

// Preview benefit images
document.addEventListener('change', function(e) {
    if (e.target && e.target.name === 'benefit_image[]') {
        const previewContainer = e.target.closest('.benefit-item').querySelector('.benefit-image-preview-container');
        previewContainer.innerHTML = '';
        
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('benefit-image-preview');
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    }
});

// Preview main image
document.querySelector('input[name="image"]').addEventListener('change', function(e) {
    const preview = this.closest('.mb-3').querySelector('.service-image-preview');
    if (preview && this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    }
});

// Preview icon image
document.querySelector('input[name="icon_image"]').addEventListener('change', function(e) {
    const preview = this.closest('.mb-3').querySelector('.service-image-preview');
    if (preview && this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    }
});


document.querySelector('input[name="title"]').addEventListener('keyup', function() {
    const slugInput = document.querySelector('input[name="slug"]');
    if (slugInput && slugInput.value === '') {
        let slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        slugInput.value = slug;
    }
});
</script>
@endpush
@endsection