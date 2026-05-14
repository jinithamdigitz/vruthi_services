@extends('layouts.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .ck-editor__editable {
        min-height: 300px;
        max-height: 500px;
    }
    
    .existing-image {
        position: relative;
        display: inline-block;
        margin: 5px;
    }
    
    .delete-image-btn {
        position: absolute;
        top: -10px;
        right: -10px;
        background: red;
        color: white;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        text-align: center;
        cursor: pointer;
        font-size: 14px;
        line-height: 23px;
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

<div class="d-flex justify-content-between mb-3">
    <h3><i class="bi bi-pencil-square"></i> Edit Product</h3>
    <a href="{{ route('admin.ourproduct.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.ourproduct.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Basic Information -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white" onclick="toggleCard(this)">
            <h5 class="mb-0">
                <i class="bi bi-info-circle"></i> Basic Information
                <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label>Title *</label>
                    <input type="text" name="title" value="{{ old('title', $product->title) }}" class="form-control mb-3" required>
                </div>
                <div class="col-md-6">
                    <label>Slug (Optional)</label>
                    <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" class="form-control mb-3" placeholder="leave-empty-to-auto-generate">
                    <small class="text-muted">Leave empty to auto-generate from title.</small>
                </div>
                <div class="col-12">
                    <label>Description *</label>
                    <textarea name="description" id="description" class="form-control mb-3" rows="5" required>{{ old('description', $product->description) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Images -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white" onclick="toggleCard(this)">
            <h5 class="mb-0">
                <i class="bi bi-images"></i> Product Images
                <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label>Current Main Image</label><br>
                    <img src="{{ asset($product->image) }}" width="150" class="mb-3 img-thumbnail"><br>
                    <label>Change Main Image</label>
                    <input type="file" name="image" class="form-control-file mb-3" accept="image/*">
                </div>
                <div class="col-md-6">
                    <label>Add New Multiple Images</label>
                    <input type="file" name="multiple_images[]" multiple class="form-control-file mb-3" accept="image/*">
                    <small class="text-muted">You can select multiple images to add more.</small>
                </div>
                @if($product->images->count())
                <div class="col-12">
                    <label>Existing Gallery Images</label><br>
                    <div id="existing-images">
                        @foreach($product->images as $img)
                        <div class="existing-image" data-id="{{ $img->id }}">
                            <img src="{{ asset($img->image) }}" width="100" class="img-thumbnail">
                            <span class="delete-image-btn" onclick="deleteImage({{ $img->id }}, this)">×</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Brand Slider -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white" onclick="toggleCard(this)">
            <h5 class="mb-0">
                <i class="bi bi-building"></i> Brand Slider
                <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
            </h5>
        </div>
        <div class="card-body">
            <div id="brand-wrapper">
                @if($product->brands->count())
                    @foreach($product->brands as $brand)
                    <div class="brand-item border rounded p-3 mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Title</label>
                                <input type="text" name="brand_title[]" value="{{ $brand->title }}" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label>Brand Name *</label>
                                <input type="text" name="brand_name[]" value="{{ $brand->brand_name }}" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label>Current Image</label><br>
                                @if($brand->image)
                                <img src="{{ asset($brand->image) }}" width="80" class="mb-2 img-thumbnail"><br>
                                @endif
                                <label>Change Image</label>
                                <input type="file" name="brand_image[]" class="form-control-file mb-2" accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <label>Link (URL)</label>
                                <input type="url" name="brand_link[]" value="{{ $brand->link }}" class="form-control mb-2">
                            </div>
                            <div class="col-md-4">
                                <label>Sort Order</label>
                                <input type="number" name="brand_sort[]" value="{{ $brand->sort_order }}" class="form-control mb-2">
                            </div>
                            <div class="col-md-4">
                                <label>Status</label>
                                <select name="brand_status[]" class="form-control mb-2">
                                    <option value="1" {{ $brand->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $brand->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>&nbsp;</label>
                                <div>
                                    <button type="button" class="btn btn-danger remove-brand">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="brand-item border rounded p-3 mb-3">
                        <div class="row">
                            <div class="col-md-6"><input type="text" name="brand_title[]" placeholder="Title" class="form-control mb-2"></div>
                            <div class="col-md-6"><input type="text" name="brand_name[]" placeholder="Brand Name" class="form-control mb-2"></div>
                            <div class="col-md-6"><input type="file" name="brand_image[]" class="form-control-file mb-2" accept="image/*"></div>
                            <div class="col-md-6"><input type="url" name="brand_link[]" placeholder="Link" class="form-control mb-2"></div>
                            <div class="col-md-4"><input type="number" name="brand_sort[]" value="0" class="form-control mb-2"></div>
                            <div class="col-md-4">
                                <select name="brand_status[]" class="form-control mb-2">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-danger remove-brand">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <button type="button" class="btn btn-info" id="add-brand">
                <i class="bi bi-plus"></i> Add More Brand
            </button>
        </div>
    </div>

    <!-- Product Sections -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white" onclick="toggleCard(this)">
            <h5 class="mb-0">
                <i class="bi bi-layout-three-columns"></i> Product Sections
                <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
            </h5>
        </div>
        <div class="card-body">
            <div id="section-wrapper">
                @if($product->sections->count())
                    @foreach($product->sections as $index => $section)
                    <div class="section-item border rounded p-3 mb-3">
                        <label>Section Title</label>
                        <input type="text" name="section_title[]" value="{{ $section->title }}" class="form-control mb-3">
                        <label>Section Description</label>
                        <textarea name="section_description[]" id="editor_{{ $loop->iteration }}" class="section-editor">{{ $section->description }}</textarea>
                        <button type="button" class="btn btn-danger remove-section mt-3">
                            <i class="bi bi-trash"></i> Remove Section
                        </button>
                    </div>
                    @endforeach
                @else
                    <div class="section-item border rounded p-3 mb-3">
                        <label>Section Title</label>
                        <input type="text" name="section_title[]" class="form-control mb-3">
                        <label>Section Description</label>
                        <textarea name="section_description[]" id="editor_1" class="section-editor"></textarea>
                        <button type="button" class="btn btn-danger remove-section mt-3">
                            <i class="bi bi-trash"></i> Remove Section
                        </button>
                    </div>
                @endif
            </div>
            <button type="button" class="btn btn-primary" id="add-section">
                <i class="bi bi-plus"></i> Add More Section
            </button>
        </div>
    </div>

    <!-- Product FAQs -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark" onclick="toggleCard(this)">
            <h5 class="mb-0">
                <i class="bi bi-question-circle"></i> Product FAQs
                <span class="toggle-icon"><i class="bi bi-dash-circle"></i></span>
            </h5>
        </div>
        <div class="card-body">
            <div id="faq-wrapper">
                @if($product->faqs->count())
                    @foreach($product->faqs as $faq)
                    <div class="faq-item border rounded p-3 mb-3">
                        <label>Question</label>
                        <input type="text" name="faq_question[]" value="{{ $faq->question }}" class="form-control mb-3">
                        <label>Answer</label>
                        <textarea name="faq_answer[]" rows="4" class="form-control mb-3">{{ $faq->answer }}</textarea>
                        <button type="button" class="btn btn-danger remove-faq">
                            <i class="bi bi-trash"></i> Remove FAQ
                        </button>
                    </div>
                    @endforeach
                @else
                    <div class="faq-item border rounded p-3 mb-3">
                        <label>Question</label>
                        <input type="text" name="faq_question[]" class="form-control mb-3">
                        <label>Answer</label>
                        <textarea name="faq_answer[]" rows="4" class="form-control mb-3"></textarea>
                        <button type="button" class="btn btn-danger remove-faq">
                            <i class="bi bi-trash"></i> Remove FAQ
                        </button>
                    </div>
                @endif
            </div>
            <button type="button" class="btn btn-success" id="add-faq">
                <i class="bi bi-plus"></i> Add More FAQ
            </button>
        </div>
    </div>

    <button class="btn btn-success btn-lg" type="submit">
        <i class="bi bi-save"></i> Update Product
    </button>
    <a href="{{ route('admin.ourproduct.index') }}" class="btn btn-secondary btn-lg">
        <i class="bi bi-x"></i> Cancel
    </a>
</form>

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

let editors = {};
let editorCount = {{ $product->sections->count() ?: 1 }};

// CKEditor upload adapter
function MyUploadAdapter(loader) {
    this.loader = loader;
}

MyUploadAdapter.prototype.upload = function() {
    return this.loader.file.then(file => {
        let data = new FormData();
        data.append('upload', file);
        return fetch('/admin/upload', {
            method: 'POST',
            body: data,
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(response => response.json())
        .then(result => ({ default: result.url }));
    });
};

function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = loader => new MyUploadAdapter(loader);
}

function createEditor(id) {
    ClassicEditor.create(document.querySelector('#' + id), {
        extraPlugins: [MyCustomUploadAdapterPlugin]
    })
    .then(editor => editors[id] = editor)
    .catch(error => console.error(error));
}

// Initialize all editors
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.section-editor').forEach(textarea => {
        if (textarea.id && !editors[textarea.id]) {
            createEditor(textarea.id);
        }
    });
    
    // Initialize main description editor if it exists
    if (document.querySelector('#description')) {
        ClassicEditor.create(document.querySelector('#description'), {
            extraPlugins: [MyCustomUploadAdapterPlugin]
        }).catch(error => console.error(error));
    }
});

// Add Section
document.getElementById('add-section').addEventListener('click', function() {
    editorCount++;
    const editorId = 'editor_' + editorCount;
    const html = `
        <div class="section-item border rounded p-3 mb-3">
            <label>Section Title</label>
            <input type="text" name="section_title[]" class="form-control mb-3">
            <label>Section Description</label>
            <textarea name="section_description[]" id="${editorId}" class="section-editor"></textarea>
            <button type="button" class="btn btn-danger remove-section mt-3">
                <i class="bi bi-trash"></i> Remove Section
            </button>
        </div>
    `;
    document.getElementById('section-wrapper').insertAdjacentHTML('beforeend', html);
    createEditor(editorId);
});

// Remove Section
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-section') || e.target.parentElement.classList.contains('remove-section')) {
        const button = e.target.classList.contains('remove-section') ? e.target : e.target.parentElement;
        const sectionItem = button.closest('.section-item');
        const textarea = sectionItem.querySelector('textarea');
        if (textarea && textarea.id && editors[textarea.id]) {
            editors[textarea.id].destroy();
            delete editors[textarea.id];
        }
        sectionItem.remove();
    }
    
    if (e.target.classList.contains('remove-faq') || e.target.parentElement.classList.contains('remove-faq')) {
        const button = e.target.classList.contains('remove-faq') ? e.target : e.target.parentElement;
        button.closest('.faq-item').remove();
    }
    
    if (e.target.classList.contains('remove-brand') || e.target.parentElement.classList.contains('remove-brand')) {
        const button = e.target.classList.contains('remove-brand') ? e.target : e.target.parentElement;
        button.closest('.brand-item').remove();
    }
});

