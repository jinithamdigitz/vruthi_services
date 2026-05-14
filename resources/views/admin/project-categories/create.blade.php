@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Create New Category</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.project-categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Create Form Card -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Category Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.project-categories.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Name Field -->
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Enter category name"
                                   required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Example: Web Development, Graphic Design, Marketing</small>
                        </div>
                    </div>

                    <!-- Image Upload Field -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Category Image</label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Max size: 2MB. Formats: jpeg, png, jpg, gif</small>
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-2 text-center" style="display: none;">
                            <img src="#" alt="Preview" class="img-fluid rounded" style="max-height: 150px;">
                            <button type="button" class="btn btn-sm btn-danger mt-2" onclick="clearImage()">
                                <i class="fas fa-times"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.project-categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Image Preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                preview.style.display = 'block';
                preview.querySelector('img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    function clearImage() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').style.display = 'none';
    }
</script>
@endpush