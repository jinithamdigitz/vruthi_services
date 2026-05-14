@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h1>Edit Post: {{ $post->title }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <!-- Main Content Section -->
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">📄 Main Content</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" required>
                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Category <span class="text-danger">*</span></label>
                            <select name="post_category_id" class="form-control" required>
                                @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('post_category_id', $post->post_category_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('post_category_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Gallery Category</label>
                            <select name="gallery_category_id" class="form-control">
                                <option value="">-- Select Gallery Category --</option>
                                @foreach($gallerycategories as $id => $name)
                                <option value="{{ $id }}" {{ old('gallery_category_id', $post->gallery_category_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('gallery_category_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Body</label>
                            <textarea name="body" class="form-control" rows="5">{{ old('body', $post->body) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Featured Image</label>
                            @if($post->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$post->image) }}" width="100" class="border rounded">
                            </div>
                            @endif
                            <input type="file" name="image" class="form-control">
                            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                <!-- SEO Section -->
                @include('admin.posts.partials.seo-fields', ['post' => $post])

                <!-- Settings Section -->
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">⚙️ Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input type="checkbox" name="published" class="form-check-input" id="published" {{ old('published', $post->published) ? 'checked' : '' }}>
                            <label class="form-check-label" for="published">Published</label>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="featured" value="1" class="form-check-input" id="featured" {{ old('featured', $post->featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">Featured</label>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Update Post</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection