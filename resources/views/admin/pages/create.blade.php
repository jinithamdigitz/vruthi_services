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
    <h1 class="mb-4">Create Post</h1>

    <form action="{{ route('admin.page.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Hidden Fields -->
        <input type="hidden" name="post_category_id" value="{{ $categoryId }}">
        <input type="hidden" name="category_slug" value="{{ $slug }}">

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control">
            @error('title')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Slug Field -->
        <div class="mb-3">
            <label class="form-label">Slug <small class="text-muted">(Leave empty to auto-generate from title)</small></label>
            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="custom-url-slug">
            @error('slug')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Gallery Category -->
        @if ($slug == 'gallery')
        <div class="mb-3">
            <label class="form-label">Gallery Category</label>
            <select name="gallery_category_id" class="form-control">
                <option value="">-- select gallery category --</option>
                @foreach ($galleryCategories as $id => $name)
                <option value="{{ $id }}" {{ old('gallery_category_id') == $id ? 'selected' : '' }}>
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
                   {{ old('show_html') ? 'checked' : '' }}>

            <label class="form-check-label" for="show_html">
                Enable CKEditor
            </label>

        </div>

    </div>

    <textarea name="body"
              id="bodyField"
              class="form-control"
              rows="60">{{ old('body') }}</textarea>

    @error('body')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>
        @if($slug == 'achievements-and-milestones')
        <div class="mb-3">
            <label class="form-label">capacity_value</label>
            <textarea name="section_one_left" id="section_one_left" class="form-control" rows="60">{{ old('section_one_left') }}</textarea>
            @error('section_one_left')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        @endif
        @if($slug == 'about-s')
        <div class="mb-3">
            <label class="form-label">Section one left</label>
            <textarea name="section_one_left" id="section_one_left" class="form-control" rows="60">{{ old('section_one_left') }}</textarea>
            @error('section_one_left')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Section one right</label>
            <textarea name="section_one_right" id="section_one_right" class="form-control" rows="60">{{ old('section_one_right') }}</textarea>
            @error('section_one_right')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Section two left</label>
            <textarea name="section_two_left" id="section_two_left" class="form-control" rows="60">{{ old('section_two_left') }}</textarea>
            @error('section_two_left')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Section two right</label>
            <textarea name="section_two_right" id="section_two_right" class="form-control" rows="60">{{ old('section_two_right') }}</textarea>
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
                value="{{ old('video_url') }}"
                placeholder="https://www.youtube.com/watch?v=... or https://vimeo.com/...">
            @error('video_url')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <small class="text-muted">Enter any video URL (YouTube, Vimeo, etc.) for the play button in banner slider</small>
        </div>
        @endif

        <!-- Single Image Upload -->
        <div class="mb-3">
            <label class="form-label">Featured Image (Single)</label>
            <input type="file" name="image" class="form-control">
            @error('image')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        @if ($slug == 'about-s')
        <!-- About Image 2 -->
        <div class="mb-3">
            <label class="form-label">About Image 2</label>
            <input type="file" name="image_two" class="form-control">
        </div>

        <!-- About Image 3 -->
        <div class="mb-3">
            <label class="form-label">About Image 3</label>
            <input type="file" name="image_three" class="form-control">
        </div>
        @endif

        <!-- Multiple Images Upload -->
        <div class="mb-3">
            <label class="form-label">Upload Multiple Images</label>
            <input type="file" name="multiple_images[]" class="form-control" multiple id="multipleImagesInput">
            <small class="text-muted">You can select multiple images</small>
            @error('multiple_images')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <!-- Preview Section -->
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
                    <input type="text"
                        name="keywords"
                        class="form-control @error('keywords') is-invalid @enderror"
                        value="{{ old('keywords') }}"
                        placeholder="printing, business, services, quality, affordable">
                    @error('keywords')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Publish -->
        <div class="form-check mb-3">
            <input type="checkbox" name="published" class="form-check-input" id="published">
            <label class="form-check-label" for="published">Publish</label>
        </div>

        <!-- Buttons -->
        <button class="btn btn-success">Save</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>

    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>


<!-- ✅ FIRST: define upload adapter -->
<script>
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
</script>


<!-- ✅ THEN: initialize editor -->
<script>
    const editors = [
    '#section_one_left',
    '#section_one_right',
    '#section_two_left',
    '#section_two_right'
];

    editors.forEach(selector => {
        ClassicEditor
            .create(document.querySelector(selector), {
                extraPlugins: [MyCustomUploadAdapterPlugin]
            })
            .then(editor => {
                console.log(`Editor initialized for ${selector}`, editor);
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>


@endsection

document.addEventListener('DOMContentLoaded', function () {

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

    if (checkbox.checked) {

        enableEditor();

    }

    checkbox.addEventListener('change', function () {

        if (this.checked) {

            enableEditor();

        } else {

            disableEditor();

        }

    });

});