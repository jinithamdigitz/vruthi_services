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
    
    .product-image-preview {
        max-width: 150px;
        margin-top: 10px;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 4px;
    }
    
    .remove-item {
        cursor: pointer;
    }
    
    .brand-item, .faq-item, .section-item {
        transition: all 0.3s ease;
    }
    
    .brand-item:hover, .faq-item:hover, .section-item:hover {
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
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-plus-circle"></i> Add New Product</h3>
        <a href="{{ route('admin.ourproduct.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Products
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

    <form action="{{ route('admin.ourproduct.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
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
                            <label for="title">Product Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title') }}" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   placeholder="Enter product title"
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
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" 
                                      id="description" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="5"
                                      placeholder="Enter product description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Images Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white" onclick="toggleCard(this)">
                <h5 class="mb-0">
                    <i class="bi bi-images"></i> Product Images 
                    <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Main Image <span class="text-danger">*</span></label>
                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   class="form-control-file @error('image') is-invalid @enderror" 
                                   accept="image/*"
                                   required>
                            <small class="form-text text-muted">Allowed formats: JPG, JPEG, PNG, WEBP. Max size: 2MB</small>
                            <div id="mainImagePreview"></div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="multiple_images">Multiple Images (Optional)</label>
                            <input type="file" 
                                   name="multiple_images[]" 
                                   id="multiple_images" 
                                   class="form-control-file @error('multiple_images.*') is-invalid @enderror" 
                                   accept="image/*"
                                   multiple>
                            <small class="form-text text-muted">You can select multiple images. Allowed formats: JPG, JPEG, PNG, WEBP</small>
                            <div id="multipleImagesPreview" class="row mt-2"></div>
                            @error('multiple_images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Brand Slider Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-dark" onclick="toggleCard(this)">
                <h5 class="mb-0">
                    <i class="bi bi-building"></i> Brand Slider 
                    <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
                </h5>
            </div>
            <div class="card-body">
                <div id="brand-wrapper">
                    <!-- Initial Brand Item -->
                    <div class="brand-item border rounded p-3 mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="brand_title[]" class="form-control" placeholder="Brand title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Brand Name <span class="text-danger">*</span></label>
                                    <input type="text" name="brand_name[]" class="form-control" placeholder="Enter brand name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Brand Image</label>
                                    <input type="file" name="brand_image[]" class="form-control-file" accept="image/*">
                                    <div class="brand-image-preview"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Link (URL)</label>
                                    <input type="url" name="brand_link[]" class="form-control" placeholder="https://example.com">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sort Order</label>
                                    <input type="number" name="brand_sort[]" value="0" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="brand_status[]" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button type="button" class="btn btn-danger remove-brand">
                                            <i class="bi bi-trash"></i> Remove Brand
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="button" class="btn btn-info" id="add-brand">
                    <i class="bi bi-plus"></i> Add More Brand
                </button>
            </div>
        </div>

        <!-- Product Sections Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white" onclick="toggleCard(this)">
                <h5 class="mb-0">
                    <i class="bi bi-layout-three-columns"></i> Product Sections 
                    <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
                </h5>
            </div>
            <div class="card-body">
                <div id="section-wrapper">
                    <!-- Initial Section Item -->
                    <div class="section-item border rounded p-3 mb-3">
                        <div class="form-group">
                            <label>Section Title</label>
                            <input type="text" name="section_title[]" class="form-control" placeholder="Enter section title">
                        </div>
                        <div class="form-group">
                            <label>Section Description</label>
                            <textarea name="section_description[]" class="form-control section-editor" rows="5" placeholder="Enter section content"></textarea>
                        </div>
                        <button type="button" class="btn btn-danger remove-section">
                            <i class="bi bi-trash"></i> Remove Section
                        </button>
                    </div>
                </div>
                
                <button type="button" class="btn btn-primary" id="add-section">
                    <i class="bi bi-plus"></i> Add More Section
                </button>
            </div>
        </div>

        <!-- Product FAQs Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white" onclick="toggleCard(this)">
                <h5 class="mb-0">
                    <i class="bi bi-question-circle"></i> Product FAQs 
                    <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
                </h5>
            </div>
            <div class="card-body">
                <div id="faq-wrapper">
                    <!-- Initial FAQ Item -->
                    <div class="faq-item border rounded p-3 mb-3">
                        <div class="form-group">
                            <label>Question</label>
                            <input type="text" name="faq_question[]" class="form-control" placeholder="Enter frequently asked question">
                        </div>
                        <div class="form-group">
                            <label>Answer</label>
                            <textarea name="faq_answer[]" class="form-control" rows="3" placeholder="Enter answer to the question"></textarea>
                        </div>
                        <button type="button" class="btn btn-danger remove-faq">
                            <i class="bi bi-trash"></i> Remove FAQ
                        </button>
                    </div>
                </div>
                
                <button type="button" class="btn btn-success" id="add-faq">
                    <i class="bi bi-plus"></i> Add More FAQ
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group text-center mb-4">
            <button type="submit" class="btn btn-lg btn-success">
                <i class="bi bi-save"></i> Save Product
            </button>
            <a href="{{ route('admin.ourproduct.index') }}" class="btn btn-lg btn-secondary ml-2">
                <i class="bi bi-x"></i> Cancel
            </a>
        </div>
    </form>
</div>

<!-- JavaScript for Dynamic Fields and Image Previews -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
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

// Initialize CKEditor for initial section
let editorCount = 1;
let editors = {};

// CKEditor configuration
function initializeEditor(elementId) {
    ClassicEditor
        .create(document.querySelector('#' + elementId), {
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
            editors[elementId] = editor;
        })
        .catch(error => {
            console.error(error);
        });
}

// Initialize first editor
document.addEventListener('DOMContentLoaded', function() {
    const firstEditor = document.querySelector('.section-editor');
    if (firstEditor && !firstEditor.id) {
        firstEditor.id = 'editor_1';
        initializeEditor('editor_1');
    }
});

// Add Section
document.getElementById('add-section').addEventListener('click', function() {
    editorCount++;
    const editorId = 'editor_' + editorCount;
    
    const sectionHtml = `
        <div class="section-item border rounded p-3 mb-3">
            <div class="form-group">
                <label>Section Title</label>
                <input type="text" name="section_title[]" class="form-control" placeholder="Enter section title">
            </div>
            <div class="form-group">
                <label>Section Description</label>
                <textarea name="section_description[]" id="${editorId}" class="form-control" rows="5" placeholder="Enter section content"></textarea>
            </div>
            <button type="button" class="btn btn-danger remove-section">
                <i class="bi bi-trash"></i> Remove Section
            </button>
        </div>
    `;
    
    document.getElementById('section-wrapper').insertAdjacentHTML('beforeend', sectionHtml);
    initializeEditor(editorId);
});

// Remove Section with editor cleanup
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-section') || e.target.parentElement.classList.contains('remove-section')) {
        const button = e.target.classList.contains('remove-section') ? e.target : e.target.parentElement;
        const sectionItem = button.closest('.section-item');
        const textarea = sectionItem.querySelector('textarea[name="section_description[]"]');
        
        if (textarea && textarea.id && editors[textarea.id]) {
            editors[textarea.id].destroy().then(() => {
                delete editors[textarea.id];
            });
        }
        
        sectionItem.remove();
    }
});