// Add Brand
document.getElementById('add-brand').addEventListener('click', function() {
    const html = `
        <div class="brand-item border rounded p-3 mb-3">
            <div class="row">
                <div class="col-md-6"><input type="text" name="brand_title[]" placeholder="Title" class="form-control mb-2"></div>
                <div class="col-md-6"><input type="text" name="brand_name[]" placeholder="Brand Name" class="form-control mb-2"></div>
                <div class="col-md-6"><input type="file" name="brand_image[]" class="form-control-file mb-2" accept="image/*"></div>
                <div class="col-md-6"><input type="url" name="brand_link[]" placeholder="Link" class="form-control mb-2"></div>
                <div class="col-md-4"><input type="number" name="brand_sort[]" value="0" class="form-control mb-2"></div>
                <div class="col-md-4">
                    <select name="brand_status[]" class="form-control mb-2">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-danger remove-brand">
                        <i class="bi bi-trash"></i> Remove
                    </button>
                </div>
            </div>
        </div>
    `;
    document.getElementById('brand-wrapper').insertAdjacentHTML('beforeend', html);
});

// Add FAQ
document.getElementById('add-faq').addEventListener('click', function() {
    const html = `
        <div class="faq-item border rounded p-3 mb-3">
            <label>Question</label>
            <input type="text" name="faq_question[]" class="form-control mb-3">
            <label>Answer</label>
            <textarea name="faq_answer[]" rows="4" class="form-control mb-3"></textarea>
            <button type="button" class="btn btn-danger remove-faq">
                <i class="bi bi-trash"></i> Remove FAQ
            </button>
        </div>
    `;
    document.getElementById('faq-wrapper').insertAdjacentHTML('beforeend', html);
});

// Delete multiple image (AJAX)
function deleteImage(imageId, element) {
    if (confirm('Delete this image?')) {
        fetch(`/admin/ourproduct/delete-image/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                element.closest('.existing-image').remove();
            }
        });
    }
}
</script>
@endsection