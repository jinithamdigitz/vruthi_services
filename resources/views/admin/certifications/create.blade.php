@extends('layouts.admin')

@section('title', 'Create Certification | Admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Create Certification</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.certifications.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.certifications.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" 
                           value="{{ old('title') }}" placeholder="e.g., ISO 9001:2015" required>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="subtitle">Subtitle</label>
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" 
                           name="subtitle" value="{{ old('subtitle') }}" placeholder="e.g., Quality Management System">
                    @error('subtitle')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="icon">Icon Class <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" 
                           value="{{ old('icon', 'bi-circle-fill') }}" placeholder="e.g., bi-patch-check" required>
                    <small class="form-text text-muted">
                        Use Bootstrap Icons class names. See <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>
                    </small>
                    @error('icon')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Create Certification
                    </button>
                    <a href="{{ route('admin.certifications.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