// Add Brand
document.getElementById('add-brand').addEventListener('click', function() {
    const brandHtml = `
        <div class="brand-item border rounded p-3 mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="brand_title[]" class="form-control" placeholder="Brand title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Brand Name <span class="text-danger">*</span></label>
                        <input type="text" name="brand_name[]" class="form-control" placeholder="Enter brand name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Brand Image</label>
                        <input type="file" name="brand_image[]" class="form-control-file" accept="image/*">
                        <div class="brand-image-preview"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Link (URL)</label>
                        <input type="url" name="brand_link[]" class="form-control" placeholder="https://example.com">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="brand_sort[]" value="0" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="brand_status[]" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div>
                            <button type="button" class="btn btn-danger remove-brand">
                                <i class="bi bi-trash"></i> Remove Brand
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('brand-wrapper').insertAdjacentHTML('beforeend', brandHtml);
});

// Remove Brand
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-brand') || e.target.parentElement.classList.contains('remove-brand')) {
        const button = e.target.classList.contains('remove-brand') ? e.target : e.target.parentElement;
        button.closest('.brand-item').remove();
    }
});

// Add FAQ
document.getElementById('add-faq').addEventListener('click', function() {
    const faqHtml = `
        <div class="faq-item border rounded p-3 mb-3">
            <div class="form-group">
                <label>Question</label>
                <input type="text" name="faq_question[]" class="form-control" placeholder="Enter frequently asked question">
            </div>
            <div class="form-group">
                <label>Answer</label>
                <textarea name="faq_answer[]" class="form-control" rows="3" placeholder="Enter answer to the question"></textarea>
            </div>
            <button type="button" class="btn btn-danger remove-faq">
                <i class="bi bi-trash"></i> Remove FAQ
            </button>
        </div>
    `;
    
    document.getElementById('faq-wrapper').insertAdjacentHTML('beforeend', faqHtml);
});

// Remove FAQ
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-faq') || e.target.parentElement.classList.contains('remove-faq')) {
        const button = e.target.classList.contains('remove-faq') ? e.target : e.target.parentElement;
        button.closest('.faq-item').remove();
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
            img.classList.add('product-image-preview');
            preview.appendChild(img);
        };
        reader.readAsDataURL(this.files[0]);
    }
});

// Multiple Images Preview
document.getElementById('multiple_images').addEventListener('change', function(e) {
    const preview = document.getElementById('multipleImagesPreview');
    preview.innerHTML = '';
    
    if (this.files) {
        Array.from(this.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.classList.add('col-md-3', 'mb-2');
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('product-image-preview', 'w-100');
                
                col.appendChild(img);
                preview.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    }
});

// Brand Image Preview (Dynamic)
document.addEventListener('change', function(e) {
    if (e.target && e.target.name === 'brand_image[]') {
        const preview = e.target.closest('.brand-item').querySelector('.brand-image-preview');
        preview.innerHTML = '';
        
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('product-image-preview');
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

<style>
.product-image-preview {
    max-width: 150px;
    max-height: 150px;
    object-fit: cover;
    border: 1px solid #ddd;
    padding: 5px;
    border-radius: 4px;
    margin-top: 10px;
}

.brand-item, .faq-item, .section-item {
    background-color: #f9f9f9;
    transition: all 0.3s ease;
}

.brand-item:hover, .faq-item:hover, .section-item:hover {
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
@endsection