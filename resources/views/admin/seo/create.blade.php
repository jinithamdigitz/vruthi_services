@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Add SEO for Static Page</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.seo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- THIS IS THE SELECT BOX YOUR SIR WANTS -->
                <div class="mb-3">
    <label class="form-label">Select Page/Route</label>

    <select id="route_select" class="form-control">
        <option value="">-- Custom Route --</option>

        @foreach($routes as $route => $label)
            <option value="{{ $route }}">
                {{ $label }} ({{ $route }})
            </option>
        @endforeach
    </select>

    <small class="text-muted">
        Select an existing page or enter a custom route below.
    </small>
</div>

<div class="mb-3">
    <label class="form-label">
        Route Name <span class="text-danger">*</span>
    </label>

    <input type="text"
           name="route_name"
           id="route_name"
           class="form-control @error('route_name') is-invalid @enderror"
           value="{{ old('route_name') }}"
           placeholder="/about or /service/interior-design"
           required>

    @error('route_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<script>
document.getElementById('route_select').addEventListener('change', function () {

    if (this.value !== '') {
        document.getElementById('route_name').value = this.value;
    }

});
</script>

                <!-- SEO Fields -->
                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" 
                           value="{{ old('meta_title') }}" placeholder="Enter meta title">
                    @error('meta_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Best practice: 50-60 characters</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" 
                              rows="3" placeholder="Enter meta description">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Best practice: 150-160 characters</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">OG Image (Social Media Preview)</label>
                    <input type="file" name="og_image" class="form-control @error('og_image') is-invalid @enderror" 
                           accept="image/jpeg,image/png,image/gif">
                    @error('og_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Recommended size: 1200×630 pixels (max 2MB)</small>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Save SEO</button>
                    <a href="{{ route('admin.seo.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection