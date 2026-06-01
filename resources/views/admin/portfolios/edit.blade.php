@extends('layouts.admin')

@section('title', 'Edit Portfolio')

@section('content_header')
    <h1><i class="fas fa-edit"></i> Edit Portfolio</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Portfolio: {{ $portfolio->title }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.portfolios.index') }}" class="btn btn-default btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <form action="{{ route('admin.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="portfolio_category_id">Category <span class="text-danger">*</span></label>
                            <select class="form-control @error('portfolio_category_id') is-invalid @enderror"
                                id="portfolio_category_id" name="portfolio_category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('portfolio_category_id', $portfolio->portfolio_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('portfolio_category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                id="location" name="location" value="{{ old('location', $portfolio->location) }}"
                                placeholder="New York, USA">
                            @error('location')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $portfolio->title) }}" required>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        name="slug" value="{{ old('slug', $portfolio->slug) }}">
                    <small class="form-text text-muted">Current: {{ $portfolio->slug }}</small>
                    @error('slug')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
<div class="form-group">

    <div class="d-flex justify-content-between align-items-center mb-2">

        <label for="body" class="mb-0">
            Body <span class="text-danger">*</span>
        </label>

        <div class="form-check">

            <input type="checkbox"
       name="show_html"
       value="1"
       class="form-check-input"
       id="show_html"
       {{ old('show_html', $portfolio->show_html) ? 'checked' : '' }}>

            <label class="form-check-label" for="show_html">
                Enable CKEditor
            </label>

        </div>

    </div>

    <textarea class="form-control @error('body') is-invalid @enderror"
              id="body"
              name="body"
              rows="8"
              required>{{ old('body', $portfolio->body) }}</textarea>

    @error('body')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror

</div>

                <div class="form-group">
                    <label for="keywords">SEO Keywords</label>
                    <textarea class="form-control @error('keywords') is-invalid @enderror" id="keywords" name="keywords" rows="3">{{ old('keywords', $portfolio->keywords) }}</textarea>
                    <small class="form-text text-muted">Comma separated keywords for SEO</small>
                    @error('keywords')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Current Image</label>
                    @if ($portfolio->image)
                        <div class="mb-2">
                            <img src="{{ asset($portfolio->image) }}" width="150" class="img-thumbnail">
                        </div>
                    @else
                        <p class="text-muted">No image uploaded</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="image">New Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image"
                            name="image" accept="image/*">
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                    <small class="form-text text-muted">Leave empty to keep current image. Max 5MB. Will be compressed &
                        converted to WebP</small>
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('admin.portfolios.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
               </form>
    </div>
@stop

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const checkbox = document.getElementById('show_html');
    const textarea = document.getElementById('body');

    if (!checkbox || !textarea) return;

    let editorInstance = null;

    function enableEditor() {

        if (editorInstance) return;

        ClassicEditor
            .create(textarea)
            .then(editor => {
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });

    }

    function disableEditor() {

        if (!editorInstance) return;

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
</script>
@endpush
