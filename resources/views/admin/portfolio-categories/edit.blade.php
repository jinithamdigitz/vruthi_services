@extends('layouts.admin')

@section('title', 'Edit Portfolio Category')

@section('content_header')
<h1><i class="fas fa-edit"></i> Edit Portfolio Category</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Category: {{ $portfolioCategory->name }}</h3>
        <div class="card-tools">
            <a href="{{ route('admin.portfolio-categories.index') }}" class="btn btn-default btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
    <form action="{{ route('admin.portfolio-categories.update', $portfolioCategory) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Category Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" value="{{ old('name', $portfolioCategory->name) }}" required>
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                    id="slug" name="slug" value="{{ old('slug', $portfolioCategory->slug) }}">
                <small class="form-text text-muted">Current: {{ $portfolioCategory->slug }}</small>
                @error('slug')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="keywords">SEO Keywords</label>
                <textarea class="form-control @error('keywords') is-invalid @enderror"
                    id="keywords" name="keywords" rows="3">{{ old('keywords', $portfolioCategory->keywords) }}</textarea>
                <small class="form-text text-muted">Comma separated keywords for SEO</small>
                @error('keywords')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('admin.portfolio-categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@stop