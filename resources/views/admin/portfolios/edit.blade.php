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
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('portfolio_category_id', $portfolio->portfolio_category_id) == $category->id ? 'selected' : '' }}>
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
                            id="location" name="location" value="{{ old('location', $portfolio->location) }}" placeholder="New York, USA">
                        @error('location')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="title">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                    id="title" name="title" value="{{ old('title', $portfolio->title) }}" required>
                @error('title')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                    id="slug" name="slug" value="{{ old('slug', $portfolio->slug) }}">
                <small class="form-text text-muted">Current: {{ $portfolio->slug }}</small>
                @error('slug')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="body">Body <span class="text-danger">*</span></label>
                <textarea class="form-control @error('body') is-invalid @enderror"
                    id="body" name="body" rows="8" required>{{ old('body', $portfolio->body) }}</textarea>
                @error('body')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="keywords">SEO Keywords</label>
                <textarea class="form-control @error('keywords') is-invalid @enderror"
                    id="keywords" name="keywords" rows="3">{{ old('keywords', $portfolio->keywords) }}</textarea>
                <small class="form-text text-muted">Comma separated keywords for SEO</small>
                @error('keywords')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Current Image</label>
                @if($portfolio->image)
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
                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                        id="image" name="image" accept="image/*">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
                <small class="form-text text-muted">Leave empty to keep current image. Max 5MB. Will be compressed & converted to WebP</small>
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

@section('js')
<script>
    $('#title').on('keyup', function() {
        if ($('#slug').val() === '{{ $portfolio->slug }}' || $('#slug').val() === '') {
            let slug = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
            $('#slug').val(slug);
        }
    });

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@stop