@extends('layouts.admin')

@section('title', 'View Gallery Category')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gallery Category Details: {{ $galleryCategory->name }}</h3>
                    <a href="{{ route('admin.gallery-categories.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Name:</th>
                                    <td>{{ $galleryCategory->name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td>{{ $galleryCategory->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge badge-{{ $galleryCategory->is_active ? 'success' : 'danger' }}">
                                            {{ $galleryCategory->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Sort Order:</th>
                                    <td>{{ $galleryCategory->sort_order }}</td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $galleryCategory->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At:</th>
                                    <td>{{ $galleryCategory->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Description:</strong></label>
                                <p class="form-control-plaintext">
                                    {{ $galleryCategory->description ?: 'No description provided.' }}
                                </p>
                            </div>
                            
                            <div class="form-group">
                                <label><strong>Posts in this category:</strong></label>
                                <p class="form-control-plaintext">
                                    <span class="badge badge-info">{{ $galleryCategory->posts->count() }}</span> posts
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.gallery-categories.edit', $galleryCategory) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Category
                        </a>
                        <form action="{{ route('admin.gallery-categories.destroy', $galleryCategory) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="fas fa-trash"></i> Delete Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection