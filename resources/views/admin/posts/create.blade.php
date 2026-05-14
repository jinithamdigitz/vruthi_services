@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h1>Create Post</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Main Content Section -->
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">📄 Main Content</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Category <span class="text-danger">*</span></label>
                            <select name="post_category_id" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('post_category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('post_category_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Gallery Category</label>
                            <select name="gallery_category_id" class="form-control">
                                <option value="">-- Select Gallery Category --</option>
                                @foreach($galleryCategories as $id => $name)
                                <option value="{{ $id }}" {{ old('gallery_category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('gallery_category_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Body</label>
                            <textarea name="body" class="form-control" rows="5">{{ old('body') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Featured Image</label>
                            <input type="file" name="image" class="form-control">
                            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                <!-- SEO Section -->
                @include('admin.posts.partials.seo-fields')

                <!-- Settings Section -->
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">⚙️ Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input type="checkbox" name="published" class="form-check-input" id="published" {{ old('published') ? 'checked' : '' }}>
                            <label class="form-check-label" for="published">Publish immediately</label>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="featured" value="1" class="form-check-input" id="featured" {{ old('featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">Mark as Featured</label>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Create Post</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection