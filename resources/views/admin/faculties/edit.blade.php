@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="bi bi-pencil"></i> Edit Faculty</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.faculties.update', $faculty) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        id="title" name="title" value="{{ old('title', $faculty->title) }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="keyword" class="form-label">Keyword</label>
                    <input type="text" class="form-control @error('keyword') is-invalid @enderror"
                        id="keyword" name="keyword" value="{{ old('keyword', $faculty->keyword) }}">
                    @error('keyword')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                    id="description" name="description" rows="4">{{ old('description', $faculty->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" class="form-control @error('qualification') is-invalid @enderror"
                        id="qualification" name="qualification" value="{{ old('qualification', $faculty->qualification) }}">
                    @error('qualification')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Multiple qualifications can be separated by commas</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="experience" class="form-label">Experience</label>
                    <input type="text" class="form-control @error('experience') is-invalid @enderror"
                        id="experience" name="experience" value="{{ old('experience', $faculty->experience) }}" placeholder="e.g., 10+ years, 5 years in industry">
                    @error('experience')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Years of experience or detailed experience summary</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Profile Image</label>
                    @if($faculty->image)
                    <div class="mb-2">
                        <img src="{{ $faculty->image_url }}" alt="{{ $faculty->title }}"
                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; border: 2px solid #007bff;">
                        <br>
                        <small class="text-muted">Current image</small>
                    </div>
                    @endif
                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                        id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Leave empty to keep current image</small>

                    <!-- New Image Preview -->
                    <div class="mt-2" id="imagePreview"></div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update Faculty
                </button>
                <a href="{{ route('admin.faculties.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Image Preview Script -->
<script>
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '150px';
                img.style.height = '150px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '10px';
                img.style.border = '2px solid #007bff';
                img.style.padding = '5px';
                img.style.marginTop = '10px';
                preview.appendChild(img);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection