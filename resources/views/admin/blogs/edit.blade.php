@extends('layouts.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Blog</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Blog: {{ $blog->title }}</h3>
            </div>
            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            id="title" name="title" value="{{ old('title', $blog->title) }}"
                            placeholder="Blog title" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Blog Image</label>
                        @if ($blog->image)
                            <div class="mb-3">
                                <p class="text-muted mb-2"><small>Current Image:</small></p>
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                    style="max-height: 150px; width: auto; border-radius: 4px;">
                            </div>
                        @endif
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*" onchange="previewImage(this)">
                                <label class="custom-file-label" for="image">{{ $blog->image ? 'Change image' : 'Choose image' }}</label>
                            </div>
                        </div>
                        <small class="form-text text-muted d-block mt-2">Accepted formats: JPG, PNG, GIF, WebP. Max size: 2MB. Leave blank to keep current image.</small>
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <p class="text-muted mb-2"><small>New Image Preview:</small></p>
                            <img id="previewImg" src="" alt="Preview" style="max-height: 200px; width: auto; border-radius: 4px;">
                        </div>
                        @error('image')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="body">Content</label>
                        <textarea class="form-control @error('body') is-invalid @enderror" id="body"
                            name="body" rows="6" placeholder="Blog content">{{ old('body', $blog->body) }}</textarea>
                        @error('body')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Blog</button>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

    </div>
</section>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const label = document.querySelector('.custom-file-label');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        
        reader.readAsDataURL(input.files[0]);
        label.textContent = input.files[0].name;
    } else {
        preview.style.display = 'none';
    }
}
</script>

@endsection
