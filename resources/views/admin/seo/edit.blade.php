@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit SEO for Static Page</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.seo.update', $seoParameter->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- THIS IS THE SELECT BOX YOUR SIR WANTS -->
                <div class="mb-3">
                    <label class="form-label">Select Page/Route <span class="text-danger">*</span></label>
                    <select name="route_name" class="form-control @error('route_name') is-invalid @enderror" required>
                        <option value="">-- Choose a page --</option>
                        @foreach($routes as $route => $label)
                            <option value="{{ $route }}" {{ old('route_name', $seoParameter->route_name) == $route ? 'selected' : '' }}>
                                {{ $label }} ({{ $route }})
                            </option>
                        @endforeach
                    </select>
                    @error('route_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- SEO Fields -->
                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" 
                           value="{{ old('meta_title', $seoParameter->meta_title) }}" placeholder="Enter meta title">
                    @error('meta_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" 
                              rows="3" placeholder="Enter meta description">{{ old('meta_description', $seoParameter->meta_description) }}</textarea>
                    @error('meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Current OG Image</label>
                    @if($seoParameter->og_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $seoParameter->og_image) }}" 
                                 style="max-width: 200px; max-height: 100px;" 
                                 class="border rounded">
                            <div class="form-check mt-2">
                                <input type="checkbox" name="remove_og_image" class="form-check-input" id="removeOgImage" value="1">
                                <label class="form-check-label text-danger" for="removeOgImage">Remove current image</label>
                            </div>
                        </div>
                    @else
                        <p class="text-muted">No image uploaded</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload New OG Image (optional)</label>
                    <input type="file" name="og_image" class="form-control @error('og_image') is-invalid @enderror" 
                           accept="image/jpeg,image/png,image/gif">
                    @error('og_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Leave empty to keep current image</small>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Update SEO</button>
                    <a href="{{ route('admin.seo.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection