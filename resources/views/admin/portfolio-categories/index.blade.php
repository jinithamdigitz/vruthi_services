@extends('layouts.admin')

@section('title', 'Portfolio Categories')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-tags"></i> Portfolio Categories</h1>
        <a href="{{ route('admin.portfolio-categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Portfolio Categories</h3>
            <div class="card-tools">
                <form method="GET" action="{{ route('admin.portfolio-categories.index') }}">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="25%">Name</th>
                        <th width="20%">Slug</th>
                        <th width="20%">Portfolios</th>
                        <th width="30%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td><code>{{ $category->slug }}</code></td>
                        <td>
                            <span class="badge badge-{{ $category->portfolios->count() > 0 ? 'info' : 'secondary' }}">
                                {{ $category->portfolios->count() }}
                            </span>
                        </td>
                        <td>
                            {{-- View Button --}}
                            <a href="{{ route('admin.portfolio-categories.show', $category) }}" 
                               class="btn btn-sm btn-info" 
                               title="View Details"
                               style="display: inline-block; margin: 2px;">
                                <i class="fas fa-eye"></i> View
                            </a>
                            
                            {{-- Edit Button --}}
                            <a href="{{ route('admin.portfolio-categories.edit', $category) }}" 
                               class="btn btn-sm btn-warning" 
                               title="Edit Category"
                               style="display: inline-block; margin: 2px;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            
                            {{-- Delete Button --}}
                            <form action="{{ route('admin.portfolio-categories.destroy', $category) }}" 
                                  method="POST" 
                                  style="display: inline-block; margin: 2px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        title="Delete Category"
                                        onclick="return confirm('Are you sure you want to delete "{{ $category->name }}"?')"
                                        style="display: inline-block;">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="fas fa-tags fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted">No categories found.</p>
                            <a href="{{ route('admin.portfolio-categories.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Create First Category
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">
                    Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} entries
                </span>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@stop

@push('styles')
<style>
    /* Table styling */
    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
        background: #f8f9fa;
        vertical-align: middle;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    /* Badge styling */
    .badge {
        padding: 5px 10px;
        font-weight: 500;
        font-size: 12px;
    }
    
    /* Button styling - FIXED */
    .btn-sm {
        padding: 5px 14px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 4px;
        display: inline-block !important;
        margin: 2px !important;
        min-width: 60px;
        text-align: center;
        white-space: nowrap;
    }
    
    .btn-sm i {
        margin-right: 4px;
    }
    
    /* Individual button colors */
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: #ffffff;
    }
    
    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
        color: #ffffff;
    }
    
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }
    
    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        color: #212529;
    }
    
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #ffffff;
    }
    
    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
        color: #ffffff;
    }
    
    .btn-sm i {
        margin-right: 5px;
    }
    
    /* Actions column - ensure buttons are visible */
    .table td:last-child {
        min-width: 220px;
    }
    
    /* Alert styling */
    .alert {
        border-radius: 4px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .btn-sm {
            padding: 4px 8px;
            font-size: 10px;
            min-width: 40px;
        }
        
        .btn-sm i {
            margin-right: 2px;
        }
        
        .table td:last-child {
            min-width: 160px;
        }
    }
</style>
@endpush