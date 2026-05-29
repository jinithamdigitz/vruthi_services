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
                        
                        {{-- Body / Description Field --}}
                        <div class="form-group">
                            <label for="body">Description</label>
                            <textarea name="body" 
                                      id="body" 
                                      class="form-control @error('body') is-invalid @enderror" 
                                      rows="5" 
                                      placeholder="Enter service description">{{ old('body', $service->body) }}</textarea>
                            @error('body')
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
                                           accept="image/*">
                                    <label class="custom-file-label" for="image">Choose new file (leave empty to keep current)</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">Recommended size: 800x600px. Max 2MB.</small>
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
                                           accept="image/*">
                                    <label class="custom-file-label" for="icon_image">Choose new icon (leave empty to keep current)</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">Recommended size: 64x64px or 128x128px. Max 1MB.</small>
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
                            <label for="keyword">SEO Keyword</label>
                            <input type="text" 
                                   name="keyword" 
                                   id="keyword" 
                                   class="form-control @error('keyword') is-invalid @enderror" 
                                   placeholder="Enter SEO keywords"
                                   value="{{ old('keyword', $service->keyword) }}">
                            <small class="form-text text-muted">Keywords for SEO optimization (comma separated).</small>
                            @error('keyword')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
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

@push('scripts')
<script>
    // Auto-generate slug from title (only if field is empty or matches old title slug)
    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }
    
    let originalSlug = $('#slug').val();
    
    // Update slug preview
    function updateSlugPreview(slug) {
        if (slug) {
            $('#previewUrl').text('{{ url("/service") }}/' + slug);
        }
    }
    
    // Generate slug from title
    $('#title').on('keyup', function() {
        var title = $(this).val();
        var slugField = $('#slug');
        
        // Only auto-generate if slug field is empty OR same as originally auto-generated
        if (slugField.val() === '' || slugField.val() === originalSlug) {
            var generatedSlug = slugify(title);
            slugField.val(generatedSlug);
            originalSlug = generatedSlug;
            updateSlugPreview(generatedSlug);
        }
    });
    
    // When user manually types in slug field
    $('#slug').on('keyup', function() {
        var slug = $(this).val();
        originalSlug = slug;
        updateSlugPreview(slug);
    });
    
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
</style>
@endpush
@endsection