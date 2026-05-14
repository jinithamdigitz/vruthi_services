@extends('layouts.admin')

@section('title', 'Project Categories')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Project Categories</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.project-categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Category
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Categories Table Card -->
    <div class="card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">All Categories</h5>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('admin.project-categories.index') }}" method="GET" class="d-flex justify-content-end">
                        <div class="input-group" style="width: 250px;">
                            <input type="text" name="search" class="form-control" placeholder="Search categories..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="50">ID</th>
                            <th width="80">Image</th>
                            <th>Name</th>
                            <th>Projects Count</th>
                            <th>Created</th>
                            <th>Last Updated</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>#{{ $category->id }}</td>
                            <td>
                                @if($category->image)
                                <img src="{{ asset($category->image) }}" 
                                     alt="{{ $category->name }}"
                                     class="rounded"
                                     width="50" 
                                     height="50"
                                     style="object-fit: cover;">
                                @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-folder text-secondary"></i>
                                </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $category->name }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $category->projects_count ?? $category->projects->count() }}</span>
                            </td>
                            <td>{{ $category->created_at->format('d M Y') }}</td>
                            <td>{{ $category->updated_at->diffForHumans() }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.project-categories.edit', $category->id) }}" 
                                       class="btn btn-sm btn-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.project-categories.destroy', $category->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3"></i>
                                    <h5>No Categories Found</h5>
                                    <p class="mb-3">Get started by creating your first project category.</p>
                                    <a href="{{ route('admin.project-categories.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Category
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($categories->hasPages())
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-end">
                {{ $categories->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush