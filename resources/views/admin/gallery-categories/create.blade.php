@extends('layouts.admin')

@section('title', 'Create Gallery Category')

@section('content')

<style>
/* Fix Back to List button positioning */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    padding: 1rem 1.25rem;
}

.card-header h3.card-title {
    margin: 0;
    flex: 1;
}

.card-header .btn.float-right {
    float: none !important;
    margin: 0;
    white-space: nowrap;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .card-header .btn {
        align-self: flex-end;
    }
}

@media (max-width: 576px) {
    .card-header {
        padding: 0.75rem 1rem;
    }
    
    .card-header h3.card-title {
        font-size: 1.2rem;
    }
    
    .card-header .btn {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
    }
}

/* Ensure proper spacing in form actions */
.card-body .form-group:last-of-type {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    align-items: center;
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid #e3e6f0;
}

/* Button styling consistency */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn i {
    font-size: 0.875em;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create New Gallery Category</h3>
                    <a href="{{ route('admin.gallery-categories.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.gallery-categories.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Category Name *</label>
                                    <input type="text" name="name" id="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort_order">Sort Order</label>
                                    <input type="number" name="sort_order" id="sort_order" 
                                           class="form-control @error('sort_order') is-invalid @enderror" 
                                           value="{{ old('sort_order', 0) }}" min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_active" value="1" 
                                       class="custom-control-input" id="is_active" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">
                                    Active Category
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Category
                            </button>
                            <a href="{{ route('admin.gallery-categories.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection