@extends('layouts.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .ck-editor__editable {
        height: 500px;
    }

    .ck-content img {
        max-width: 200px !important;
        height: auto;
    }
</style>

<div class="container card card-primary p-4">
    <h1 class="mb-4">Edit Post</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.page.update', $post->id) }}" method="POST" enctype="multipart/form-data" id="editPostForm">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" id="title_field" value="{{ old('title', $post->title) }}" class="form-control">
            @error('title')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Slug Field -->
        <div class="mb-3">
            <label class="form-label">Slug <small class="text-muted">(Leave empty to auto-generate from title)</small></label>
            <input type="text" name="slug" id="slug_field" value="{{ old('slug', $post->slug) }}" class="form-control" placeholder="custom-url-slug">
            <small class="text-muted">Current slug: <strong>{{ $post->slug }}</strong></small>
            @error('slug')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Hidden Fields -->
        <input type="hidden" name="post_category_id" value="{{ $post->post_category_id }}">
        <input type="hidden" name="category_slug" value="{{ $slug }}">
        @error('post_category_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <!-- Gallery Category -->
        @if($slug=="gallery")
        <div class="mb-3">
            <label class="form-label">Gallery Category</label>
            <select name="gallery_category_id" class="form-control">
                <option value="">-- select gallery category --</option>
                @foreach($galleryCategories as $id => $name)
                <option value="{{ $id }}" {{ old('gallery_category_id', $post->gallery_category_id) == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
                @endforeach
            </select>
            @error('gallery_category_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        @endif

        <!-- Body -->
       <div class="mb-3">

    <div class="d-flex align-items-center justify-content-between mb-2">

        <label class="form-label mb-0">
            Body
        </label>

        <div class="form-check">

            <input type="checkbox"
                   name="show_html"
                   value="1"
                   class="form-check-input"
                   id="show_html"
                   {{ old('show_html', $post->show_html ?? 0) ? 'checked' : '' }}>

            <label class="form-check-label" for="show_html">
                Enable CKEditor
            </label>

        </div>

    </div>

    <textarea name="body"
              id="bodyField"
              rows="60"
              class="form-control">{{ old('body', $post->body) }}</textarea>

    @error('body')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

        @if($slug == 'achievements-and-milestones')
        <div class="mb-3">
            <label class="form-label">capacity_value</label>
            <textarea name="section_one_left" id="section_one_left" class="form-control" rows="60">{{ old('section_one_left', $post->section_one_left) }}</textarea>
            @error('section_one_left')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        @endif

        @if($slug == 'about-s')
        <div class="mb-3">
            <label class="form-label">Section one left</label>
            <textarea name="section_one_left" id="section_one_left" class="form-control" rows="60">{{ old('section_one_left', $post->section_one_left) }}</textarea>
            @error('section_one_left')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Section one right</label>
            <textarea name="section_one_right" id="section_one_right" class="form-control" rows="60">{{ old('section_one_right', $post->section_one_right) }}</textarea>
            @error('section_one_right')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Section two left</label>
            <textarea name="section_two_left" id="section_two_left" class="form-control" rows="60">{{ old('section_two_left', $post->section_two_left) }}</textarea>
            @error('section_two_left')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Section two right</label>
            <textarea name="section_two_right" id="section_two_right" class="form-control" rows="60">{{ old('section_two_right', $post->section_two_right) }}</textarea>
            @error('section_two_right')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        @endif

        {{-- VIDEO URL FIELD - ONLY SHOW FOR BANNER SLUG --}}
        @if($slug == 'banner')
        <div class="mb-3">
            <label class="form-label">Video URL <small class="text-muted">(For Banner Slider)</small></label>
            <input type="url"
                name="video_url"
                class="form-control @error('video_url') is-invalid @enderror"
                value="{{ old('video_url', $post->video_url) }}"
                placeholder="https://www.youtube.com/watch?v=... or https://vimeo.com/...">
            @error('video_url')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <small class="text-muted">Enter any video URL (YouTube, Vimeo, etc.) for the play button in banner slider</small>
        </div>
        @endif

        <!-- Single Image -->
        <div class="mb-3">
            <label class="form-label">Featured Image (Single)</label>

            @if($post->image)
            <div class="mb-2">
                <img src="{{ asset($post->image) }}" width="120" class="img-thumbnail">
            </div>
            @endif

            <input type="file" name="image" class="form-control">
            @error('image')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Existing Multiple Images -->
        @if($post->images && $post->images->count() > 0)
        <div class="mb-3">
            <label class="form-label">Existing Multiple Images</label>
            <div class="row">
                @foreach($post->images as $multiImage)
                <div class="col-md-3 mb-3 text-center">
                    <div class="card">
                        <img src="{{ asset('posts/'.$multiImage->image_name) }}" class="card-img-top" style="height:150px;object-fit:cover;">
                        <div class="card-body p-2">
                            <div class="form-check">
                                <input type="checkbox" name="delete_images[]" value="{{ $multiImage->id }}" class="form-check-input">
                                <label class="form-check-label text-danger">
                                    Delete
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <small class="text-muted">Check images to delete them while updating</small>
        </div>
        @endif

        <!-- Add New Multiple Images -->
        <div class="mb-3">
            <label class="form-label">Add More Images</label>
            <input type="file" name="multiple_images[]" class="form-control" multiple id="multipleImagesInput">
            <small class="text-muted">You can select multiple images</small>

            <!-- Preview -->
            <div class="row mt-3" id="previewContainer"></div>
        </div>

        <!-- KEYWORDS FIELD -->
        <div class="card mt-4 mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">🔑 Keywords for SEO</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Keywords <small class="text-muted">(separate with commas)</small></label>
                    <input type="text" name="keywords" class="form-control @error('keywords') is-invalid @enderror" 
                        value="{{ old('keywords', $post->keywords->pluck('keyword')->implode(', ')) }}" 
                        placeholder="printing, business, services, quality, affordable">
                    @error('keywords')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Example: printing, business, services, quality, affordable</small>
                </div>
            </div>
        </div>

        <!-- Publish -->
        <div class="form-check mb-3">
            <input type="checkbox" name="published" class="form-check-input" id="published" {{ old('published', $post->published) ? 'checked' : '' }}>
            <label class="form-check-label" for="published">Publish</label>
        </div>

        <!-- Buttons -->
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>

    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    // Upload Adapter
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
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(result => {
                    return {
                        default: result.url
                    };
                });
        });
    };

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
            return new MyUploadAdapter(loader);
        };
    }

    // Initialize CKEditor only for elements that exist
    document.addEventListener('DOMContentLoaded', function() {
        const editorSelectors = [];
        
        // Add conditional editors if they exist
        if (document.querySelector('#section_one_left')) editorSelectors.push('#section_one_left');
        if (document.querySelector('#section_one_right')) editorSelectors.push('#section_one_right');
        if (document.querySelector('#section_two_left')) editorSelectors.push('#section_two_left');
        if (document.querySelector('#section_two_right')) editorSelectors.push('#section_two_right');
const checkbox = document.getElementById('show_html');
const textarea = document.getElementById('bodyField');

let bodyEditor = null;

function enableEditor() {

    if (!bodyEditor) {

        ClassicEditor
            .create(textarea, {
                extraPlugins: [MyCustomUploadAdapterPlugin]
            })
            .then(editor => {

                bodyEditor = editor;

            })
            .catch(error => {

                console.error(error);

            });
    }
}

function disableEditor() {

    if (bodyEditor) {

        let content = bodyEditor.getData();

        let plainText = content
            .replace(/<[^>]*>/g, '')
            .replace(/&nbsp;/g, ' ')
            .replace(/<\/p>/gi, '\n')
            .replace(/<br\s*\/?>/gi, '\n')
            .trim();

        bodyEditor.destroy()

            .then(() => {

                bodyEditor = null;

                textarea.value = plainText;

            });
    }
}

// AUTO LOAD FROM DATABASE VALUE
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
        editorSelectors.forEach(selector => {
            const element = document.querySelector(selector);
            if (element) {
                ClassicEditor
                    .create(element, {
                        extraPlugins: [MyCustomUploadAdapterPlugin]
                    })
                    .catch(error => {
                        console.error(`Error with ${selector}:`, error);
                    });
            }
        });
    });

    // Auto-generate slug from title
    const titleField = document.getElementById('title_field');
    const slugField = document.getElementById('slug_field');

    if (titleField && slugField) {
        titleField.addEventListener('keyup', function() {
            // Only auto-generate if slug is empty OR user hasn't manually edited it
            if (!slugField.value || slugField.getAttribute('data-auto') === 'true') {
                const slug = this.value.toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugField.value = slug;
                slugField.setAttribute('data-auto', 'true');
            }
        });

        slugField.addEventListener('focus', function() {
            this.setAttribute('data-auto', 'false');
        });
        
        // Initialize the auto flag
        if (!slugField.value) {
            slugField.setAttribute('data-auto', 'true');
        }
    }

    // Multiple Image Preview
    const multipleImagesInput = document.getElementById('multipleImagesInput');
    if (multipleImagesInput) {
        multipleImagesInput.addEventListener('change', function(event) {
            const previewContainer = document.getElementById('previewContainer');
            if (previewContainer) {
                previewContainer.innerHTML = '';

                Array.from(event.target.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.classList.add('col-md-3', 'mb-3');

                        col.innerHTML = `
                        <div class="card">
                            <img src="${e.target.result}" class="card-img-top" style="height:150px;object-fit:cover;">
                        </div>
                    `;
                        previewContainer.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    }
</script>

<!-- TinyMCE for multiple image preview (keep your existing one) -->
<script>
    // Keep your existing multiple image preview if needed
</script>

@endsection