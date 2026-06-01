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

    <div class="d-flex justify-content-between align-items-center mb-2">

        <label for="body" class="mb-0">
            Description
        </label>

        <div class="form-check">

            <input type="checkbox"
                   name="show_html"
                   value="1"
                   class="form-check-input"
                   id="show_html"
                   {{ old('show_html', $service->show_html) ? 'checked' : '' }}>

            <label class="form-check-label" for="show_html">
                Enable CKEditor
            </label>

        </div>

    </div>

    <textarea name="body"
              id="body"
              class="form-control @error('body') is-invalid @enderror"
              rows="8"
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
@endsection
@push('scripts')

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const checkbox = document.getElementById('show_html');
    const textarea = document.getElementById('body');

    let editorInstance = null;

    function enableEditor() {

        if (!editorInstance) {

            ClassicEditor
                .create(textarea)
                .then(editor => {
                    editorInstance = editor;
                })
                .catch(error => {
                    console.error(error);
                });

        }

    }

    function disableEditor() {

        if (editorInstance) {

            let content = editorInstance.getData();

            let plainText = content
                .replace(/<\/p>/gi, '\n')
                .replace(/<br\s*\/?>/gi, '\n')
                .replace(/<[^>]*>/g, '')
                .replace(/&nbsp;/g, ' ')
                .replace(/[ \t]+/g, ' ')
                .replace(/\n\s*\n/g, '\n\n')
                .trim();

            editorInstance.destroy().then(() => {

                editorInstance = null;
                textarea.value = plainText;

            });

        }

    }

    if (checkbox && checkbox.checked) {
        enableEditor();
    }

    if (checkbox) {
        checkbox.addEventListener('change', function () {

            if (this.checked) {
                enableEditor();
            } else {
                disableEditor();
            }

        });
    }

});
</script>

@endpush

